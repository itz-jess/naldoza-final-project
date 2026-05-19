@props([
    'striped' => true,
    'hoverable' => true,
])

@php
    $tableClasses = 'table';
    if($striped) $tableClasses .= ' table-striped';
    $classes = $tableClasses . ' ' . ($attributes->get('class') ?? '');
@endphp

<div class="table-container">
    <table {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </table>
</div>
