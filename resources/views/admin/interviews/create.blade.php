@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Schedule Interview</h1>
        <p class="text-gray-600 mt-2">Schedule a new interview for a candidate</p>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <form action="{{ route('admin.interviews.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Candidate Selection -->
                <div class="md:col-span-2">
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Candidate <span class="text-red-500">*</span>
                    </label>
                    <select id="user_id" name="user_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Select a candidate</option>
                        @foreach(App\Models\User::where('role', 'user')->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Job Selection -->
                <div>
                    <label for="job_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Related Job (Optional)
                    </label>
                    <select id="job_id" name="job_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Select a job (optional)</option>
                        @foreach(App\Models\Job::all() as $job)
                            <option value="{{ $job->id }}">{{ $job->title }} - {{ $job->company }}</option>
                        @endforeach
                    </select>
                    @error('job_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company -->
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                        Company <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="company" name="company" required
                           value="{{ old('company') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                           placeholder="Company name">
                    @error('company')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Job Title -->
                <div>
                    <label for="job_title" class="block text-sm font-medium text-gray-700 mb-2">
                        Job Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="job_title" name="job_title" required
                           value="{{ old('job_title') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                           placeholder="Job title">
                    @error('job_title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Interview Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                        Interview Type <span class="text-red-500">*</span>
                    </label>
                    <select id="type" name="type" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Select type</option>
                        <option value="Video Call" {{ old('type') == 'Video Call' ? 'selected' : '' }}>Video Call</option>
                        <option value="Phone Call" {{ old('type') == 'Phone Call' ? 'selected' : '' }}>Phone Call</option>
                        <option value="In-Person" {{ old('type') == 'In-Person' ? 'selected' : '' }}>In-Person</option>
                    </select>
                    @error('type')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Date -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                        Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="date" name="date" required
                           value="{{ old('date') }}"
                           min="{{ now()->format('Y-m-d') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    @error('date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Time -->
                <div>
                    <label for="time" class="block text-sm font-medium text-gray-700 mb-2">
                        Time <span class="text-red-500">*</span>
                    </label>
                    <input type="time" id="time" name="time" required
                           value="{{ old('time') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    @error('time')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Duration -->
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">
                        Duration (minutes) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="duration" name="duration" required
                           value="{{ old('duration') ?: '60' }}"
                           min="15" max="480"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                           placeholder="60">
                    @error('duration')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Meeting Link -->
                <div class="md:col-span-2">
                    <label for="meeting_link" class="block text-sm font-medium text-gray-700 mb-2">
                        Meeting Link / Location <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="meeting_link" name="meeting_link" required
                           value="{{ old('meeting_link') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                           placeholder="https://zoom.us/j/123456789 or 123 Main St, City, State">
                    @error('meeting_link')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div class="md:col-span-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Notes (Optional)
                    </label>
                    <textarea id="notes" name="notes" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                              placeholder="Additional notes about the interview...">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('admin.interviews.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-orange-600 text-white font-medium rounded-xl hover:bg-orange-700 transition-colors">
                    Schedule Interview
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
