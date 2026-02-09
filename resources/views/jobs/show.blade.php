@extends('user.layout')

@section('title', $job->title . ' | ' . $job->company)

@section('content')
<div class="min-h-screen bg-gray-50 py-8 md:py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-2">
                <li>
                    <a href="{{ route('jobs.index') }}" class="text-gray-500 hover:text-orange-600 transition">
                        Jobs
                    </a>
                </li>
                <li class="flex items-center">
                    <svg class="w-4 h-4 mx-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium text-gray-700 truncate max-w-xs">{{ $job->title }}</span>
                </li>
            </ol>
        </nav>

        <!-- Main Job Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            
            <!-- Full Width Image Header -->
            <div class="relative w-full h-64 md:h-80 bg-gradient-to-r from-orange-600 to-orange-500">
                @if($job->image)
                    <img src="{{ asset('uploads/jobs/' . $job->image) }}" 
                         alt="{{ $job->company }}" 
                         class="w-full h-full object-cover">
                @else
                    <!-- Default gradient background when no image -->
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-32 h-32 text-white opacity-30" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Job Title & Company Section -->
            <div class="px-6 md:px-10 py-8 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
                    <div class="flex-1">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                            {{ $job->title }}
                        </h1>
                        <p class="text-xl md:text-2xl text-orange-600 font-semibold mb-4">
                            {{ $job->company }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3 md:self-start">
                        <span class="px-5 py-2 text-sm font-semibold rounded-full bg-orange-100 text-orange-700 border border-orange-200">
                            {{ $job->type }}
                        </span>

                        @if($job->is_active)
                            <span class="px-5 py-2 text-sm font-semibold rounded-full bg-green-100 text-green-700 border border-green-200">
                                Active
                            </span>
                        @else
                            <span class="px-5 py-2 text-sm font-semibold rounded-full bg-red-100 text-red-700 border border-red-200">
                                Inactive
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Job Meta Info -->
            <div class="px-6 md:px-10 py-8 border-b border-gray-100 bg-gray-50">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 mr-3 text-orange-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-1">Location</p>
                            <p class="font-medium text-gray-900 text-sm">{{ $job->location ?: 'Remote / Worldwide' }}</p>
                        </div>
                    </div>

                    @if($job->experience_level)
                    <div class="flex items-start">
                        <svg class="w-6 h-6 mr-3 text-orange-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-1">Experience</p>
                            <p class="font-medium text-gray-900 text-sm">{{ $job->experience_level }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="flex items-start">
                        <svg class="w-6 h-6 mr-3 text-orange-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-1">Posted</p>
                            <p class="font-medium text-gray-900 text-sm">{{ $job->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    @if($job->user)
                    <div class="flex items-start">
                        <svg class="w-6 h-6 mr-3 text-orange-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-1">Posted by</p>
                            <p class="font-medium text-gray-900 text-sm">{{ $job->user->name }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Main Content -->
            <div class="p-6 md:p-10">
                <!-- Description -->
                <div class="mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Job Description</h2>
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>

                <!-- How to Apply -->
                <div class="bg-orange-50 rounded-2xl p-6 md:p-8 border border-orange-100">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-5">How to Apply</h2>

                    <div class="space-y-4">
                        @if($job->apply_url)
                            <div>
                                <p class="text-gray-700 text-sm md:text-base mb-3">
                                    Apply directly through the company's official application page:
                                </p>
                                <a href="{{ $job->apply_url }}" target="_blank" rel="noopener noreferrer"
                                   class="w-full inline-flex items-center justify-center px-5 py-3 md:px-6 md:py-3.5 bg-orange-600 text-white text-sm md:text-base font-semibold rounded-xl hover:bg-orange-700 transition-all shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002 2v4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Apply on Company Website
                                </a>
                            </div>
                        @endif

                        @if($job->application_method === 'whatsapp')
                            <div>
                                <p class="text-gray-700 text-sm md:text-base mb-3">
                                    Apply directly via WhatsApp:
                                </p>
                                <button onclick="shareViaWhatsApp('{{ $job->whatsapp_number }}', '{{ $job->title }} at {{ $job->company }}')"
                                        class="w-full inline-flex items-center justify-center px-5 py-3 md:px-6 md:py-3.5 bg-green-600 text-white text-sm md:text-base font-semibold rounded-xl hover:bg-green-700 transition-all shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002 2v4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Apply via WhatsApp
                                </button>
                            </div>
                        @endif

                        @if($job->application_method === 'external_site')
                            <div>
                                <p class="text-gray-700 text-sm md:text-base mb-3">
                                    Apply directly through the company's application website:
                                </p>
                                <a href="{{ $job->application_link }}" target="_blank" rel="noopener noreferrer"
                                   class="w-full inline-flex items-center justify-center px-5 py-3 md:px-6 md:py-3.5 bg-purple-600 text-white text-sm md:text-base font-semibold rounded-xl hover:bg-purple-700 transition-all shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002 2v4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Apply on Website
                                </a>
                            </div>
                        @endif

                        @if($job->application_method === 'phone')
                            <div>
                                <p class="text-gray-700 text-sm md:text-base mb-3">
                                    Apply by Phone:
                                </p>
                                <a href="tel:{{ $job->phone_number }}" 
                                   class="w-full inline-flex items-center justify-center px-5 py-3 md:px-6 md:py-3.5 bg-yellow-600 text-white text-sm md:text-base font-semibold rounded-xl hover:bg-yellow-700 transition-all shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h14a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002 2v4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Call {{ $job->phone_number }}
                                </a>
                            </div>
                        @endif

                        @if($job->email)
                            <div>
                                <p class="text-gray-700 text-sm md:text-base mb-3">
                                    Or send your resume and cover letter via email:
                                </p>
                                <a href="mailto:{{ $job->email }}" 
                                   class="w-full inline-flex items-center justify-center px-5 py-3 md:px-6 md:py-3.5 bg-white text-orange-700 border-2 border-orange-600 text-sm md:text-base font-semibold rounded-xl hover:bg-orange-50 transition-all">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="truncate">Email: {{ $job->email }}</span>
                                </a>
                            </div>
                        @endif

                        @if(!$job->apply_url && !$job->email)
                            <p class="text-gray-600 text-sm md:text-base italic">
                                No application method specified. Please contact the employer directly.
                            </p>
                        @endif

                        <!-- Save Job Button -->
                        @if(auth()->check() && !auth()->user()->isAdmin())
                            <div class="mt-5 pt-5 border-t border-orange-200">
                                <form action="{{ route('user.saved-jobs.save', $job) }}" method="POST" onsubmit="this.querySelector('button').disabled = true; this.querySelector('button').innerHTML = 'Saving...';">
                                    @csrf
                                    <button type="submit" 
                                            class="w-full inline-flex items-center justify-center px-5 py-3 md:px-6 md:py-3.5 bg-gray-100 text-gray-700 border-2 border-gray-300 text-sm md:text-base font-semibold rounded-xl hover:bg-gray-200 transition-all"
                                            onclick="if(this.form.submitted) return false; this.form.submitted = true;">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                        </svg>
                                        @if(auth()->user()->savedJobs()->where('job_id', $job->id)->exists())
                                            Saved
                                        @else
                                            Save Job
                                        @endif
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('jobs.index') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-800 text-white rounded-xl hover:bg-gray-900 transition shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to All Jobs
            </a>
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