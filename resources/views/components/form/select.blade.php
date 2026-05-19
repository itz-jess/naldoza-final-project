@props([
    'label' => null,
    'id' => null,
    'options' => [],
    'selected' => null,
    'placeholder' => null,
    'error' => null,
    'required' => false,
    'disabled' => false,
    'help' => null,
])

@php
    $selectId = $id ?? 'select-' . uniqid();
    $hasError = $error || $errors->has($attributes->get('name'));
    $errorClasses = $hasError ? 'form-input-error' : '';
@endphp

<div class="form-group">
    @if($label)
        <label for="{{ $selectId }}" class="form-label">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <select 
        id="{{ $selectId }}"
        class="form-select {{ $errorClasses }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        {{ $attributes->except(['class']) }}
    >
        @if($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif

        @forelse($options as $value => $label)
            <option 
                value="{{ $value }}" 
                @selected($value == ($selected ?: old($attributes->get('name'))))
            >
                {{ $label }}
            </option>
        @empty
            {{ $slot }}
        @endforelse
    </select>

    @if($error)
        <p class="form-error">{{ $error }}</p>
    @elseif($errors->has($attributes->get('name')))
        <p class="form-error">{{ $errors->first($attributes->get('name')) }}</p>
    @endif

    @if($help)
        <p class="form-help">{{ $help }}</p>
    @endif
</div>
