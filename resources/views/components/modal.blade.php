@props([
    'name' => null,
    'title' => null,
    'show' => false,
    'maxWidth' => 'md',
    'closeButton' => true,
])

@php
    $maxWidthClasses = match($maxWidth) {
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        default => 'max-w-md',
    };
@endphp

<div
    x-data="{ open: @js($show) }"
    @if($name)
        x-on:open-modal.window="$event.detail == '{{ $name }}' ? open = true : null"
        x-on:close-modal.window="$event.detail == '{{ $name }}' ? open = false : null"
    @endif
    x-show="open"
    @keydown.escape.window="open = false"
    class="modal-overlay"
    style="display: none;"
>
    <div 
        @click.away="open = false"
        class="modal {{ $maxWidthClasses }}"
    >
        @if($title || $closeButton)
            <div class="modal-header">
                @if($title)
                    <h3 class="text-lg font-semibold text-slate-900">{{ $title }}</h3>
                @endif
                @if($closeButton)
                    <button 
                        type="button"
                        @click="open = false"
                        class="text-slate-400 hover:text-slate-600 transition-colors"
                        aria-label="Close modal"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </div>
        @endif

        <div class="modal-body">
            {{ $slot }}
        </div>
    </div>
</div>

