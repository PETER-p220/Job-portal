<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Oby Portal - Dashboard')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Fallback Tailwind CSS for mobile -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-orange-50 antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile Menu Toggle -->
        <button onclick="toggleMobileSidebar()" 
                class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-orange-600 text-white rounded-lg shadow-lg hover:bg-orange-700 transition-colors focus:outline-none focus:ring-2 focus:ring-orange-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Professional Orange Sidebar -->
        <aside id="mobile-sidebar" class="w-64 bg-orange-600 shadow-xl flex-shrink-0 fixed inset-y-0 left-0 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 lg:block z-40 lg:z-auto">
            <div class="flex flex-col h-full">
                <!-- Logo & User Info -->
                <div class="p-6 border-b border-orange-500">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white rounded-xl p-2 shadow-md cursor-pointer hover:bg-orange-50 transition-colors" 
                             onclick="toggleLogoDisplay(this)" title="Toggle Logo/Text">
                            <img id="sidebar-logo" src="{{ asset('assets/images/jk.png') }}" alt="OBY Jobs Logo" class="h-8 w-8 object-contain">
                            <span id="sidebar-text" class="hidden h-8 w-8 flex items-center justify-center text-orange-600 font-bold text-lg">OBY</span>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Oby Portal</h2>
                            <p class="text-sm text-orange-100 mt-0.5">@if(auth()->check()){{ auth()->user()->name }}@endif</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 p-5 space-y-1.5 overflow-y-auto">
                    <a href="{{ route('user.dashboard') }}"
                       class="flex items-center space-x-3 px-5 py-3.5 text-white rounded-xl hover:bg-orange-700 transition-all {{ request()->routeIs('user.dashboard') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1 1v10a1 1 0 001 1h6a1 1 0 001-1V10a1 1 0 00-1-1h-6z" />
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('jobs.index') }}"
                       class="flex items-center space-x-3 px-5 py-3.5 text-white rounded-xl hover:bg-orange-700 transition-all {{ request()->routeIs('jobs.*') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="font-medium">Find Jobs</span>
                    </a>

                    <a href="{{ route('user.applications') }}"
                       class="flex items-center space-x-3 px-5 py-3.5 text-white rounded-xl hover:bg-orange-700 transition-all {{ request()->routeIs('user.applications') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="font-medium">My Applications</span>
                    </a>

                    <a href="{{ route('user.saved-jobs') }}"
                       class="flex items-center space-x-3 px-5 py-3.5 text-white rounded-xl hover:bg-orange-700 transition-all {{ request()->routeIs('user.saved-jobs') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                        <span class="font-medium">Saved Jobs</span>
                    </a>

                    <a href="{{ route('user.interviews.index') }}"
                       class="flex items-center space-x-3 px-5 py-3.5 text-white rounded-xl hover:bg-orange-700 transition-all {{ request()->routeIs('user.interviews.*') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="font-medium">Interviews</span>
                    </a>

                    <a href="{{ route('jobs.index') }}"
                       class="flex items-center space-x-3 px-5 py-3.5 text-white rounded-xl hover:bg-orange-700 transition-all {{ request()->routeIs('jobs.*') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="font-medium">Recommended Jobs</span>
                    </a>
                </nav>

                <!-- Bottom Section -->
                <div class="p-5 border-t border-orange-500 mt-auto">
                    <a href="{{ route('profile.edit') }}"
                       class="flex items-center space-x-3 px-5 py-3.5 text-white rounded-xl hover:bg-orange-700 transition-all mb-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium">My Profile</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center space-x-3 px-5 py-3.5 text-orange-100 hover:bg-orange-700 rounded-xl transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto bg-gray-50 pt-16 lg:pt-0 relative z-30">
            <!-- Mobile Sidebar Overlay -->
            <div id="sidebar-overlay" onclick="closeMobileSidebar()" 
                 class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-30 hidden"></div>
            
            <!-- Page Content with safe padding -->
            <div class="p-4 sm:p-6 lg:p-8">
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
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function closeMobileSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
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
    </script>
</body>
</html>