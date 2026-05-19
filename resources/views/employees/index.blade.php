<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employee Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- ADD NEW EMPLOYEE BUTTON - OUTSIDE THE CARD, VISIBLE -->
            <div class="mb-4 flex justify-end">
                <a href="{{ route('employees.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition duration-200">
                    <i class="fas fa-plus mr-2"></i> Add New Employee
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    <!-- ADVANCED FILTERS -->
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-6 border border-gray-200">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="font-medium text-gray-900">Filters</h3>
                            <button type="button" onclick="toggleFilters()" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-chevron-down text-sm"></i>
                            </button>
                        </div>
                        <div id="filterContent">
                            <form method="GET" action="{{ route('employees.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Search</label>
                                    <input type="text" name="search" value="{{ request('search') }}" 
                                           placeholder="Name or email..." 
                                           class="w-full rounded-lg border-gray-300 text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Department</label>
                                    <select name="department" class="w-full rounded-lg border-gray-300 text-sm">
                                        <option value="">All Departments</option>
                                        <option value="IT" {{ request('department') == 'IT' ? 'selected' : '' }}>IT</option>
                                        <option value="HR" {{ request('department') == 'HR' ? 'selected' : '' }}>HR</option>
                                        <option value="Finance" {{ request('department') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                        <option value="Marketing" {{ request('department') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                        <option value="Sales" {{ request('department') == 'Sales' ? 'selected' : '' }}>Sales</option>
                                        <option value="Admin" {{ request('department') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="Maintenance" {{ request('department') == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                        <option value="Security" {{ request('department') == 'Security' ? 'selected' : '' }}>Security</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                                    <select name="status" class="w-full rounded-lg border-gray-300 text-sm">
                                        <option value="">All</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </div>
                                <div class="flex items-end">
                                    <div class="flex gap-2">
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm">
                                            <i class="fas fa-search mr-1"></i> Filter
                                        </button>
                                        <a href="{{ route('employees.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm">
                                            <i class="fas fa-undo mr-1"></i> Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- EMPLOYEES TABLE -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-6 py-3 border-b text-left">ID</th>
                                    <th class="px-6 py-3 border-b text-left">Name</th>
                                    <th class="px-6 py-3 border-b text-left">Email</th>
                                    <th class="px-6 py-3 border-b text-left">Position</th>
                                    <th class="px-6 py-3 border-b text-left">Department</th>
                                    <th class="px-6 py-3 border-b text-left">Salary</th>
                                    <th class="px-6 py-3 border-b text-left">Status</th>
                                    <th class="px-6 py-3 border-b text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($employees as $employee)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 border-b">{{ $employee->id }}</td>
                                    <td class="px-6 py-4 border-b font-medium">
                                        <a href="{{ route('employees.show', $employee) }}" class="text-blue-600 hover:underline">
                                            {{ $employee->first_name }} {{ $employee->last_name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 border-b">{{ $employee->email }}</td>
                                    <td class="px-6 py-4 border-b">{{ $employee->position }}</td>
                                    <td class="px-6 py-4 border-b">{{ $employee->department }}</td>
                                    <td class="px-6 py-4 border-b">₱{{ number_format($employee->salary, 2) }}</td>
                                    <td class="px-6 py-4 border-b">
                                        @if($employee->is_active)
                                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Active</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 border-b">
                                        <div class="flex gap-2">
                                            <a href="{{ route('employees.show', $employee) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                            <a href="{{ route('employees.edit', $employee) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                            
                                            @if(!$employee->is_active)
                                                <form action="{{ route('employees.approve', $employee) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-green-600 hover:text-green-900">Approve</button>
                                                </form>
                                                <form action="{{ route('employees.reject', $employee) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Reject this employee?')">Reject</button>
                                                </form>
                                            @endif
                                            
                                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Archive this employee?')">Archive</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                        No employees found.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $employees->withQueryString()->links() }}
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