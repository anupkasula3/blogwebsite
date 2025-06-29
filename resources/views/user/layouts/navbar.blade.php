<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">User Dashboard</span>
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Notification Dropdown -->
                <div class="relative" x-data="{ open: false, notifications: [], unreadCount: 0 }" x-init="
                    fetch('/api/notifications/unread-count')
                        .then(response => response.json())
                        .then(data => unreadCount = data.count);
                    fetch('/api/notifications/latest')
                        .then(response => response.json())
                        .then(data => notifications = data.notifications);
                ">
                    <button @click="open = !open" class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors">
                        <i class="fas fa-bell text-xl"></i>
                        <span x-show="unreadCount > 0" x-text="unreadCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
                    </button>
                    <!-- Notification Dropdown -->
                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900">Notifications</h3>
                                <a href="{{ route('user.notifications.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
                            </div>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <template x-if="notifications.length === 0">
                                <div class="p-4 text-center text-gray-500">
                                    <i class="fas fa-bell text-2xl mb-2"></i>
                                    <p>No new notifications</p>
                                </div>
                            </template>
                            <template x-for="notification in notifications" :key="notification.id">
                                <div class="p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <i :class="notification.icon" class="text-lg"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900" x-text="notification.title"></p>
                                            <p class="text-sm text-gray-600 mt-1" x-text="notification.message"></p>
                                            <p class="text-xs text-gray-500 mt-2" x-text="notification.time_ago"></p>
                                        </div>
                                    </div>
                                    <div class="mt-2 flex justify-end space-x-2">
                                        <template x-if="notification.action_url">
                                            <a :href="notification.action_url" class="text-xs text-blue-600 hover:text-blue-800">View</a>
                                        </template>
                                        <button @click="
                                            fetch(`/user/notifications/${notification.id}/read`, {
                                                method: 'POST',
                                                headers: {
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content'),
                                                    'Content-Type': 'application/json'
                                                }
                                            }).then(() => {
                                                unreadCount = Math.max(0, unreadCount - 1);
                                                notifications = notifications.filter(n => n.id !== notification.id);
                                            })
                                        " class="text-xs text-gray-500 hover:text-gray-700">Mark as read</button>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="p-4 border-t border-gray-200">
                            <form action="{{ route('user.notifications.read-all') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="w-full text-sm text-blue-600 hover:text-blue-800">Mark all as read</button>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-home"></i>
                    <span class="ml-1 hidden sm:inline">View Site</span>
                </a>
                <div class="relative group">
                    <button class="flex items-center space-x-2 text-gray-700 hover:text-gray-900">
                        <img src="{{ auth()->user()->avatar_url }}"
                             alt="{{ auth()->user()->name }}"
                             class="w-8 h-8 rounded-full">
                        <span class="hidden sm:block">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div class="absolute top-full right-0 mt-2 w-48 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        <div class="py-2">
                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-cog mr-2"></i>Profile Settings
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
