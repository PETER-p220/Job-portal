@extends('user.layout')

@section('title', 'My Dashboard')

@section('content')
<div class="p-6 lg:p-10 max-w-7xl mx-auto">
    <!-- Welcome / Header -->
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="mt-2 text-lg text-gray-600">
            Manage your job search, applications, saved jobs, and interviews from here.
        </p>
    </div>

    <!-- Quick Stats Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow transition">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-orange-500 rounded-lg p-3">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Applications</p>
                    <p class="text-2xl font-bold text-gray-900">8</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow transition">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-500 rounded-lg p-3">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Upcoming Interviews</p>
                    <p class="text-2xl font-bold text-gray-900">2</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow transition">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-500 rounded-lg p-3">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Saved Jobs</p>
                    <p class="text-2xl font-bold text-gray-900">15</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow transition">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-500 rounded-lg p-3">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Profile Strength</p>
                    <p class="text-2xl font-bold text-gray-900">78%</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-12">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Quick Actions</h2>
        </div>
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <a href="{{ route('jobs.index') }}"
               class="flex items-center justify-center px-6 py-5 bg-orange-600 text-white rounded-xl hover:bg-orange-700 transition font-medium shadow-sm">
                Browse New Jobs
            </a>

            <a href="{{ route('user.applications') }}"
               class="flex items-center justify-center px-6 py-5 bg-green-600 text-white rounded-xl hover:bg-green-700 transition font-medium shadow-sm">
                Check Applications
            </a>

            <a href="{{ route('user.saved-jobs') }}"
               class="flex items-center justify-center px-6 py-5 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition font-medium shadow-sm">
                View Saved Jobs
            </a>

        </div>
    </div>

    <!-- Recommended Jobs -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-12">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Recommended Jobs</h2>
            <p class="text-sm text-gray-600 mt-1">Based on your profile and recent activity</p>
        </div>
        <div class="p-6">
            @php
                $recommendedJobs = \App\Models\Job::where('is_active', true)
                    ->whereNotIn('id', function($query) {
                        $query->select('job_id')
                              ->from('saved_jobs')
                              ->where('user_id', auth()->id());
                    })
                    ->whereNotIn('id', function($query) {
                        $query->select('job_id')
                              ->from('applications')
                              ->where('user_id', auth()->id());
                    })
                    ->inRandomOrder()
                    ->limit(3)
                    ->get();
                    
                // Debug: Log the jobs we found
                \Log::info('Recommended jobs found: ' . $recommendedJobs->count());
                foreach($recommendedJobs as $job) {
                    \Log::info('Job: ' . $job->title . ' (ID: ' . $job->id . ')');
                    \Log::info('Route: ' . route('jobs.show', $job));
                }
            @endphp

            @if($recommendedJobs->count() > 0)
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($recommendedJobs as $job)
                        <div class="border border-gray-200 rounded-xl p-5 hover:shadow-lg hover:border-orange-200 transition-all duration-200">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1 line-clamp-2">
                                        <a href="{{ route('jobs.show', $job) }}" class="hover:text-orange-600 transition-colors">
                                            {{ $job->title }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 font-medium">{{ $job->company }}</p>
                                </div>
                                <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full shadow-sm
                                    {{ match($job->type) {
                                        'Full-time' => 'bg-green-100 text-green-800 border border-green-200',
                                        'Part-time' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                        'Remote'    => 'bg-blue-100 text-blue-800 border border-blue-200',
                                        'Contract'  => 'bg-purple-100 text-purple-800 border border-purple-200',
                                        'Freelance' => 'bg-pink-100 text-pink-800 border border-pink-200',
                                        default     => 'bg-orange-100 text-orange-800 border border-orange-200'
                                    } }}">
                                    {{ $job->type }}
                                </span>
                            </div>
                            
                            <div class="space-y-2 text-sm text-gray-600 mb-4">
                                @if($job->location)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $job->location }}
                                    </div>
                                @endif
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Posted {{ $job->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ url('/jobs/' . $job->id) }}" 
                                   class="flex-1 text-center px-4 py-2 bg-orange-600 text-white text-sm font-medium rounded-lg hover:bg-orange-700 transition">
                                    View Details
                                </a>
                                <form action="{{ route('user.saved-jobs.save', $job) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition"
                                            onclick="if(this.form.submitted) return false; this.form.submitted = true;">
                                        Save
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('jobs.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-colors">
                        View All Jobs
                    </a>
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No new recommendations</h3>
                    <p class="text-gray-600 mb-4">Check back later for new job opportunities</p>
                    <a href="{{ route('jobs.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-colors">
                        Browse All Jobs
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Activity Placeholder -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
        </div>
        <div class="p-8 text-center text-gray-600">
            <p class="mb-4">Your recent applications, saved jobs, and upcoming interviews will appear here.</p>
            <a href="{{ route('jobs.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors">
                Start Exploring Jobs
            </a>
        </div>
    </div>
</div>
@endsection