@extends('layouts.app')

@section('title', 'Latest Jobs')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Latest Job Opportunities</h1>
                <p class="mt-2 text-gray-600">Discover your next career move</p>
            </div>
            @if(auth()->check())
                <a href="{{ route('jobs.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Post a New Job
                </a>
            @endif
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg shadow mb-6 p-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" placeholder="Search jobs..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Job Type</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Types</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Remote">Remote</option>
                        <option value="Contract">Contract</option>
                        <option value="Freelance">Freelance</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <input type="text" placeholder="City or Remote" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="flex items-end">
                    <button class="w-full px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                        Search Jobs
                    </button>
                </div>
            </div>
        </div>

        <!-- Job Listings -->
        <div class="space-y-6">
            @forelse ($jobs as $job)
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center">
                                <h3 class="text-xl font-semibold text-gray-900">
                                    <a href="{{ route('jobs.show', $job) }}" class="hover:text-indigo-600 transition-colors">
                                        {{ $job->title }}
                                    </a>
                                </h3>
                                <span class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    @if($job->type == 'Full-time') bg-green-100 text-green-800
                                    @elseif($job->type == 'Part-time') bg-yellow-100 text-yellow-800
                                    @elseif($job->type == 'Remote') bg-blue-100 text-blue-800
                                    @elseif($job->type == 'Contract') bg-purple-100 text-purple-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $job->type }}
                                </span>
                            </div>
                            
                            <div class="mt-2 flex items-center text-gray-600">
                                <span class="font-medium text-gray-900">{{ $job->company }}</span>
                                @if($job->location)
                                    <span class="mx-2">•</span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $job->location }}
                                    </span>
                                @endif
                            </div>

                            @if($job->salary)
                                <div class="mt-2 text-green-600 font-medium">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $job->salary }}
                                </div>
                            @endif

                            @if($job->experience_level)
                                <div class="mt-2 text-sm text-gray-500">
                                    <span class="inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $job->experience_level }}
                                    </span>
                                </div>
                            @endif

                            <div class="mt-3 text-sm text-gray-500">
                                Posted {{ $job->created_at->diffForHumans() }} 
                                @if($job->user)
                                    by {{ $job->user->name }}
                                @endif
                            </div>
                        </div>

                        <div class="ml-4 flex-shrink-0">
                            <a href="{{ route('jobs.show', $job) }}"
                               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors">
                                View Details
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">No jobs posted yet</h3>
                    <p class="mt-1 text-gray-500">Be the first to post a job opportunity!</p>
                    @if(auth()->check())
                        <div class="mt-6">
                            <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Post the First Job
                            </a>
                        </div>
                    @endif
                </div>
            @endforelse
        </div>
    </div>
@endsection