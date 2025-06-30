<nav class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Mobile Sidebar Toggle -->
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-600 hover:text-gray-900 focus:outline-none mr-4">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
                <h1 class="hidden lg:block text-2xl font-bold text-gray-800" x-data x-text="document.title.split(' - ')[0]"></h1>
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
                    <button @click="open = !open" class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors focus:outline-none">
                        <i class="fas fa-bell text-xl"></i>
                        <span x-show="unreadCount > 0" x-text="unreadCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
                    </button>
                    <!-- Notification Dropdown -->
                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50 origin-top-right">
                        <div class="p-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900">Notifications</h3>
                                <a href="{{ route('user.notifications.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View All</a>
                            </div>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            <template x-if="notifications.length === 0">
                                <div class="p-4 text-center text-gray-500">
                                    <i class="far fa-bell-slash text-2xl mb-2"></i>
                                    <p>No new notifications</p>
                                </div>
                            </template>
                            <template x-for="notification in notifications" :key="notification.id">
                                <div class="p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <i :class="notification.icon" class="text-lg w-6 text-center"></i>
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
                        <div class="p-4 bg-gray-50 border-t border-gray-200">
                            <form action="{{ route('user.notifications.read-all') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="w-full text-sm text-center text-blue-600 hover:text-blue-800 font-medium">Mark all as read</button>
                            </form>
                        </div>
                    </div>
                </div>
                <a href="{{ route('home') }}" class="p-2 text-gray-600 hover:text-gray-900" title="View Site">
                    <i class="fas fa-home text-xl"></i>
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-gray-900 focus:outline-none">
                        <img src="{{ auth()->user()->avatar_url }}"
                             alt="{{ auth()->user()->name }}"
                             class="w-10 h-10 rounded-full border-2 border-transparent hover:border-purple-500 transition">
                        <span class="hidden sm:block font-medium">{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition
                         class="absolute top-full right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 origin-top-right">
                        <div class="py-2">
                            <div class="px-4 py-3 border-b border-gray-200">
                                <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-600 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-purple-600 transition-colors">
                                <i class="fas fa-user-cog w-6 mr-2"></i>Profile Settings
                            </a>
                            <a href="{{ route('user.password.change.form') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-purple-600 transition-colors">
                                <i class="fas fa-key w-6 mr-2"></i>Change Password
                            </a>
                            <div class="border-t border-gray-200"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors">
                                    <i class="fas fa-sign-out-alt w-6 mr-2"></i>Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
