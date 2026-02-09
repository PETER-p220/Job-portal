<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Job Board')) - Admin</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-orange-50">
    <div class="flex h-screen">
        <!-- Mobile Menu Toggle -->
        <button onclick="toggleMobileSidebar()" 
                class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-orange-600 text-white rounded-lg shadow-lg hover:bg-orange-700 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Sidebar -->
        <aside id="mobile-sidebar" class="w-64 bg-orange-600 shadow-lg flex-shrink-0 fixed inset-y-0 left-0 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 lg:block z-40">
            <div class="flex flex-col h-full">
                <!-- Logo Section -->
                <div class="p-6 border-b border-orange-500">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white rounded-lg p-2 cursor-pointer hover:bg-orange-50 transition-colors" 
                             onclick="toggleLogoDisplay(this)" title="Toggle Logo/Text">
                            <img id="sidebar-logo" src="{{ asset('assets/images/jk.png') }}" alt="OBY Jobs Logo" class="h-6 w-6 object-contain">
                            <span id="sidebar-text" class="hidden h-6 w-6 flex items-center justify-center text-orange-600 font-bold text-sm">OBY</span>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">OBY Oby Portal</h2>
                            <p class="text-xs text-orange-200">@if(auth()->check()){{ auth()->user()->name }}@endif</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 p-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg hover:bg-orange-700 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1 1v10a1 1 0 001 1h3"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('admin.jobs.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg hover:bg-orange-700 transition-colors {{ request()->routeIs('admin.jobs.*') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                        </svg>
                        <span class="font-medium">Jobs</span>
                    </a>

                    <a href="{{ route('admin.jobs.create') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg hover:bg-orange-700 transition-colors {{ request()->routeIs('admin.jobs.create') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="font-medium">Post Job</span>
                    </a>

                    <a href="{{ route('admin.interviews.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg hover:bg-orange-700 transition-colors {{ request()->routeIs('admin.interviews.*') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span class="font-medium">Interviews</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg hover:bg-orange-700 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-medium">Users</span>
                    </a>

                    <a href="{{ route('admin.reports.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg hover:bg-orange-700 transition-colors {{ request()->routeIs('admin.reports.*') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2V10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2V14a2 2 0 01-2 2h-2A2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="font-medium">Reports</span>
                    </a>

                    <a href="{{ route('admin.settings.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg hover:bg-orange-700 transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-2.573-1.066c-.94 1.543-.826 3.31-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 002.573-1.066c.94-1.543-.826 3.31-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 002.573-1.066c.94-1.543-.826 3.31-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 002.573-1.066z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-medium">Settings</span>
                    </a>
                </nav>

                <!-- User Section -->
                <div class="p-4 border-t border-orange-500">
                    <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg hover:bg-orange-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 007-7z"></path>
                        </svg>
                        <span class="font-medium">Profile</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-orange-200 rounded-lg hover:bg-orange-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto lg:ml-0">
            <!-- Mobile Sidebar Overlay -->
            <div id="sidebar-overlay" onclick="closeMobileSidebar()" 
                 class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-30 hidden"></div>
            
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

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
