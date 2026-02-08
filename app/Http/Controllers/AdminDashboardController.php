<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get statistics for dashboard
        $totalJobs = Job::count();
        $activeJobs = Job::where('is_active', true)->count();
        $pendingJobs = Job::where('is_active', false)->count();
        $totalUsers = User::count();
        
        // Interview statistics
        $totalInterviews = Interview::count();
        $upcomingInterviews = Interview::where('status', 'upcoming')->count();
        $todayInterviews = Interview::whereDate('date', today())->count();
        $completedInterviews = Interview::where('status', 'completed')->count();
        
        // Get recent jobs for table
        $recentJobs = Job::latest()->take(10)->get();
        
        // Get recent interviews for table
        $recentInterviews = Interview::with(['user', 'job'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalJobs', 
            'activeJobs', 
            'pendingJobs', 
            'totalUsers',
            'totalInterviews',
            'upcomingInterviews', 
            'todayInterviews',
            'completedInterviews',
            'recentJobs', 
            'recentInterviews'
        ));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        // validation + store logic here (similar to your existing JobController@store)
        // ...
        return redirect()->route('admin.jobs.index')->with('success', 'Job created.');
    }

    public function show(Job $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
       
        return redirect()->route('admin.jobs.index')->with('success', 'Job updated.');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted.');
    }
}