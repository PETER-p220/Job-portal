<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Oby Portal - Dashboard')</title>

    <!-- Open Graph Meta Tags for WhatsApp Sharing -->
    @if(request()->routeIs('jobs.show') && isset($job))
        <meta property="og:title" content="{{ $job->title }} - {{ $job->company }}">
        <meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($job->description), 150) }}">
        <meta property="og:url" content="{{ route('jobs.show', $job) }}">
        <meta property="og:type" content="website">
        @if($job->image)
            <meta property="og:image" content="{{ asset('uploads/jobs/' . $job->image) }}">
            <meta property="og:image:secure_url" content="{{ asset('uploads/jobs/' . $job->image) }}">
            <meta property="og:image:width" content="1200">
            <meta property="og:image:height" content="630">
            <meta property="og:image:alt" content="{{ $job->title }} - {{ $job->company }}">
        @endif
        <meta property="og:site_name" content="Oby Portal">
    @endif

    <!-- Twitter Card Meta Tags -->
    @if(request()->routeIs('jobs.show') && isset($job))
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $job->title }} - {{ $job->company }}">
        <meta name="twitter:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($job->description), 150) }}">
        @if($job->image)
            <meta name="twitter:image" content="{{ asset('uploads/jobs/' . $job->image) }}">
        @endif
    @endif

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=pub-9512545299443856"
            crossorigin="anonymous"></script>

    <!-- Fallback Tailwind CSS for mobile -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Vite Assets -->
