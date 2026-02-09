@extends('user.layout')

@section('title', 'Saved Jobs')

@section('content')
<div class="p-6 lg:p-10 max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Saved Jobs</h1>
        <p class="mt-2 text-lg text-gray-600">Keep track of the opportunities you're interested in</p>
    </div>

    <!-- Saved Jobs Grid -->
    @if($savedJobs->isNotEmpty())
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($savedJobs as $job)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl hover:border-orange-200 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6 md:p-8">
                        <!-- Job Header -->
                        <div class="flex items-start justify-between mb-5">
                            <div class="flex-1">
                                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2 line-clamp-2">
                                    <a href="{{ route('jobs.show', $job) }}" class="hover:text-orange-600 transition-colors">
                                        {{ $job->title }}
                                    </a>
                                </h3>
                                <p class="text-lg font-semibold text-orange-600">{{ $job->company }}</p>
                            </div>

                            <span class="inline-flex px-5 py-2 text-sm font-bold rounded-full shadow-sm
                                {{ match($job->type) {
                                    'Full-time' => 'bg-green-100 text-green-800 border border-green-200',
                                    'Part-time' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                    'Remote'    => 'bg-blue-100 text-blue-800 border border-blue-200',
                                    'Contract'  => 'bg-purple-100 text-purple-800 border border-purple-200',
                                    'Freelance' => 'bg-pink-100 text-pink-800 border border-pink-200',
                                    default     => 'bg-orange-100 text-orange-800 border border-orange-200'
                                } }}">
                                {{ $job->type }}
                            </span>
                        </div>

                        <!-- Job Meta -->
                        <div class="space-y-4 text-gray-700 mb-6">
                            <div class="flex items-center text-base">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $job->location ?: 'Remote / Worldwide' }}</span>
                            </div>

                            @if($job->experience_level)
                            <div class="flex items-center text-base">
                                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $job->experience_level }}</span>
                            </div>
                            @endif

                            <div class="text-base text-gray-500">
                                Saved {{ $job->saved_at->diffForHumans() ?? $job->created_at->diffForHumans() }}
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                            <a href="{{ route('jobs.show', $job) }}" 
                               class="inline-flex items-center px-6 py-3 bg-orange-50 text-orange-700 font-semibold rounded-xl hover:bg-orange-100 transition">
                                View Details
                            </a>

                            <form method="POST" action="{{ route('user.saved-jobs.remove', $job) }}" class="inline" onsubmit="this.querySelector('button').disabled = true; this.querySelector('button').innerHTML = 'Removing...';">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-800 font-medium transition"
                                        onclick="if(this.form.submitted) return false; this.form.submitted = true;">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $savedJobs->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center">
            <svg class="mx-auto h-20 w-20 text-orange-400 mb-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
            </svg>
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">No Saved Jobs Yet</h3>
            <p class="text-lg text-gray-600 mb-10 max-w-xl mx-auto">
                Save jobs that interest you while browsing — they'll appear here for easy access.
            </p>
            <a href="{{ route('jobs.index') }}" 
               class="inline-flex items-center px-10 py-5 bg-orange-600 text-white font-bold text-xl rounded-2xl hover:bg-orange-700 transition-all shadow-lg">
                Start Browsing Jobs
            </a>
        </div>
    @endif
</div>
@endsection