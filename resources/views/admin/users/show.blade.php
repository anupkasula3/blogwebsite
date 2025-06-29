<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6 mt-8">
    <h2 class="text-lg font-bold text-gray-800 mb-2 text-sm">{{ $user->name }}</h2>
    <div class="mb-2 text-xs text-gray-500">Email: <span class="text-sm text-gray-700">{{ $user->email }}</span></div>
    <div class="mb-2 text-xs text-gray-500">Status: <span class="text-sm text-gray-700">{{ $user->status }}</span></div>
    <div class="mb-2 text-xs text-gray-500">Posts: <span class="text-sm text-gray-700">{{ $user->posts_count ?? '-' }}</span></div>
    <div class="mb-2 text-xs text-gray-500">Joined: <span class="text-sm text-gray-700">{{ $user->created_at->format('Y-m-d') }}</span></div>
    <div class="mb-2 text-xs text-gray-500">Updated: <span class="text-sm text-gray-700">{{ $user->updated_at->format('Y-m-d') }}</span></div>
    <div class="mt-4 flex space-x-2">
        <a href="{{ route('admin.users.edit', $user) }}" class="px-3 py-1 bg-blue-500 text-white rounded text-xs">Edit</a>
        <a href="{{ route('admin.users.index') }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded text-xs">Back</a>
    </div>
</div>
