<header class="bg-white shadow-sm border-b border-gray-200 fixed top-0 left-0 right-0 z-30 w-full">
    <div class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center space-x-4">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-600 hover:text-gray-900 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <h1 class="text-2xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
        </div>
        <div class="flex items-center space-x-4">
            <!-- Notification Dropdown -->
            <div class="relative" x-data="{ notificationOpen: false, notifications: [], unreadCount: 0 }" x-init="
                fetch('/api/notifications/unread-count')
                    .then(response => response.json())
                    .then(data => unreadCount = data.count);
                fetch('/api/notifications/latest')
                    .then(response => response.json())
                    .then(data => notifications = data.notifications);
            ">
                <button @click="notificationOpen = !notificationOpen" class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors">
                    <i class="fas fa-bell text-xl"></i>
                    <span x-show="unreadCount > 0" x-text="unreadCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
                </button>
                <div x-show="notificationOpen" @click.away="notificationOpen = false" class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Notifications</h3>
                            <a href="{{ route('admin.notifications.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
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
                                        fetch(`/admin/notifications/${notification.id}/read`, {
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
                        <form action="{{ route('admin.notifications.read-all') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="w-full text-sm text-blue-600 hover:text-blue-800">Mark all as read</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="relative" x-data="{ open: false }">
                @if(Auth::guard('admin')->check())
                    <button @click="open = !open" @keydown.escape="open = false" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none">
                        <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="hidden md:block">{{ Auth::guard('admin')->user()->name }}</span>
                        <i class="fas fa-chevron-down text-sm"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50 py-2" x-cloak>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('admin.logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('admin.login') }}" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none px-4 py-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-sign-in-alt text-white text-sm"></i>
                        </div>
                        <span>Login</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</header>
