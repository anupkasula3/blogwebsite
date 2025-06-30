@extends('admin.layouts.app')

@section('title', 'Manage Categories - Admin')
@section('page-title', 'Manage Categories')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="flex items-center justify-between mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-900">All Categories</h2>
            <a href="{{ route('admin.categories.create') }}"
                class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-lg shadow hover:shadow-lg hover:from-purple-700 hover:to-blue-700 transition-all font-semibold">
                <i class="fas fa-plus mr-2"></i>
                Create Category
            </a>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Category
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Posts</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Created
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Actions
                        </th>
                    </tr>

                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($categories as $category)
                        <tr class="hover:bg-purple-50 even:bg-gray-50 transition-all">
                            <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                                @if ($category->image)
                                    <img class="h-10 w-10 rounded-lg object-cover border"
                                        src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
                                @else
                                    <div
                                        class="h-10 w-10 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-folder text-white"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="text-base font-semibold text-gray-900">{{ $category->name }}</div>
                                    <div class="text-xs text-gray-500">{{ Str::limit($category->description, 40) }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $category->slug }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $category->posts_count }}</td>
                            <td class="px-6 py-4">
                                @if ($category->is_active)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i> Active
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times mr-1"></i> Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $category->created_at->format('M j, Y') }}</td>
                            <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                                <a href="{{ route('admin.categories.show', $category) }}"
                                    class="text-blue-600 hover:text-blue-800 bg-blue-50 rounded p-2 transition"
                                    title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 rounded p-2 transition"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                    class="inline delete-category-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="text-red-600 hover:text-red-800 bg-red-50 rounded p-2 transition delete-category-btn"
                                        title="Delete" data-category-name="{{ $category->name }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500 bg-white">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-folder text-4xl mb-4 text-gray-300"></i>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No categories found</h3>
                                    <p class="text-gray-600">Get started by creating your first category.</p>
                                    <a href="{{ route('admin.categories.create') }}"
                                        class="mt-4 bg-gradient-to-r from-purple-600 to-blue-600 text-white px-4 py-2 rounded-lg hover:from-purple-700 hover:to-blue-700 transition-all font-semibold">
                                        Create Category
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($categories->hasPages())
            <div class="pt-6">
                {{ $categories->links() }}
            </div>
        @endif
    </div>

    {{-- Delete Confirmation Modal --}}
    <div x-data="{ open: false, form: null, category: '' }" x-init="document.querySelectorAll('.delete-category-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            $data.open = true;
            $data.form = btn.closest('form');
            $data.category = btn.getAttribute('data-category-name');
        });
    });" x-show="open" style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
            <h2 class="text-xl font-bold mb-4 text-gray-900">Delete Category</h2>
            <p class="mb-6 text-gray-700">Are you sure you want to delete the category <span
                    class="font-semibold text-red-600" x-text="category"></span>? This will also delete all posts in this
                category.</p>
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
