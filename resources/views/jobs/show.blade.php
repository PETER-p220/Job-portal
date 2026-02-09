@extends('user.layout')

@section('title', $job->title . ' | ' . $job->company)

@section('content')
<div class="min-h-screen bg-gray-50 py-8 md:py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li>
                    <a href="{{ route('jobs.index') }}" class="text-gray-500 hover:text-orange-600 transition">
                        Jobs
                    </a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium text-gray-700 truncate max-w-xs">{{ $job->title }}</span>
                </li>
            </ol>
        </nav>

        <!-- Main Job Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Header with Image/Logo & Title -->
            <div class="bg-gradient-to-r from-orange-600 to-orange-500 px-8 py-10 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex items-center space-x-5">
                        <!-- Company Logo / Placeholder -->
                        @if($job->image)
                            <div class="w-20 h-20 md:w-24 md:h-24 bg-white rounded-xl p-2 flex-shrink-0 shadow-md">
                                <img src="{{ asset('uploads/jobs/' . $job->image) }}" 
                                     alt="{{ $job->company }} logo" 
                                     class="w-full h-full object-contain rounded-lg">
                            </div>
                        @else
                            <div class="w-20 h-20 md:w-24 md:h-24 bg-white bg-opacity-20 rounded-xl p-3 flex-shrink-0 flex items-center justify-center shadow-md">
                                <svg class="w-12 h-12 text-white opacity-90" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                </svg>
                            </div>
                        @endif

                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold mb-2 drop-shadow-md">
                                {{ $job->title }}
                            </h1>
                            <p class="text-xl md:text-2xl text-orange-100 font-medium">
                                {{ $job->company }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3 self-start md:self-center">
                        <span class="px-5 py-2 text-sm font-semibold rounded-full bg-white bg-opacity-25 backdrop-blur-sm">
                            {{ $job->type }}
                        </span>

                        @if($job->is_active)
                            <span class="px-5 py-2 text-sm font-semibold rounded-full bg-green-600/80 backdrop-blur-sm">
                                Active
                            </span>
                        @else
                            <span class="px-5 py-2 text-sm font-semibold rounded-full bg-red-600/80 backdrop-blur-sm">
                                Inactive
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Job Meta Info -->
            <div class="px-6 md:px-10 py-8 border-b border-gray-100 bg-gray-50">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Location</p>
                            <p class="font-medium text-gray-900">{{ $job->location ?: 'Remote / Worldwide' }}</p>
                        </div>
                    </div>

                    @if($job->experience_level)
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Experience</p>
                            <p class="font-medium text-gray-900">{{ $job->experience_level }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Posted</p>
                            <p class="font-medium text-gray-900">{{ $job->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    @if($job->user)
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Posted by</p>
                            <p class="font-medium text-gray-900">{{ $job->user->name }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Main Content -->
            <div class="p-6 md:p-10">
                <!-- Description -->
                <div class="mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Job Description</h2>
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>

                <!-- How to Apply -->
                <div class="bg-orange-50 rounded-2xl p-8 border border-orange-100">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">How to Apply</h2>

                    <div class="space-y-6">
                        @if($job->apply_url)
                            <div>
                                <p class="text-gray-700 text-lg mb-4">
                                    Apply directly through the company's official application page:
                                </p>
                                <a href="{{ $job->apply_url }}" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex items-center px-8 py-4 bg-orange-600 text-white text-lg font-semibold rounded-xl hover:bg-orange-700 transition-all shadow-md">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Apply Now (External Link)
                                </a>
                            </div>
                        @endif

                        @if($job->email)
                            <div>
                                <p class="text-gray-700 text-lg mb-4">
                                    Or send your resume and cover letter directly via email:
                                </p>
                                <a href="mailto:{{ $job->email }}" 
                                   class="inline-flex items-center px-8 py-4 bg-white text-orange-700 border-2 border-orange-600 text-lg font-semibold rounded-xl hover:bg-orange-50 transition-all">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Email Application to {{ $job->email }}
                                </a>
                            </div>
                        @endif

                        @if(!$job->apply_url && !$job->email)
                            <p class="text-gray-600 text-lg italic">
                                No application method specified. Please contact the employer directly.
                            </p>
                        @endif

                        <!-- Save Job Button -->
                        @if(auth()->check() && !auth()->user()->isAdmin())
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <form action="{{ route('user.saved-jobs.save', $job) }}" method="POST" onsubmit="this.querySelector('button').disabled = true; this.querySelector('button').innerHTML = 'Saving...';">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full inline-flex items-center justify-center px-8 py-4 bg-gray-100 text-gray-700 border-2 border-gray-300 text-lg font-semibold rounded-xl hover:bg-gray-200 transition-all"
                                            onclick="if(this.form.submitted) return false; this.form.submitted = true;">
                                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                        </svg>
                                        @if(auth()->user()->savedJobs()->where('job_id', $job->id)->exists())
                                            Saved
                                        @else
                                            Save Job
                                        @endif
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Admin / Owner Actions -->
                @if(auth()->check() && (auth()->user()->id === $job->user_id || auth()->user()->isAdmin()))
                    <div class="mt-12 flex flex-wrap gap-4">
                        <a href="{{ route('jobs.edit', $job) }}" 
                           class="inline-flex items-center px-6 py-3 bg-amber-600 text-white rounded-xl hover:bg-amber-700 transition shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 0L11.828 15H9v2.828l8.586-8.586z" />
                            </svg>
                            Edit This Job
                        </a>

                        <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this job posting?')" 
                                    class="inline-flex items-center px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete Job
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('jobs.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-800 text-white rounded-xl hover:bg-gray-900 transition shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to All Jobs
            </a>
        </div>
    </div>
</div>

@endsection