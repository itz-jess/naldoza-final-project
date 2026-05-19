<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    
                    <h3 class="text-2xl font-bold mb-2">Welcome, {{ Auth::user()->name }}!</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div class="bg-blue-50 p-5 rounded-lg">
                            <h4 class="font-semibold text-blue-800">Your Role</h4>
                            <p class="text-2xl font-bold text-blue-600">{{ ucfirst(Auth::user()->role) }}</p>
                            <p class="text-sm text-blue-600 mt-2">
                                @if(Auth::user()->isAdmin())
                                    You have full access to manage employees.
                                @else
                                    You can view employees and submit new ones for approval.
                                @endif
                            </p>
                        </div>

                        <div class="bg-green-50 p-5 rounded-lg">
                            <h4 class="font-semibold text-green-800">Quick Actions</h4>
                            <div class="mt-2">
                                <a href="{{ route('employees.index') }}" class="block text-green-700">View Employees →</a>
                                @if(Auth::user()->isAdmin())
                                <a href="{{ route('employees.create') }}" class="block text-green-700 mt-1">Add New Employee →</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>