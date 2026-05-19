@props([
    'hover' => false,
])

@php
    $hoverClass = $hover ? 'hover:shadow-md' : '';
    $classes = "card $hoverClass " . ($attributes->get('class') ?? '');
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
