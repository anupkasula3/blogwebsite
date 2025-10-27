<div class="bg-gradient-to-b from-gray-900 to-gray-800 text-gray-100 w-64 min-h-screen h-screen flex-shrink-0 fixed inset-y-0 left-0 z-40 border-r border-gray-700 shadow-2xl
        transform transition-transform duration-200 ease-in-out
        hidden lg:block"
    :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }" x-show="sidebarOpen || window.innerWidth >= 1024"
    @resize.window="if(window.innerWidth >= 1024) sidebarOpen = false"
    @click.away="if(window.innerWidth < 1024) sidebarOpen = false" x-cloak>
    <div class="p-4 h-full overflow-y-auto">
        <div class="flex items-center gap-3 mb-2 pb-3.5 border-b border-gray-700">

            <div class="flex items-center justify-center">
                <div class="text-sm font-bold leading-tight text-white">
                    <img src="{{ asset('images/NepBlog_white.png') }}" alt="Logo" class="w-44 object-contain ">
                    {{-- <div class="text-[11px] ml-10 text-gray-400">Dashboard</div> --}}
                </div>
            </div>
        </div>
        <nav class="flex flex-col gap-1 text-sm">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#ff2953] text-white shadow-lg shadow-[#ff2953]/20' : 'text-gray-300 hover:bg-gray-800' }}">
                <i class="fas fa-home text-sm"></i>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.banners.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.banners.*') ? 'bg-[#ff2953] text-white shadow-lg shadow-[#ff2953]/20' : 'text-gray-300 hover:bg-gray-800' }}">
                <i class="fas fa-image text-sm"></i>
                <span class="text-sm font-medium">Banners</span>
            </a>
            <div class="mt-4 mb-2 px-3 text-[10px] uppercase tracking-wider text-gray-500 font-semibold">Content</div>
            <a href="{{ route('admin.categories.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-[#ff2953] text-white shadow-lg shadow-[#ff2953]/20' : 'text-gray-300 hover:bg-gray-800' }}">
                <i class="fas fa-folder text-sm"></i>
                <span class="text-sm font-medium">Categories</span>
            </a>
            <a href="{{ route('admin.metapages.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.metapages.*') ? 'bg-[#ff2953] text-white shadow-lg shadow-[#ff2953]/20' : 'text-gray-300 hover:bg-gray-800' }}">
                <i class="fas fa-file-alt text-sm"></i>
                <span class="text-sm font-medium">Meta Pages</span>
            </a>
            <div x-data="{ open: {{ request()->routeIs('admin.posts.*') || request()->routeIs('admin.userposts.*') ? 'true' : 'false' }} }" class="relative" @click.away="open = false">
                <button @click="open = !open" @keydown.escape.window="open = false"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-800 transition w-full focus:outline-none {{ request()->routeIs('admin.posts.*') || request()->routeIs('admin.userposts.*') ? 'bg-[#ff2953] text-white shadow-lg shadow-[#ff2953]/20' : 'text-gray-300' }}">
                    <i class="fas fa-newspaper text-sm"></i>
                    <span class="text-sm font-medium">Posts</span>
                    <i class="fas fa-chevron-down text-xs ml-auto transition-transform"
                        :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-transition class="mt-1 ml-2 pl-6 border-l-2 border-gray-700 space-y-1">
                    <a href="{{ route('admin.posts.index') }}"
                        class="block px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 transition {{ request()->routeIs('admin.posts.*') ? 'bg-gray-800 text-white' : '' }}">Admin
                        Posts</a>
                    <a href="{{ route('admin.userposts.index') }}"
                        class="block px-3 py-2 rounded-lg text-gray-300 hover:bg-gray-800 transition {{ request()->routeIs('admin.userposts.*') ? 'bg-gray-800 text-white' : '' }}">User
                        Posts</a>
                </div>
            </div>

            <div class="mt-4 mb-2 px-3 text-[10px] uppercase tracking-wider text-gray-500 font-semibold">Users &
                Settings</div>
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.users.*') ? 'bg-[#ff2953] text-white shadow-lg shadow-[#ff2953]/20' : 'text-gray-300 hover:bg-gray-800' }}">
                <i class="fas fa-users text-sm"></i>
                <span class="text-sm font-medium">Users</span>
            </a>

            <a href="{{ route('admin.quotes.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.quotes.*') ? 'bg-[#ff2953] text-white shadow-lg shadow-[#ff2953]/20' : 'text-gray-300 hover:bg-gray-800' }}">
                <i class="fas fa-quote-left text-sm"></i>
                <span class="text-sm font-medium">Quotes</span>
            </a>
            <a href="{{ route('admin.notifications.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.notifications.*') ? 'bg-[#ff2953] text-white shadow-lg shadow-[#ff2953]/20' : 'text-gray-300 hover:bg-gray-800' }}">
                <i class="fas fa-bell text-sm"></i>
                <span class="text-sm font-medium">Notifications</span>
            </a>
            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-[#ff2953] text-white shadow-lg shadow-[#ff2953]/20' : 'text-gray-300 hover:bg-gray-800' }}">
                <i class="fas fa-cogs text-sm"></i>
                <span class="text-sm font-medium">Settings</span>
            </a>


        </nav>
    </div>
</div>
