@props([
    'items' => [],
])

<nav {{ $attributes->merge(['class' => 'breadcrumb']) }} aria-label="Breadcrumb">
    @forelse($items as $index => $item)
        @if($index > 0)
            <span class="breadcrumb-separator">/</span>
        @endif
        
        @if(isset($item['href']))
            <a href="{{ $item['href'] }}" class="breadcrumb-item hover:text-slate-900 transition-colors">
                {{ $item['label'] }}
            </a>
        @else
            <span class="breadcrumb-item active">
                {{ $item['label'] }}
            </span>
        @endif
    @empty
        {{ $slot }}
    @endforelse
</nav>
