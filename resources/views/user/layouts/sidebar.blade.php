<!-- Static sidebar for desktop -->
<div class="hidden lg:flex lg:flex-shrink-0">
    <div class="flex flex-col w-64 bg-gray-800 text-gray-300">
        <div class="flex items-center justify-center h-20 bg-gray-900">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center">
                    <i class="fas fa-blog text-white text-xl"></i>
                </div>
                <span class="text-xl font-bold text-white">MyBlogSite</span>
            </a>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('user.dashboard') }}"
               class="flex items-center px-4 py-2.5 rounded-lg transition-colors
                      {{ request()->routeIs('user.dashboard')
                         ? 'bg-purple-600 text-white shadow-lg'
                         : 'hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-tachometer-alt w-6 text-center mr-3"></i>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('user.posts.index') }}"
               class="flex items-center px-4 py-2.5 rounded-lg transition-colors
                      {{ request()->routeIs('user.posts.*')
                         ? 'bg-purple-600 text-white shadow-lg'
                         : 'hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-file-alt w-6 text-center mr-3"></i>
                <span class="font-medium">My Posts</span>
            </a>
            <a href="{{ route('user.analytics') }}"
               class="flex items-center px-4 py-2.5 rounded-lg transition-colors
                      {{ request()->routeIs('user.analytics')
                         ? 'bg-purple-600 text-white shadow-lg'
                         : 'hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-chart-line w-6 text-center mr-3"></i>
                <span class="font-medium">Analytics</span>
            </a>
            <a href="{{ route('user.profile') }}"
               class="flex items-center px-4 py-2.5 rounded-lg transition-colors
                      {{ request()->routeIs('user.profile')
                         ? 'bg-purple-600 text-white shadow-lg'
                         : 'hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-user-cog w-6 text-center mr-3"></i>
                <span class="font-medium">Profile</span>
            </a>
            <a href="{{ route('user.notifications.index') }}"
               class="flex items-center px-4 py-2.5 rounded-lg transition-colors
                      {{ request()->routeIs('user.notifications.*')
                         ? 'bg-purple-600 text-white shadow-lg'
                         : 'hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-bell w-6 text-center mr-3"></i>
                <span class="font-medium">Notifications</span>
            </a>
        </nav>
        <div class="p-4 border-t border-gray-700">
            <a href="{{ route('user.posts.create') }}" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg font-semibold hover:opacity-90 transition-opacity">
                <i class="fas fa-plus mr-2"></i>
                <span>Create New Post</span>
            </a>
        </div>
    </div>
</div>

<!-- Mobile sidebar -->
<div x-show="sidebarOpen" class="lg:hidden" x-cloak>
    <div class="fixed inset-0 flex z-999">
        <!-- Overlay -->
        <div @click="sidebarOpen = false" class="fixed inset-0 bg-gray-600 bg-opacity-75" x-show="sidebarOpen"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        <!-- Sidebar -->
        <div class="relative flex-1 flex flex-col max-w-xs w-full bg-gray-800 text-gray-300"
             x-show="sidebarOpen"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full">
            <div class="absolute top-0 right-0 -mr-12 pt-2">
                <button @click="sidebarOpen = false" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                    <span class="sr-only">Close sidebar</span>
                    <i class="fas fa-times text-white"></i>
                </button>
            </div>
            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                <div class="flex-shrink-0 flex items-center px-4">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-blog text-white text-xl"></i>
                        </div>
                        <span class="text-xl font-bold text-white">MyBlogSite</span>
                    </a>
                </div>
                <nav class="mt-5 px-2 space-y-1">
                    <a href="{{ route('user.dashboard') }}"
                       class="flex items-center px-2 py-2 text-base font-medium rounded-md transition-colors
                              {{ request()->routeIs('user.dashboard') ? 'bg-purple-600 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-tachometer-alt w-6 text-center mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('user.posts.index') }}"
                       class="flex items-center px-2 py-2 text-base font-medium rounded-md transition-colors
                              {{ request()->routeIs('user.posts.*') ? 'bg-purple-600 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-file-alt w-6 text-center mr-3"></i>
                        My Posts
                    </a>
                    <a href="{{ route('user.analytics') }}"
                       class="flex items-center px-2 py-2 text-base font-medium rounded-md transition-colors
                              {{ request()->routeIs('user.analytics') ? 'bg-purple-600 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-chart-line w-6 text-center mr-3"></i>
                        Analytics
                    </a>
                    <a href="{{ route('user.profile') }}"
                       class="flex items-center px-2 py-2 text-base font-medium rounded-md transition-colors
                              {{ request()->routeIs('user.profile') ? 'bg-purple-600 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-user-cog w-6 text-center mr-3"></i>
                        Profile
                    </a>
                    <a href="{{ route('user.notifications.index') }}"
                       class="flex items-center px-2 py-2 text-base font-medium rounded-md transition-colors
                              {{ request()->routeIs('user.notifications.*') ? 'bg-purple-600 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                        <i class="fas fa-bell w-6 text-center mr-3"></i>
                        Notifications
                    </a>
                </nav>
            </div>
            <div class="flex-shrink-0 flex border-t border-gray-700 p-4">
                <a href="{{ route('user.posts.create') }}" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-lg font-semibold hover:opacity-90 transition-opacity">
                    <i class="fas fa-plus mr-2"></i>
                    <span>Create New Post</span>
                </a>
            </div>
        </div>
        <div class="flex-shrink-0 w-14"></div> <!-- Force sidebar to shrink to fit close icon -->
    </div>
</div>
