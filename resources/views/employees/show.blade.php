<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Employee Details: {{ $employee->first_name ?? 'N/A' }} {{ $employee->last_name ?? 'N/A' }}
            </h2>
            <div class="flex gap-2">
                @if(auth()->user()->isAdmin())
                    <form action="{{ route('employees.promote', $employee) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-sm" onclick="return confirm('Promote this employee to HR Manager?')">
                            Promote to HR
                        </button>
                    </form>
                @endif
                @if(auth()->user()->isAdmin() || auth()->user()->isHrManager())
                    <a href="{{ route('employees.edit', $employee) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1 rounded text-sm">Edit</a>
                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm" onclick="return confirm('Archive this employee?')">
                            Archive
                        </button>
                    </form>
                @endif
                <a href="{{ route('employees.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded text-sm">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <!-- STATS BADGES -->
                <div class="grid grid-cols-5 gap-4 p-6 border-b bg-gray-50">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ $stats['total_attendance'] ?? 0 }}</div>
                        <div class="text-xs text-gray-600">Total Attendance</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending_leaves'] ?? 0 }}</div>
                        <div class="text-xs text-gray-600">Pending Leaves</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $stats['approved_leaves'] ?? 0 }}</div>
                        <div class="text-xs text-gray-600">Approved Leaves</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-600">{{ $stats['avg_performance'] ?? 0 }}</div>
                        <div class="text-xs text-gray-600">Avg Rating</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-orange-600">{{ $stats['remaining_credits'] ?? 0 }}</div>
                        <div class="text-xs text-gray-600">Leave Credits Left</div>
                    </div>
                </div>

                <!-- TABS -->
                <style>
                    [x-cloak] { display: none !important; }
                    .tab-active { border-bottom-color: #3b82f6 !important; color: #3b82f6 !important; }
                </style>

                <div x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'profile' }" x-cloak>
                    <!-- Tab Buttons -->
                    <div class="border-b px-6 pt-4">
                        <div class="flex gap-6">
                            <button @click="tab = 'profile'; window.location.hash = 'profile'" 
                                    :class="{ 'tab-active': tab === 'profile' }" 
                                    class="pb-2 px-1 border-b-2 border-transparent font-medium hover:text-blue-600 transition">
                                Profile
                            </button>
                            <button @click="tab = 'attendance'; window.location.hash = 'attendance'" 
                                    :class="{ 'tab-active': tab === 'attendance' }" 
                                    class="pb-2 px-1 border-b-2 border-transparent font-medium hover:text-blue-600 transition">
                                Attendance
                            </button>
                            <button @click="tab = 'leaves'; window.location.hash = 'leaves'" 
                                    :class="{ 'tab-active': tab === 'leaves' }" 
                                    class="pb-2 px-1 border-b-2 border-transparent font-medium hover:text-blue-600 transition">
                                Leave Records
                            </button>
                            <button @click="tab = 'performance'; window.location.hash = 'performance'" 
                                    :class="{ 'tab-active': tab === 'performance' }" 
                                    class="pb-2 px-1 border-b-2 border-transparent font-medium hover:text-blue-600 transition">
                                Performance
                            </button>
                        </div>
                    </div>

                    <!-- TAB 1: PROFILE -->
                    <div x-show="tab === 'profile'" class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                                <div class="space-y-2">
                                    <p><strong>Employee ID:</strong> {{ $employee->id ?? 'N/A' }}</p>
                                    <p><strong>First Name:</strong> {{ $employee->first_name ?? 'N/A' }}</p>
                                    <p><strong>Last Name:</strong> {{ $employee->last_name ?? 'N/A' }}</p>
                                    <p><strong>Email:</strong> {{ $employee->email ?? 'N/A' }}</p>
                                    <p><strong>Contact Number:</strong> {{ $employee->contact_number ?? 'N/A' }}</p>
                                    <p><strong>Address:</strong> {{ $employee->address ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Employment Information</h3>
                                <div class="space-y-2">
                                    <p><strong>Position:</strong> {{ $employee->position ?? 'N/A' }}</p>
                                    <p><strong>Department:</strong> {{ $employee->department ?? 'N/A' }}</p>
                                    <p><strong>Rank:</strong> {{ $employee->rank ?? 'N/A' }}</p>
                                    @if(auth()->user()->isAdmin() || auth()->user()->isHrManager())
                                        <p><strong>Salary:</strong> ₱{{ number_format($employee->salary ?? 0, 2) }}</p>
                                    @endif
                                    <p><strong>Hire Date:</strong> {{ $employee->hire_date ?? 'N/A' }}</p>
                                    <p><strong>Skills:</strong> {{ $employee->skills ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TAB 2: ATTENDANCE -->
                    <div x-show="tab === 'attendance'" class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-4 py-2 text-left">Date</th>
                                        <th class="px-4 py-2 text-left">Time In</th>
                                        <th class="px-4 py-2 text-left">Time Out</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($employee->attendances ?? [] as $att)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $att->date }}</td>
                                        <td class="px-4 py-2">{{ $att->time_in ? date('h:i A', strtotime($att->time_in)) : '--' }}</td>
                                        <td class="px-4 py-2">{{ $att->time_out ? date('h:i A', strtotime($att->time_out)) : '--' }}</td>
                                        <td class="px-4 py-2">
                                            <span class="px-2 py-1 rounded text-xs {{ $att->status == 'present' ? 'bg-green-100 text-green-800' : ($att->status == 'late' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($att->status ?? 'N/A') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">No attendance records</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 3: LEAVE RECORDS -->
                    <div x-show="tab === 'leaves'" class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-4 py-2 text-left">Type</th>
                                        <th class="px-4 py-2 text-left">Start Date</th>
                                        <th class="px-4 py-2 text-left">End Date</th>
                                        <th class="px-4 py-2 text-left">Days</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($employee->leaves ?? [] as $leave)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ ucfirst($leave->leave_type ?? 'N/A') }}</td>
                                        <td class="px-4 py-2">{{ $leave->start_date ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $leave->end_date ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $leave->days_taken ?? 0 }}</td>
                                        <td class="px-4 py-2">
                                            <span class="px-2 py-1 rounded text-xs 
                                                {{ ($leave->status ?? '') == 'approved' ? 'bg-green-100 text-green-800' : (($leave->status ?? '') == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($leave->status ?? 'N/A') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-2 text-center text-gray-500">No leave records</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 4: PERFORMANCE -->
                    <div x-show="tab === 'performance'" class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-4 py-2 text-left">Review Date</th>
                                        <th class="px-4 py-2 text-left">Rating</th>
                                        <th class="px-4 py-2 text-left">Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($employee->performances ?? [] as $perf)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $perf->review_date ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">
                                            <span class="text-yellow-500">★</span> {{ $perf->rating ?? 0 }}/5
                                        </td>
                                        <td class="px-4 py-2">{{ $perf->comments ?? 'No comments' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-2 text-center text-gray-500">No performance records</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>