<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Request Leave
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <!-- Leave Credits Info -->
                    <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                        <p class="text-blue-700">
                            <strong><i class="fa-regular fa-calendar"></i> Remaining Leave Credits:</strong> {{ $remainingCredits }} days
                        </p>
                        <p class="text-blue-600 text-sm mt-1">
                            <i class="fa-regular fa-info-circle"></i> Unpaid leaves do not consume credits.
                        </p>
                    </div>

                    <!-- Late filing warning -->
                    <div class="mb-6 p-4 bg-yellow-50 rounded-lg">
                        <p class="text-yellow-700 text-sm">
                            <i class="fa-regular fa-clock"></i> Please submit leave requests at least 3 days in advance.
                        </p>
                    </div>

                    <form action="{{ route('leaves.store') }}" method="POST">
                        @csrf

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Leave Type *</label>
                                <select name="leave_type" class="mt-1 block w-full rounded-md border-gray-300" required>
                                    <option value="vacation">Vacation Leave</option>
                                    <option value="sick">Sick Leave</option>
                                    <option value="emergency">Emergency Leave</option>
                                    <option value="maternity">Maternity Leave</option>
                                    <option value="paternity">Paternity Leave</option>
                                    <option value="unpaid">Unpaid Leave</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Start Date *</label>
                                <input type="date" name="start_date" class="mt-1 block w-full rounded-md border-gray-300" required>
                                <p class="text-xs text-gray-500 mt-1">First day of absence</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">End Date *</label>
                                <input type="date" name="end_date" class="mt-1 block w-full rounded-md border-gray-300" required>
                                <p class="text-xs text-gray-500 mt-1">Last day of absence</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Reason (Optional)</label>
                                <textarea name="reason" rows="3" class="mt-1 block w-full rounded-md border-gray-300" placeholder="Please provide reason for leave..."></textarea>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-2">
                            <a href="{{ route('leaves.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">Cancel</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>