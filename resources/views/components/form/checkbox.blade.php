@props([
    'label' => null,
    'id' => null,
    'value' => '1',
    'checked' => false,
    'error' => null,
    'disabled' => false,
    'help' => null,
])

@php
    $checkboxId = $id ?? 'checkbox-' . uniqid();
    $hasError = $error || $errors->has($attributes->get('name'));
@endphp

<div class="form-group">
    <div class="flex items-center gap-3">
        <input 
            id="{{ $checkboxId }}"
            type="checkbox"
            value="{{ $value }}"
            @checked($checked || old($attributes->get('name')))
            class="form-checkbox"
            @if($disabled) disabled @endif
            {{ $attributes->except(['class']) }}
        />

        @if($label)
            <label for="{{ $checkboxId }}" class="text-sm text-slate-700 cursor-pointer">
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

    @if($slot->isNotEmpty())
        <div class="mt-2">
            {{ $slot }}
        </div>
    @endif
</div>
