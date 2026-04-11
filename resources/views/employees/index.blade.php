{{-- resources/views/employees/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Employees
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('employees.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3 inline-block">Add Employee</a>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Name</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Position</th>
                                <th class="border px-4 py-2">Salary</th>
                                @if(auth()->user()->role === 'admin')
                                    <th class="border px-4 py-2">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($employees as $employee)
                                <tr>
                                    <td class="border px-4 py-2">{{ $employee->id }}</td>
                                    <td class="border px-4 py-2">{{ $employee->name }}</td>
                                    <td class="border px-4 py-2">{{ $employee->email }}</td>
                                    <td class="border px-4 py-2">{{ $employee->position }}</td>
                                    <td class="border px-4 py-2">₱{{ number_format($employee->salary, 2) }}</td>
                                    @if(auth()->user()->role === 'admin')
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('employees.edit', $employee->id) }}" class="text-blue-500 mr-2">Edit</a>
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500" onclick="return confirm('Delete this employee?')">Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border px-4 py-2 text-center">No employees found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>