</head>
<body class="bg-gray-50 antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Professional Mobile Menu Toggle -->
        <button onclick="toggleMobileSidebar()" 
                class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-gradient-to-r from-orange-600 to-orange-500 text-white rounded-xl shadow-xl hover:shadow-2xl hover:from-orange-700 hover:to-orange-600 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-orange-400 backdrop-blur-sm">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Professional Sidebar -->
        <aside id="mobile-sidebar" class="w-72 bg-gradient-to-b from-orange-600 to-orange-700 shadow-2xl flex-shrink-0 fixed inset-y-0 left-0 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 lg:block z-50 lg:z-auto">
            <div class="flex flex-col h-full">
                <!-- Professional Header -->
                <div class="p-6 border-b border-orange-500/30 bg-gradient-to-r from-orange-500/20 to-orange-600/20">
                    <div class="flex items-center space-x-4">
                        <div class="bg-white rounded-2xl p-3 shadow-lg cursor-pointer hover:shadow-xl hover:scale-105 transition-all duration-300" 
                             onclick="toggleLogoDisplay(this)" title="Toggle Logo/Text">
                            <img id="sidebar-logo" src="{{ asset('assets/images/jk.png') }}" alt="OBY Jobs Logo" class="h-10 w-10 object-contain">
                            <span id="sidebar-text" class="hidden h-10 w-10 flex items-center justify-center text-orange-600 font-bold text-xl">OBY</span>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-white">Oby Portal</h2>
                            <p class="text-sm text-orange-100 mt-1 truncate">@if(auth()->check()){{ auth()->user()->name }}@endif</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 p-6 space-y-2 overflow-y-auto">
                    <a href="{{ route('user.dashboard') }}"
                       class="group flex items-center space-x-4 px-5 py-4 text-white rounded-2xl hover:bg-white/10 transition-all duration-200 {{ request()->routeIs('user.dashboard') ? 'bg-white/20 shadow-lg' : '' }}">
                        <div class="flex-shrink-0 w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1 1v10a1 1 0 001 1h6a1 1 0 001-1V10a1 1 0 00-1-1h-6z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="font-semibold text-lg">Dashboard</span>
                            @if(request()->routeIs('user.dashboard'))
                                <div class="text-xs text-orange-200 mt-1">Overview</div>
                            @endif
                        </div>
                    </a>

                    <a href="{{ route('jobs.index') }}"
                       class="group flex items-center space-x-4 px-5 py-4 text-white rounded-2xl hover:bg-white/10 transition-all duration-200 {{ request()->routeIs('jobs.*') && !request()->routeIs('jobs.show') ? 'bg-white/20 shadow-lg' : '' }}">
                        <div class="flex-shrink-0 w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="font-semibold text-lg">Find Jobs</span>
                            @if(request()->routeIs('jobs.*') && !request()->routeIs('jobs.show'))
                                <div class="text-xs text-orange-200 mt-1">Browse opportunities</div>
                            @endif
                        </div>
                    </a>

                    <a href="{{ route('user.applications') }}"
                       class="group flex items-center space-x-4 px-5 py-4 text-white rounded-2xl hover:bg-white/10 transition-all duration-200 {{ request()->routeIs('user.applications') ? 'bg-white/20 shadow-lg' : '' }}">
                        <div class="flex-shrink-0 w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="font-semibold text-lg">My Applications</span>
                            @if(request()->routeIs('user.applications'))
                                <div class="text-xs text-orange-200 mt-1">Track progress</div>
                            @endif
                        </div>
                    </a>

                    <a href="{{ route('user.saved-jobs') }}"
                       class="group flex items-center space-x-4 px-5 py-4 text-white rounded-2xl hover:bg-white/10 transition-all duration-200 {{ request()->routeIs('user.saved-jobs') ? 'bg-white/20 shadow-lg' : '' }}">
                        <div class="flex-shrink-0 w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="font-semibold text-lg">Saved Jobs</span>
                            @if(request()->routeIs('user.saved-jobs'))
                                <div class="text-xs text-orange-200 mt-1">Bookmarked positions</div>
                            @endif
                        </div>
                    </a>

                    <a href="{{ route('user.interviews.index') }}"
                       class="group flex items-center space-x-4 px-5 py-4 text-white rounded-2xl hover:bg-white/10 transition-all duration-200 {{ request()->routeIs('user.interviews.*') ? 'bg-white/20 shadow-lg' : '' }}">
                        <div class="flex-shrink-0 w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="font-semibold text-lg">Interviews</span>
                            @if(request()->routeIs('user.interviews.*'))
                                <div class="text-xs text-orange-200 mt-1">Schedule & details</div>
                            @endif
                        </div>
                    </a>

                    <!-- Divider -->
                    <div class="border-t border-orange-500/30 my-4"></div>

                    <a href="{{ route('jobs.index') }}"
                       class="group flex items-center space-x-4 px-5 py-4 text-white rounded-2xl hover:bg-white/10 transition-all duration-200">
                        <div class="flex-shrink-0 w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="font-semibold text-lg">Recommended Jobs</span>
                            <div class="text-xs text-orange-200 mt-1">AI-powered matches</div>
                        </div>
                    </a>
                </nav>

                <!-- Professional Bottom Section -->
                <div class="p-6 border-t border-orange-500/30 bg-gradient-to-r from-orange-500/10 to-orange-600/10">
                    <a href="{{ route('profile.edit') }}"
                       class="group flex items-center space-x-4 px-5 py-4 text-white rounded-2xl hover:bg-white/10 transition-all duration-200 mb-3">
                        <div class="flex-shrink-0 w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center group-hover:bg-white/20 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="font-semibold text-lg">My Profile</span>
                            <div class="text-xs text-orange-200 mt-1">Account settings</div>
                        </div>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="group w-full flex items-center space-x-4 px-5 py-4 text-orange-100 hover:bg-red-500/20 hover:text-white rounded-2xl transition-all duration-200">
                            <div class="flex-shrink-0 w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center group-hover:bg-red-500/30 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </div>
                            <div class="flex-1 text-left">
                                <span class="font-semibold text-lg">Logout</span>
                                <div class="text-xs text-orange-200 mt-1">Sign out safely</div>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto bg-gray-50 lg:ml-0 relative">
            <!-- Mobile Sidebar Overlay -->
            <div id="sidebar-overlay" onclick="closeMobileSidebar()" 
                 class="lg:hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden transition-opacity duration-300"></div>
            
            <!-- Page Content with proper spacing -->
            <div class="p-4 sm:p-6 lg:p-8 pt-20 lg:pt-8 min-h-screen">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleLogoDisplay(element) {
            const logo = document.getElementById('sidebar-logo');
            const text = document.getElementById('sidebar-text');
            
            if (logo.classList.contains('hidden')) {
                logo.classList.remove('hidden');
                text.classList.add('hidden');
            } else {
                logo.classList.add('hidden');
                text.classList.remove('hidden');
            }
        }

        function toggleMobileSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const body = document.body;
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            
            // Prevent body scroll when sidebar is open
            if (!sidebar.classList.contains('-translate-x-full')) {
                body.style.overflow = 'hidden';
            } else {
                body.style.overflow = '';
            }
        }

        function closeMobileSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const body = document.body;
            
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
            body.style.overflow = '';
        }

        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const toggleButton = event.target.closest('button[onclick="toggleMobileSidebar()"]');
            
            if (!sidebar.contains(event.target) && !toggleButton && !sidebar.classList.contains('-translate-x-full')) {
                closeMobileSidebar();
            }
        });

        // Close sidebar on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeMobileSidebar();
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('mobile-sidebar');
            const body = document.body;
            
            if (window.innerWidth >= 1024) {
                sidebar.classList.add('-translate-x-full');
                document.getElementById('sidebar-overlay').classList.add('hidden');
                body.style.overflow = '';
            }
        });
    </script>
</body>
</html>