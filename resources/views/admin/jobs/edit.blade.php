@extends('admin.layout')

@section('title', 'Edit Job')

@section('content')
<div class="p-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Edit Job</h1>
        <p class="mt-2 text-gray-600">Update job posting information</p>
    </div>

    <div class="bg-white rounded-lg shadow">
        <form method="POST" action="{{ route('admin.jobs.update', $job) }}">
            @csrf
            @method('PUT')
            
            <div class="p-6 space-y-6">
                <!-- Job Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Job Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="title" 
                           name="title" 
                           value="{{ $job->title }}"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company -->
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                        Company <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="company" 
                           name="company" 
                           value="{{ $job->company }}"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('company')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                        Location
                    </label>
                    <input type="text" 
                           id="location" 
                           name="location" 
                           value="{{ $job->location }}"
                           placeholder="e.g., Dar es Salaam, Remote, etc."
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Job Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                        Job Type <span class="text-red-500">*</span>
                    </label>
                    <select id="type" 
                            name="type" 
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select job type</option>
                        <option value="Full-time" {{ $job->type == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                        <option value="Part-time" {{ $job->type == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                        <option value="Remote" {{ $job->type == 'Remote' ? 'selected' : '' }}>Remote</option>
                        <option value="Contract" {{ $job->type == 'Contract' ? 'selected' : '' }}>Contract</option>
                        <option value="Freelance" {{ $job->type == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Experience Level -->
                <div>
                    <label for="experience_level" class="block text-sm font-medium text-gray-700 mb-2">
                        Experience Level
                    </label>
                    <select id="experience_level" 
                            name="experience_level" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select experience level</option>
                        <option value="Entry Level" {{ $job->experience_level == 'Entry Level' ? 'selected' : '' }}>Entry Level</option>
                        <option value="Mid Level" {{ $job->experience_level == 'Mid Level' ? 'selected' : '' }}>Mid Level</option>
                        <option value="Senior Level" {{ $job->experience_level == 'Senior Level' ? 'selected' : '' }}>Senior Level</option>
                        <option value="Executive" {{ $job->experience_level == 'Executive' ? 'selected' : '' }}>Executive</option>
                    </select>
                    @error('experience_level')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Salary -->
                <div>
                    <label for="salary" class="block text-sm font-medium text-gray-700 mb-2">
                        Salary
                    </label>
                    <input type="text" 
                           id="salary" 
                           name="salary" 
                           value="{{ $job->salary }}"
                           placeholder="e.g., TZS 1,000,000 - 2,000,000"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                    @error('salary')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Job Description <span class="text-red-500">*</span>
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="8" 
                              required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">{{ $job->description }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active Status -->
                <div class="flex items-center">
                    <input type="checkbox" 
                           id="is_active" 
                           name="is_active" 
                           value="1"
                           {{ $job->is_active ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">
                        Make this job posting active
                    </label>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="bg-gray-50 px-6 py-3 flex justify-end space-x-3">
                <a href="{{ route('admin.jobs.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Update Job
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
