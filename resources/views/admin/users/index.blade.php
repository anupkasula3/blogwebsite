@extends('admin.layouts.app')

@section('title', 'Manage Users - Admin')
@section('page-title', 'Manage Users')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-8">
    <div class="flex items-center justify-between mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-900">All Users</h2>
        <a href="{{ route('admin.users.create') }}"
           class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-lg shadow hover:shadow-lg hover:from-purple-700 hover:to-blue-700 transition-all font-semibold">
            <i class="fas fa-plus mr-2"></i>
            Create User
        </a>
    </div>
    <div class="w-full overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg shadow divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">User</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Posts</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Joined</th>
                    <th class="px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                <tr class="hover:bg-purple-50 even:bg-gray-50 transition-all">
                    <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                        <img class="h-10 w-10 rounded-full object-cover border" src="{{ $user->avatar_url }}" alt="{{ $user->name }}">
                        <div>
                            <div class="text-base font-semibold text-gray-900">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $user->bio ?: 'No bio' }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1">
                            {{ $user->posts_count }} total
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $user->approved_posts_count }} published
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($user->email_verified_at)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i> Verified
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i> Pending
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">{{ $user->created_at->format('M j, Y') }}</td>
                    <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                        <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:text-blue-800 bg-blue-50 rounded p-2 transition" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 rounded p-2 transition" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        @if(!$user->email_verified_at)
                        <form method="POST" action="{{ route('admin.users.verify', $user) }}" class="inline">
                            @csrf
                            <button type="submit" class="text-green-600 hover:text-green-800 bg-green-50 rounded p-2 transition" title="Verify Email">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.users.unverify', $user) }}" class="inline">
                            @csrf
                            <button type="submit" class="text-yellow-600 hover:text-yellow-800 bg-yellow-50 rounded p-2 transition" title="Unverify Email">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                        @endif
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline delete-user-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-red-600 hover:text-red-800 bg-red-50 rounded p-2 transition delete-user-btn" title="Delete" data-user-name="{{ $user->name }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500 bg-white">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-users text-4xl mb-4 text-gray-300"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No users found</h3>
                            <p class="text-gray-600">Get started by creating your first user.</p>
                            <a href="{{ route('admin.users.create') }}"
                               class="mt-4 bg-gradient-to-r from-purple-600 to-blue-600 text-white px-4 py-2 rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all font-semibold">
                                Create User
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="pt-6">
        {{ $users->links() }}
    </div>
    @endif
</div>

{{-- Delete Confirmation Modal --}}
<div x-data="{ open: false, form: null, user: '' }" x-init="
    document.querySelectorAll('.delete-user-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            $data.open = true;
            $data.form = btn.closest('form');
            $data.user = btn.getAttribute('data-user-name');
        });
    });
" x-show="open" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
        <h2 class="text-xl font-bold mb-4 text-gray-900">Delete User</h2>
        <p class="mb-6 text-gray-700">Are you sure you want to delete the user <span class="font-semibold text-red-600" x-text="user"></span>? This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button @click="open = false" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Cancel</button>
            <button @click="form.submit(); open = false" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
@endsection
