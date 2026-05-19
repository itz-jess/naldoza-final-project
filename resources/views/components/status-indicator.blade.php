@props([
    'status' => 'active',
    'label' => null,
])

@php
    $statusClasses = match($status) {
        'active' => 'status-active',
        'inactive' => 'status-inactive',
        'pending' => 'status-pending',
        default => 'status-active',
    };
@endphp

<span {{ $attributes->merge(['class' => "status-indicator $statusClasses"]) }}>
    <span class="status-dot"></span>
    @if($label)
        <span>{{ $label }}</span>
    @else
        {{ $slot }}
    @endif
</span>
