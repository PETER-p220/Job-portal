<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $totalJobs = Job::count();
        $activeJobs = Job::where('is_active', true)->count();
        $totalUsers = User::count();
        $adminUsers = User::where('role', 'admin')->count();
        
        // Get job statistics by type
        $jobsByType = Job::selectRaw('type, count(*) as count')
            ->groupBy('type')
            ->get();
        
        // Get user registration by month
        $usersByMonth = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();
        
        // Get recent activity
        $recentJobs = Job::with('user')->latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.reports.index', compact(
            'totalJobs', 
            'activeJobs', 
            'totalUsers', 
            'adminUsers',
            'jobsByType',
            'usersByMonth',
            'recentJobs',
            'recentUsers'
        ));
    }
}
