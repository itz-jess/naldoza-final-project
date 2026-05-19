@props(['variant' => 'primary'])

@php
    $variantClasses = match($variant) {
        'primary' => 'badge-primary',
        'success' => 'badge-success',
        'danger' => 'badge-danger',
        'warning' => 'badge-warning',
        'slate' => 'badge-slate',
        default => 'badge-primary',
    };
    $classes = "badge $variantClasses " . ($attributes->get('class') ?? '');
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
