@extends('user.layout')

@section('title', 'My Applications')

@section('content')
<div class="p-6 lg:p-10">
    <!-- Header -->
    <div class="mb-10">
        <h1 class="text-3xl font-bold text-gray-900">My Applications</h1>
        <p class="mt-2 text-lg text-gray-600">Track the status of all your job applications</p>
    </div>

    <!-- Applications List -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 divide-y divide-gray-200">
        @forelse ($applications as $application)
            <div class="px-6 py-5 hover:bg-gray-50 transition-colors">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">{{ $application->job->title }}</h3>
                        <p class="text-gray-600">{{ $application->job->company }} • {{ $application->job->location ?? 'Remote' }}</p>
                        <div class="mt-2 flex flex-wrap gap-3 text-sm text-gray-500">
                            <span>Applied {{ $application->created_at->diffForHumans() }}</span>
                            <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($application->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($application->status == 'reviewed') bg-blue-100 text-blue-800
                                @elseif($application->status == 'accepted') bg-green-100 text-green-800
                                @elseif($application->status == 'rejected') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('jobs.show', $application->job) }}" class="text-orange-600 hover:text-orange-800 text-sm font-medium">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="px-6 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No applications yet</h3>
                <p class="mt-2 text-gray-500">When you apply to jobs, they'll appear here.</p>
                <a href="{{ route('jobs.index') }}" class="mt-6 inline-flex items-center px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700">
                    Browse Jobs
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection