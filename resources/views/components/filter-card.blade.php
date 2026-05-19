@props(['title' => 'Filters', 'route' => '#'])

<div class="bg-white rounded-lg shadow-sm p-4 mb-6 border border-gray-200">
    <div class="flex justify-between items-center mb-3">
        <h3 class="font-medium text-gray-900">{{ $title }}</h3>
        <button type="button" onclick="toggleFilters()" class="text-gray-500 hover:text-gray-700">
            <i class="fas fa-chevron-down text-sm"></i>
        </button>
    </div>
    <div id="filterContent">
        <form method="GET" action="{{ $route }}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                {{ $slot }}
            </div>
            <div class="flex justify-end gap-2 mt-4 pt-2 border-t">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                    <i class="fas fa-search mr-1"></i> Apply Filters
                </button>
                <a href="{{ $route }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                    <i class="fas fa-undo mr-1"></i> Reset
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleFilters() {
        const content = document.getElementById('filterContent');
        if (content.style.display === 'none') {
            content.style.display = 'block';
        } else {
            content.style.display = 'none';
        }
    }
</script>