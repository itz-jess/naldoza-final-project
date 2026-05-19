<aside id="sidebar" class="w-64 bg-white border-r border-gray-200 flex-shrink-0">
    <div class="p-6">
        <!-- Logo -->
        <div class="flex items-center mb-8">
            <span class="font-black text-gray-900">JESS</span>
            <span class="font-normal text-gray-600 ml-1">Tech</span>
        </div>

        <nav class="space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-chart-line w-5 h-5"></i>
                <span>Dashboard</span>
            </a>

            @if(auth()->user()->isAdmin() || auth()->user()->isHrManager())
                <a href="{{ route('employees.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('employees.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-users w-5 h-5"></i>
                    <span>Employees</span>
                </a>

                <a href="{{ route('attendance.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('attendance.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-clock w-5 h-5"></i>
                    <span>Attendance</span>
                </a>

                <a href="{{ route('leaves.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('leaves.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-calendar-alt w-5 h-5"></i>
                    <span>Leaves</span>
                </a>

                <a href="{{ route('recruitment.applications') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('recruitment.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-bullhorn w-5 h-5"></i>
                    <span>Applications</span>
                </a>

                <a href="{{ route('archive.rejected') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('archive.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-archive w-5 h-5"></i>
                    <span>Archive</span>
                </a>
            @endif

            @if(auth()->user()->isEmployee() && auth()->user()->employee)
                <a href="{{ route('employees.show', auth()->user()->employee->id) }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('employees.show') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-user w-5 h-5"></i>
                    <span>My Profile</span>
                </a>

                <a href="{{ route('leaves.create') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-pen w-5 h-5"></i>
                    <span>Request Leave</span>
                </a>
            @endif

            <div class="pt-4 mt-4 border-t border-gray-200">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('profile.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-cog w-5 h-5"></i>
                    <span>Settings</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt w-5 h-5"></i>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </nav>
    </div>
</aside>