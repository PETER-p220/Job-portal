<?php

namespace App\Http\Controllers;

use App\Models\Job;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();

        return view('admin.dashboard', compact('jobs'));
    }
}
