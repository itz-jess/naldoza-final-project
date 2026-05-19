@props([
    'label' => null,
    'id' => null,
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'error' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'help' => null,
])

@php
    $inputId = $id ?? 'input-' . uniqid();
    $hasError = $error || $errors->has($attributes->get('name'));
    $errorClasses = $hasError ? 'form-input-error' : '';
@endphp

<div class="form-group">
    @if($label)
        <label for="{{ $inputId }}" class="form-label">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <input 
        id="{{ $inputId }}"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        value="{{ $value ?: old($attributes->get('name')) }}"
        class="form-input {{ $errorClasses }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        @if($readonly) readonly @endif
        {{ $attributes->except(['class']) }}
    />

    @if($error)
        <p class="form-error">{{ $error }}</p>
    @elseif($errors->has($attributes->get('name')))
        <p class="form-error">{{ $errors->first($attributes->get('name')) }}</p>
    @endif

    @if($help)
        <p class="form-help">{{ $help }}</p>
    @endif
</div>
