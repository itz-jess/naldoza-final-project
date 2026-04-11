{{-- resources/views/employees/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Employee
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700">Name</label>
                            <input type="text" name="name" value="{{ old('name', $employee->name) }}" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Email</label>
                            <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Position</label>
                            <input type="text" name="position" value="{{ old('position', $employee->position) }}" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700">Salary</label>
                            <input type="number" name="salary" value="{{ old('salary', $employee->salary) }}" class="w-full border px-3 py-2 rounded">
                        </div>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Update Employee</button>
                        <a href="{{ route('employees.index') }}" class="ml-2 text-gray-700">Cancel</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>