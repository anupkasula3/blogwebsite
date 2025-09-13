@extends('admin.layouts.app')

@section('title', 'Edit User - Admin')
@section('page-title', 'Edit User')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-8 max-w-3xl">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-900">Editing: {{ $user->name }}</h2>
        <p class="text-sm text-gray-500">Joined {{ $user->created_at->format('M d, Y') }}</p>
    </div>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="bio" class="block text-sm font-medium text-gray-700">Bio (optional)</label>
            <textarea id="bio" name="bio" rows="3"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('bio', $user->bio) }}</textarea>
            @error('bio')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="website" class="block text-sm font-medium text-gray-700">Website (optional)</label>
            <input type="url" id="website" name="website" value="{{ old('website', $user->website) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            @error('website')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <input id="is_verified" name="is_verified" type="checkbox" value="1" {{ old('is_verified', $user->email_verified_at ? true : false) ? 'checked' : '' }}
                   class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
            <label for="is_verified" class="ml-2 block text-sm text-gray-700">Email is verified</label>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Cancel</a>
            <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">Update User</button>
            <a href="{{ route('admin.users.show', $user) }}" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">View</a>
        </div>
    </form>
</div>
@endsection
