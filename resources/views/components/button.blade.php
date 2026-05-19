@props([
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false,
    'type' => 'button',
    'href' => null,
    'onclick' => null,
])

@php
    $baseClasses = 'btn';
    $variantClasses = match($variant) {
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'outline' => 'btn-outline',
        'danger' => 'btn-danger',
        'success' => 'btn-success',
        'warning' => 'btn-warning',
        'ghost' => 'btn-ghost',
        default => 'btn-primary',
    };
    $sizeClasses = match($size) {
        'sm' => 'btn-sm',
        'lg' => 'btn-lg',
        'full' => 'btn-full',
        default => '',
    };
    $classes = "$baseClasses $variantClasses $sizeClasses " . ($attributes->get('class') ?? '');
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button 
        type="{{ $type }}" 
        @disabled($disabled)
        @if($onclick) onclick="{{ $onclick }}" @endif
        {{ $attributes->merge(['class' => $classes]) }}
    >
        {{ $slot }}
    </button>
@endif
