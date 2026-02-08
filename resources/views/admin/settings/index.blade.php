@extends('layouts.app')

@section('title', 'Settings')

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="flex flex-col h-full">
            <!-- Logo Section -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="bg-indigo-600 rounded-lg p-2">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Admin Panel</h2>
                        <p class="text-xs text-gray-500">{{ auth()->user()->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1 1v10a1 1 0 001 1h6a1 1 0 001-1V10a1 1 0 00-1-1h-6z"></path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                <a href="{{ route('jobs.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                    </svg>
                    <span class="font-medium">All Jobs</span>
                </a>

                <a href="{{ route('jobs.create') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="font-medium">Post Job</span>
                </a>

                <a href="{{ route('admin.users.index') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="font-medium">Users</span>
                </a>

                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2V10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2V14a2 2 0 01-2 2h-2A2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="font-medium">Reports</span>
                </a>

                <a href="#" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg bg-indigo-50 hover:bg-indigo-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c-.94 1.543.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c.94-1.543-.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="font-medium">Settings</span>
                </a>
            </nav>

            <!-- User Section -->
            <div class="p-4 border-t border-gray-200">
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="font-medium">Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-red-600 rounded-lg hover:bg-red-50 transition-colors">
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
        <div class="p-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
                <p class="mt-2 text-gray-600">Manage your application settings and preferences</p>
            </div>

            <!-- Settings Tabs -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px">
                        <button class="px-6 py-3 border-b-2 border-indigo-500 text-indigo-600 font-medium">
                            General
                        </button>
                        <button class="px-6 py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium">
                            Email
                        </button>
                        <button class="px-6 py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium">
                            Security
                        </button>
                        <button class="px-6 py-3 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium">
                            Notifications
                        </button>
                    </nav>
                </div>

                <div class="p-6">
                    <!-- General Settings -->
                    <form class="space-y-6">
                        <!-- Site Information -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Site Information</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Site Name
                                    </label>
                                    <input type="text" id="site_name" name="site_name" value="Job Board" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="site_email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Site Email
                                    </label>
                                    <input type="email" id="site_email" name="site_email" value="admin@jobboard.com" 
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>
                            </div>
                        </div>

                        <!-- Job Settings -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Job Settings</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="auto_approve_jobs" name="auto_approve_jobs" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="auto_approve_jobs" class="ml-2 text-sm text-gray-700">
                                        Auto-approve new job postings
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="allow_remote_jobs" name="allow_remote_jobs" checked class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="allow_remote_jobs" class="ml-2 text-sm text-gray-700">
                                        Allow remote job postings
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="require_moderation" name="require_moderation" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="require_moderation" class="ml-2 text-sm text-gray-700">
                                        Require moderation for all job postings
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Registration Settings -->
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">User Registration</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="allow_registration" name="allow_registration" checked class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="allow_registration" class="ml-2 text-sm text-gray-700">
                                        Allow new user registration
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="require_email_verification" name="require_email_verification" checked class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="require_email_verification" class="ml-2 text-sm text-gray-700">
                                        Require email verification
                                    </label>
                                </div>
                                <div>
                                    <label for="default_user_role" class="block text-sm font-medium text-gray-700 mb-2">
                                        Default User Role
                                    </label>
                                    <select id="default_user_role" name="default_user_role" 
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                        <option value="user" selected>User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
