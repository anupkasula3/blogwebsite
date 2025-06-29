<div class="w-64 bg-white shadow-sm min-h-screen hidden lg:block">
    <div class="p-4">
        <nav class="space-y-2">
            <a href="{{ route('user.dashboard') }}"
               class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('user.dashboard') ? 'bg-gray-100' : '' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('user.posts.index') }}"
               class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('user.posts.*') ? 'bg-gray-100' : '' }}">
                <i class="fas fa-file-alt mr-3"></i>
                My Posts
            </a>
            <a href="{{ route('user.posts.create') }}"
               class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('user.posts.create') ? 'bg-gray-100' : '' }}">
                <i class="fas fa-plus mr-3"></i>
                Create Post
            </a>
            <a href="{{ route('user.analytics') }}"
               class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('user.analytics') ? 'bg-gray-100' : '' }}">
                <i class="fas fa-chart-line mr-3"></i>
                Analytics
            </a>
            <a href="{{ route('user.profile') }}"
               class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('user.profile') ? 'bg-gray-100' : '' }}">
                <i class="fas fa-user-cog mr-3"></i>
                Profile
            </a>
            <a href="{{ route('user.notifications.index') }}"
               class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('user.notifications.*') ? 'bg-gray-100' : '' }}">
                <i class="fas fa-bell mr-3"></i>
                Notifications
            </a>
        </nav>
    </div>
</div>
