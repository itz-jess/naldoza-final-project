<x-layouts.app>
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard']
        ]" />
        <h1 class="mt-4">Dashboard</h1>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-card class="stat-card">
            <div class="card-body">
                <p class="stat-label">Total Employees</p>
                <p class="stat-value">1,234</p>
                <p class="stat-change up">↑ 12% from last month</p>
            </div>
        </x-card>

        <x-card class="stat-card">
            <div class="card-body">
                <p class="stat-label">Present Today</p>
                <p class="stat-value">987</p>
                <p class="stat-change up">↑ 98.5% attendance</p>
            </div>
        </x-card>

        <x-card class="stat-card">
            <div class="card-body">
                <p class="stat-label">Pending Approvals</p>
                <p class="stat-value">23</p>
                <p class="stat-change down">↓ Leave requests</p>
            </div>
        </x-card>

        <x-card class="stat-card">
            <div class="card-body">
                <p class="stat-label">Open Positions</p>
                <p class="stat-value">5</p>
                <p class="stat-change up">↑ 2 new postings</p>
            </div>
        </x-card>
    </div>

    <!-- Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <x-card>
                <div class="card-header">
                    <h3>Recent Employees</h3>
                </div>
                <x-table.table>
                    <x-table.thead>
                        <x-table.th>Employee</x-table.th>
                        <x-table.th>Position</x-table.th>
                        <x-table.th>Department</x-table.th>
                        <x-table.th>Status</x-table.th>
                    </x-table.thead>
                    <x-table.tbody>
                        <tr>
                            <x-table.td class="font-medium">John Smith</x-table.td>
                            <x-table.td>Senior Developer</x-table.td>
                            <x-table.td>IT</x-table.td>
                            <x-table.td>
                                <x-status-indicator status="active" label="Active" />
                            </x-table.td>
                        </tr>
                        <tr>
                            <x-table.td class="font-medium">Sarah Johnson</x-table.td>
                            <x-table.td>HR Manager</x-table.td>
                            <x-table.td>Human Resources</x-table.td>
                            <x-table.td>
                                <x-status-indicator status="active" label="Active" />
                            </x-table.td>
                        </tr>
                        <tr>
                            <x-table.td class="font-medium">Michael Brown</x-table.td>
                            <x-table.td>Marketing Lead</x-table.td>
                            <x-table.td>Marketing</x-table.td>
                            <x-table.td>
                                <x-status-indicator status="pending" label="On Leave" />
                            </x-table.td>
                        </tr>
                    </x-table.tbody>
                </x-table.table>
            </x-card>
        </div>

        <div>
            <x-card>
                <div class="card-header">
                    <h3>Quick Actions</h3>
                </div>
                <div class="card-body space-y-3">
                    <x-button variant="primary" href="/employees/create" class="w-full">
                        Add Employee
                    </x-button>
                    <x-button variant="outline" href="/leaves" class="w-full">
                        Manage Leaves
                    </x-button>
                    <x-button variant="outline" href="/attendance" class="w-full">
                        Check Attendance
                    </x-button>
                    <x-button variant="outline" href="/recruitment" class="w-full">
                        View Jobs
                    </x-button>
                </div>
            </x-card>
        </div>
    </div>
</x-layouts.app>
