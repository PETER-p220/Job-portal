@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="flex flex-col h-full">
            <!-- Logo Section -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-600 rounded-lg p-2">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">My Dashboard</h2>
                        <p class="text-xs text-gray-500">{{ auth()->user()->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1 1v10a1 1 0 001 1h6a1 1 0 001-1V10a1 1 0 00-1-1h-6z"></path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('jobs.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                    </svg>
                    <span class="font-medium">Browse Jobs</span>
                </a>

                <a href="{{ route('jobs.create') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="font-medium">Post Job</span>
                </a>

                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span class="font-medium">Applications</span>
                </a>

                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-medium">Interviews</span>
                </a>

                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2V10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2V14a2 2 0 01-2 2h-2A2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="font-medium">Analytics</span>
                </a>

                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-2.572 1.065c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c.94-1.543-.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="font-medium">Settings</span>
                </a>
            </nav>

            <!-- User Section -->
            <div class="p-4 border-t border-gray-200">
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium">Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-red-600 rounded-lg hover:bg-red-50 transition-colors">
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
        <div class="p-8">
            <!-- Welcome Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="mt-2 text-gray-600">Manage your job postings and track your applications</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-lg p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Your Jobs</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $jobs->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-lg p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Active Jobs</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $jobs->where('is_active', true)->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-lg p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1A3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Profile Views</p>
                            <p class="text-2xl font-bold text-gray-900">247</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500 rounded-lg p-3">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Applications</p>
                            <p class="text-2xl font-bold text-gray-900">18</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Quick Actions</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('jobs.create') }}" class="inline-flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Post New Job
                        </a>
                        <a href="{{ route('jobs.index') }}" class="inline-flex items-center justify-center px-4 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Browse Jobs
                        </a>
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center justify-center px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <!-- Your Job Postings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Your Job Postings</h2>
                    <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Add New
                    </a>
                </div>
                <div class="overflow-hidden">
                    @forelse ($jobs as $job)
                        <div class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center">
                                            <h3 class="text-lg font-medium text-gray-900">
                                                <a href="{{ route('jobs.show', $job) }}" class="hover:text-blue-600">
                                                    {{ $job->title }}
                                                </a>
                                            </h3>
                                            <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ 
                                                $job->type == 'Full-time' ? 'bg-green-100 text-green-800' :
                                                ($job->type == 'Part-time' ? 'bg-yellow-100 text-yellow-800' :
                                                ($job->type == 'Remote' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800')
                                            }}">
                                                {{ $job->type }}
                                            </span>
                                            @if($job->is_active)
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Active
                                                </span>
                                            @else
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    Inactive
                                                </span>
                                            @endif
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <span class="font-medium">{{ $job->company }}</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ $job->location ?? 'Remote' }}</span>
                                            @if($job->salary)
                                                <span class="mx-2">•</span>
                                                <span class="text-green-600 font-medium">{{ $job->salary }}</span>
                                            @endif
                                        </div>
                                        <div class="mt-1 text-sm text-gray-400">
                                            Posted {{ $job->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('jobs.edit', $job) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                            Edit
                                        </a>
                                        <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium" onclick="return confirm('Are you sure you want to delete this job posting?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-6 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No job postings yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by posting your first job opportunity.</p>
                            <div class="mt-6">
                                <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Post Your First Job
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
