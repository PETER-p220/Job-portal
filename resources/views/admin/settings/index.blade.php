@extends('admin.layout')

@section('title', 'Settings')

@section('content')
    <!-- Header -->
    <div class="p-8">
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
                                <input type="email" id="site_email" name="site_email" value="admin@OBY.com" 
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
                                    <input type="email" id="site_email" name="site_email" value="admin@OBY.com" 
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
