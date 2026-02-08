@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Find Your Dream Job
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-indigo-100">
                    Discover opportunities from top companies and start your career journey
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-3xl mx-auto">
                    <form action="{{ route('jobs.index') }}" method="GET" class="bg-white rounded-lg shadow-lg p-2 flex flex-col md:flex-row gap-2">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Job title, keywords, or company"
                            value="{{ request('search') }}"
                            class="flex-1 px-4 py-3 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                        <select name="type" class="px-4 py-3 text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">All Types</option>
                            <option value="Full-time" {{ request('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ request('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Remote" {{ request('type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                            <option value="Contract" {{ request('type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                        </select>
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition-colors">
                            Search Jobs
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Jobs Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Featured Job Opportunities</h2>
                <p class="text-lg text-gray-600">Explore latest positions from top employers</p>
            </div>

            @if(isset($featuredJobs) && $featuredJobs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($featuredJobs as $job)
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border border-gray-200">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $job->title }}</h3>
                                    <p class="text-lg text-indigo-600 font-medium">{{ $job->company }}</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-medium rounded-full {{ 
                                    $job->type == 'Full-time' ? 'bg-green-100 text-green-800' :
                                    ($job->type == 'Part-time' ? 'bg-blue-100 text-blue-800' :
                                    ($job->type == 'Remote' ? 'bg-purple-100 text-purple-800' : 'bg-yellow-100 text-yellow-800'))
                                }}">
                                    {{ $job->type }}
                                </span>
                            </div>
                            
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $job->location ?: 'Remote' }}
                                </div>
                                @if($job->salary)
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                    {{ $job->salary }}
                                </div>
                                @endif
                                @if($job->experience_level)
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $job->experience_level }}
                                </div>
                                @endif
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">
                                    Posted {{ $job->created_at->diffForHumans() }}
                                </span>
                                <div class="space-x-2">
                                    @if(auth()->check())
                                        <a href="{{ route('jobs.show', $job) }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                                            View Details
                                        </a>
                                    @else
                                        <button onclick="showLoginModal()" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                                            Login to Apply
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No jobs available yet</h3>
                    <p class="text-gray-500">Be the first to post a job opportunity!</p>
                    @if(auth()->check())
                        <a href="{{ route('jobs.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                            Post Your First Job
                        </a>
                    @endif
                </div>
            @endif

            <div class="text-center mt-12">
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                    View All Jobs
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">How It Works</h2>
                <p class="text-lg text-gray-600">Simple steps to find your next opportunity</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-indigo-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">1. Search Jobs</h3>
                    <p class="text-gray-600">Browse through hundreds of job listings from top companies</p>
                </div>

                <div class="text-center">
                    <div class="bg-indigo-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">2. Review Details</h3>
                    <p class="text-gray-600">Read job descriptions and requirements to find perfect match</p>
                </div>

                <div class="text-center">
                    <div class="bg-indigo-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">3. Apply Easily</h3>
                    <p class="text-gray-600">Submit your application with just a few clicks</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Find Your Dream Job?</h2>
            <p class="text-xl mb-8 text-indigo-100">
                Join thousands of job seekers who have found their perfect match
            </p>
            @if(auth()->guest())
                <div class="space-x-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-white text-indigo-600 rounded-md hover:bg-gray-100 transition-colors font-medium">
                        Get Started Now
                    </a>
                    <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-500 text-white rounded-md hover:bg-indigo-400 transition-colors font-medium">
                        Browse Jobs
                    </a>
                </div>
            @else
                <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-6 py-3 bg-white text-indigo-600 rounded-md hover:bg-gray-100 transition-colors font-medium">
                    Start Your Job Search
                </a>
            @endif
        </div>
    </section>
</div>

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
            <p class="text-gray-600 mb-6">Please login or create an account to apply for jobs and access all features.</p>
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
function showLoginModal() {
    document.getElementById('loginModal').classList.remove('hidden');
}

function hideLoginModal() {
    document.getElementById('loginModal').classList.add('hidden');
}
</script>
@endsection
