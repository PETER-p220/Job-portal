@extends('admin.layout')

@section('title', 'All Jobs')

@section('content')
<div class="p-8">
    <h1 class="text-3xl font-bold mb-6">All Job Postings</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Company</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($jobs as $job)
                    <tr>
                        <td class="px-6 py-4">{{ $job->title }}</td>
                        <td class="px-6 py-4">{{ $job->company }}</td>
                        <td class="px-6 py-4">
                            <span class="{{ $job->is_active ? 'text-green-600' : 'text-red-600' }}">
                                {{ $job->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.jobs.edit', $job) }}" class="text-indigo-600 hover:underline">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">No jobs found</td>
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