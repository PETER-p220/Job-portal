@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Schedule Interview</h1>
        <p class="text-gray-600 mt-2">Create a new interview posting</p>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
        <form action="{{ route('admin.interviews.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Interview Title -->
                <div class="md:col-span-2">
                    <label for="job_title" class="block text-sm font-medium text-gray-700 mb-2">
                        Interview Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="job_title" 
                           name="job_title" 
                           value="{{ old('job_title') }}"
                           placeholder="e.g., Senior Developer Interview"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    @error('job_title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company Name -->
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                        Company Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="company" 
                           name="company" 
                           value="{{ old('company') }}"
                           placeholder="e.g., Tech Company"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    @error('company')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Company Picture -->
                <div>
                    <label for="company_image" class="block text-sm font-medium text-gray-700 mb-2">
                        Company Picture (Optional)
                    </label>
                    <input type="file" 
                           id="company_image" 
                           name="company_image" 
                           accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <p class="mt-1 text-sm text-gray-500">Upload company logo or image (JPG, PNG, GIF - Max 2MB)</p>
                    @error('company_image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Interview Date -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                        Interview Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           id="date" 
                           name="date" 
                           value="{{ old('date') }}"
                           required
                           min="{{ now()->format('Y-m-d') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    @error('date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Interview Time -->
                <div>
                    <label for="time" class="block text-sm font-medium text-gray-700 mb-2">
                        Interview Time <span class="text-red-500">*</span>
                    </label>
                    <input type="time" 
                           id="time" 
                           name="time" 
                           value="{{ old('time') }}"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    @error('time')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Application Method -->
                <div>
                    <label for="application_method" class="block text-sm font-medium text-gray-700 mb-2">
                        How to Apply <span class="text-red-500">*</span>
                    </label>
                    <select id="application_method" name="application_method" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Select application method</option>
                        <option value="email" {{ old('application_method') == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="whatsapp" {{ old('application_method') == 'whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                        <option value="external_site" {{ old('application_method') == 'external_site' ? 'selected' : '' }}>External Website</option>
                        <option value="phone" {{ old('application_method') == 'phone' ? 'selected' : '' }}>Phone</option>
                    </select>
                    @error('application_method')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Conditional Application Details -->
                <div id="application-details">
                    <!-- Email Field -->
                    <div class="email-field" style="display: none;">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Contact Email
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               placeholder="careers@company.com"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- WhatsApp Field -->
                    <div class="whatsapp-field" style="display: none;">
                        <label for="whatsapp_number" class="block text-sm font-medium text-gray-700 mb-2">
                            WhatsApp Number
                        </label>
                        <input type="text" 
                               id="whatsapp_number" 
                               name="whatsapp_number" 
                               value="{{ old('whatsapp_number') }}"
                               placeholder="+255123456789"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        @error('whatsapp_number')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- External Site Field -->
                    <div class="external_site-field" style="display: none;">
                        <label for="application_link" class="block text-sm font-medium text-gray-700 mb-2">
                            Application Website
                        </label>
                        <input type="url" 
                               id="application_link" 
                               name="application_link" 
                               value="{{ old('application_link') }}"
                               placeholder="https://company.com/careers"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        @error('application_link')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Field -->
                    <div class="phone-field" style="display: none;">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number
                        </label>
                        <input type="tel" 
                               id="phone_number" 
                               name="phone_number" 
                               value="{{ old('phone_number') }}"
                               placeholder="+255123456789"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        @error('phone_number')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Meeting Link -->
                <div class="md:col-span-2">
                    <label for="meeting_link" class="block text-sm font-medium text-gray-700 mb-2">
                        Meeting Link <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           id="meeting_link" 
                           name="meeting_link" 
                           value="{{ old('meeting_link') }}"
                           placeholder="e.g., https://zoom.us/j/123456789"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                    <p class="mt-1 text-sm text-gray-500">Zoom, Google Meet, or other video conference link</p>
                    @error('meeting_link')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Select status</option>
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
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Notes (Optional)
                    </label>
                    <textarea id="notes" name="notes" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                              placeholder="Add any additional notes about the interview...">{{ old('notes') }}</textarea>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const applicationMethod = document.getElementById('application_method');
    const emailField = document.querySelector('.email-field');
    const whatsappField = document.querySelector('.whatsapp-field');
    const externalSiteField = document.querySelector('.external_site-field');
    const phoneField = document.querySelector('.phone-field');
    
    function showApplicationFields() {
        // Hide all fields first
        if (emailField) emailField.style.display = 'none';
        if (whatsappField) whatsappField.style.display = 'none';
        if (externalSiteField) externalSiteField.style.display = 'none';
        if (phoneField) phoneField.style.display = 'none';
        
        // Show relevant field based on selection
        switch (applicationMethod.value) {
            case 'email':
                if (emailField) emailField.style.display = 'block';
                break;
            case 'whatsapp':
                if (whatsappField) whatsappField.style.display = 'block';
                break;
            case 'external_site':
                if (externalSiteField) externalSiteField.style.display = 'block';
                break;
            case 'phone':
                if (phoneField) phoneField.style.display = 'block';
                break;
        }
    }
    
    // Initial call
    showApplicationFields();
    
    // Listen for changes
    applicationMethod.addEventListener('change', showApplicationFields);
});
</script>
@endsection
