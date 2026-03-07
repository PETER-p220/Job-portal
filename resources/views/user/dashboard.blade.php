@extends('user.layout')

@section('title', 'My Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        <!-- Welcome / Header -->
        <div class="mb-6 sm:mb-10">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900">Welcome, {{ auth()->user()->name }}!</h1>
            <p class="mt-1.5 sm:mt-2 text-base sm:text-lg text-gray-600">
                Manage your job search, applications, saved jobs, and interviews.
            </p>
        </div>

        <!-- Quick Stats Overview -->
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8 sm:mb-12">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-orange-500 rounded-lg p-2.5 sm:p-3">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm font-medium text-gray-500">Applications</p>
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $appliedJobsCount }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-lg p-2.5 sm:p-3">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm font-medium text-gray-500">Upcoming Interviews</p>
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $upcomingInterviewsCount }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-lg p-2.5 sm:p-3">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm font-medium text-gray-500">Saved Jobs</p>
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $savedJobsCount }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 rounded-lg p-2.5 sm:p-3">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm font-medium text-gray-500">Profile Strength</p>
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $profileStrength }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- AdSense Ad -->
        <div class="my-8 border-t border-gray-200 pt-8">
            <x-adsense slot="XXXXXXXXXX" format="auto" class="mb-8" />
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 sm:mb-12">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                <h2 class="text-base sm:text-lg font-semibold text-gray-900">Quick Actions</h2>
            </div>
            <div class="p-4 sm:p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <a href="{{ route('jobs.index') }}"
                   class="flex items-center justify-center px-5 py-4 bg-orange-600 text-white rounded-xl hover:bg-orange-700 transition font-medium shadow-sm text-sm sm:text-base">
                    Browse New Jobs
                </a>

                <a href="{{ route('user.applications') }}"
                   class="flex items-center justify-center px-5 py-4 bg-green-600 text-white rounded-xl hover:bg-green-700 transition font-medium shadow-sm text-sm sm:text-base">
                    Check Applications
                </a>

                <a href="{{ route('user.saved-jobs') }}"
                   class="flex items-center justify-center px-5 py-4 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition font-medium shadow-sm text-sm sm:text-base">
                    View Saved Jobs
                </a>
            </div>
        </div>

        <!-- Recommended Jobs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 sm:mb-12">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                <h2 class="text-base sm:text-lg font-semibold text-gray-900">Recommended Jobs</h2>
                <p class="text-xs sm:text-sm text-gray-600 mt-0.5">Based on your profile and recent activity</p>
            </div>
            <div class="p-4 sm:p-6">
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
                @endphp

                @if($recommendedJobs->count() > 0)
                    <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($recommendedJobs as $job)
                            <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md hover:border-orange-200 transition-all duration-200 flex flex-col">
                                <div class="flex-1">
                                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-1 line-clamp-2">
                                        <a href="{{ route('jobs.show', $job) }}" class="hover:text-orange-600 transition-colors">
                                            {{ $job->title }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 font-medium text-sm mb-2">{{ $job->company }}</p>

                                    <span class="inline-flex px-2.5 py-1 text-xs font-bold rounded-full
                                        {{ match($job->type) {
                                            'Full-time' => 'bg-green-100 text-green-800',
                                            'Part-time' => 'bg-yellow-100 text-yellow-800',
                                            'Remote'    => 'bg-blue-100 text-blue-800',
                                            'Contract'  => 'bg-purple-100 text-purple-800',
                                            'Freelance' => 'bg-pink-100 text-pink-800',
                                            default     => 'bg-orange-100 text-orange-800'
                                        } }}">
                                        {{ $job->type }}
                                    </span>
                                </div>

                                <div class="mt-3 space-y-1.5 text-xs sm:text-sm text-gray-600">
                                    @if($job->location)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            <span>{{ $job->location }}</span>
                                        </div>
                                    @endif
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>Posted {{ $job->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                <div class="mt-4 flex gap-3">
                                    <a href="{{ route('jobs.show', $job) }}"
                                       class="flex-1 text-center px-4 py-2.5 bg-orange-600 text-white text-sm font-medium rounded-lg hover:bg-orange-700 transition">
                                        View Details
                                    </a>
                                    <form action="{{ route('user.saved-jobs.save', $job) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="px-4 py-2.5 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition"
                                                onclick="if(this.form.submitted) return false; this.form.submitted = true;">
                                            Save
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 sm:mt-8 text-center">
                        <a href="{{ route('jobs.index') }}"
                           class="inline-flex items-center px-6 py-3 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-colors text-sm sm:text-base">
                            View All Jobs
                        </a>
                    </div>
                @else
                    <div class="text-center py-10 sm:py-12">
                        <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2">No new recommendations</h3>
                        <p class="text-sm text-gray-600 mb-4">Check back later for new job opportunities</p>
                        <a href="{{ route('jobs.index') }}"
                           class="inline-flex items-center px-6 py-3 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-colors text-sm sm:text-base">
                            Browse All Jobs
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
                <h2 class="text-base sm:text-lg font-semibold text-gray-900">Recent Activity</h2>
            </div>
            <div class="p-4 sm:p-6">
                @if($recentInterviews->count() > 0 || $recentApplications->count() > 0)
                    <div class="space-y-6">
                        <!-- Recent Interviews -->
                        @if($recentInterviews->count() > 0)
                            <div class="mb-6">
                                <h3 class="text-sm font-semibold text-gray-700 mb-3">Recent Interviews</h3>
                                <div class="space-y-3">
                                    @foreach($recentInterviews as $interview)
                                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-200">
                                            <div class="flex-1">
                                                <div class="flex items-center">
                                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">{{ $interview->job_title }}</p>
                                                        <p class="text-xs text-gray-600">{{ $interview->company }}</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-xs text-gray-500">{{ $interview->date->format('M j') }}</p>
                                                    <p class="text-xs text-gray-500">{{ $interview->time->format('g:i A') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Recent Applications -->
                        @if($recentApplications->count() > 0)
                            <div>
                                <h3 class="text-sm font-semibold text-gray-700 mb-3">Recent Applications</h3>
                                <div class="space-y-3">
                                    @foreach($recentApplications as $application)
                                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg border border-blue-200">
                                            <div class="flex-1">
                                                <div class="flex items-center">
                                                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-900">{{ $application->job->title }}</p>
                                                        <p class="text-xs text-gray-600">{{ $application->job->company }}</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-xs text-gray-500">{{ $application->created_at->format('M j') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-10 sm:py-12">
                        <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2">No recent activity</h3>
                        <p class="text-sm text-gray-600 mb-4">Start applying to jobs and scheduling interviews to see your activity here.</p>
                        <a href="{{ route('jobs.index') }}"
                           class="inline-flex items-center px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors text-sm sm:text-base">
                            Browse Jobs
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection