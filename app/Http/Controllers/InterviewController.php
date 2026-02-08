<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function index()
    {
        $interviews = Interview::where('user_id', auth()->id())
            ->with('job')
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get();

        $stats = [
            'upcoming' => Interview::where('user_id', auth()->id())->where('status', 'upcoming')->count(),
            'completed' => Interview::where('user_id', auth()->id())->where('status', 'completed')->count(),
            'pending' => Interview::where('user_id', auth()->id())->where('status', 'pending')->count(),
            'this_week' => Interview::where('user_id', auth()->id())
                ->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()])
                ->count()
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
            'job_id' => 'nullable|exists:job_postings,id',
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'type' => 'required|in:Video Call,Phone Call,In-Person',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:15|max:480',
            'meeting_link' => 'required|string|max:500',
            'notes' => 'nullable|string|max:1000'
        ]);

        Interview::create($validated + [
            'user_id' => auth()->id(),
            'status' => 'upcoming'
        ]);

        return redirect()->route('user.interviews')
            ->with('success', 'Interview scheduled successfully!');
    }

    public function edit(Interview $interview)
    {
        if ($interview->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.interviews.edit', compact('interview'));
    }

    public function update(Request $request, Interview $interview)
    {
        if ($interview->user_id !== auth()->id()) {
            abort(403);
        }

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
        if ($interview->user_id !== auth()->id()) {
            abort(403);
        }

        $interview->delete();

        return redirect()->route('user.interviews')
            ->with('success', 'Interview cancelled successfully!');
    }
}
