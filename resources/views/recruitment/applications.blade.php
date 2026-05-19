<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Job Applications
            </h2>
            <a href="{{ route('jobs.openings') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm" target="_blank">
                View Public Job Listings
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <!-- FILTERS SECTION -->
                    <div class="bg-white rounded-lg shadow-sm p-4 mb-6 border border-gray-200">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="font-medium text-gray-900">Filters</h3>
                            <button type="button" onclick="toggleFilters()" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-chevron-down text-sm"></i>
                            </button>
                        </div>
                        <div id="filterContent">
                            <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Search</label>
                                    <input type="text" name="search" value="{{ request('search') }}" 
                                           placeholder="Name or email..." 
                                           class="w-full rounded-lg border-gray-300 text-sm">
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
                                    <select name="status" class="w-full rounded-lg border-gray-300 text-sm">
                                        <option value="">All Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="shortlisted" {{ request('status') == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                        <option value="interviewed" {{ request('status') == 'interviewed' ? 'selected' : '' }}>Interviewed</option>
                                        <option value="hired" {{ request('status') == 'hired' ? 'selected' : '' }}>Hired</option>
                                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Position</label>
                                    <select name="job_position_id" class="w-full rounded-lg border-gray-300 text-sm">
                                        <option value="">All Positions</option>
                                        @foreach($positions as $pos)
                                        <option value="{{ $pos->id }}" {{ request('job_position_id') == $pos->id ? 'selected' : '' }}>
                                            {{ $pos->title }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Date From</label>
                                    <input type="date" name="date_from" value="{{ request('date_from') }}" 
                                           class="w-full rounded-lg border-gray-300 text-sm">
                                </div>

                                <div>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Date To</label>
                                    <input type="date" name="date_to" value="{{ request('date_to') }}" 
                                           class="w-full rounded-lg border-gray-300 text-sm">
                                </div>

                                <div class="md:col-span-5 flex justify-end gap-2 pt-2">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                                        <i class="fas fa-search mr-1"></i> Apply Filters
                                    </button>
                                    <a href="{{ route('recruitment.applications') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                                        <i class="fas fa-undo mr-1"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Applications Table -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-2 text-left">Date</th>
                                    <th class="px-4 py-2 text-left">Position</th>
                                    <th class="px-4 py-2 text-left">Applicant</th>
                                    <th class="px-4 py-2 text-left">Contact</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                    <th class="px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $app)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $app->created_at->format('M d, Y') }}</td>
                                    <td class="px-4 py-2">{{ $app->jobPosition->title ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">
                                        <div class="font-medium">{{ $app->applicant_name }}</div>
                                        <div class="text-xs text-gray-500">{{ $app->email }}</div>
                                    </div>
                                    <td class="px-4 py-2">{{ $app->contact_number }}</div>
                                    <td class="px-4 py-2">
                                        <span class="px-2 py-1 rounded text-xs 
                                            {{ $app->status == 'hired' ? 'bg-green-100 text-green-800' : 
                                               ($app->status == 'rejected' ? 'bg-red-100 text-red-800' : 
                                               ($app->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800')) }}">
                                            {{ ucfirst($app->status) }}
                                        </span>
                                    </div>
                                    <td class="px-4 py-2">
                                        <div class="flex gap-2 flex-wrap">
                                            <button onclick="showDetails({{ $app->id }})" class="text-blue-600 hover:text-blue-900 text-sm">View</button>
                                            
                                            @if($app->status == 'pending')
                                            <form action="{{ route('recruitment.update-status', $app) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="shortlisted">
                                                <button type="submit" class="text-blue-600 hover:text-blue-900 text-sm">Shortlist</button>
                                            </form>
                                            <form action="{{ route('recruitment.update-status', $app) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm" onclick="return confirm('Reject this applicant?')">Reject</button>
                                            </form>
                                            @endif
                                            
                                            @if($app->status == 'shortlisted')
                                            <form action="{{ route('recruitment.update-status', $app) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="interviewed">
                                                <button type="submit" class="text-purple-600 hover:text-purple-900 text-sm">Mark Interviewed</button>
                                            </form>
                                            @endif
                                            
                                            @if($app->status == 'interviewed')
                                                @if(!$app->isConvertedToEmployee())
                                                <form action="{{ route('recruitment.hire', $app) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-green-600 hover:text-green-900 text-sm" onclick="return confirm('Hire this applicant?')">
                                                        <i class="fas fa-user-plus mr-1"></i> Hire
                                                    </button>
                                                </form>
                                                @endif
                                                <form action="{{ route('recruitment.update-status', $app) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm" onclick="return confirm('Reject this applicant?')">Reject</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </tr>
                                
                                <!-- Modal for Application Details -->
                                <div id="modal-{{ $app->id }}" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); z-index: 1000; width: 90%; max-width: 550px; max-height: 80vh; overflow-y: auto;">
                                    <h3 class="font-bold text-lg mb-3">Application Details</h3>
                                    <div class="space-y-2 text-sm">
                                        @if($app->profile_picture)
                                            <div class="flex justify-center mb-3">
                                                <img src="{{ asset('storage/' . $app->profile_picture) }}" class="w-24 h-24 rounded-full object-cover">
                                            </div>
                                        @endif
                                        <p><strong>Name:</strong> {{ $app->applicant_name }}</p>
                                        <p><strong>Email:</strong> {{ $app->email }}</p>
                                        <p><strong>Age:</strong> {{ $app->age ?? 'N/A' }}</p>
                                        <p><strong>Gender:</strong> {{ ucfirst($app->sex ?? 'N/A') }}</p>
                                        <p><strong>Contact:</strong> {{ $app->contact_number }}</p>
                                        <p><strong>Address:</strong> {{ $app->address }}</p>
                                        <p><strong>Skills:</strong> {{ $app->skills }}</p>
                                        <p><strong>Experience:</strong> {{ $app->experience ?? 'None provided' }}</p>
                                        @if($app->resume_file)
                                            <p><strong>Resume:</strong> <a href="{{ asset('storage/' . $app->resume_file) }}" target="_blank" class="text-blue-600 underline">Download Resume</a></p>
                                        @endif
                                    </div>
                                    <button onclick="closeDetails({{ $app->id }})" class="mt-4 bg-gray-600 text-white px-4 py-2 rounded w-full">Close</button>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">No applications found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetails(id) {
            document.getElementById('modal-' + id).style.display = 'block';
        }
        function closeDetails(id) {
            document.getElementById('modal-' + id).style.display = 'none';
        }
        function toggleFilters() {
            const content = document.getElementById('filterContent');
            if (content.style.display === 'none') {
                content.style.display = 'block';
            } else {
                content.style.display = 'none';
            }
        }
    </script>
</x-app-layout>