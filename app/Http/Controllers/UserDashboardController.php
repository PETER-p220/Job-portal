<?php

namespace App\Http\Controllers;

class UserDashboardController extends Controller
{
    public function index()
    {
        $jobs = auth()->user()->jobs()->latest()->get();

        return view('user.dashboard', compact('jobs'));
    }
}
