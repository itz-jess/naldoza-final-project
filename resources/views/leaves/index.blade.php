<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Leave Requests
            </h2>
            @if(auth()->user()->isEmployee())
                <a href="{{ route('leaves.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                    <i class="fas fa-plus mr-1"></i> Request Leave
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Summary Stats Cards (HR/Admin only) -->
            @if(auth()->user()->isAdmin() || auth()->user()->isHrManager())
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-yellow-500">
                    <div class="text-2xl font-bold text-yellow-600">{{ $summary['pending'] ?? 0 }}</div>
                    <div class="text-sm text-gray-600">Pending Requests</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-green-500">
                    <div class="text-2xl font-bold text-green-600">{{ $summary['approved'] ?? 0 }}</div>
                    <div class="text-sm text-gray-600">Approved</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-red-500">
                    <div class="text-2xl font-bold text-red-600">{{ $summary['rejected'] ?? 0 }}</div>
                    <div class="text-sm text-gray-600">Rejected</div>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-4 border-l-4 border-blue-500">
                    <div class="text-2xl font-bold text-blue-600">{{ $summary['total_days'] ?? 0 }}</div>
                    <div class="text-sm text-gray-600">Total Days Taken</div>
                </div>
            </div>
            @endif

            <!-- Filters -->
            @include('leaves.partials.filters')

            <!-- Leaves Table -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Employee</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Start Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">End Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Days</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                @if(auth()->user()->isAdmin() || auth()->user()->isHrManager())
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($leaves as $leave)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    @if($leave->employee)
                                        <a href="{{ route('employees.show', $leave->employee) }}" class="text-blue-600 hover:underline text-sm">
                                            {{ $leave->employee->first_name }} {{ $leave->employee->last_name }}
                                        </a>
                                        <div class="text-xs text-gray-500">{{ $leave->employee->email }}</div>
                                    @else
                                        <span class="text-gray-400">N/A</span>
                                    @endif
                                </td>
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
                                @if(auth()->user()->isAdmin() || auth()->user()->isHrManager())
                                <td class="px-6 py-4 text-sm">
                                    @if($leave->status == 'pending')
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
                                    @else
                                        <span class="text-gray-400 text-sm">—</span>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ (auth()->user()->isAdmin() || auth()->user()->isHrManager()) ? '7' : '6' }}" 
                                    class="px-6 py-8 text-center text-gray-500">
                                    <i class="fas fa-calendar-alt text-3xl mb-2 block text-gray-300"></i>
                                    No leave requests found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t">
                    {{ $leaves->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>