@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li>
                    <a href="{{ route('jobs.index') }}" class="text-gray-500 hover:text-gray-700">
                        Jobs
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="ml-2 text-gray-500 font-medium">{{ $job->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Job Details Card -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Job Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6 text-white">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ $job->title }}</h1>
                        <p class="text-xl text-indigo-100">{{ $job->company }}</p>
                    </div>
                    <span class="px-4 py-2 text-sm font-medium rounded-full bg-white bg-opacity-20">
                        {{ $job->type }}
                    </span>
                </div>
            </div>

            <!-- Job Info -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Location</p>
                            <p class="text-sm">{{ $job->location ?: 'Remote' }}</p>
                        </div>
                    </div>

                    @if($job->salary)
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Salary</p>
                            <p class="text-sm">{{ $job->salary }}</p>
                        </div>
                    </div>
                    @endif

                    @if($job->experience_level)
                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Experience</p>
                            <p class="text-sm">{{ $job->experience_level }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="flex items-center text-gray-600">
                        <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Posted</p>
                            <p class="text-sm">{{ $job->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Job Description -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Job Description</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>

                <!-- How to Apply -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">How to Apply</h2>
                    
                    @if($job->apply_url)
                        <div class="mb-4">
                            <p class="text-gray-700 mb-3">Apply directly through the company's website:</p>
                            <a 
                                href="{{ $job->apply_url }}" 
                                target="_blank"
                                class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Apply Now
                            </a>
                        </div>
                    @endif

                    @if($job->email)
                        <div>
                            <p class="text-gray-700 mb-3">Or send your resume to:</p>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <a href="mailto:{{ $job->email }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                    {{ $job->email }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                @if(auth()->check())
                    @if(auth()->user()->id === $job->user_id || auth()->user()->isAdmin())
                        <div class="flex space-x-4 mt-8">
                            <a href="{{ route('jobs.edit', $job) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 0L11.828 3H15a2 2 0 012 2v2.172a2 2 0 00.586 1.414l5.828 5.828a2 2 0 01.586 1.414V19a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h8.172z"></path>
                                </svg>
                                Edit Job
                            </a>
                            
                            <form action="{{ route('jobs.destroy', $job) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this job?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete Job
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="mt-8">
                            <button 
                                onclick="showApplyModal()" 
                                class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Apply for this Position
                            </button>
                        </div>
                    @endif
                @else
                    <div class="mt-8">
                        <button 
                            onclick="showLoginModal()" 
                            class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Login to Apply
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <!-- Back to Jobs -->
        <div class="mt-8">
            <a href="{{ route('jobs.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Job Listings
            </a>
        </div>
    </div>
</div>

<!-- Apply Modal -->
@if(auth()->check() && auth()->user()->id !== $job->user_id && !auth()->user()->isAdmin())
<div id="applyModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Apply for {{ $job->title }}</h3>
                <button onclick="hideApplyModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="text-gray-600 mb-6">Thank you for your interest! Please use the contact information provided below to apply for this position.</p>
            
            <div class="space-y-4">
                @if($job->apply_url)
                    <div>
                        <p class="font-medium text-gray-900">Apply Online:</p>
                        <a href="{{ $job->apply_url }}" target="_blank" class="text-indigo-600 hover:text-indigo-800">
                            {{ $job->apply_url }}
                        </a>
                    </div>
                @endif
                
                @if($job->email)
                    <div>
                        <p class="font-medium text-gray-900">Email Resume:</p>
                        <a href="mailto:{{ $job->email }}" class="text-indigo-600 hover:text-indigo-800">
                            {{ $job->email }}
                        </a>
                    </div>
                @endif
            </div>
            
            <div class="mt-6">
                <button onclick="hideApplyModal()" class="w-full px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Login Modal -->
@if(!auth()->check())
<div id="loginModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Login Required</h3>
                <button onclick="hideLoginModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <p class="text-gray-600 mb-6">Please login or create an account to apply for this job.</p>
            <div class="flex space-x-3">
                <a href="{{ route('login') }}" class="flex-1 text-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                    Login
                </a>
                <a href="{{ route('register') }}" class="flex-1 text-center px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors">
                    Sign Up
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<script>
function showApplyModal() {
    document.getElementById('applyModal').classList.remove('hidden');
}

function hideApplyModal() {
    document.getElementById('applyModal').classList.add('hidden');
}

function showLoginModal() {
    document.getElementById('loginModal').classList.remove('hidden');
}

function hideLoginModal() {
    document.getElementById('loginModal').classList.add('hidden');
}
</script>
@endsection