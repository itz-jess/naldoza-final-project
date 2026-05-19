@props([
    'current' => 1,
    'total' => 5,
    'perPage' => 15,
    'baseUrl' => '#',
    'onPageChange' => null,
])

<div class="flex items-center justify-between gap-4">
    <div class="text-sm text-slate-600">
        Showing page {{ $current }} of {{ $total }}
    </div>

    <nav class="pagination" role="navigation" aria-label="Pagination">
        @if($current > 1)
            <a href="{{ $baseUrl }}?page=1" class="pagination-link">First</a>
            <a href="{{ $baseUrl }}?page={{ $current - 1 }}" class="pagination-link">Previous</a>
        @else
            <span class="pagination-link disabled">First</span>
            <span class="pagination-link disabled">Previous</span>
        @endif

        @php
            $start = max(1, $current - 2);
            $end = min($total, $current + 2);
            if($end - $start < 4) {
                if($start === 1) $end = min($total, 5);
                else $start = max(1, $end - 4);
            }
        @endphp

        @if($start > 1)
            <span class="text-slate-500 text-sm">...</span>
        @endif

        @foreach(range($start, $end) as $page)
            @if($page === $current)
                <span class="pagination-link active">{{ $page }}</span>
            @else
                <a href="{{ $baseUrl }}?page={{ $page }}" class="pagination-link">{{ $page }}</a>
            @endif
        @endforeach

        @if($end < $total)
            <span class="text-slate-500 text-sm">...</span>
        @endif

        @if($current < $total)
            <a href="{{ $baseUrl }}?page={{ $current + 1 }}" class="pagination-link">Next</a>
            <a href="{{ $baseUrl }}?page={{ $total }}" class="pagination-link">Last</a>
        @else
            <span class="pagination-link disabled">Next</span>
            <span class="pagination-link disabled">Last</span>
        @endif
    </nav>
</div>
