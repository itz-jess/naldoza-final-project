@props([
    'label' => null,
    'id' => null,
    'placeholder' => '',
    'value' => '',
    'rows' => 4,
    'error' => null,
    'required' => false,
    'disabled' => false,
    'help' => null,
])

@php
    $textareaId = $id ?? 'textarea-' . uniqid();
    $hasError = $error || $errors->has($attributes->get('name'));
    $errorClasses = $hasError ? 'form-input-error' : '';
@endphp

<div class="form-group">
    @if($label)
        <label for="{{ $textareaId }}" class="form-label">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    <textarea 
        id="{{ $textareaId }}"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        class="form-textarea {{ $errorClasses }}"
        @if($required) required @endif
        @if($disabled) disabled @endif
        {{ $attributes->except(['class']) }}
    >{{ $value ?: old($attributes->get('name')) }}</textarea>

    @if($error)
        <p class="form-error">{{ $error }}</p>
    @elseif($errors->has($attributes->get('name')))
        <p class="form-error">{{ $errors->first($attributes->get('name')) }}</p>
    @endif

    @if($help)
        <p class="form-help">{{ $help }}</p>
    @endif
</div>
