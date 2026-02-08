<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('jobs.index') }}" class="flex items-center space-x-2">
                        <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                        </svg>
                        <span class="text-xl font-bold text-gray-900">JobBoard</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('jobs.*') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                        Browse Jobs
                    </a>
                    @if(auth()->check())
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.dashboard') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                Admin Dashboard
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('user.dashboard') ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium">
                                My Dashboard
                            </a>
                        @endif
                        <a href="{{ route('jobs.create') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 text-sm font-medium">
                            Post Job
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center">
                @if(auth()->guest())
                    <!-- Guest Links -->
                    <div class="hidden space-x-4 sm:flex sm:items-center">
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition-colors">
                            Sign Up
                        </a>
                    </div>
                @else
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                            <span class="text-indigo-600 font-medium text-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                                        </div>
                                        <div>{{ Auth::user()->name }}</div>
                                    </div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @if(auth()->user()->isAdmin())
                                    <x-dropdown-link :href="route('admin.dashboard')">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                            Admin Dashboard
                                        </div>
                                    </x-dropdown-link>
                                @else
                                    <x-dropdown-link :href="route('user.dashboard')">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            My Dashboard
                                        </div>
                                    </x-dropdown-link>
                                @endif
                                
                                <x-dropdown-link :href="route('jobs.create')">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                            Post New Job
                                        </div>
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('profile.edit')">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                            Profile Settings
                                    </div>
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            Log Out
                                        </div>
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('jobs.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('jobs.index') ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium">
                Browse Jobs
            </a>
            
            @if(auth()->check())
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.dashboard') ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium">
                        Admin Dashboard
                    </a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('user.dashboard') ? 'border-indigo-500 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium">
                        My Dashboard
                    </a>
                @endif
                <a href="{{ route('jobs.create') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 text-base font-medium">
                    Post Job
                </a>
            @endif
        </div>

        @if(auth()->guest())
            <!-- Responsive Guest Links -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="space-y-1">
                    <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 text-base font-medium">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 text-base font-medium">
                        Sign Up
                    </a>
                </div>
            </div>
        @else
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 text-base font-medium">
                        Profile Settings
                    </a>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="{{ route('logout') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 text-base font-medium"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            Log Out
                        </a>
                    </form>
                </div>
            </div>
        @endif
    </div>
</nav>
