@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
<div class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg flex-shrink-0">
        <div class="flex flex-col h-full">
            <!-- Brand / Logo -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="bg-indigo-600 rounded-lg p-2">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Job Portal</h2>
                        <p class="text-xs text-gray-500">{{ auth()->user()->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto">
                <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1 1v10a1 1 0 001 1h6a1 1 0 001-1V10a1 1 0 00-1-1h-6z"></path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('jobs.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="font-medium">Find Jobs</span>
                </a>

                <a href="{{ route('user.applications') }}" class="flex items-center space-x-3 px-4 py-3 text-indigo-700 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="font-medium">My Applications</span>
                </a>

                <a href="{{ route('user.saved-jobs') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                    <span class="font-medium">Saved Jobs</span>
                </a>

                <a href="{{ route('user.interviews.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2 2h-10a2 2 0 002 2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span class="font-medium">Interviews</span>
                </a>

                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium">My Profile</span>
                </a>
            </nav>

            <!-- Logout -->
            <div class="p-4 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-3 px-4 py-3 text-red-600 rounded-lg hover:bg-red-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        <div class="p-6 md:p-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">My Applications</h1>
            <p class="text-gray-600 mb-8">Track the status of all your job applications</p>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 divide-y divide-gray-200">
                @forelse (range(1,5) as $i)
                    <div class="px-6 py-5 hover:bg-gray-50 transition-colors">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Senior Frontend Developer</h3>
                                <p class="text-gray-600">TechNova Solutions • Remote</p>
                                <div class="mt-2 flex flex-wrap gap-3 text-sm text-gray-500">
                                    <span>Applied 3 days ago</span>
                                    <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Under Review
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-16 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No applications yet</h3>
                        <p class="mt-2 text-gray-500">When you apply to jobs, they'll appear here.</p>
                        <a href="{{ route('jobs.index') }}" class="mt-6 inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Browse Jobs
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

</div>
@endsection