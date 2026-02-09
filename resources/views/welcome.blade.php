<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'OBY PORTAL'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Fallback Tailwind CSS for mobile -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <div class="min-h-screen bg-gray-50">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-orange-600 via-orange-500 to-orange-700 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_70%,rgba(255,255,255,0.2)_0%,transparent_50%)]"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 md:py-32">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4 sm:mb-6 leading-tight drop-shadow-lg">
                    Your Next Career Move Starts Here
                </h1>
                <p class="text-base sm:text-xl md:text-2xl mb-8 sm:mb-12 text-orange-100 font-light max-w-3xl mx-auto px-4">
                    Connect with leading employers and discover roles that match your skills and aspirations.
                </p>

                <!-- Search Bar -->
                <form action="{{ route('jobs.index') }}" method="GET" 
                      class="bg-white/95 backdrop-blur-md rounded-xl sm:rounded-2xl shadow-2xl p-4 sm:p-5 md:p-6 max-w-4xl mx-auto flex flex-col gap-3 sm:gap-4 border border-white/20">
                    <div class="flex-1 relative">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Job title, skills, keywords..." 
                            class="w-full pl-12 pr-4 py-3 sm:py-4 md:py-5 rounded-lg sm:rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent text-gray-900 text-sm sm:text-base md:text-lg transition shadow-inner"
                        >
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 sm:h-6 sm:w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <select name="type" 
                            class="w-full px-4 py-3 sm:py-4 md:py-5 rounded-lg sm:rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-white text-gray-900 text-sm sm:text-base md:text-lg appearance-none shadow-inner">
                        <option value="">All Job Types</option>
                        <option value="Full-time" {{ request('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ request('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Remote" {{ request('type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                        <option value="Contract" {{ request('type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Freelance" {{ request('type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                    </select>

                    <button type="submit" 
                            class="w-full bg-orange-600 text-white px-6 py-3 sm:py-4 md:py-5 rounded-lg sm:rounded-xl hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition font-semibold text-sm sm:text-base md:text-lg shadow-md">
                        Search Jobs
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Featured Jobs -->
    <section class="py-12 sm:py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 mb-3 sm:mb-5">Featured Opportunities</h2>
                <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                    Discover the latest roles from top employers — updated daily
                </p>
            </div>

            @if(isset($featuredJobs) && $featuredJobs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 md:gap-10">
                    @foreach($featuredJobs as $job)
                        <div class="group bg-white rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden transform hover:-translate-y-1">
                            <div class="p-5 sm:p-6 md:p-8">
                                <div class="flex flex-col sm:flex-row items-start justify-between mb-4 sm:mb-6 gap-3">
                                    <div class="flex-1 w-full">
                                        <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 group-hover:text-orange-600 transition-colors line-clamp-2 leading-tight mb-2">
                                            @auth
                                                <a href="{{ route('jobs.show', $job) }}">
                                                    {{ $job->title }}
                                                </a>
                                            @else
                                                <button 
                                                    onclick="showLoginModal()"
                                                    type="button"
                                                    class="text-left w-full hover:text-orange-600">
                                                    {{ $job->title }}
                                                </button>
                                            @endauth
                                        </h3>
                                        <p class="text-base sm:text-lg md:text-xl font-semibold text-orange-600">{{ $job->company }}</p>
                                    </div>

                                    <span class="inline-flex px-3 sm:px-4 md:px-5 py-1.5 sm:py-2 text-xs sm:text-sm font-bold rounded-full shadow-sm whitespace-nowrap
                                        {{ match($job->type) {
                                            'Full-time' => 'bg-green-100 text-green-800 border border-green-200',
                                            'Part-time' => 'bg-blue-100 text-blue-800 border border-blue-200',
                                            'Remote'    => 'bg-purple-100 text-purple-800 border border-purple-200',
                                            'Contract'  => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                            'Freelance' => 'bg-pink-100 text-pink-800 border border-pink-200',
                                            default     => 'bg-orange-100 text-orange-800 border border-orange-200'
                                        } }}">
                                        {{ $job->type }}
                                    </span>
                                </div>

                                <div class="space-y-3 sm:space-y-4 text-gray-700 mb-6 sm:mb-8">
                                    <div class="flex items-center text-sm sm:text-base">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="truncate">{{ $job->location ?: 'Remote / Worldwide' }}</span>
                                    </div>

                                    @if($job->experience_level)
                                    <div class="flex items-center text-sm sm:text-base">
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>{{ $job->experience_level }}</span>
                                    </div>
                                    @endif

                                    <div class="text-sm sm:text-base text-gray-500">
                                        Posted {{ $job->created_at->diffForHumans() }}
                                    </div>
                                </div>

                                <div class="pt-4 sm:pt-6 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                                    <span class="text-xs sm:text-sm text-gray-500 truncate w-full sm:w-auto">
                                        {{ $job->user ? 'by ' . $job->user->name : '' }}
                                    </span>

                                    @auth
                                        <a href="{{ route('jobs.show', $job) }}" 
                                           class="w-full sm:w-auto text-center inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-orange-50 text-orange-700 font-semibold rounded-lg sm:rounded-xl hover:bg-orange-100 transition text-sm sm:text-base whitespace-nowrap">
                                            View Details →
                                        </a>
                                    @else
                                        <button onclick="showLoginModal()" 
                                                type="button"
                                                class="w-full sm:w-auto text-center inline-flex items-center justify-center px-4 sm:px-6 py-2 sm:py-3 bg-orange-50 text-orange-700 font-semibold rounded-lg sm:rounded-xl hover:bg-orange-100 transition text-sm sm:text-base whitespace-nowrap">
                                            View Details →
                                        </button>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-10 sm:mt-16">
                    <a href="{{ route('jobs.index') }}" 
                       class="inline-flex items-center justify-center px-8 sm:px-10 py-3 sm:py-4 md:py-5 bg-orange-600 text-white font-bold text-base sm:text-lg md:text-xl rounded-xl sm:rounded-2xl hover:bg-orange-700 transition-all shadow-lg">
                        Browse All Opportunities
                        <svg class="ml-2 sm:ml-3 w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            @else
                <!-- Empty state -->
                <div class="text-center py-16 sm:py-20 md:py-24 bg-white rounded-2xl sm:rounded-3xl shadow-lg border border-gray-100">
                    <svg class="mx-auto h-16 w-16 sm:h-20 sm:w-20 text-orange-400 mb-6 sm:mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3 sm:mb-4 px-4">No Opportunities Yet</h3>
                    <p class="text-base sm:text-lg md:text-xl text-gray-600 mb-8 sm:mb-10 max-w-xl mx-auto px-4">
                        We're adding new jobs every day. Check back soon or be the first to post!
                    </p>

                    @auth
                        <a href="{{ route('jobs.create') }}" 
                           class="inline-flex items-center px-8 sm:px-10 py-3 sm:py-4 md:py-5 bg-orange-600 text-white font-bold text-base sm:text-lg md:text-xl rounded-xl sm:rounded-2xl hover:bg-orange-700 transition-all shadow-lg">
                            Post Your First Job
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-12 sm:py-16 md:py-24 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 sm:mb-16">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-900 mb-3 sm:mb-5">How It Works</h2>
                <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-3xl mx-auto px-4">
                    Simple, fast, and effective — land your next role in just a few steps
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 md:gap-10">
                <div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg p-6 sm:p-8 md:p-10 border border-gray-100 hover:shadow-2xl transition-all">
                    <div class="bg-orange-100 rounded-full w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-6 sm:mb-8 flex items-center justify-center">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-5 text-center">1. Search & Discover</h3>
                    <p class="text-sm sm:text-base md:text-lg text-gray-600 leading-relaxed text-center">
                        Use smart filters to find roles that match your experience, location, and career goals.
                    </p>
                </div>

                <div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg p-6 sm:p-8 md:p-10 border border-gray-100 hover:shadow-2xl transition-all">
                    <div class="bg-orange-100 rounded-full w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-6 sm:mb-8 flex items-center justify-center">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-5 text-center">2. Review & Prepare</h3>
                    <p class="text-sm sm:text-base md:text-lg text-gray-600 leading-relaxed text-center">
                        Explore detailed job descriptions, requirements, and company information.
                    </p>
                </div>

                <div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg p-6 sm:p-8 md:p-10 border border-gray-100 hover:shadow-2xl transition-all">
                    <div class="bg-orange-100 rounded-full w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-6 sm:mb-8 flex items-center justify-center">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5 6v6m-6-6v6m-6-6v6" />
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3 sm:mb-5 text-center">3. Apply Confidently</h3>
                    <p class="text-sm sm:text-base md:text-lg text-gray-600 leading-relaxed text-center">
                        Submit applications quickly and track your progress in your personal dashboard.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-12 sm:py-16 md:py-24 bg-gradient-to-br from-orange-600 to-orange-500 text-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-6 sm:mb-8">
                Ready to Land Your Next Role?
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl mb-8 sm:mb-12 text-orange-100 max-w-4xl mx-auto px-4">
                Join thousands of professionals who found their perfect opportunity through our platform.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center max-w-2xl mx-auto">
                @guest
                    <a href="{{ route('register') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center px-8 sm:px-12 py-3 sm:py-4 md:py-6 bg-white text-orange-600 font-bold text-base sm:text-lg md:text-xl rounded-xl sm:rounded-2xl hover:bg-orange-50 transition-all shadow-2xl">
                        Create Free Account
                    </a>
                @endguest

                <a href="{{ route('jobs.index') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center px-8 sm:px-12 py-3 sm:py-4 md:py-6 bg-orange-700 text-white font-bold text-base sm:text-lg md:text-xl rounded-xl sm:rounded-2xl hover:bg-orange-800 transition-all shadow-2xl">
                    Explore All Jobs Now
                    <svg class="ml-3 sm:ml-4 w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

</div>

<!-- Login Modal (shown when user tries to view job details without being logged in) -->
@if(!auth()->check())
<div id="loginModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl sm:rounded-3xl max-w-md w-full p-6 sm:p-8 md:p-10 relative shadow-2xl">
        <button onclick="document.getElementById('loginModal').classList.add('hidden');" 
                type="button"
                class="absolute top-4 sm:top-6 right-4 sm:right-6 text-gray-400 hover:text-gray-600 transition">
            <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="text-center">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 sm:mb-6">Login Required</h2>
            <p class="text-base sm:text-lg text-gray-600 mb-8 sm:mb-10 px-2">
                Please sign in or create an account to view full job details and apply.
            </p>

            <div class="space-y-3 sm:space-y-4">
                <a href="{{ route('login') }}" 
                   class="block w-full py-3 sm:py-4 bg-orange-600 text-white rounded-xl sm:rounded-2xl font-bold hover:bg-orange-700 transition text-base sm:text-lg">
                    Sign In
                </a>
                <a href="{{ route('register') }}" 
                   class="block w-full py-3 sm:py-4 bg-gray-100 text-gray-900 rounded-xl sm:rounded-2xl font-bold hover:bg-gray-200 transition text-base sm:text-lg border border-gray-300">
                    Create Free Account
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<script>
// Show login modal when user clicks "View Details" or job title without being logged in
function showLoginModal() {
    const modal = document.getElementById('loginModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('loginModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        });
    }
});
</script>

    </div>
</body>
</html>

