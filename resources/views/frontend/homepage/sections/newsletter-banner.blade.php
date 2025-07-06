<div class="bg-gradient-to-r from-blue-400 to-green-300 py-12 mt-12 rounded-xl shadow-lg">
  <div class="max-w-3xl mx-auto flex flex-col md:flex-row items-center justify-between px-6 gap-6">
    <div class="flex items-center gap-4 mb-4 md:mb-0">
      <i class="fas fa-envelope-open-text text-4xl text-blue-600"></i>
      <div>
        <h3 class="text-2xl font-bold mb-2">Sign up for Newsletter</h3>
        <p class="text-gray-800">Get the latest tech news, straight to your inbox.</p>
      </div>
    </div>
    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex w-full md:w-auto">
      @csrf
      <input type="email" name="email" placeholder="Enter your email" class="px-4 py-2 rounded-l border border-gray-300 focus:ring-2 focus:ring-blue-500">
      <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-r hover:bg-blue-700">Subscribe</button>
    </form>
  </div>
</div>
