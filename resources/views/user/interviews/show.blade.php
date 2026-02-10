@extends('user.layout')

@section('title', 'Interview Details')

@section('content')
<div class="min-h-screen bg-gray-50 pb-8">
    <div class="p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto">
        <!-- Back Button -->
        <div class="mb-4 sm:mb-6">
            <a href="{{ route('user.interviews.index') }}" 
               class="inline-flex items-center px-3 sm:px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition shadow-md text-xs sm:text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>

        <!-- Interview Details -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="p-4 sm:p-6 lg:p-8">
                <!-- Company Header -->
                <div class="flex items-start space-x-3 sm:space-x-4 mb-6">
                    @if($interview->company_image)
                        <div class="flex-shrink-0 w-14 h-14 sm:w-20 sm:h-20 rounded-xl overflow-hidden bg-gray-100 shadow-lg">
                            <img src="{{ asset($interview->company_image) }}" alt="{{ $interview->company }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="flex-shrink-0 w-14 h-14 sm:w-20 sm:h-20 rounded-xl bg-orange-100 flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 sm:w-10 sm:h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h-14m14 0l-6-6m6 6l-6-6m6 6v-3m-6 3v3"></path>
                            </svg>
                        </div>
                    @endif

                    <div class="flex-1 min-w-0">
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-1 leading-tight">{{ $interview->job_title }}</h1>
                        <p class="text-base sm:text-lg text-gray-700 font-medium mb-2">{{ $interview->company }}</p>
                        
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
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
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    {{ $interview->type }}
                                </span>
                            @endif

                            @if($interview->duration)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-orange-50 text-orange-700">
                                    {{ $interview->duration }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Interview Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6">
                    <div class="space-y-3 sm:space-y-4">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3">Schedule Details</h3>
                        
                        <div class="space-y-2.5">
                            <div class="flex items-center text-sm sm:text-base text-gray-700">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $interview->date->format('F j, Y') }}</span>
                            </div>

                            <div class="flex items-center text-sm sm:text-base text-gray-700">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $interview->time->format('g:i A') }}</span>
                            </div>

                            @if($interview->duration)
                                <div class="flex items-center text-sm sm:text-base text-gray-700">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2.5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $interview->duration }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($interview->meeting_link)
                        <div class="space-y-3 sm:space-y-4">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3">Meeting Link</h3>
                            <div class="bg-orange-50 rounded-lg p-3 sm:p-4 border border-orange-200">
                                <p class="text-xs sm:text-sm text-gray-600 mb-2">Click to join:</p>
                                <a href="{{ $interview->meeting_link }}" target="_blank" 
                                   class="text-orange-600 hover:text-orange-700 font-medium text-xs sm:text-sm break-all block mb-3">
                                    {{ Str::limit($interview->meeting_link, 40) }}
                                </a>
                                
                            </div>
                        </div>
                    @endif
                </div>

                @if($interview->job)
                    <div class="space-y-3 sm:space-y-4 mb-6">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900">Related Job</h3>
                        <div class="bg-gray-50 rounded-lg p-3 sm:p-4 border border-gray-200">
                            <div class="flex items-start space-x-3 mb-3">
                                @if($interview->job->image)
                                    <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-lg overflow-hidden bg-gray-100">
                                        <img src="{{ asset($interview->job->image) }}" alt="{{ $interview->job->company }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="flex-shrink-0 w-10 h-10 sm:w-12 sm:h-12 rounded-lg bg-orange-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745M21 13.255A9.002 9.002 0 0012 3a9.002 9.002 0 00-9 10.255M12 3v18"></path>
                                        </svg>
                                    </div>
                                @endif

                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm sm:text-base font-semibold text-gray-900 mb-1 leading-tight">{{ $interview->job->title }}</h4>
                                    <p class="text-xs sm:text-sm text-gray-600">{{ $interview->job->company }}</p>
                                    <div class="flex items-center text-xs text-gray-500 mt-1 flex-wrap">
                                        <span>{{ $interview->job->location ?: 'Remote' }}</span>
                                        @if($interview->job->type)
                                            <span class="mx-1.5">•</span>
                                            <span>{{ $interview->job->type }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('jobs.show', $interview->job) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 bg-white text-gray-700 border border-gray-300 font-medium rounded-lg hover:bg-gray-50 transition text-xs sm:text-sm">
                                View Job Details
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif

                @if($interview->notes)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-3">Additional Notes</h3>
                        <div class="prose prose-sm sm:prose max-w-none text-gray-700 leading-relaxed">
                            {!! nl2br(e($interview->notes)) !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @if($interview->meeting_link)
                <a href="{{ $interview->meeting_link }}" target="_blank"
                   class="inline-flex items-center justify-center px-4 py-2.5 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 transition shadow-md text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    Join Interview
                </a>
            @endif
           

            @if($interview->job)
                <a href="{{ route('jobs.show', $interview->job) }}" 
                   class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-100 text-gray-700 border border-gray-300 font-medium rounded-lg hover:bg-gray-200 transition text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A9.002 9.002 0 0112 21a9.002 9.002 0 01-9-7.745"></path>
                    </svg>
                    View Job
                </a>
            @endif

            @if($interview->application_method === 'whatsapp')
                <button onclick="shareViaWhatsApp('{{ $interview->whatsapp_number }}', 'I want to apply for the {{ $interview->job_title }} interview at {{ $interview->company }}')"
                        class="inline-flex items-center justify-center px-4 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors shadow-md text-sm">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Apply via WhatsApp
                </button>
            @endif

            @if($interview->application_method === 'external_site')
                <a href="{{ $interview->application_link }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center justify-center px-4 py-2.5 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors shadow-md text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                    Apply on Website
                </a>
            @endif

            @if($interview->application_method === 'email')
                <a href="mailto:{{ $interview->email }}" 
                   class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-md text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Apply via Email
                </a>
            @endif

            @if($interview->application_method === 'phone')
                <a href="tel:{{ $interview->phone_number }}" 
                   class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition-colors shadow-md text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    Call to Apply
                </a>
            @endif

            <button class="inline-flex items-center justify-center px-4 py-2.5 bg-yellow-100 text-yellow-700 border border-yellow-300 font-medium rounded-lg hover:bg-yellow-200 transition text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Reschedule
            </button>

            <button class="inline-flex items-center justify-center px-4 py-2.5 bg-red-100 text-red-700 border border-red-300 font-medium rounded-lg hover:bg-red-200 transition text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Cancel
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