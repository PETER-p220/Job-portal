@extends('user.layout')

@section('title', 'Interview Details')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('user.interviews.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition shadow-md text-sm sm:text-base">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Interviews
            </a>
        </div>

        <!-- Interview Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8">
            <div class="p-6 sm:p-8">
                <!-- Company Header -->
                <div class="flex items-start space-x-4 sm:space-x-6 mb-6 sm:mb-8">
                    @if($interview->company_image)
                        <div class="flex-shrink-0 w-16 h-16 sm:w-20 sm:h-20 rounded-xl overflow-hidden bg-gray-100 shadow-lg">
                            <img src="{{ asset($interview->company_image) }}" alt="{{ $interview->company }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="flex-shrink-0 w-16 h-16 sm:w-20 sm:h-20 rounded-xl bg-orange-100 flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h-14m14 0l-6-6m6 6l-6-6m6 6v-3m-6 3v3"></path>
                            </svg>
                        </div>
                    @endif

                    <div class="flex-1">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">{{ $interview->job_title }}</h1>
                        <p class="text-lg sm:text-xl text-gray-700 font-medium">{{ $interview->company }}</p>
                        
                        <div class="flex flex-wrap gap-2 mt-3">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium
                                {{ match($interview->status) {
                                    'upcoming' => 'bg-green-100 text-green-800',
                                    'completed' => 'bg-blue-100 text-blue-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-700'
                                } }}">
                                {{ ucfirst($interview->status) }}
                            </span>

                            @if($interview->type)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    {{ $interview->type }}
                                </span>
                            @endif

                            @if($interview->duration)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-orange-50 text-orange-700">
                                    {{ $interview->duration }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Interview Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 mb-6 sm:mb-8">
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Schedule Details</h3>
                        
                        <div class="space-y-3">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $interview->date->format('F j, Y') }}</span>
                            </div>

                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $interview->time->format('g:i A') }}</span>
                            </div>

                            @if($interview->duration)
                                <div class="flex items-center text-gray-700">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $interview->duration }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($interview->meeting_link)
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Meeting Link</h3>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-600 mb-2">Click to join the interview:</p>
                                        <a href="{{ $interview->meeting_link }}" target="_blank" 
                                           class="text-orange-600 hover:text-orange-700 font-medium text-sm break-all">
                                            {{ $interview->meeting_link }}
                                        </a>
                                    </div>
                                    <a href="{{ $interview->meeting_link }}" target="_blank"
                                       class="inline-flex items-center px-6 py-3 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition shadow-md">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 752l2.122 2.122a1 1 0 001.414 0l4.293-4.293a1 1 0 00.001.414l-1.994 1.994a1 1 0 00-.414.414L10 14.586 8.293a1 1 0 00-1.414 0l-4.293 4.293a1 1 0 00-.001.414l1.994 1.994a1 1 0 00.414-.414L14 17.414 8.293a1 1 0 001.414 0l4.293-4.293a1 1 0 00.001-.414l-1.994-1.994a1 1 0 00-.414-.414z"></path>
                                        </svg>
                                        Join Interview
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($interview->job)
                        <div class="space-y-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Related Job</h3>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-center space-x-3">
                                    @if($interview->job->image)
                                        <div class="flex-shrink-0 w-12 h-12 rounded-lg overflow-hidden bg-gray-100">
                                            <img src="{{ asset($interview->job->image) }}" alt="{{ $interview->job->company }}" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                                            </svg>
                                        </div>
                                    @endif

                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-base font-semibold text-gray-900 mb-1">{{ $interview->job->title }}</h4>
                                        <p class="text-sm text-gray-600">{{ $interview->job->company }}</p>
                                        <div class="flex items-center text-xs text-gray-500 mt-1">
                                            <span>{{ $interview->job->location ?: 'Remote' }}</span>
                                            @if($interview->job->type)
                                                <span class="mx-2">•</span>
                                                <span>{{ $interview->job->type }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('jobs.show', $interview->job) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-white text-gray-700 border border-gray-300 font-medium rounded-lg hover:bg-gray-50 transition text-sm">
                                    View Job Details
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4-4m4 4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                @if($interview->notes)
                    <div class="mt-6 sm:mt-8 pt-6 sm:pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Additional Notes</h3>
                        <div class="prose prose-gray max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($interview->notes)) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-4">
            @if($interview->meeting_link)
                <a href="{{ $interview->meeting_link }}" target="_blank"
                   class="inline-flex items-center px-6 py-3 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 752l2.122 2.122a1 1 0 001.414 0l4.293-4.293a1 1 0 00.001.414l-1.994 1.994a1 1 0 00-.414.414L10 14.586 8.293a1 1 0 00-1.414 0l-4.293 4.293a1 1 0 00-.001.414l1.994 1.994a1 1 0 00.414-.414L14 17.414 8.293a1 1 0 001.414 0l4.293-4.293a1 1 0 00.001-.414l-1.994-1.994a1 1 0 00-.414-.414z"></path>
                    </svg>
                    Join Interview
                </a>
            @endif

            @if($interview->job)
                <a href="{{ route('jobs.show', $interview->job) }}" 
                   class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 border border-gray-300 font-medium rounded-lg hover:bg-gray-200 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4-4m4 4H3"></path>
                    </svg>
                    View Job Details
                </a>
            @endif

            @if($interview->application_method === 'whatsapp')
                <button onclick="shareViaWhatsApp('{{ $interview->whatsapp_number }}', 'I want to apply for the {{ $interview->job_title }} interview at {{ $interview->company }}')"
                        class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16h12M4 4h16m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Apply via WhatsApp
                </button>
            @endif

            @if($interview->application_method === 'external_site')
                <a href="{{ $interview->application_link }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center px-6 py-3 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Apply on Website
                </a>
            @endif

            @if($interview->application_method === 'email')
                <a href="mailto:{{ $interview->email }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Apply via Email
                </a>
            @endif

            @if($interview->application_method === 'phone')
                <a href="tel:{{ $interview->phone_number }}" 
                   class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white font-medium rounded-lg hover:bg-yellow-700 transition-colors shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h14a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002 2v4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Call to Apply
                </a>
            @endif

            <button class="inline-flex items-center px-6 py-3 bg-yellow-100 text-yellow-700 border border-yellow-300 font-medium rounded-lg hover:bg-yellow-200 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16h12M4 4h16m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Reschedule
            </button>

            <button class="inline-flex items-center px-6 py-3 bg-red-100 text-red-700 border border-red-300 font-medium rounded-lg hover:bg-red-200 transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Cancel Interview
            </button>
        </div>
    </div>
</div>

<script>
function shareViaWhatsApp(phoneNumber, message) {
    if (phoneNumber) {
        const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, '_blank');
        return false;
    }
}
</script>
@endsection
