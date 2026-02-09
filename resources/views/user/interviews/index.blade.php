@extends('user.layout')

@section('title', 'All Interviews')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-6 sm:mb-10">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900">All Interviews</h1>
            <p class="mt-1.5 sm:mt-2 text-base sm:text-lg text-gray-600">
                Browse and apply to available interview opportunities
            </p>
        </div>

        <!-- Interview Stats -->
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8 sm:mb-12">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-orange-500 rounded-lg p-2.5 sm:p-3">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm font-medium text-gray-500">Total Interviews</p>
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-lg p-2.5 sm:p-3">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm font-medium text-gray-500">Upcoming</p>
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $stats['upcoming'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-lg p-2.5 sm:p-3">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm font-medium text-gray-500">Completed</p>
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $stats['completed'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 rounded-lg p-2.5 sm:p-3">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm font-medium text-gray-500">Pending</p>
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $stats['pending'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 rounded-lg p-2.5 sm:p-3">
                        <svg class="h-5 w-5 sm:h-6 sm:w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-3 sm:ml-4">
                        <p class="text-xs sm:text-sm font-medium text-gray-500">This Week</p>
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $stats['this_week'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6 sm:mb-10">
            <form method="GET" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <div class="relative">
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                               placeholder="Interview title, company..."
                               class="w-full pl-8 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                        <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="application_method" class="block text-sm font-medium text-gray-700 mb-2">Application Method</label>
                    <select id="application_method" name="application_method" class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white">
                        <option value="">All Methods</option>
                        <option value="email" {{ request('application_method') == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="whatsapp" {{ request('application_method') == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                        <option value="external_site" {{ request('application_method') == 'external_site' ? 'selected' : '' }}>External Website</option>
                        <option value="phone" {{ request('application_method') == 'phone' ? 'selected' : '' }}>Phone</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Interview Listings -->
        @if($interviews->isNotEmpty())
            <div class="grid gap-4 sm:gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($interviews as $interview)
                    <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:border-orange-200 transition-all duration-200">
                        <div class="p-4 sm:p-6">
                            <!-- Company Image and Title -->
                            <div class="flex items-start space-x-3 sm:space-x-4 mb-3 sm:mb-4">
                                @if($interview->company_image)
                                    <div class="flex-shrink-0 w-12 h-12 sm:w-16 sm:h-16 rounded-lg overflow-hidden bg-gray-100">
                                        <img src="{{ asset($interview->company_image) }}" alt="{{ $interview->company }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="flex-shrink-0 w-12 h-12 sm:w-16 sm:h-16 rounded-lg bg-orange-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h-14m14 0l-6-6m6 6l-6-6m6 6v-3m-6 3v3"></path>
                                        </svg>
                                    </div>
                                @endif

                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-1 line-clamp-2">
                                        {{ $interview->job_title }}
                                    </h3>
                                    <p class="text-gray-700 font-medium text-sm sm:text-base">{{ $interview->company }}</p>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <div class="flex flex-wrap gap-1.5 sm:gap-2 mb-3 sm:mb-4">
                                <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium
                                    {{ match($interview->status) {
                                        'upcoming' => 'bg-green-100 text-green-800',
                                        'completed' => 'bg-blue-100 text-blue-800',
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-700'
                                    } }}">
                                    {{ ucfirst($interview->status) }}
                                </span>
                            </div>

                            <!-- Application Method Badge -->
                            @if($interview->application_method)
                                <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs font-medium
                                            {{ match($interview->application_method) {
                                                'email' => 'bg-blue-100 text-blue-800',
                                                'whatsapp' => 'bg-green-100 text-green-800',
                                                'external_site' => 'bg-purple-100 text-purple-800',
                                                'phone' => 'bg-yellow-100 text-yellow-800',
                                                default => 'bg-gray-100 text-gray-700'
                                            } }}">
                                            {{ match($interview->application_method) {
                                                'email' => 'Email',
                                                'whatsapp' => 'WhatsApp',
                                                'external_site' => 'External Website',
                                                'phone' => 'Phone',
                                                default => 'Unknown'
                                            } }}
                                        </span>
                            @endif

                            <!-- Date and Time -->
                            <div class="space-y-1.5 text-xs sm:text-sm text-gray-600 mb-3 sm:mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $interview->date->format('M j, Y') }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $interview->time->format('g:i A') }}</span>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-2 sm:gap-3">
                                @if($interview->meeting_link)
                                    <a href="{{ $interview->meeting_link }}" target="_blank"
                                       class="flex-1 text-center px-3 sm:px-4 py-2 sm:py-2.5 bg-orange-600 text-white text-xs sm:text-sm font-medium rounded-lg hover:bg-orange-700 transition">
                                        Join Interview
                                    </a>
                                @endif

                                <a href="{{ route('user.interviews.show', $interview) }}"
                                   class="flex-1 text-center px-3 sm:px-4 py-2 sm:py-2.5 bg-gray-100 text-gray-700 text-xs sm:text-sm font-medium rounded-lg hover:bg-gray-200 transition">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $interviews->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-lg border border-gray-100 p-10 sm:p-12 text-center">
                <svg class="mx-auto h-16 w-16 sm:h-20 sm:w-20 text-orange-400 mb-6 sm:mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-900 mb-3 sm:mb-4">No Interviews Available</h3>
                <p class="text-base sm:text-lg text-gray-600 mb-8 sm:mb-10 max-w-xl mx-auto">
                    There are no interview opportunities available at the moment. Check back later for new postings.
                </p>
                <a href="{{ route('jobs.index') }}"
                   class="inline-flex items-center px-8 sm:px-10 py-3 sm:py-4 md:py-5 bg-orange-600 text-white font-bold text-base sm:text-lg md:text-xl rounded-xl sm:rounded-2xl hover:bg-orange-700 transition-all shadow-lg">
                    Browse Job Opportunities
                    <svg class="ml-2 sm:ml-3 w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4-4m4 4H3"></path>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</div>
@endsection