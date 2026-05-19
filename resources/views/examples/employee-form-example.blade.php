<x-layouts.app>
    <!-- Breadcrumb & Header -->
    <div class="mb-8">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'href' => '/dashboard'],
            ['label' => 'Employees', 'href' => '/employees'],
            ['label' => 'Add New Employee']
        ]" />
        <h1 class="mt-4">Add New Employee</h1>
    </div>

    <!-- Form Card -->
    <div class="max-w-2xl">
        <x-card>
            <form method="POST" action="/employees" class="card-body space-y-6">
                @csrf

                <!-- Personal Information Section -->
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Personal Information</h3>
                    <div class="space-y-4">
                        <x-form.input
                            label="Full Name"
                            name="name"
                            type="text"
                            placeholder="John Doe"
                            required
                            help="Employee's full legal name"
                        />

                        <x-form.input
                            label="Email Address"
                            name="email"
                            type="email"
                            placeholder="john.doe@company.com"
                            required
                            help="Company email address"
                        />

                        <x-form.input
                            label="Phone Number"
                            name="phone"
                            type="tel"
                            placeholder="+1 (555) 000-0000"
                            help="Contact phone number"
                        />

                        <x-form.input
                            label="Date of Birth"
                            name="dob"
                            type="date"
                            required
                        />
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Employment Information Section -->
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Employment Information</h3>
                    <div class="space-y-4">
                        <x-form.select
                            label="Department"
                            name="department"
                            :options="[
                                'it' => 'Information Technology',
                                'hr' => 'Human Resources',
                                'fin' => 'Finance',
                                'mkt' => 'Marketing',
                                'ops' => 'Operations'
                            ]"
                            placeholder="Select a department"
                            required
                        />

                        <x-form.select
                            label="Position"
                            name="position"
                            :options="[
                                'dev' => 'Developer',
                                'mgr' => 'Manager',
                                'spec' => 'Specialist',
                                'coord' => 'Coordinator',
                                'intern' => 'Intern'
                            ]"
                            placeholder="Select a position"
                            required
                        />

                        <x-form.input
                            label="Employee ID"
                            name="employee_id"
                            type="text"
                            placeholder="EMP-001"
                            help="Unique employee identifier"
                        />

                        <x-form.input
                            label="Date of Joining"
                            name="joining_date"
                            type="date"
                            required
                        />
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Additional Information Section -->
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 mb-4">Additional Information</h3>
                    <div class="space-y-4">
                        <x-form.textarea
                            label="Notes"
                            name="notes"
                            rows="4"
                            placeholder="Any additional notes about the employee..."
                            help="Internal notes (not visible to employee)"
                        />

                        <x-form.checkbox
                            label="Active Employee"
                            name="is_active"
                            value="1"
                            checked
                        />

                        <x-form.checkbox
                            label="Send Welcome Email"
                            name="send_welcome_email"
                            value="1"
                        />
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="divider"></div>
                <div class="flex gap-3 justify-end pt-4">
                    <x-button variant="outline" href="/employees">
                        Cancel
                    </x-button>
                    <x-button type="submit" variant="primary">
                        Create Employee
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-layouts.app>
