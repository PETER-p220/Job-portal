@props([
    'slot' => 'XXXXXXXXXX',
    'format' => 'auto',
    'class' => 'my-6'
])

@php
    $uniqueId = 'adsense-' . uniqid();
@endphp

<div class="adsense-container {{ $class }}" id="{{ $uniqueId }}">
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="pub-9512545299443856"
         data-ad-slot="{{ $slot }}"
         data-ad-format="{{ $format }}"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
