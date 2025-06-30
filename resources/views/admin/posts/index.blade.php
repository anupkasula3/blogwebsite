@extends('admin.layouts.app')

@section('title', 'Manage Posts - Admin')
@section('page-title', 'Manage Posts')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="flex items-center justify-between mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-900">Admin Posts</h2>
            <div class="flex space-x-3">
                <a href="{{ route('admin.userposts.index') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-users mr-2"></i>
                    User Posts
                </a>
                <a href="{{ route('admin.posts.create') }}"
                    class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-lg shadow hover:shadow-lg hover:from-purple-700 hover:to-blue-700 transition-all font-semibold">
                    <i class="fas fa-plus mr-2"></i>
                    Create Post
                </a>
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Post</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Category
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Author</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Views</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Published
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>

                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($posts as $post)
                        <tr class="hover:bg-purple-50 even:bg-gray-50 transition-all">
                            <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                                @if ($post->featured_image)
                                    <img class="h-10 w-10 rounded-lg object-cover border"
                                        src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}">
                                @else
                                    <div
                                        class="h-10 w-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-newspaper text-white"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="text-base font-semibold text-gray-900">{{ $post->title }}</div>
                                    <div class="text-xs text-gray-500">{{ Str::limit($post->excerpt, 40) }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $post->category->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $post->author_name }}</td>
                            <td class="px-6 py-4">
                                @if ($post->status === 'published')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i> Published
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i> Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($post->views_count) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $post->published_at ? $post->published_at->format('M j, Y') : '-' }}</td>
                            <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                                <a href="{{ route('admin.posts.show', $post) }}"
                                    class="text-blue-600 hover:text-blue-800 bg-blue-50 rounded p-2 transition"
                                    title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                    class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 rounded p-2 transition"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                    class="inline delete-post-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="text-red-600 hover:text-red-800 bg-red-50 rounded p-2 transition delete-post-btn"
                                        title="Delete" data-post-title="{{ $post->title }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500 bg-white">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-newspaper text-4xl mb-4 text-gray-300"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No posts found</h3>
                                    <p class="text-gray-600">Get started by creating your first post.</p>
                                    <a href="{{ route('admin.posts.create') }}"
                                        class="mt-4 bg-gradient-to-r from-purple-600 to-blue-600 text-white px-4 py-2 rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all font-semibold">
                                        Create Post
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($posts->hasPages())
            <div class="pt-6">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    <div x-data="{ open: false, form: null, post: '' }" x-init="document.querySelectorAll('.delete-post-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            $data.open = true;
            $data.form = btn.closest('form');
            $data.post = btn.getAttribute('data-post-title');
        });
    });" x-show="open" style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
            <h2 class="text-xl font-bold mb-4 text-gray-900">Delete Post</h2>
            <p class="mb-6 text-gray-700">Are you sure you want to delete the post <span class="font-semibold text-red-600"
                    x-text="post"></span>? This action cannot be undone.</p>
            <div class="flex justify-end gap-3">
                <button @click="open = false"
                    class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Cancel</button>
                <button @click="form.submit(); open = false"
                    class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @endpush
@endsection
