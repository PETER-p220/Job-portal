<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function index()
    {
        $query = Interview::with(['user', 'job'])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc');

        // Apply filters
        if (request('application_method')) {
            $query->where('application_method', request('application_method'));
        }

        if (request('search')) {
            $query->where(function($q) use ($request) {
                $q->where('job_title', 'like', '%' . $request('search') . '%')
                  ->orWhere('company', 'like', '%' . $request('search') . '%');
            });
        }

        $interviews = $query->paginate(12);

        $stats = [
            'total' => Interview::count(),
            'upcoming' => Interview::where('status', 'upcoming')->count(),
            'completed' => Interview::where('status', 'completed')->count(),
            'pending' => Interview::where('status', 'pending')->count(),
            'this_week' => Interview::whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])->count()
        ];

        return view('user.interviews.index', compact('interviews', 'stats'));
    }

    public function create()
    {
        return view('user.interviews.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'company_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'meeting_link' => 'required|string|max:500',
            'status' => 'required|in:upcoming,completed,cancelled,pending',
            'notes' => 'nullable|string|max:1000'
        ]);

        // Handle company image upload
        if ($request->hasFile('company_image')) {
            $image = $request->file('company_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/company-images'), $imageName);
            $validated['company_image'] = 'uploads/company-images/' . $imageName;
        }

        $interview = new Interview();
        $interview->user_id = auth()->id();
        $interview->fill($validated);
        $interview->status = 'upcoming';
        $interview->duration = 60; // Default 60 minutes
        $interview->save();

        return redirect()->route('user.interviews')
            ->with('success', 'Interview scheduled successfully!');
    }

    public function edit(Interview $interview)
    {
        return view('user.interviews.edit', compact('interview'));
    }

    public function show(Interview $interview)
    {
        return view('user.interviews.show', compact('interview'));
    }

    public function update(Request $request, Interview $interview)
    {
        $validated = $request->validate([
            'job_id' => 'nullable|exists:job_postings,id',
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'type' => 'required|in:Video Call,Phone Call,In-Person',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:15|max:480',
            'meeting_link' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:upcoming,completed,cancelled,pending'
        ]);

        $interview->update($validated);

        return redirect()->route('user.interviews')
            ->with('success', 'Interview updated successfully!');
    }

    public function destroy(Interview $interview)
    {
        $interview->delete();

        return redirect()->route('user.interviews')
            ->with('success', 'Interview cancelled successfully!');
    }
}
