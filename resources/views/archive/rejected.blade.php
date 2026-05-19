<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Archive - Rejected Applicants
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="mb-4 p-3 bg-yellow-50 rounded-lg">
                        <p class="text-yellow-700 text-sm">
                            <i class="fas fa-info-circle mr-1"></i> 
                            Rejected applicants are stored here. You can restore them if they reapply, or permanently delete them.
                        </p>
                    </div>

                    <!-- FILTERS SECTION -->
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-6 border border-gray-200">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="font-medium text-gray-900">Filters</h3>
                            <button type="button" onclick="toggleFilters()" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-chevron-down text-sm"></i>
                            </button>
                        </div>
                        <div id="filterContent">
                            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Search</label>
                                    <input type="text" name="search" value="{{ request('search') }}" 
                                           placeholder="Name or email..." 
                                           class="w-full rounded-lg border-gray-300 text-sm">
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Position</label>
                                    <select name="job_position_id" class="w-full rounded-lg border-gray-300 text-sm">
                                        <option value="">All Positions</option>
                                        @foreach($positions as $pos)
                                        <option value="{{ $pos->id }}" {{ request('job_position_id') == $pos->id ? 'selected' : '' }}>
                                            {{ $pos->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Rejected From</label>
                                    <input type="date" name="date_from" value="{{ request('date_from') }}" 
                                           class="w-full rounded-lg border-gray-300 text-sm">
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Rejected To</label>
                                    <input type="date" name="date_to" value="{{ request('date_to') }}" 
                                           class="w-full rounded-lg border-gray-300 text-sm">
                                </div>

                                <div class="md:col-span-4 flex justify-end gap-2 pt-2">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                        <i class="fas fa-search mr-1"></i> Apply Filters
                                    </button>
                                    <a href="{{ route('archive.rejected') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                                        <i class="fas fa-undo mr-1"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Archived Applications Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-2 text-left">Rejected Date</th>
                                    <th class="px-4 py-2 text-left">Position</th>
                                    <th class="px-4 py-2 text-left">Applicant</th>
                                    <th class="px-4 py-2 text-left">Email</th>
                                    <th class="px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rejected as $app)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $app->rejected_at ? date('M d, Y', strtotime($app->rejected_at)) : 'N/A' }}</td>
                                    <td class="px-4 py-2">{{ $app->jobPosition->title ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">{{ $app->applicant_name }}</td>
                                    <td class="px-4 py-2">{{ $app->email }}</td>
                                    <td class="px-4 py-2">
                                        <div class="flex gap-2">
                                            <form action="{{ route('archive.restore', $app->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-green-600 hover:text-green-900 text-sm" onclick="return confirm('Restore this applicant? They will be moved back to pending applications.')">
                                                    Restore
                                                </button>
                                            </form>
                                            <form action="{{ route('archive.permanent-delete', $app->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm" onclick="return confirm('Permanently delete this application? This cannot be undone.')">
                                                    Delete Permanently
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">
                                        <i class="fas fa-archive text-3xl mb-2 block text-gray-300"></i>
                                        No rejected applicants in archive
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $rejected->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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