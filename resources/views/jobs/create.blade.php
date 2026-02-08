@extends('layouts.app')

@section('title', 'Post a New Job')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Post a New Job</h1>
            <p class="mt-2 text-gray-600">Find the perfect candidate for your opportunity</p>
        </div>

        <form action="{{ route('jobs.store') }}" method="POST" class="bg-white shadow rounded-lg">
            @csrf
            <div class="p-6 space-y-6">
                <!-- Job Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title *</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror"
                           placeholder="e.g. Senior Laravel Developer">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company Name -->
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company Name *</label>
                    <input type="text" name="company" id="company" value="{{ old('company') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('company') border-red-500 @enderror"
                           placeholder="e.g. Tech Corp Inc.">
                    @error('company')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('location') border-red-500 @enderror"
                               placeholder="e.g. New York, NY or Remote">
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Job Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Job Type *</label>
                        <select name="type" id="type" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('type') border-red-500 @enderror">
                            <option value="">Select Job Type</option>
                            <option value="Full-time" {{ old('type') == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('type') == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Remote" {{ old('type') == 'Remote' ? 'selected' : '' }}>Remote</option>
                            <option value="Contract" {{ old('type') == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Freelance" {{ old('type') == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Salary -->
                    <div>
                        <label for="salary" class="block text-sm font-medium text-gray-700 mb-2">Salary</label>
                        <input type="text" name="salary" id="salary" value="{{ old('salary') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('salary') border-red-500 @enderror"
                               placeholder="e.g. $80,000 - $120,000">
                        @error('salary')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Experience Level -->
                    <div>
                        <label for="experience_level" class="block text-sm font-medium text-gray-700 mb-2">Experience Level</label>
                        <select name="experience_level" id="experience_level" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('experience_level') border-red-500 @enderror">
                            <option value="">Select Experience Level</option>
                            <option value="Entry Level" {{ old('experience_level') == 'Entry Level' ? 'selected' : '' }}>Entry Level</option>
                            <option value="Mid Level" {{ old('experience_level') == 'Mid Level' ? 'selected' : '' }}>Mid Level</option>
                            <option value="Senior Level" {{ old('experience_level') == 'Senior Level' ? 'selected' : '' }}>Senior Level</option>
                            <option value="Executive" {{ old('experience_level') == 'Executive' ? 'selected' : '' }}>Executive</option>
                        </select>
                        @error('experience_level')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Job Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Job Description *</label>
                    <textarea name="description" id="description" rows="8"
                              class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror"
                              placeholder="Provide a detailed description of the role, responsibilities, and requirements...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Application URL -->
                    <div>
                        <label for="apply_url" class="block text-sm font-medium text-gray-700 mb-2">Application URL</label>
                        <input type="url" name="apply_url" id="apply_url" value="{{ old('apply_url') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('apply_url') border-red-500 @enderror"
                               placeholder="https://example.com/apply">
                        @error('apply_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Application Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Application Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror"
                               placeholder="careers@company.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-gray-900">
                        Cancel
                    </a>
                    <div class="space-x-3">
                        <button type="button" class="px-6 py-3 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Save as Draft
                        </button>
                        <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                            Post Job
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection