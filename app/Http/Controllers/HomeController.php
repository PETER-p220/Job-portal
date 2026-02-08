<?php

namespace App\Http\Controllers;

use App\Models\Job;

class HomeController extends Controller
{
    public function index()
    {
        $featuredJobs = Job::where('is_active', true)
            ->with('user')
            ->latest()
            ->take(6)
            ->get();
            
        return view('welcome', compact('featuredJobs'));
    }
}
