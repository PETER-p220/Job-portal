<?php

namespace App\Http\Controllers;

class UserDashboardController extends Controller
{
    public function index()
    {
        $jobs = auth()->user()->jobs()->latest()->get();

        return view('user.dashboard', compact('jobs'));
    }
    public function applications()
{
    // $applications = auth()->user()->applications()->with('job')->latest()->get();
    return view('user.applications');
}

public function savedJobs()
{
    // $savedJobs = auth()->user()->savedJobs()->latest()->get();
    return view('user.saved-jobs');
}

public function interviews()
{
    // $interviews = auth()->user()->interviews()->with('job')->where('date_time', '>', now())->get();
    return view('user.interviews');
}
}
