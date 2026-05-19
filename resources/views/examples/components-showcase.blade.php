<x-layouts.app>
    <!-- Header -->
    <div class="mb-8">
        <h1>Component Showcase</h1>
        <p class="text-slate-600 mt-2">All reusable components from the JESS Tech Design System</p>
    </div>

    <!-- Buttons Section -->
    <div class="mb-8">
        <x-card>
            <div class="card-header">
                <h2>Buttons</h2>
            </div>
            <div class="card-body space-y-6">
                <div>
                    <h4 class="font-semibold text-slate-900 mb-3">Variants</h4>
                    <div class="flex flex-wrap gap-3">
                        <x-button variant="primary">Primary</x-button>
                        <x-button variant="secondary">Secondary</x-button>
                        <x-button variant="outline">Outline</x-button>
                        <x-button variant="ghost">Ghost</x-button>
                        <x-button variant="danger">Danger</x-button>
                        <x-button variant="success">Success</x-button>
                        <x-button variant="warning">Warning</x-button>
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold text-slate-900 mb-3">Sizes</h4>
                    <div class="flex flex-wrap gap-3 items-center">
                        <x-button size="sm" variant="primary">Small</x-button>
                        <x-button size="md" variant="primary">Medium</x-button>
                        <x-button size="lg" variant="primary">Large</x-button>
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold text-slate-900 mb-3">States</h4>
                    <div class="flex flex-wrap gap-3">
                        <x-button variant="primary">Normal</x-button>
                        <x-button variant="primary" disabled>Disabled</x-button>
                        <x-button variant="primary" href="#" size="full">Full Width</x-button>
                    </div>
                </div>
            </div>
        </x-card>
    </div>

    <!-- Badges Section -->
    <div class="mb-8">
        <x-card>
            <div class="card-header">
                <h2>Badges</h2>
            </div>
            <div class="card-body">
                <div class="flex flex-wrap gap-3">
                    <x-badge variant="primary">Primary</x-badge>
                    <x-badge variant="success">Success</x-badge>
                    <x-badge variant="danger">Danger</x-badge>
                    <x-badge variant="warning">Warning</x-badge>
                    <x-badge variant="slate">Default</x-badge>
                </div>
            </div>
        </x-card>
    </div>

    <!-- Alerts Section -->
    <div class="mb-8">
        <x-card>
            <div class="card-header">
                <h2>Alerts</h2>
            </div>
            <div class="card-body space-y-3">
                <x-alert type="success" dismissible>
                    Success! Your changes have been saved.
                </x-alert>
                <x-alert type="danger" dismissible>
                    Error! Please check the form and try again.
                </x-alert>
                <x-alert type="warning" dismissible>
                    Warning! This action cannot be undone.
                </x-alert>
                <x-alert type="info" dismissible>
                    Info: The system will be down for maintenance tonight.
                </x-alert>
            </div>
        </x-card>
    </div>

    <!-- Status Indicators Section -->
    <div class="mb-8">
        <x-card>
            <div class="card-header">
                <h2>Status Indicators</h2>
            </div>
            <div class="card-body space-y-3">
                <x-status-indicator status="active" label="Active" />
                <x-status-indicator status="inactive" label="Inactive" />
                <x-status-indicator status="pending" label="Pending" />
            </div>
        </x-card>
    </div>

    <!-- Forms Section -->
    <div class="mb-8">
        <x-card>
            <div class="card-header">
                <h2>Form Elements</h2>
            </div>
            <form class="card-body space-y-4">
                <x-form.input
                    label="Text Input"
                    name="text"
                    placeholder="Enter text..."
                    help="This is help text"
                />

                <x-form.textarea
                    label="Textarea"
                    name="textarea"
                    rows="3"
                    placeholder="Enter multiple lines..."
                />

                <x-form.select
                    label="Select"
                    name="select"
                    :options="['opt1' => 'Option 1', 'opt2' => 'Option 2', 'opt3' => 'Option 3']"
                    placeholder="Choose an option"
                />

                <x-form.checkbox
                    label="Checkbox"
                    name="checkbox"
                />

                <x-form.radio
                    label="Radio Option 1"
                    name="radio"
                    value="opt1"
                />

                <x-form.radio
                    label="Radio Option 2"
                    name="radio"
                    value="opt2"
                />

                <div class="pt-2">
                    <x-button type="submit" variant="primary">Submit Form</x-button>
                </div>
            </form>
        </x-card>
    </div>

    <!-- Table Section -->
    <div class="mb-8">
        <x-card>
            <div class="card-header">
                <h2>Tables</h2>
            </div>
            <x-table.table striped>
                <x-table.thead>
                    <x-table.th>Column 1</x-table.th>
                    <x-table.th>Column 2</x-table.th>
                    <x-table.th>Column 3</x-table.th>
                    <x-table.th>Status</x-table.th>
                </x-table.thead>
                <x-table.tbody>
                    <tr>
                        <x-table.td>Row 1, Col 1</x-table.td>
                        <x-table.td>Row 1, Col 2</x-table.td>
                        <x-table.td>Row 1, Col 3</x-table.td>
                        <x-table.td>
                            <x-status-indicator status="active" label="Active" />
                        </x-table.td>
                    </tr>
                    <tr>
                        <x-table.td>Row 2, Col 1</x-table.td>
                        <x-table.td>Row 2, Col 2</x-table.td>
                        <x-table.td>Row 2, Col 3</x-table.td>
                        <x-table.td>
                            <x-status-indicator status="inactive" label="Inactive" />
                        </x-table.td>
                    </tr>
                </x-table.tbody>
            </x-table.table>
        </x-card>
    </div>

    <!-- Cards Section -->
    <div class="mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-card hover>
                <div class="card-body text-center">
                    <h3 class="text-xl font-semibold text-slate-900 mb-2">Card Title</h3>
                    <p class="text-slate-600">Card with content and hover effect</p>
                </div>
            </x-card>

            <x-card>
                <div class="card-header">
                    <h3>Card with Header</h3>
                </div>
                <div class="card-body">
                    This card has a header section
                </div>
            </x-card>

            <x-card>
                <div class="card-header">
                    <h3>Full Featured Card</h3>
                </div>
                <div class="card-body">
                    Content in the body
                </div>
                <div class="card-footer">
                    Footer section
                </div>
            </x-card>
        </div>
    </div>

    <!-- Breadcrumb Section -->
    <div class="mb-8">
        <x-card>
            <div class="card-header">
                <h2>Breadcrumb</h2>
            </div>
            <div class="card-body">
                <x-breadcrumb :items="[
                    ['label' => 'Home', 'href' => '/'],
                    ['label' => 'Components', 'href' => '/components'],
                    ['label' => 'Showcase']
                ]" />
            </div>
        </x-card>
    </div>

    <!-- Pagination Section -->
    <div class="mb-8">
        <x-card>
            <div class="card-header">
                <h2>Pagination</h2>
            </div>
            <div class="card-body">
                <x-pagination :current="3" :total="10" baseUrl="/components" />
            </div>
        </x-card>
    </div>
</x-layouts.app>
