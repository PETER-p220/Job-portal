<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Interview;

class HomeController extends Controller
{
    public function index()
    {
        $featuredJobs = Job::where('is_active', true)
            ->with('user')
            ->latest()
            ->take(6)
            ->get();
            
        $featuredInterviews = Interview::where('status', 'upcoming')
            ->with('user', 'job')
            ->orderBy('date', 'asc')
            ->take(6)
            ->get();
            
        return view('welcome', compact('featuredJobs', 'featuredInterviews'));
    }
}
