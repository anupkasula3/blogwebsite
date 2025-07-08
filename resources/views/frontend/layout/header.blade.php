<script src="//unpkg.com/alpinejs" defer></script>
<!-- Top Banner Ad -->
@if(isset($headerAd) && $headerAd)
  <div class="w-full bg-white z-[999]  flex justify-center items-center py-2 border-b">
    <a href="{{ $headerAd->link }}" target="_blank" class="block">
      <img src="{{ asset('/uploads/' . $headerAd->image) }}" alt="{{ $headerAd->title }}" class="h-12 object-contain mx-auto">
    </a>
  </div>
@endif

<header x-data="{ open: false }" class="sticky top-0 z-[999] bg-white/80 backdrop-blur shadow-sm">
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
    <div x-show="open" @click="open = false" class="fixed inset-0 bg-black bg-opacity-40 z-[999] transition-opacity" x-transition.opacity></div>
    <!-- Sidebar -->
    <aside x-show="open"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="-translate-x-full"
      x-transition:enter-end="translate-x-0"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="translate-x-0"
      x-transition:leave-end="-translate-x-full"
      class="fixed top-0 left-0 h-full w-64 bg-white z-[999] shadow-2xl flex flex-col p-6 space-y-2 overflow-y-auto">
      <div class="flex items-center justify-between mb-6">
        <span class="text-lg font-bold text-blue-700">Menu</span>
        <button @click="open = false" aria-label="Close menu" class="text-gray-500 hover:text-blue-600">
          <i class="fas fa-times text-xl"></i>
        </button>
      </div>
      @foreach(($categories ?? collect())->take(6) as $category)
        <a href="{{ route('category.show', $category->slug) }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium text-sm rounded">{{ $category->name }}</a>
      @endforeach
      <a href="{{ route('categories.index') }}" class="block px-3 py-2 text-blue-600 font-semibold text-sm rounded">View All</a>
      <form action="{{ route('search') }}" method="GET" class="flex items-center px-3 py-2 mt-4">
        <input type="text" name="q" placeholder="Search..." class="w-full border rounded-full px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="ml-2 text-gray-500">
          <i class="fas fa-search"></i>
        </button>
      </form>
      @auth
        <a href="{{ route('user.dashboard') }}" class="block px-3 py-2 text-blue-600 font-semibold text-sm">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button type="submit" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium text-sm">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="block px-3 py-2 text-blue-600 font-medium text-sm">Sign In</a>
        <a href="{{ route('register') }}" class="block px-3 py-2 bg-blue-600 text-white rounded font-medium mt-2 text-sm">Register</a>
      @endauth
    </aside>
    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.effect(() => {
          if (Alpine.store('openSidebar') ?? false) {
            document.body.classList.add('overflow-hidden');
          } else {
            document.body.classList.remove('overflow-hidden');
          }
        });
      });
    </script>
    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.store('openSidebar', false);
      });
    </script>
    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.effect(() => {
          if (Alpine.store('openSidebar')) {
            document.body.classList.add('overflow-hidden');
          } else {
            document.body.classList.remove('overflow-hidden');
          }
        });
      });
    </script>
    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.store('openSidebar', false);
      });
    </script>
    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.effect(() => {
          if (Alpine.store('openSidebar')) {
            document.body.classList.add('overflow-hidden');
          } else {
            document.body.classList.remove('overflow-hidden');
          }
        });
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
