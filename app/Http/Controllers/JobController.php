<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->where('is_active', true)->get();

        return view('jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
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
            'location' => 'nullable|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:100',
            'type' => 'required|in:Full-time,Part-time,Remote,Contract,Freelance',
            'experience_level' => 'nullable|string|max:100',
            'apply_url' => 'nullable|url',
            'email' => 'nullable|email',
        ]);

        $validated['user_id'] = auth()->id();
        Job::create($validated);

        return redirect()->route('jobs.index')
            ->with('success', 'Job posting created successfully!');
    }

    public function edit(Job $job)
    {
        $this->authorize('update', $job);

        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $this->authorize('update', $job);

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
        $this->authorize('delete', $job);
        $job->delete();

        return redirect()->route('jobs.index')
            ->with('success', 'Job posting deleted successfully!');
    }
}
