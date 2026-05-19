<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Message -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="text-gray-500 mt-1">{{ now()->format('l, F j, Y') }}</p>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <h3 class="font-semibold text-gray-900 mb-3">Quick Actions</h3>
                <div class="flex flex-wrap gap-3">
                    <form action="{{ route('attendance.timeIn') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                            <i class="fas fa-clock mr-2"></i> Time In
                        </button>
                    </form>
                    <form action="{{ route('attendance.timeOut') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm">
                            <i class="fas fa-clock mr-2"></i> Time Out
                        </button>
                    </form>
                    <a href="{{ route('leaves.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                        <i class="fas fa-calendar-plus mr-2"></i> Request Leave
                    </a>
                    <a href="{{ route('employees.show', auth()->user()->employee->id) }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm">
                        <i class="fas fa-user mr-2"></i> My Profile
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-blue-500">
                    <div class="text-2xl font-bold text-blue-600">{{ $stats['my_attendance'] ?? 0 }}</div>
                    <div class="text-sm text-gray-600">Days Present (This Month)</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-green-500">
                    <div class="text-2xl font-bold text-green-600">{{ $stats['my_leaves'] ?? 0 }}</div>
                    <div class="text-sm text-gray-600">Leaves Taken (This Year)</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-yellow-500">
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending_requests'] ?? 0 }}</div>
                    <div class="text-sm text-gray-600">Pending Requests</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-purple-500">
                    <div class="text-2xl font-bold text-purple-600">{{ $stats['remaining_credits'] ?? 0 }}</div>
                    <div class="text-sm text-gray-600">Remaining Leave Credits</div>
                </div>
            </div>

            <!-- This Month's Attendance -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-900">This Month's Attendance</h3>
                    <a href="{{ route('attendance.index') }}" class="text-blue-600 text-sm hover:underline">View All →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Day</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time In</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time Out</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hours Worked</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentAttendance ?? [] as $att)
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
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($att->date)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($att->date)->format('l') }}</td>
                                <td class="px-6 py-4 text-sm">{{ $att->time_in ? date('h:i A', strtotime($att->time_in)) : '--' }}</td>
                                <td class="px-6 py-4 text-sm">{{ $att->time_out ? date('h:i A', strtotime($att->time_out)) : '--' }}</td>
                                <td class="px-6 py-4 text-sm">{{ $hoursWorked }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $att->status == 'present' ? 'bg-green-100 text-green-800' : 
                                           ($att->status == 'late' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($att->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-calendar-alt text-3xl mb-2 block text-gray-300"></i>
                                    No attendance records this month
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Leave Requests -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="font-semibold text-gray-900">Recent Leave Requests</h3>
                    <a href="{{ route('leaves.index') }}" class="text-blue-600 text-sm hover:underline">View All →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Start Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">End Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Days</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Approved By</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentLeaves ?? [] as $leave)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm">{{ ucfirst($leave->leave_type) }}</td>
                                <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($leave->start_date)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($leave->end_date)->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-sm">{{ $leave->days_taken }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $leave->status == 'approved' ? 'bg-green-100 text-green-800' : 
                                           ($leave->status == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($leave->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $leave->approver->name ?? 'Pending' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-calendar-alt text-3xl mb-2 block text-gray-300"></i>
                                    No leave requests found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>