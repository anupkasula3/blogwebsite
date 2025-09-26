@extends('frontend.layout.main')

@section('title', 'Register - ' . \App\Models\Setting::get('site_name', 'NepBlog'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl w-full">
        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-xl border border-gray-100 p-8 sm:p-10">
            <div class="flex flex-col items-center text-center">
                <div class="mx-auto h-14 w-14 bg-primary rounded-xl flex items-center justify-center shadow-md">
                    <i class="fas fa-user-plus text-on-primary text-xl"></i>
                </div>
                <h2 class="mt-4 text-2xl sm:text-3xl font-extrabold text-gray-900">
                    Create your account
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">
                        Sign in
                    </a>
                </p>
            </div>

            @if($errors->any())
            <div class="mt-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="grid gap-4">
                    <div>
                        <label for="name" class="sr-only">Full name</label>
                        <input id="name" name="name" type="text" autocomplete="name" required
                               class="block w-full rounded-lg px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent sm:text-sm"
                               placeholder="Full name"
                               value="{{ old('name') }}">
                    </div>
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="block w-full rounded-lg px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent sm:text-sm"
                               placeholder="Email address"
                               value="{{ old('email') }}">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               class="block w-full rounded-lg px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent sm:text-sm"
                               placeholder="Password">
                    </div>
                    <div>
                        <label for="password_confirmation" class="sr-only">Confirm password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                               class="block w-full rounded-lg px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent sm:text-sm"
                               placeholder="Confirm password">
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="terms" name="terms" type="checkbox" required
                           class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        I agree to the
                        <a href="{{ route('terms') }}" class="text-primary hover:underline">Terms of Service</a>
                        and
                        <a href="{{ route('privacy') }}" class="text-primary hover:underline">Privacy Policy</a>
                    </label>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full inline-flex items-center justify-center gap-2 py-3 px-4 text-sm font-semibold rounded-lg text-on-primary bg-primary hover:bg-primary transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <i class="fas fa-user-plus h-5 w-5"></i>
                        Create Account
                    </button>
                </div>
            </form>

            <div class="mt-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Or continue with</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div>
                        <a href="#" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 border border-gray-200 rounded-lg bg-white text-sm font-medium text-gray-600 hover:bg-gray-50">
                            <i class="fab fa-google text-red-500"></i>
                            <span>Google</span>
                        </a>
                    </div>

                    <div>
                        <a href="#" class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 border border-gray-200 rounded-lg bg-white text-sm font-medium text-gray-600 hover:bg-gray-50">
                            <i class="fab fa-facebook text-blue-600"></i>
                            <span>Facebook</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
