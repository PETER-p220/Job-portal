@extends('user.layout')

@section('title', 'Latest Jobs')

@section('content')
<div class="p-6 lg:p-10 max-w-7xl mx-auto">

            <!-- Page Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-10 gap-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Latest Job Opportunities</h1>
                    <p class="mt-2 text-lg text-gray-600">Discover the newest career opportunities</p>
                </div>

               
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-10">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Keywords</label>
                        <div class="relative">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                   placeholder="Job title, skills, company..."
                                   class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Job Type</label>
                        <select id="type" name="type" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white">
                            <option value="">All Types</option>
                            <option value="Full-time" {{ request('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ request('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Remote" {{ request('type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                            <option value="Contract" {{ request('type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Freelance" {{ request('type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                        </select>
                    </div>

                    <div>
                        <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Experience Level</label>
                        <select id="experience" name="experience" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white">
                            <option value="">All Levels</option>
                            <option value="Entry Level" {{ request('experience') == 'Entry Level' ? 'selected' : '' }}>Entry Level</option>
                            <option value="Mid Level" {{ request('experience') == 'Mid Level' ? 'selected' : '' }}>Mid Level</option>
                            <option value="Senior Level" {{ request('experience') == 'Senior Level' ? 'selected' : '' }}>Senior Level</option>
                            <option value="Executive" {{ request('experience') == 'Executive' ? 'selected' : '' }}>Executive</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button type="submit"
                                class="w-full px-6 py-2.5 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-all shadow-sm">
                            Search Jobs
                        </button>
                    </div>
                </form>
            </div>

            <!-- Job Listings -->
            @if($jobs->isNotEmpty())
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($jobs as $job)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md hover:border-orange-200 transition-all duration-200">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2">
                                    <a href="{{ route('jobs.show', $job) }}" class="hover:text-orange-600 transition-colors">
                                        {{ $job->title }}
                                    </a>
                                </h3>

                                <p class="text-gray-700 font-medium mb-3">{{ $job->company }}</p>

                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                        {{ match($job->type) {
                                            'Full-time' => 'bg-green-100 text-green-800',
                                            'Part-time' => 'bg-yellow-100 text-yellow-800',
                                            'Remote'    => 'bg-blue-100 text-blue-800',
                                            'Contract'  => 'bg-purple-100 text-purple-800',
                                            'Freelance' => 'bg-pink-100 text-pink-800',
                                            default     => 'bg-gray-100 text-gray-700'
                                        } }}">
                                        {{ $job->type }}
                                    </span>

                                    @if($job->location)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                            {{ $job->location }}
                                        </span>
                                    @endif

                                    @if($job->experience_level)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-50 text-orange-700">
                                            {{ $job->experience_level }}
                                        </span>
                                    @endif
                                </div>

                                <div class="text-sm text-gray-500 mb-5">
                                    Posted {{ $job->created_at->diffForHumans() }}
                                    @if($job->user)
                                        • by {{ $job->user->name }}
                                    @endif
                                </div>

                                <a href="{{ route('jobs.show', $job) }}"
                                   class="inline-flex items-center px-5 py-2.5 bg-orange-50 text-orange-700 font-medium rounded-lg hover:bg-orange-100 transition-colors">
                                    View Details
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    {{ $jobs->links() }}
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="mx-auto h-16 w-16 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <h3 class="mt-5 text-xl font-medium text-gray-900">No jobs found</h3>
                    <p class="mt-3 text-gray-600">Try adjusting your search filters or check back later for new opportunities.</p>

                    @auth
                        <div class="mt-8">
                            <a href="{{ route('jobs.create') }}"
                               class="inline-flex items-center px-6 py-3 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-colors shadow-sm">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                Post a Job
                            </a>
                        </div>
                    @endauth
                </div>
            @endif

        </div>
    </main>
</div>
@endsection