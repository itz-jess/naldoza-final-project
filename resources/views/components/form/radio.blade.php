@props([
    'label' => null,
    'id' => null,
    'value' => null,
    'checked' => false,
    'error' => null,
    'disabled' => false,
    'help' => null,
])

@php
    $radioId = $id ?? 'radio-' . uniqid();
    $hasError = $error || $errors->has($attributes->get('name'));
@endphp

<div class="form-group">
    <div class="flex items-center gap-3">
        <input 
            id="{{ $radioId }}"
            type="radio"
            value="{{ $value }}"
            @checked($checked || old($attributes->get('name')) == $value)
            class="form-radio"
            @if($disabled) disabled @endif
            {{ $attributes->except(['class']) }}
        />

        @if($label)
            <label for="{{ $radioId }}" class="text-sm text-slate-700 cursor-pointer">
                {{ $label }}
            </label>
        @endif
    </div>

    @if($error)
        <p class="form-error">{{ $error }}</p>
    @elseif($errors->has($attributes->get('name')))
        <p class="form-error">{{ $errors->first($attributes->get('name')) }}</p>
    @endif

    @if($help)
        <p class="form-help">{{ $help }}</p>
    @endif
</div>
