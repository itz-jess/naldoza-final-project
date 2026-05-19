<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="px-6 py-3 flex items-center justify-end">
        <!-- Right side - Settings Dropdown only -->
        <div class="relative">
            <button id="settingsButton" class="flex items-center gap-2 text-gray-700 hover:text-gray-900">
                <i class="fas fa-cog text-gray-500"></i>
                <i class="fas fa-chevron-down text-xs"></i>
            </button>

            <div id="settingsMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 hidden z-50">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                    <i class="fas fa-user-circle mr-2"></i> My Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                        <i class="fas fa-sign-out-alt mr-2"></i> Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Settings dropdown
        const settingsButton = document.getElementById('settingsButton');
        const settingsMenu = document.getElementById('settingsMenu');

        if (settingsButton && settingsMenu) {
            settingsButton.addEventListener('click', function(e) {
                e.stopPropagation();
                settingsMenu.classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                if (!settingsButton.contains(event.target) && !settingsMenu.contains(event.target)) {
                    settingsMenu.classList.add('hidden');
                }
            });
        }
    });
</script>