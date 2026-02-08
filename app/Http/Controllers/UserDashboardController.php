<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Interview;
use App\Models\Job;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get user's job postings
        $jobs = $user->jobs()->latest()->get();
        
        // Get statistics using relationships
        $appliedJobsCount = $user->applications()->count();
        $interviewsCount = $user->interviews()->count();
        $savedJobsCount = $user->savedJobs()->count();
        $upcomingInterviewsCount = $user->interviews()
                                      ->where('date', '>=', now())
                                      ->count();
        
        // Get recent interviews
        $recentInterviews = $user->interviews()
                                 ->with('job')
                                 ->latest()
                                 ->take(5)
                                 ->get();
        
        // Get recent applications
        $recentApplications = $user->applications()
                                    ->with('job')
                                    ->latest()
                                    ->take(5)
                                    ->get();

        return view('user.dashboard', compact(
            'jobs',
            'appliedJobsCount',
            'interviewsCount', 
            'savedJobsCount',
            'upcomingInterviewsCount',
            'recentInterviews',
            'recentApplications'
        ));
    }

    public function applications()
    {
        $applications = auth()->user()->applications()->with('job')->latest()->get();
        return view('user.applications', compact('applications'));
    }

    public function savedJobs()
    {
        $user = auth()->user();
        $savedJobs = $user->savedJobs()->with('company')->latest()->get();
        
        return view('user.saved-jobs', compact('savedJobs'));
    }

    public function saveJob(Job $job)
    {
        $user = auth()->user();
        
        // Check if already saved
        if ($user->savedJobs()->where('job_id', $job->id)->exists()) {
            return redirect()->back()->with('info', 'Job already saved!');
        }
        
        // Save the job
        $user->savedJobs()->attach($job->id);
        
        return redirect()->back()->with('success', 'Job saved successfully!');
    }

    public function removeSavedJob(Job $job)
    {
        $user = auth()->user();
        
        // Remove the saved job
        $user->savedJobs()->detach($job->id);
        
        return redirect()->route('user.saved-jobs')->with('success', 'Job removed from saved!');
    }

    public function interviews()
    {
        $user = auth()->user();
        
        $interviews = $user->interviews()->with('job')->latest()->get();
        
        $interviewsCount = $interviews->count();
        $upcomingInterviewsCount = $user->interviews()
                                      ->where('date', '>=', now())
                                      ->count();
        $completedInterviewsCount = $user->interviews()
                                        ->where('status', 'completed')
                                        ->count();
        $cancelledInterviewsCount = $user->interviews()
                                        ->where('status', 'cancelled')
                                        ->count();

        return view('user.interviews', compact(
            'interviews',
            'interviewsCount',
            'upcomingInterviewsCount', 
            'completedInterviewsCount',
            'cancelledInterviewsCount'
        ));
    }
}
