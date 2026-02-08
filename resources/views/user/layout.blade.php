<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Job Board')) - User</title>
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-orange-600 shadow-lg">
            <div class="flex flex-col h-full">
                <!-- Logo Section -->
                <div class="p-6 border-b border-orange-500">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white rounded-lg p-2">
                            <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">Job Portal</h2>
                            <p class="text-xs text-orange-200">{{ auth()->user()->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 p-4 space-y-2">
                    <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg hover:bg-orange-700 transition-colors {{ request()->routeIs('user.dashboard') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1 1v10a1 1 0 001 1h3"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('jobs.index') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg hover:bg-orange-700 transition-colors {{ request()->routeIs('jobs.*') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                        </svg>
                        <span class="font-medium">Browse Jobs</span>
                    </a>
                </nav>

                <div class="border-t border-orange-500">
                    <a href="{{ route('user.applications') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg hover:bg-orange-700 transition-colors {{ request()->routeIs('user.applications.*') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        <span class="font-medium">Applications</span>
                    </a>
                </div>

                <div>
                    <a href="{{ route('user.saved-jobs') }}" class="flex items-center space-x-3 px-4 py-3 text-white rounded-lg hover:bg-orange-700 transition-colors {{ request()->routeIs('user.saved-jobs.*') ? 'bg-orange-700' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 012 2h10a2 2 0 012 2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        <span class="font-medium">Saved Jobs</span>
                    </a>
                </div>

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
        <main class="flex-1 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</body>
</html>
