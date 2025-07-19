<div
    class="bg-gray-900 text-white w-56 min-h-screen flex-shrink-0 fixed inset-y-0 left-0 z-40
        transform transition-transform duration-200 ease-in-out
        hidden lg:block"
    :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
    x-show="sidebarOpen || window.innerWidth >= 1024"
    @resize.window="if(window.innerWidth >= 1024) sidebarOpen = false"
    @click.away="if(window.innerWidth < 1024) sidebarOpen = false"
    x-cloak
>
    <div class="p-4">
        <div class="flex items-center space-x-2 mb-6">
            <div class="w-8 h-8 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-cog text-white text-lg"></i>
            </div>
            <span class="text-base font-bold tracking-tight">Admin Panel</span>
        </div>
        <nav class="flex flex-col gap-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-gray-800 transition">
                <i class="fas fa-tachometer-alt text-xs"></i>
                <span class="text-xs font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-gray-800 transition">
                <i class="fas fa-folder text-xs"></i>
                <span class="text-xs font-medium">Categories</span>
            </a>
            <div x-data="{ open: false }" class="relative group">
                <button @click="open = !open" @keydown.escape="open = false"
                    class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-gray-800 transition w-full focus:outline-none">
                    <i class="fas fa-newspaper text-xs"></i>
                    <span class="text-xs font-medium">Posts</span>
                    <i class="fas fa-chevron-down text-xs ml-auto"></i>
                </button>
                <div x-show="open" @click.away="open = false"
                    class="absolute left-0 mt-1 w-44 bg-gray-800 rounded shadow-lg z-50 py-1"
                    x-cloak>
                    <a href="{{ route('admin.posts.index') }}" class="block px-4 py-2 text-xs text-white hover:bg-gray-700 rounded transition">Admin Posts</a>
                    <a href="{{ route('admin.userposts.index') }}" class="block px-4 py-2 text-xs text-white hover:bg-gray-700 rounded transition">User Posts</a>
                </div>
            </div>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-gray-800 transition">
                <i class="fas fa-users text-xs"></i>
                <span class="text-xs font-medium">Users</span>
            </a>
            <a href="{{ route('admin.advertisements.index') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-gray-800 transition">
                <i class="fas fa-ad text-xs"></i>
                <span class="text-xs font-medium">Ads</span>
            </a>
            <a href="{{ route('admin.quotes.index') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-gray-800 transition">
                <i class="fas fa-quote-left text-xs"></i>
                <span class="text-xs font-medium">Quotes</span>
            </a>
            <a href="{{ route('admin.notifications.index') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-gray-800 transition">
                <i class="fas fa-bell text-xs"></i>
                <span class="text-xs font-medium">Notifications</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-gray-800 transition">
                <i class="fas fa-cogs text-xs"></i>
                <span class="text-xs font-medium">Settings</span>
            </a>
        </nav>
    </div>
</div>
