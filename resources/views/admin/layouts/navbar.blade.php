<header class="bg-white shadow-md border-b border-gray-100 fixed top-0 left-0 right-0 z-40 w-full backdrop-blur-sm">
    <div class="flex items-center justify-between px-4 md:px-6 py-4">
        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-600 hover:text-[#ff2953] focus:outline-none transition-colors">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <div class="hidden lg:flex items-center gap-3">
                <div class="w-8 h-8 bg-[#ff2953] rounded-lg flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
            </div>
        </div>
        <div class="flex items-center gap-3 md:gap-4">
            <div class="hidden md:block">
                <div class="relative">
                    <input type="text" placeholder="Search…" class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-200 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-[#ff2953]/20 focus:border-[#ff2953] transition-all" />
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
            </div>
            <!-- Notification Dropdown -->
            <div class="relative" x-data="{ notificationOpen: false, notifications: [], unreadCount: 0 }" x-init="
                fetch('/api/notifications/unread-count')
                    .then(response => response.json())
                    .then(data => unreadCount = data.count)
                    .catch(() => unreadCount = 0);
                fetch('/api/notifications/latest')
                    .then(response => response.json())
                    .then(data => notifications = data.notifications || [])
                    .catch(() => notifications = []);
            ">
                <button @click="notificationOpen = !notificationOpen" class="relative p-2 text-gray-600 hover:text-[#ff2953] transition-colors">
                    <i class="fas fa-bell text-xl"></i>
                    <span x-show="unreadCount > 0" x-text="unreadCount" class="absolute -top-1 -right-1 bg-[#ff2953] text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold"></span>
                </button>
                <div
                    x-show="notificationOpen"
                    @click.away="notificationOpen = false"
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-2xl border border-gray-200 z-[60]"
                    x-cloak
                    style="display: none;">
                    <div class="p-4 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-[#ff2953]/5 to-transparent">
                        <h3 class="text-sm font-bold text-gray-900">Notifications</h3>
                        <a href="{{ route('admin.notifications.index') }}" class="text-xs text-[#ff2953] hover:text-[#ff2953]/80 font-medium">View All</a>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        <template x-if="notifications.length === 0">
                            <div class="p-6 text-center text-gray-500">
                                <i class="fas fa-bell text-3xl mb-3 text-gray-300"></i>
                                <p class="text-sm">No new notifications</p>
                            </div>
                        </template>
                        <template x-for="notification in notifications" :key="notification.id">
                            <div class="p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-10 h-10 bg-[#ff2953]/10 rounded-lg flex items-center justify-center">
                                        <i :class="notification.icon" class="text-[#ff2953]"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-gray-900" x-text="notification.title"></p>
                                        <p class="text-sm text-gray-600 mt-1" x-text="notification.message"></p>
                                        <p class="text-xs text-gray-500 mt-2" x-text="notification.time_ago"></p>
                                    </div>
                                </div>
                                <div class="mt-2 flex justify-end space-x-2">
                                    <template x-if="notification.action_url">
                                        <a :href="notification.action_url" class="text-xs px-3 py-1 rounded-lg border border-[#ff2953] text-[#ff2953] hover:bg-[#ff2953] hover:text-white transition-colors">View</a>
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
                                    " class="text-xs px-3 py-1 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition-colors">Mark as read</button>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="p-4 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                        <form action="{{ route('admin.notifications.read-all') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="w-full text-xs px-3 py-2 rounded-lg bg-[#ff2953] text-white hover:bg-[#ff2953]/90 transition-colors font-medium">Mark all as read</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="relative" x-data="{ open: false }">
                @if(Auth::guard('admin')->check())
                    <button @click="open = !open" @keydown.escape="open = false" class="flex items-center gap-2 text-gray-700 hover:text-[#ff2953] focus:outline-none transition-colors">
                        <div class="w-9 h-9 bg-[#ff2953] rounded-lg flex items-center justify-center shadow-lg ring-2 ring-[#ff2953]/20">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="hidden md:block font-medium">{{ Auth::guard('admin')->user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="{'rotate-180': open}"></i>
                    </button>
                    <div
                        x-show="open"
                        @click.away="open = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-52 bg-white rounded-xl shadow-2xl border border-gray-200 z-[60] py-2"
                        x-cloak
                        style="display: none;">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-user-circle mr-2 text-[#ff2953]"></i>Profile
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center transition-colors">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('admin.login') }}" class="flex items-center gap-2 text-gray-700 hover:text-[#ff2953] focus:outline-none px-3 py-2 transition-colors">
                        <div class="w-9 h-9 bg-[#ff2953] rounded-lg flex items-center justify-center shadow-lg">
                            <i class="fas fa-sign-in-alt text-white text-sm"></i>
                        </div>
                        <span class="font-medium">Login</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</header>
