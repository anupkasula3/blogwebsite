<!-- Top Banner Ad -->
@if(isset($headerAd) && $headerAd)
  <div class="w-full bg-white flex justify-center items-center py-2 border-b">
    <a href="{{ $headerAd->link }}" target="_blank" class="block">
      <img src="{{ asset('/uploads/' . $headerAd->image) }}" alt="{{ $headerAd->title }}" class="h-12 object-contain mx-auto">
    </a>
  </div>
@endif

<header class="sticky top-0 z-50 bg-white shadow">
  <div class="container mx-auto flex items-center justify-between py-3 px-4 lg:px-8">
    <!-- Logo -->
    <a href="{{ url('/') }}" class="flex items-center gap-2">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
      <span class="text-2xl font-bold text-blue-700">NEVDO</span>
    </a>

    <!-- Main Navigation -->
    <nav class="hidden md:flex items-center space-x-6">
      <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Home</a>
      <div class="relative group">
        <button class="text-gray-700 hover:text-blue-600 font-medium flex items-center gap-1">
          Categories <i class="fas fa-chevron-down text-xs"></i>
        </button>
        <div class="absolute left-0 mt-2 w-56 bg-white rounded shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
          <ul class="py-2">
            @foreach($categories ?? [] as $category)
              <li>
                <a href="{{ route('category.show', $category->slug) }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                  {{ $category->name }}
                </a>
              </li>
            @endforeach
            <li class="border-t mt-2 pt-2">
              <a href="{{ route('categories.index') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 font-medium">All Categories</a>
            </li>
          </ul>
        </div>
      </div>
      <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">About</a>
      <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Contact</a>
    </nav>

    <!-- Right Side: Auth/Buttons -->
    <div class="flex items-center space-x-4">
      <form action="{{ route('search') }}" method="GET" class="relative hidden md:block">
        <input type="text" name="q" placeholder="Search..." class="border rounded-full px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="absolute right-2 top-1 text-gray-500">
          <i class="fas fa-search"></i>
        </button>
      </form>
      @auth
        <a href="{{ route('user.dashboard') }}" class="text-blue-600 font-semibold">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button type="submit" class="text-gray-700 hover:text-blue-600 font-medium">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="px-4 py-1 border rounded-full text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white transition">Sign In</a>
        <a href="{{ route('register') }}" class="px-4 py-1 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">Register</a>
      @endauth
    </div>

    <!-- Mobile Menu Button -->
    <button class="md:hidden text-gray-700 hover:text-blue-600 ml-2" @click="open = !open">
      <i class="fas fa-bars text-2xl"></i>
    </button>
  </div>

  <!-- Mobile Navigation -->
  <div class="md:hidden" x-show="open" @click.outside="open = false" x-transition>
    <div class="px-4 pt-2 pb-3 bg-white border-t">
      <a href="{{ url('/') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">Home</a>
      <div x-data="{ categoriesOpen: false }">
        <button @click="categoriesOpen = !categoriesOpen" class="w-full text-left px-3 py-2 text-gray-700 hover:text-blue-600 font-medium flex items-center justify-between">
          <span>Categories</span>
          <i class="fas fa-chevron-down text-xs" :class="{ 'rotate-180': categoriesOpen }"></i>
        </button>
        <div x-show="categoriesOpen" x-transition class="pl-4">
          @foreach($categories ?? [] as $category)
            <a href="{{ route('category.show', $category->slug) }}" class="block px-3 py-2 text-gray-600 hover:text-blue-600">{{ $category->name }}</a>
          @endforeach
        </div>
      </div>
      <a href="{{ route('about') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">About</a>
      <a href="{{ route('contact') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">Contact</a>
      <form action="{{ route('search') }}" method="GET" class="flex items-center px-3 py-2">
        <input type="text" name="q" placeholder="Search..." class="w-full border rounded-full px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="ml-2 text-gray-500">
          <i class="fas fa-search"></i>
        </button>
      </form>
      @auth
        <a href="{{ route('user.dashboard') }}" class="block px-3 py-2 text-blue-600 font-semibold">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button type="submit" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium">Logout</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="block px-3 py-2 text-blue-600 font-medium">Sign In</a>
        <a href="{{ route('register') }}" class="block px-3 py-2 bg-blue-600 text-white rounded font-medium mt-2">Register</a>
      @endauth
    </div>
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
