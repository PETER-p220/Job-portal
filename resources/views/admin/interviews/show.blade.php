@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Interview Details</h1>
                <p class="text-gray-600 mt-2">View interview information and details</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.interviews.edit', $interview) }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.interviews.destroy', $interview) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-xl hover:bg-red-700 transition-colors"
                            onclick="return confirm('Are you sure you want to delete this interview?')">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Interview Details -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Candidate Info -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Candidate Information</h2>
            <div class="flex items-center">
                <div class="flex-shrink-0 h-16 w-16">
                    <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center">
                        <span class="text-xl font-medium text-gray-600">
                            {{ substr($interview->user->name, 0, 1) }}
                        </span>
                    </div>
                </div>
                <div class="ml-6">
                    <h3 class="text-xl font-bold text-gray-900">{{ $interview->user->name }}</h3>
                    <p class="text-gray-600">{{ $interview->user->email }}</p>
                    <p class="text-sm text-gray-500">Member since {{ $interview->user->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Interview Info -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Interview Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-sm font-medium text-gray-500">Job Title</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $interview->job_title }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Company</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $interview->company }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Interview Type</p>
                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                        @if($interview->type == 'Video Call') bg-blue-100 text-blue-800
                        @elseif($interview->type == 'Phone Call') bg-green-100 text-green-800
                        @else bg-purple-100 text-purple-800 @endif">
                        {{ $interview->type }}
                    </span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Status</p>
                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                        @if($interview->status == 'upcoming') bg-yellow-100 text-yellow-800
                        @elseif($interview->status == 'completed') bg-green-100 text-green-800
                        @elseif($interview->status == 'cancelled') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($interview->status) }}
                    </span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Date</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $interview->date->format('F d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Time</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $interview->time->format('h:i A') }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Duration</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $interview->duration }} minutes</p>
                </div>
                @if($interview->job)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Related Job</p>
                        <a href="{{ route('admin.jobs.show', $interview->job) }}" 
                           class="text-lg font-semibold text-orange-600 hover:text-orange-700">
                            {{ $interview->job->title }}
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Meeting Link -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Meeting Location</h2>
            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-gray-900 font-mono">{{ $interview->meeting_link }}</p>
                @if(str_starts_with($interview->meeting_link, 'http'))
                    <a href="{{ $interview->meeting_link }}" target="_blank" 
                       class="inline-flex items-center mt-3 text-orange-600 hover:text-orange-700 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Open Link
                    </a>
                @endif
            </div>
        </div>

        <!-- Notes -->
        @if($interview->notes)
            <div class="p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Notes</h2>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-900 whitespace-pre-wrap">{{ $interview->notes }}</p>
                </div>
            </div>
        @endif

        <!-- Timestamps -->
        <div class="p-6 bg-gray-50 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-500">
                <div>
                    <p class="font-medium">Scheduled on</p>
                    <p>{{ $interview->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div>
                    <p class="font-medium">Last updated</p>
                    <p>{{ $interview->updated_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
