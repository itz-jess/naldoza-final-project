<div class="bg-white rounded-lg shadow-sm p-4 mb-6 border border-gray-200">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Name or email..." 
                   class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Leave Type</label>
            <select name="leave_type" class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">All Types</option>
                <option value="vacation" {{ request('leave_type') == 'vacation' ? 'selected' : '' }}>Vacation</option>
                <option value="sick" {{ request('leave_type') == 'sick' ? 'selected' : '' }}>Sick</option>
                <option value="emergency" {{ request('leave_type') == 'emergency' ? 'selected' : '' }}>Emergency</option>
                <option value="maternity" {{ request('leave_type') == 'maternity' ? 'selected' : '' }}>Maternity</option>
                <option value="paternity" {{ request('leave_type') == 'paternity' ? 'selected' : '' }}>Paternity</option>
                <option value="unpaid" {{ request('leave_type') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Date From</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}" 
                   class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Date To</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}" 
                   class="w-full rounded-lg border-gray-300 text-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="md:col-span-5 flex justify-end gap-2 pt-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                <i class="fas fa-search mr-1"></i> Apply Filters
            </button>
            <a href="{{ route('leaves.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm">
                <i class="fas fa-undo mr-1"></i> Reset
            </a>
        </div>
    </form>
</div>