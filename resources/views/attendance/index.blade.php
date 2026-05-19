<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Attendance Records
            </h2>
            @if(auth()->user()->isEmployee() && auth()->user()->employee)
            <div class="flex gap-2">
                <form action="{{ route('attendance.timeIn') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-clock mr-2"></i> Time In
                    </button>
                </form>
                <form action="{{ route('attendance.timeOut') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-clock mr-2"></i> Time Out
                    </button>
                </form>
            </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    <!-- FILTERS SECTION -->
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-6 border border-gray-200">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="font-medium text-gray-900">Filters</h3>
                            <button type="button" onclick="toggleFilters()" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-chevron-down text-sm"></i>
                            </button>
                        </div>
                        <div id="filterContent">
                            <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Search Employee</label>
                                    <input type="text" name="search" value="{{ request('search') }}" 
                                           placeholder="Name or email..." 
                                           class="w-full rounded-lg border-gray-300 text-sm">
                                </div>
                                
                                @if(auth()->user()->isAdmin() || auth()->user()->isHrManager())
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Employee</label>
                                    <select name="employee_id" class="w-full rounded-lg border-gray-300 text-sm">
                                        <option value="">All Employees</option>
                                        @foreach($employees as $emp)
                                        <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>
                                            {{ $emp->first_name }} {{ $emp->last_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif
                                
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Date From</label>
                                    <input type="date" name="date_from" value="{{ request('date_from') }}" 
                                           class="w-full rounded-lg border-gray-300 text-sm">
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Date To</label>
                                    <input type="date" name="date_to" value="{{ request('date_to') }}" 
                                           class="w-full rounded-lg border-gray-300 text-sm">
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                                    <select name="status" class="w-full rounded-lg border-gray-300 text-sm">
                                        <option value="">All Status</option>
                                        <option value="present" {{ request('status') == 'present' ? 'selected' : '' }}>Present</option>
                                        <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Late</option>
                                        <option value="absent" {{ request('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                                    </select>
                                </div>
                                
                                <div class="md:col-span-5 flex justify-end gap-2 pt-2">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                        <i class="fas fa-search mr-1"></i> Apply Filters
                                    </button>
                                    <a href="{{ route('attendance.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                                        <i class="fas fa-undo mr-1"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- INFO NOTE about late time -->
                    <div class="mb-4 p-3 bg-blue-50 rounded-lg">
                        <p class="text-blue-700 text-sm">
                            <i class="fas fa-info-circle mr-1"></i> 
                            Time in after 8:30 AM is marked as <strong>LATE</strong>.
                        </p>
                    </div>

                    <!-- ATTENDANCE TABLE -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-2 text-left">Date</th>
                                    <th class="px-4 py-2 text-left">Employee</th>
                                    <th class="px-4 py-2 text-left">Time In</th>
                                    <th class="px-4 py-2 text-left">Time Out</th>
                                    <th class="px-4 py-2 text-left">Hours Worked</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                <tr>
                            </thead>
                            <tbody>
                                @forelse($attendances as $att)
                                @php
                                    $hoursWorked = '--';
                                    if ($att->time_in && $att->time_out) {
                                        $start = \Carbon\Carbon::parse($att->time_in);
                                        $end = \Carbon\Carbon::parse($att->time_out);
                                        $hours = $start->diffInHours($end);
                                        $minutes = $start->diffInMinutes($end) % 60;
                                        $hoursWorked = $hours . 'h ' . $minutes . 'm';
                                    }
                                @endphp
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($att->date)->format('M d, Y') }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('employees.show', $att->employee) }}" class="text-blue-600 hover:underline">
                                            {{ $att->employee->first_name ?? 'N/A' }} {{ $att->employee->last_name ?? '' }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">{{ $att->time_in ? date('h:i A', strtotime($att->time_in)) : '--' }}</td>
                                    <td class="px-4 py-2">{{ $att->time_out ? date('h:i A', strtotime($att->time_out)) : '--' }}</td>
                                    <td class="px-4 py-2">{{ $hoursWorked }}</td>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded text-xs 
                                            {{ $att->status == 'present' ? 'bg-green-100 text-green-800' : 
                                               ($att->status == 'late' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($att->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                                        <i class="fas fa-calendar-alt text-3xl mb-2 block text-gray-300"></i>
                                        No attendance records found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $attendances->links() }}
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