@extends('layouts.app')

@section('title', 'Post a New Job')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Post a New Job</h1>
            <p class="text-lg text-gray-600">Find the perfect candidate for your opportunity</p>
        </div>

        <!-- Job Creation Form -->
        <form action="{{ route('jobs.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg p-8">
            @csrf
            
            <!-- Job Information Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6 pb-2 border-b border-gray-200">Job Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Job Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title *</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror"
                               placeholder="e.g. Senior Laravel Developer">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Name -->
                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company Name *</label>
                        <input type="text" name="company" id="company" value="{{ old('company') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('company') border-red-500 @enderror"
                               placeholder="e.g. Tech Corp">
                        @error('company')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('location') border-red-500 @enderror"
                               placeholder="e.g. Dar es Salaam, Remote">
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Job Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Job Type *</label>
                        <select name="type" id="type"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('type') border-red-500 @enderror">
                            <option value="">Select job type</option>
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

                    <!-- Experience Level -->
                    <div>
                        <label for="experience_level" class="block text-sm font-medium text-gray-700 mb-2">Experience Level</label>
                        <select name="experience_level" id="experience_level"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('experience_level') border-red-500 @enderror">
                            <option value="">Select experience level</option>
                            <option value="Entry Level" {{ old('experience_level') == 'Entry Level' ? 'selected' : '' }}>Entry Level</option>
                            <option value="Mid Level" {{ old('experience_level') == 'Mid Level' ? 'selected' : '' }}>Mid Level</option>
                            <option value="Senior Level" {{ old('experience_level') == 'Senior Level' ? 'selected' : '' }}>Senior Level</option>
                            <option value="Executive" {{ old('experience_level') == 'Executive' ? 'selected' : '' }}>Executive</option>
                        </select>
                        @error('experience_level')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Salary -->
                    <div>
                        <label for="salary" class="block text-sm font-medium text-gray-700 mb-2">Salary Range</label>
                        <input type="text" name="salary" id="salary" value="{{ old('salary') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('salary') border-red-500 @enderror"
                               placeholder="e.g. TZS 1,000,000 - 2,000,000">
                        @error('salary')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Application Deadline -->
                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">Application Deadline *</label>
                        <input type="date" name="deadline" id="deadline" value="{{ old('deadline') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('deadline') border-red-500 @enderror">
                        @error('deadline')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Job Description Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6 pb-2 border-b border-gray-200">Job Description</h2>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                    <textarea name="description" id="description" rows="8"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror"
                              placeholder="Provide a detailed description of the job role, responsibilities, and requirements...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Application Information Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6 pb-2 border-b border-gray-200">Application Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- How to Apply -->
                    <div>
                        <label for="apply_url" class="block text-sm font-medium text-gray-700 mb-2">How to Apply *</label>
                        <input type="url" name="apply_url" id="apply_url" value="{{ old('apply_url') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('apply_url') border-red-500 @enderror"
                               placeholder="https://example.com/apply">
                        @error('apply_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror"
                               placeholder="careers@company.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Company Logo/Image Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6 pb-2 border-b border-gray-200">Company Branding</h2>
                
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Company Logo</label>
                    <div class="flex items-center space-x-4">
                        <input type="file" name="image" id="image" accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('image') border-red-500 @enderror">
                        <div class="text-sm text-gray-500">
                            <p>JPG, PNG, GIF (Max 2MB)</p>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Section -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    <p>* Required fields</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('jobs.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Post Job
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection