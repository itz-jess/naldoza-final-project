<x-layouts.app>
    <!-- Breadcrumb & Header -->
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'href' => '/dashboard'],
            ['label' => 'Employees']
        ]" />
        
        <div class="flex items-center justify-between mt-4">
            <h1>Employees</h1>
            <x-button variant="primary" href="/employees/create">
                Add Employee
            </x-button>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <x-alert type="success" dismissible class="mb-6">
            {{ session('success') }}
        </x-alert>
    @endif

    <!-- Search & Filter -->
    <x-card class="mb-6">
        <div class="card-body">
            <form class="flex gap-3">
                <input 
                    type="text" 
                    placeholder="Search employees..." 
                    class="form-input flex-1"
                />
                <x-button type="submit" variant="outline">
                    Search
                </x-button>
            </form>
        </div>
    </x-card>

    <!-- Employees Table -->
    <x-card>
        <div class="card-header">
            <h3>Active Employees</h3>
        </div>

        <x-table.table striped>
            <x-table.thead>
                <x-table.th>Name</x-table.th>
                <x-table.th>Email</x-table.th>
                <x-table.th>Department</x-table.th>
                <x-table.th>Position</x-table.th>
                <x-table.th>Join Date</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Actions</x-table.th>
            </x-table.thead>
            <x-table.tbody>
                <tr>
                    <x-table.td class="font-medium">John Smith</x-table.td>
                    <x-table.td>john.smith@company.com</x-table.td>
                    <x-table.td>Information Technology</x-table.td>
                    <x-table.td>Senior Developer</x-table.td>
                    <x-table.td>2022-01-15</x-table.td>
                    <x-table.td>
                        <x-status-indicator status="active" label="Active" />
                    </x-table.td>
                    <x-table.td>
                        <div class="flex gap-2">
                            <x-button variant="ghost" size="sm" href="/employees/1/edit">Edit</x-button>
                            <x-button variant="ghost" size="sm" onclick="alert('View details')">View</x-button>
                        </div>
                    </x-table.td>
                </tr>

                <tr>
                    <x-table.td class="font-medium">Sarah Johnson</x-table.td>
                    <x-table.td>sarah.johnson@company.com</x-table.td>
                    <x-table.td>Human Resources</x-table.td>
                    <x-table.td>HR Manager</x-table.td>
                    <x-table.td>2021-03-22</x-table.td>
                    <x-table.td>
                        <x-status-indicator status="active" label="Active" />
                    </x-table.td>
                    <x-table.td>
                        <div class="flex gap-2">
                            <x-button variant="ghost" size="sm" href="/employees/2/edit">Edit</x-button>
                            <x-button variant="ghost" size="sm" onclick="alert('View details')">View</x-button>
                        </div>
                    </x-table.td>
                </tr>

                <tr>
                    <x-table.td class="font-medium">Michael Brown</x-table.td>
                    <x-table.td>michael.brown@company.com</x-table.td>
                    <x-table.td>Marketing</x-table.td>
                    <x-table.td>Marketing Lead</x-table.td>
                    <x-table.td>2020-07-10</x-table.td>
                    <x-table.td>
                        <x-status-indicator status="pending" label="On Leave" />
                    </x-table.td>
                    <x-table.td>
                        <div class="flex gap-2">
                            <x-button variant="ghost" size="sm" href="/employees/3/edit">Edit</x-button>
                            <x-button variant="ghost" size="sm" onclick="alert('View details')">View</x-button>
                        </div>
                    </x-table.td>
                </tr>

                <tr>
                    <x-table.td class="font-medium">Emma Wilson</x-table.td>
                    <x-table.td>emma.wilson@company.com</x-table.td>
                    <x-table.td>Finance</x-table.td>
                    <x-table.td>Finance Officer</x-table.td>
                    <x-table.td>2023-05-01</x-table.td>
                    <x-table.td>
                        <x-status-indicator status="active" label="Active" />
                    </x-table.td>
                    <x-table.td>
                        <div class="flex gap-2">
                            <x-button variant="ghost" size="sm" href="/employees/4/edit">Edit</x-button>
                            <x-button variant="ghost" size="sm" onclick="alert('View details')">View</x-button>
                        </div>
                    </x-table.td>
                </tr>
            </x-table.tbody>
        </x-table.table>

        <div class="card-footer">
            <x-pagination :current="1" :total="5" baseUrl="/employees" />
        </div>
    </x-card>
</x-layouts.app>
