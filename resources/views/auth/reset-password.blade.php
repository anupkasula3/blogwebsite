@extends('frontend.layout.main')

@section('title', 'Reset Password - ' . \App\Models\Setting::get('site_name', 'NepBlog'))

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <div class="bg-white/90 backdrop-blur rounded-2xl shadow-xl border border-gray-100 p-8 sm:p-10">
            <div class="flex flex-col items-center text-center">
                <div class="mx-auto h-14 w-14 bg-primary rounded-xl flex items-center justify-center shadow-md">
                    <i class="fas fa-lock text-on-primary text-xl"></i>
                </div>
                <h2 class="mt-4 text-2xl sm:text-3xl font-extrabold text-gray-900">
                    Reset your password
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Enter your new password below.
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

            <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="grid gap-4">
                    <div>
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="block w-full rounded-lg px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent sm:text-sm"
                               placeholder="Email address"
                               value="{{ $email ?? old('email') }}">
                    </div>
                    <div>
                        <label for="password" class="sr-only">New password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                               class="block w-full rounded-lg px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent sm:text-sm"
                               placeholder="New password">
                    </div>
                    <div>
                        <label for="password_confirmation" class="sr-only">Confirm new password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                               class="block w-full rounded-lg px-4 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent sm:text-sm"
                               placeholder="Confirm new password">
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full inline-flex items-center justify-center gap-2 py-3 px-4 text-sm font-semibold rounded-lg text-on-primary bg-primary hover:bg-primary transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        <i class="fas fa-save h-5 w-5"></i>
                        Reset Password
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">
                        Back to login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
