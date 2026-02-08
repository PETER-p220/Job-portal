@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-orange-600 to-orange-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight mb-6 drop-shadow-lg">
                    Find Your Next Great Opportunity
                </h1>
                <p class="text-xl md:text-2xl mb-10 text-orange-100 font-light">
                    Connect with top employers. Discover roles that match your skills and ambition.
                </p>

                <!-- Search Bar -->
                <form action="{{ route('jobs.index') }}" method="GET" 
                      class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-4 md:p-5 max-w-4xl mx-auto flex flex-col md:flex-row gap-4">
                    <div class="flex-1 relative">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Job title, skills, or company..." 
                            value="{{ request('search') }}"
                            class="w-full px-5 py-4 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent text-gray-900 text-lg transition"
                        >
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <select name="type" 
                            class="md:w-48 px-5 py-4 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-white text-gray-900 text-lg">
                        <option value="">Job Type</option>
                        <option value="Full-time" {{ request('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ request('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Remote" {{ request('type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                        <option value="Contract" {{ request('type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                    </select>

                    <button type="submit" 
                            class="md:w-48 bg-orange-600 text-white px-8 py-4 rounded-xl hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition font-semibold text-lg shadow-md">
                        Search Jobs
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Featured Jobs -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Opportunities</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Explore the latest openings from leading companies — updated daily
                </p>
            </div>

            @if(isset($featuredJobs) && $featuredJobs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($featuredJobs as $job)
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden group">
                            <!-- Company Logo Section -->
                            <div class="p-6 pb-0">
                                <div class="flex items-center space-x-4 mb-4">
                                    @if($job->image)
                                        <div class="w-16 h-16 bg-gray-100 rounded-xl p-3 flex-shrink-0">
                                            <img src="{{ asset('uploads/jobs/' . $job->image) }}" 
                                                 alt="{{ $job->company }} logo" 
                                                 class="w-full h-full object-contain rounded">
                                        </div>
                                    @else
                                        <div class="w-16 h-16 bg-gray-100 rounded-xl p-3 flex-shrink-0 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors line-clamp-2">
                                            <a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
                                        </h3>
                                        <p class="text-lg text-orange-600 font-semibold mt-1">{{ $job->company }}</p>
                                    </div>
                                    <span class="px-4 py-1.5 text-sm font-medium rounded-full 
                                        {{ match($job->type) {
                                            'Full-time' => 'bg-green-100 text-green-800',
                                            'Part-time' => 'bg-blue-100 text-blue-800',
                                            'Remote' => 'bg-purple-100 text-purple-800',
                                            default => 'bg-orange-100 text-orange-800'
                                        } }}">
                                        {{ $job->type }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-6 pt-0">
                                <!-- Job Description -->
                                <div class="mb-6">
                                    <p class="text-gray-600 line-clamp-3 leading-relaxed">
                                        {!! Str::limit(strip_tags($job->description), 150) !!}
                                    </p>
                                </div>

                                <!-- Job Details -->
                                <div class="space-y-3 text-gray-600 mb-6">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-2.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span>{{ $job->location ?: 'Remote / Worldwide' }}</span>
                                    </div>

                                    @if($job->experience_level)
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 mr-2.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>{{ $job->experience_level }}</span>
                                        </div>
                                    @endif

                                    <div class="text-sm text-gray-500">
                                        Posted {{ $job->created_at->diffForHumans() }}
                                    </div>
                                </div>

                                <!-- Apply Button -->
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">
                                        {{ $job->user ? 'by ' . $job->user->name : '' }}
                                    </span>
                                    <a href="{{ $job->apply_url ?: route('jobs.show', $job) }}" 
                                       target="{{ $job->apply_url ? '_blank' : '_self' }}"
                                       class="inline-flex items-center px-6 py-3 bg-orange-600 text-white font-medium rounded-xl hover:bg-orange-700 transition-colors shadow-md">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $job->apply_url ? 'Apply Now' : 'View Details' }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('jobs.index') }}" 
                       class="inline-flex items-center px-8 py-4 bg-orange-600 text-white text-lg font-medium rounded-xl hover:bg-orange-700 transition-all shadow-md">
                        View All Opportunities
                        <svg class="ml-3 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            @else
                <!-- Empty state -->
                <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-200">
                    <svg class="mx-auto h-16 w-16 text-orange-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No jobs available yet</h3>
                    <p class="text-lg text-gray-600 mb-8">New opportunities are added every day — check back soon!</p>

                    @auth
                        <a href="{{ route('jobs.create') }}" 
                           class="inline-flex items-center px-8 py-4 bg-orange-600 text-white text-lg font-medium rounded-xl hover:bg-orange-700 transition-all shadow-md">
                            Post Your First Job
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">How It Works</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Simple, fast, and effective way to land your next role
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="text-center bg-white rounded-2xl shadow-md p-8 hover:shadow-xl transition-all border border-gray-100">
                    <div class="bg-orange-100 rounded-full w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">1. Search & Discover</h3>
                    <p class="text-gray-600 text-lg">
                        Use powerful filters to find roles that match your skills and goals.
                    </p>
                </div>

                <div class="text-center bg-white rounded-2xl shadow-md p-8 hover:shadow-xl transition-all border border-gray-100">
                    <div class="bg-orange-100 rounded-full w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">2. Review & Prepare</h3>
                    <p class="text-gray-600 text-lg">
                        Read detailed descriptions and prepare your best application.
                    </p>
                </div>

                <div class="text-center bg-white rounded-2xl shadow-md p-8 hover:shadow-xl transition-all border border-gray-100">
                    <div class="bg-orange-100 rounded-full w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5 6v6m-6-6v6m-6-6v6" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">3. Apply with Ease</h3>
                    <p class="text-gray-600 text-lg">
                        Submit applications quickly — track progress in your dashboard.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Strong CTA -->
    <section class="py-20 bg-gradient-to-br from-orange-600 to-orange-500 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Ready to Take the Next Step?
            </h2>
            <p class="text-xl md:text-2xl mb-10 text-orange-100 max-w-3xl mx-auto">
                Join thousands of professionals who found their perfect role through our platform
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                @guest
                    <a href="{{ route('register') }}" 
                       class="inline-flex items-center px-10 py-5 bg-white text-orange-600 font-bold text-xl rounded-xl hover:bg-orange-50 transition-all shadow-lg">
                        Create Free Account
                    </a>
                @endguest

                <a href="{{ route('jobs.index') }}" 
                   class="inline-flex items-center px-10 py-5 bg-orange-700 text-white font-bold text-xl rounded-xl hover:bg-orange-800 transition-all shadow-lg">
                    Explore All Jobs
                    <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

</div>

<!-- Login Modal -->
@if(!auth()->check())
<div id="loginModal" class="fixed inset-0 bg-black bg-opacity-60 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-8 relative">
        <button onclick="hideLoginModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="text-center mb-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Login Required</h3>
            <p class="text-gray-600">
                Please sign in or create an account to apply for jobs and save your favorites.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4">
            <a href="{{ route('login') }}" 
               class="flex items-center justify-center px-6 py-4 bg-orange-600 text-white rounded-xl hover:bg-orange-700 transition font-semibold text-lg shadow-md">
                Sign In
            </a>
            <a href="{{ route('register') }}" 
               class="flex items-center justify-center px-6 py-4 bg-gray-100 text-gray-900 rounded-xl hover:bg-gray-200 transition font-semibold text-lg border border-gray-300">
                Create Account
            </a>
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