<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Employee: {{ $employee->first_name }} {{ $employee->last_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form action="{{ route('employees.update', $employee) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">First Name *</label>
                                <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                                @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Last Name *</label>
                                <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                                @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Address *</label>
                                <input type="email" name="email" value="{{ old('email', $employee->email) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Position *</label>
                                <input type="text" name="position" value="{{ old('position', $employee->position) }}" class="mt-1 block w-full rounded-md border-gray-300" required>
                                @error('position') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Department *</label>
                                <select name="department" class="mt-1 block w-full rounded-md border-gray-300" required>
                                    <option value="IT" {{ $employee->department == 'IT' ? 'selected' : '' }}>IT</option>
                                    <option value="HR" {{ $employee->department == 'HR' ? 'selected' : '' }}>HR</option>
                                    <option value="Finance" {{ $employee->department == 'Finance' ? 'selected' : '' }}>Finance</option>
                                    <option value="Marketing" {{ $employee->department == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                                    <option value="Sales" {{ $employee->department == 'Sales' ? 'selected' : '' }}>Sales</option>
                                    <option value="Operations" {{ $employee->department == 'Operations' ? 'selected' : '' }}>Operations</option>
                                    <option value="Maintenance" {{ $employee->department == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                    <option value="Security" {{ $employee->department == 'Security' ? 'selected' : '' }}>Security</option>
                                    <option value="Admin" {{ $employee->department == 'Admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Monthly Salary (₱) *</label>
                                <input type="number" name="salary" value="{{ old('salary', $employee->salary) }}" step="0.01" class="mt-1 block w-full rounded-md border-gray-300" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Hire Date</label>
                                <input type="date" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}" class="mt-1 block w-full rounded-md border-gray-300">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="text" name="contact_number" value="{{ old('contact_number', $employee->contact_number) }}" class="mt-1 block w-full rounded-md border-gray-300">
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Address</label>
                                <textarea name="address" rows="2" class="mt-1 block w-full rounded-md border-gray-300">{{ old('address', $employee->address) }}</textarea>
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Skills</label>
                                <textarea name="skills" rows="2" class="mt-1 block w-full rounded-md border-gray-300" placeholder="e.g., PHP, Laravel, JavaScript">{{ old('skills', $employee->skills) }}</textarea>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm">
                                <strong>Status:</strong>
                                @if($employee->is_active)
                                    <span class="text-green-600">Active</span>
                                @else
                                    <span class="text-yellow-600">Pending Approval</span>
                                @endif
                            </p>
                        </div>

                        <div class="mt-6 flex justify-end gap-2">
                            <a href="{{ route('employees.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">Cancel</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Update Employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>