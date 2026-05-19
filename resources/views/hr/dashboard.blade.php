<x-app-layout>
    <!-- GREETING SECTION -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ Auth::user()->name }}!</h1>
                    <p class="text-gray-500 mt-1">{{ now()->format('l, F j, Y') }}</p>
                </div>
                <div>
                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                        {{ ucfirst(Auth::user()->role) }} Dashboard
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- STATS CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="text-blue-600 text-3xl font-bold">{{ $stats['total_employees'] ?? 0 }}</div>
                    <div class="text-gray-600">Total Employees</div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="text-green-600 text-3xl font-bold">{{ $stats['present_today'] ?? 0 }}</div>
                    <div class="text-gray-600">Present Today</div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="text-yellow-600 text-3xl font-bold">{{ $stats['pending_leaves'] ?? 0 }}</div>
                    <div class="text-gray-600">Pending Leaves</div>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="text-purple-600 text-3xl font-bold">{{ $stats['total_departments'] ?? 0 }}</div>
                    <div class="text-gray-600">Departments</div>
                </div>
            </div>

            <!-- RECENT EMPLOYEES -->
            <div class="bg-white rounded-lg shadow mb-8">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold">Recent Employees</h2>
                </div>
                <div class="p-6">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Position</th>
                                <th class="px-4 py-2 text-left">Department</th>
                                <th class="px-4 py-2 text-left">Hire Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentEmployees ?? [] as $emp)
                            <tr class="border-b">
                                <td class="px-4 py-2">
                                    <a href="{{ route('employees.show', $emp) }}" class="text-blue-600 hover:underline">
                                        {{ $emp->first_name }} {{ $emp->last_name }}
                                    </a>
                                </td>
                                <td class="px-4 py-2">{{ $emp->position }}</td>
                                <td class="px-4 py-2">{{ $emp->department }}</td>
                                <td class="px-4 py-2">{{ $emp->hire_date ?? 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center">No employees found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PENDING LEAVES -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-lg font-semibold">Pending Leave Requests</h2>
                </div>
                <div class="p-6">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-4 py-2 text-left">Employee</th>
                                <th class="px-4 py-2 text-left">Type</th>
                                <th class="px-4 py-2 text-left">Dates</th>
                                <th class="px-4 py-2 text-left">Days</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingLeaves ?? [] as $leave)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $leave->employee->first_name ?? 'N/A' }} {{ $leave->employee->last_name ?? '' }}</td>
                                <td class="px-4 py-2">{{ ucfirst($leave->leave_type) }}</td>
                                <td class="px-4 py-2">{{ $leave->start_date }} to {{ $leave->end_date }}</td>
                                <td class="px-4 py-2">{{ $leave->days_taken }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex gap-2">
                                        <form action="{{ route('leaves.approve', $leave) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-600 hover:text-green-900">Approve</button>
                                        </form>
                                        <form action="{{ route('leaves.reject', $leave) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center">No pending leaves</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>