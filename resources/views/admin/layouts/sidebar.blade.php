<div
    class="bg-slate-900 text-slate-100 w-64 min-h-screen h-screen flex-shrink-0 fixed inset-y-0 left-0 z-40 border-r border-slate-800 shadow-lg
        transform transition-transform duration-200 ease-in-out
        hidden lg:block"
    :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
    x-show="sidebarOpen || window.innerWidth >= 1024"
    @resize.window="if(window.innerWidth >= 1024) sidebarOpen = false"
    @click.away="if(window.innerWidth < 1024) sidebarOpen = false"
    x-cloak
>
    <div class="p-4 h-full overflow-y-auto">
        <div class="flex items-center gap-3 mb-6">
            <div class="w-9 h-9 bg-gradient-to-r from-indigo-600 to-fuchsia-600 rounded-lg flex items-center justify-center shadow-md">
                <i class="fas fa-bolt text-white text-lg"></i>
            </div>
            <div>
                <div class="text-sm font-semibold leading-tight">{{ \App\Models\Setting::get('site_name', 'Admin Panel') }}</div>
                <div class="text-[11px] text-slate-400">Administration</div>
            </div>
        </div>
        <nav class="flex flex-col gap-1 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded text-slate-300 hover:bg-slate-800 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-800 text-white' : '' }}">
                <i class="fas fa-tachometer-alt text-xs"></i>
                <span class="text-xs font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin.banners.index') }}" class="block px-3 py-2 rounded text-slate-300 hover:bg-slate-800 {{ request()->routeIs('admin.banners.*') ? 'bg-slate-800 text-white' : '' }}">
                <i class="fas fa-tachometer-alt text-xs"></i>
                <span class="text-xs font-medium">Banners</span>
            <div class="mt-3 mb-1 px-3 text-[10px] uppercase tracking-wider text-slate-500">Content</div>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-800 transition {{ request()->routeIs('admin.categories.*') ? 'bg-slate-800 text-white' : 'text-slate-300' }}">
                <i class="fas fa-folder text-xs"></i>
                <span class="text-sm">Categories</span>
            </a>
            <a href="{{ route('admin.metapages.index') }}" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-800 transition {{ request()->routeIs('admin.metapages.*') ? 'bg-slate-800 text-white' : 'text-slate-300' }}">
                <i class="fas fa-file-alt text-xs"></i>
                <span class="text-sm">Meta Pages</span>
            </a>
            <div x-data="{ open: {{ request()->routeIs('admin.posts.*') || request()->routeIs('admin.userposts.*') ? 'true' : 'false' }} }" class="relative" @click.away="open = false">
                <button @click="open = !open" @keydown.escape.window="open = false"
                    class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-800 transition w-full focus:outline-none {{ (request()->routeIs('admin.posts.*') || request()->routeIs('admin.userposts.*')) ? 'bg-slate-800 text-white' : 'text-slate-300' }}">
                    <i class="fas fa-newspaper text-xs"></i>
                    <span class="text-sm">Posts</span>
                    <i class="fas fa-chevron-down text-xs ml-auto transition-transform" :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-transition
                    class="mt-1 ml-2 pl-6 border-l border-slate-800">
                    <a href="{{ route('admin.posts.index') }}" class="block px-3 py-2 rounded text-slate-300 hover:bg-slate-800 {{ request()->routeIs('admin.posts.*') ? 'bg-slate-800 text-white' : '' }}">Admin Posts</a>
                </div>
            </div>

            <div class="mt-3 mb-1 px-3 text-[10px] uppercase tracking-wider text-slate-500">Users & Settings</div>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-800 transition {{ request()->routeIs('admin.users.*') ? 'bg-slate-800 text-white' : 'text-slate-300' }}">
                <i class="fas fa-users text-xs"></i>
                <span class="text-sm">Users</span>
            </a>
            <a href="{{ route('admin.advertisements.index') }}" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-800 transition {{ request()->routeIs('admin.advertisements.*') ? 'bg-slate-800 text-white' : 'text-slate-300' }}">
                <i class="fas fa-ad text-xs"></i>
                <span class="text-sm">Ads</span>
            </a>
            <a href="{{ route('admin.quotes.index') }}" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-800 transition {{ request()->routeIs('admin.quotes.*') ? 'bg-slate-800 text-white' : 'text-slate-300' }}">
                <i class="fas fa-quote-left text-xs"></i>
                <span class="text-sm">Quotes</span>
            </a>
            <a href="{{ route('admin.notifications.index') }}" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-800 transition {{ request()->routeIs('admin.notifications.*') ? 'bg-slate-800 text-white' : 'text-slate-300' }}">
                <i class="fas fa-bell text-xs"></i>
                <span class="text-sm">Notifications</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-800 transition {{ request()->routeIs('admin.settings.*') ? 'bg-slate-800 text-white' : 'text-slate-300' }}">
                <i class="fas fa-cogs text-xs"></i>
                <span class="text-sm">Settings</span>
            </a>


        </nav>
    </div>
</div>

