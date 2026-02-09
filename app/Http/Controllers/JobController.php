<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::active()->latest(); // only active jobs (not expired)

        // Keyword search (title, company, description)
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by job type
        if ($request->filled('type') && in_array($request->type, ['Full-time', 'Part-time', 'Remote', 'Contract', 'Freelance'])) {
            $query->where('type', $request->type);
        }

        // Filter by experience level
        if ($request->filled('experience') && in_array($request->experience, ['Entry Level', 'Mid Level', 'Senior Level', 'Executive'])) {
            $query->where('experience_level', $request->experience);
        }

        // Filter by application method
        if ($request->filled('application_method') && in_array($request->application_method, ['email', 'whatsapp', 'external_site', 'phone'])) {
            $query->where('application_method', $request->application_method);
        }

        // Optional: You can add location filter later if you want
        // if ($request->filled('location')) {
        //     $query->where('location', 'like', "%{$request->location}%");
        // }

        // Get paginated results (12 per page is good balance)
        $jobs = $query->paginate(12)->appends($request->query());

        return view('jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        // Check if job is expired
        if ($job->isExpired()) {
            return redirect()->route('jobs.index')
                ->with('error', 'This job posting has expired and is no longer available.');
        }

        return view('jobs.show', compact('job'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:100',
            'type' => 'required|in:Full-time,Part-time,Remote,Contract,Freelance',
            'experience_level' => 'nullable|string|max:100',
            'deadline' => 'required|date|after:today',
            'apply_url' => 'required|url',
            'email' => 'nullable|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['user_id'] = auth()->id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/jobs'), $imageName);
            $validated['image'] = $imageName;
        }

        Job::create($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Job posting created successfully!');
    }

    public function edit(Job $job)
    {
        // Simple ownership check - user can only edit their own jobs
        if (auth()->id() !== $job->user_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        // Simple ownership check - user can only update their own jobs
        if (auth()->id() !== $job->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:100',
            'type' => 'required|in:Full-time,Part-time,Remote,Contract,Freelance',
            'experience_level' => 'nullable|string|max:100',
            'apply_url' => 'nullable|url',
            'email' => 'nullable|email',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job posting updated successfully!');
    }

    public function destroy(Job $job)
    {
        // Simple ownership check - user can only delete their own jobs
        if (auth()->id() !== $job->user_id) {
            abort(403, 'Unauthorized action.');
        }
        
        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Job posting deleted successfully!');
    }
}
