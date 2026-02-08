<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function index()
    {
        // Mock interview data - in a real app, this would come from a database
        $interviews = [
            [
                'id' => 1,
                'job_title' => 'Senior Frontend Developer',
                'company' => 'Tech Corp',
                'type' => 'Video Call',
                'date' => '2026-02-08',
                'time' => '14:00',
                'duration' => '60',
                'status' => 'upcoming',
                'meeting_link' => 'https://zoom.us/j/123456789'
            ],
            [
                'id' => 2,
                'job_title' => 'Full Stack Engineer',
                'company' => 'StartupXYZ',
                'type' => 'Phone Call',
                'date' => '2026-02-10',
                'time' => '10:00',
                'duration' => '30',
                'status' => 'upcoming',
                'meeting_link' => 'tel:+1234567890'
            ],
            [
                'id' => 3,
                'job_title' => 'React Developer',
                'company' => 'Digital Agency',
                'type' => 'In-Person',
                'date' => '2026-02-15',
                'time' => '14:00',
                'duration' => '90',
                'status' => 'upcoming',
                'meeting_link' => '123 Main St, City, State'
            ]
        ];

        $stats = [
            'upcoming' => 3,
            'completed' => 12,
            'pending' => 2,
            'this_week' => 5
        ];

        return view('user.interviews.index', compact('interviews', 'stats'));
    }

    public function create()
    {
        return view('user.interviews.create');
    }

    public function store(Request $request)
    {
        // Validate and store interview
        $validated = $request->validate([
            'job_title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'type' => 'required|in:Video Call,Phone Call,In-Person',
            'date' => 'required|date',
            'time' => 'required|string',
            'duration' => 'required|integer',
            'meeting_link' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        // In a real app, save to database
        // Interview::create($validated + ['user_id' => auth()->id()]);

        return redirect()->route('interviews.index')
            ->with('success', 'Interview scheduled successfully!');
    }
}
