<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'OBY PORTAL'))</title>

    <!-- Open Graph Meta Tags for WhatsApp Sharing -->
    @if(request()->routeIs('jobs.show') && isset($job))
        <meta property="og:title" content="{{ $job->title }} - {{ $job->company }}">
        <meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($job->description), 150) }}">
        <meta property="og:url" content="{{ route('jobs.show', $job) }}">
        <meta property="og:type" content="website">
        @if($job->image)
            <meta property="og:image" content="{{ asset($job->image) }}">
            <meta property="og:image:width" content="1200">
            <meta property="og:image:height" content="630">
        @endif
        <meta property="og:site_name" content="OBY PORTAL">
    @endif

    <!-- Twitter Card Meta Tags -->
    @if(request()->routeIs('jobs.show') && isset($job))
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $job->title }} - {{ $job->company }}">
        <meta name="twitter:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($job->description), 150) }}">
        @if($job->image)
            <meta name="twitter:image" content="{{ asset($job->image) }}">
        @endif
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen bg-gray-100">

        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Header (optional) -->
        @yield('header')

        <!-- Page Content -->
        <main class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Success / Error Messages -->
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

    </div>

    <script>
        // Prevent double-click on all forms
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn && !submitBtn.disabled) {
                        submitBtn.disabled = true;
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = 'Processing...';
                        
                        // Re-enable after 10 seconds in case of error
                        setTimeout(() => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;
                        }, 10000);
                    }
                });
            });
        });
    </script>

</body>
</html>