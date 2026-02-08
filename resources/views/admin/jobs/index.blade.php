@extends('admin.layout')

@section('title', 'All Jobs')

@section('content')
<div class="p-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold mb-6">All Job Postings</h1>
        
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 rounded-lg p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Active Jobs</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $activeJobs }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-red-500 rounded-lg p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Expired Jobs</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $expiredJobs }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 rounded-lg p-3">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Jobs</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $activeJobs + $expiredJobs }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deadline</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($jobs as $job)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $job->title }}</div>
                            <div class="text-xs text-gray-500">{{ $job->type }}</div>
                        </td>
                        <td class="px-6 py-4">{{ $job->company }}</td>
                        <td class="px-6 py-4">
                            @if($job->deadline)
                                <div class="text-sm text-gray-900">{{ $job->deadline->format('M d, Y') }}</div>
                                @if($job->isExpired())
                                    <div class="text-xs text-red-600">Expired</div>
                                @else
                                    <div class="text-xs text-green-600">{{ $job->deadline->diffForHumans() }} left</div>
                                @endif
                            @else
                                <div class="text-sm text-gray-500">No deadline</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($job->isExpired())
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Expired
                                </span>
                            @elseif($job->isActive())
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                            <a href="{{ route('admin.jobs.edit', $job) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            
                            @if($job->isExpired())
                                <form action="{{ route('admin.jobs.extend-deadline', $job) }}" method="POST" class="inline-block" onsubmit="return confirm('Do you want to extend the deadline for this job?')">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900">Extend</button>
                                </form>
                            @endif
                            
                            <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this job?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">No jobs found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $jobs->links() }}
    </div>
</div>
@endsection
