@extends('layouts.app')

@section('title', 'Edit Job')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Job Posting</h1>
                    <p class="mt-2 text-gray-600">Update the details of your job posting</p>
                </div>
                <a href="{{ route('jobs.show', $job) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Job
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Job Information</h2>
            </div>
            
            <form action="{{ route('jobs.update', $job) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Job Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Job Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title', $job->title) }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company -->
                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                            Company Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="company" name="company" value="{{ old('company', $job->company) }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                               required>
                        @error('company')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            Location
                        </label>
                        <input type="text" id="location" name="location" value="{{ old('location', $job->location) }}" 
                               placeholder="e.g., New York, NY or Remote" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Job Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Job Type <span class="text-red-500">*</span>
                        </label>
                        <select id="type" name="type" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                required>
                            <option value="">Select Job Type</option>
                            <option value="Full-time" {{ old('type', $job->type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="Part-time" {{ old('type', $job->type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="Remote" {{ old('type', $job->type) == 'Remote' ? 'selected' : '' }}>Remote</option>
                            <option value="Contract" {{ old('type', $job->type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                            <option value="Freelance" {{ old('type', $job->type) == 'Freelance' ? 'selected' : '' }}>Freelance</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Salary -->
                    <div>
                        <label for="salary" class="block text-sm font-medium text-gray-700 mb-2">
                            Salary Range
                        </label>
                        <input type="text" id="salary" name="salary" value="{{ old('salary', $job->salary) }}" 
                               placeholder="e.g., $50,000 - $70,000" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('salary')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Experience Level -->
                    <div>
                        <label for="experience_level" class="block text-sm font-medium text-gray-700 mb-2">
                            Experience Level
                        </label>
                        <input type="text" id="experience_level" name="experience_level" value="{{ old('experience_level', $job->experience_level) }}" 
                               placeholder="e.g., Senior, Mid-level, Entry-level" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('experience_level')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Job Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" name="description" rows="8" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                  required>{{ old('description', $job->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Application Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Application Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $job->email) }}" 
                               placeholder="jobs@company.com" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Application URL -->
                    <div>
                        <label for="apply_url" class="block text-sm font-medium text-gray-700 mb-2">
                            Application URL
                        </label>
                        <input type="url" id="apply_url" name="apply_url" value="{{ old('apply_url', $job->apply_url) }}" 
                               placeholder="https://company.com/careers/apply" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('apply_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="mt-8 flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" {{ $job->is_active ? 'checked' : '' }} 
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('jobs.show', $job) }}" 
                           class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Update Job
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
