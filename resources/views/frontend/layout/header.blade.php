<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<!-- Top Banner Ad -->
@if(isset($headerAd) && $headerAd)
  <div class="w-full bg-white z-[9998] flex justify-center items-center py-2 border-b">
    <a href="{{ $headerAd->link }}" target="_blank" class="block">
      <img src="{{ asset('/uploads/' . $headerAd->image) }}" alt="{{ $headerAd->title }}" class="h-12 object-contain mx-auto">
    </a>
  </div>
@endif

<header x-data="{ open: false }" class="sticky top-0 z-[9999] bg-white/80 backdrop-blur shadow-sm">
  <div class="container bg-white mx-auto flex items-center justify-between py-2 px-2 lg:px-8">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="flex items-center gap-2">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8 object-contain">
      <span class="text-lg font-bold text-blue-700 tracking-tight">NEVDO</span>
    </a>

    <!-- Main Navigation -->
    <nav class="hidden md:flex items-center gap-2 ml-6  bg-white">
      @foreach(($categories ?? collect())->take(6) as $category)
        <a href="{{ route('category.show', $category->slug) }}" class="text-gray-700 hover:text-blue-600 font-medium text-sm px-3 py-1 rounded transition hover:bg-blue-50">{{ $category->name }}</a>
      @endforeach
      <a href="{{ route('categories.index') }}" class="ml-2 text-blue-600 font-semibold text-sm px-3 py-1 rounded border border-blue-100 bg-blue-50 hover:bg-blue-100 transition">View All</a>
    </nav>

    <!-- Right Side: Auth/Buttons -->
    <div class="flex items-center space-x-2">
      <form action="{{ route('search') }}" method="GET" class="relative hidden md:block">
        <input type="text" name="q" placeholder="Search..." class="border rounded-full px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white/80">
        <button type="submit" class="absolute right-2 top-1 text-gray-500">
          <i class="fas fa-search"></i>
        </button>
      </form>
      @auth
        <a href="{{ route('user.dashboard') }}" class="text-blue-600 font-semibold text-sm">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button type="submit" class="text-gray-700 hover:text-blue-600 font-medium text-sm">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="px-3 py-1 border rounded-full text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white transition text-sm">Sign In</a>
        <a href="{{ route('register') }}" class="px-3 py-1 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition text-sm">Register</a>
      @endauth
    </div>

    <!-- Mobile Menu Button -->
    <button class="md:hidden text-gray-700 hover:text-blue-600 ml-2" @click="open = true" aria-label="Open menu">
      <i class="fas fa-bars text-2xl"></i>
    </button>
  </div>

  <!-- Mobile Sidebar Navigation -->
  <div class="md:hidden">
    <!-- Overlay -->
    <div x-show="open" @click="open = false" class="fixed inset-0 w-screen h-screen bg-black bg-opacity-40 z-[9998] transition-opacity" x-transition.opacity></div>
    <!-- Sidebar -->
    <aside x-show="open"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="-translate-x-full"
      x-transition:enter-end="translate-x-0"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="translate-x-0"
      x-transition:leave-end="-translate-x-full"
      class="fixed top-0 left-0 h-screen w-full max-w-xs bg-gradient-to-br from-white via-blue-50 to-blue-100 z-[9999] shadow-2xl shadow-blue-200 rounded-r-2xl flex flex-col p-6 space-y-4 overflow-y-auto">
      <div class="flex flex-col items-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-12 object-contain mb-2">
        <span class="text-xl font-bold text-blue-700 tracking-tight">NEVDO</span>
      </div>
      @auth
        <div class="flex items-center gap-3 mb-4 p-3 rounded-xl bg-white/80 shadow">
          <div class="w-10 h-10 rounded-full bg-blue-200 flex items-center justify-center font-bold text-blue-700 text-lg uppercase">
            {{ auth()->user()->name[0] ?? '?' }}
          </div>
          <div>
            <div class="font-semibold text-blue-700">{{ auth()->user()->name }}</div>
            <div class="text-xs text-gray-500">{{ auth()->user()->email }}</div>
          </div>
        </div>
      @endauth
      <div class="flex items-center justify-between mb-4">
        <span class="text-xl font-extrabold text-blue-700 tracking-tight">Menu</span>
        <button @click="open = false" aria-label="Close menu" class="text-gray-500 hover:text-blue-600 transition">
          <i class="fas fa-times text-2xl"></i>
        </button>
      </div>
      <div class="divide-y divide-blue-100">
        <div class="flex flex-col gap-1 pb-3">
          @foreach(($categories ?? collect())->take(6) as $category)
            <a href="{{ route('category.show', $category->slug) }}" class="block px-4 py-2 rounded-lg font-medium text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition">{{ $category->name }}</a>
          @endforeach
          <a href="{{ route('categories.index') }}" class="block px-4 py-2 rounded-lg font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 transition mt-1">View All</a>
        </div>
        <div class="pt-3 flex flex-col gap-2">
          <form action="{{ route('search') }}" method="GET" class="flex items-center bg-white rounded-lg px-2 py-1 shadow-sm">
            <input type="text" name="q" placeholder="Search..." class="w-full border-0 focus:ring-0 text-sm bg-transparent">
            <button type="submit" class="ml-2 text-blue-600 hover:text-blue-800">
              <i class="fas fa-search"></i>
            </button>
          </form>
          @auth
            <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 rounded-lg font-semibold text-blue-700 hover:bg-blue-100 transition">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit" class="block w-full text-left px-4 py-2 rounded-lg font-medium text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition">Logout</button>
            </form>
          @else
            <a href="{{ route('login') }}" class="block px-4 py-2 rounded-lg font-semibold text-blue-600 hover:bg-blue-100 transition">Sign In</a>
            <a href="{{ route('register') }}" class="block px-4 py-2 rounded-lg font-semibold text-white bg-blue-600 hover:bg-blue-700 transition mt-1">Register</a>
          @endauth
        </div>
      </div>
    </aside>
        <script>
      // Wait for Alpine to be ready
      document.addEventListener('alpine:init', () => {
        // Initialize sidebar store
        if (typeof Alpine !== 'undefined') {
          Alpine.store('openSidebar', false);

          // Handle body overflow when sidebar is open
          Alpine.effect(() => {
            const isOpen = Alpine.store('openSidebar');
            if (isOpen) {
              document.body.classList.add('overflow-hidden');
            } else {
              document.body.classList.remove('overflow-hidden');
            }
          });
        }
      });
    </script>
  </div>
</header>

<!-- Below Navbar Banner Ad -->
@if(isset($belowHeaderAd) && $belowHeaderAd)
  <div class="w-full bg-white flex justify-center items-center py-2 border-b">
    <a href="{{ $belowHeaderAd->link }}" target="_blank" class="block">
      <img src="{{ asset('/uploads/' . $belowHeaderAd->image) }}" alt="{{ $belowHeaderAd->title }}" class="h-12 object-contain mx-auto">
    </a>
  </div>
@endif
