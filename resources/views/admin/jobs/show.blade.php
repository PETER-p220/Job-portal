@extends('admin.layout')

@section('title', 'Job Details')

@section('content')
<div class="p-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">{{ $job->title }}</h1>
        <p class="mt-2 text-gray-600">{{ $job->company }}</p>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <!-- Job Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Job Information</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Company</dt>
                            <dd class="text-sm text-gray-900">{{ $job->company }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Location</dt>
                            <dd class="text-sm text-gray-900">{{ $job->location ?? 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Job Type</dt>
                            <dd class="text-sm text-gray-900">{{ $job->type }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Experience Level</dt>
                            <dd class="text-sm text-gray-900">{{ $job->experience_level ?? 'Not specified' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Salary</dt>
                            <dd class="text-sm text-gray-900">{{ $job->salary ?? 'Not specified' }}</dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Information</h3>
                    <dl class="space-y-3">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd>
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $job->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $job->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Posted By</dt>
                            <dd class="text-sm text-gray-900">{{ $job->user ? $job->user->name : 'Unknown' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Posted Date</dt>
                            <dd class="text-sm text-gray-900">{{ $job->created_at->format('M d, Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                            <dd class="text-sm text-gray-900">{{ $job->updated_at->format('M d, Y') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Job Description -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Job Description</h3>
                <div class="prose max-w-none">
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $job->description }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.jobs.edit', $job) }}" 
                   class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Edit Job
                </a>
                <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                            onclick="return confirm('Are you sure you want to delete this job posting?')">
                        Delete Job
                    </button>
                </form>
                <a href="{{ route('admin.jobs.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Back to Jobs
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
