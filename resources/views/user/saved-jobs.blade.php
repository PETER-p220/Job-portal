@extends('user.layout')

@section('title', 'Saved Jobs')

@section('content')
<div class="p-6 lg:p-10">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Saved Jobs</h1>
        <p class="mt-2 text-gray-600">Jobs you've saved for later review</p>
    </div>

    <!-- Saved Jobs Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($savedJobs as $job)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                <!-- Job Header -->
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $job->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $job->company }}</p>
                        </div>
                        @if($job->isExpired())
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                Expired
                            </span>
                        @endif
                    </div>

                    <!-- Job Details -->
                    <div class="space-y-3 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $job->location }}
                        </div>

                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                            </svg>
                            @if($job->type)
                                {{ $job->type }}
                            @else
                                Not specified
                            @endif
                        </div>

                        @if($job->salary)
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 3-1.343 3-3 3m0-8c1.657 0 3 .895 3 2s-1.343 2-3 2m0-8c1.657 0 3 .895 3 2s-1.343 2-3 2m0-8c1.657 0 3 .895 3 2s-1.343 2-3 2m0-8c1.657 0 3 .895 3 2s-1.343 2-3 2m0-8c1.657 0 3 .895 3 2s-1.343 2-3 2"></path>
                                </svg>
                                {{ $job->salary }}
                            </div>
                        @endif

                        @if($job->deadline)
                            <div class="flex items-center text-sm @if($job->isExpired()) text-red-600 @else text-gray-600 @endif">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                @if($job->isExpired())
                                    Expired {{ $job->deadline->diffForHumans() }}
                                @else
                                    {{ $job->deadline->diffForHumans() }} left
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Description Preview -->
                    <p class="text-sm text-gray-600 line-clamp-3 mb-4">
                        {{ Str::limit(strip_tags($job->description), 150) }}
                    </p>
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('jobs.show', $job) }}" 
                           class="text-orange-600 hover:text-orange-800 font-medium text-sm">
                            View Details
                        </a>
                        
                        <form action="{{ route('user.saved-jobs.remove', $job->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-800 font-medium text-sm"
                                    onclick="return confirm('Are you sure you want to remove this job from saved?')">
                                Remove
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No saved jobs</h3>
                <p class="mt-2 text-gray-500">Start browsing jobs and save the ones you're interested in!</p>
                <a href="{{ route('jobs.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition-colors">
                    Browse Jobs
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
