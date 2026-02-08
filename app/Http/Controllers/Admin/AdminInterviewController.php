<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use Illuminate\Http\Request;

class AdminInterviewController extends Controller
{
    public function index()
    {
        $interviews = Interview::with(['user', 'job'])
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(15);

        $stats = [
            'total' => Interview::count(),
            'upcoming' => Interview::where('status', 'upcoming')->count(),
            'completed' => Interview::where('status', 'completed')->count(),
            'cancelled' => Interview::where('status', 'cancelled')->count(),
            'today' => Interview::whereDate('date', today())->count(),
            'this_week' => Interview::whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])->count()
        ];

        return view('admin.interviews.index', compact('interviews', 'stats'));
    }

    public function create()
    {
        return view('admin.interviews.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'job_id' => 'nullable|exists:job_postings,id',
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'type' => 'required|in:Video Call,Phone Call,In-Person',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:15|max:480',
            'meeting_link' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:upcoming,completed,cancelled,pending'
        ]);

        Interview::create($validated);

        return redirect()->route('admin.interviews.index')
            ->with('success', 'Interview scheduled successfully!');
    }

    public function show(Interview $interview)
    {
        $interview->load(['user', 'job']);
        return view('admin.interviews.show', compact('interview'));
    }

    public function edit(Interview $interview)
    {
        $interview->load(['user', 'job']);
        return view('admin.interviews.edit', compact('interview'));
    }

    public function update(Request $request, Interview $interview)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'job_id' => 'nullable|exists:job_postings,id',
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'type' => 'required|in:Video Call,Phone Call,In-Person',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:15|max:480',
            'meeting_link' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:upcoming,completed,cancelled,pending'
        ]);

        $interview->update($validated);

        return redirect()->route('admin.interviews.index')
            ->with('success', 'Interview updated successfully!');
    }

    public function destroy(Interview $interview)
    {
        $interview->delete();

        return redirect()->route('admin.interviews.index')
            ->with('success', 'Interview deleted successfully!');
    }
}
