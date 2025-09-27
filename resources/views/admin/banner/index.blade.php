@extends('admin.layouts.app')

@section('title', 'Banners - Admin')
@section('page-title', 'Banners')

@section('content')

    <!-- Header Section -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Banners</h1>
            <p class="text-sm text-gray-600">Manage homepage banners and hero images</p>
        </div>
        <div>
            <a href="{{ route('admin.banners.create') }}"
                class="flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-[#ff3131] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-[#ff3131]/50 focus:ring-offset-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 5l0 14"></path>
                    <path d="M5 12l14 0"></path>
                </svg>
                Add Banner
            </a>
        </div>
    </div>

    <!-- Banner Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Title
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Image
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Created
                            Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($banners as $key => $banner)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $banner->title }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <img class="w-20 h-14 object-cover rounded-lg border border-gray-200 shadow-sm"
                                    src="{{ asset('uploads/' . $banner->image) }}" alt="{{ $banner->title }}">
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $banner->created_at->format('M d, Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $banner->created_at->format('g:i A') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white rounded-lg bg-[#050a30] hover:opacity-90 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                            </path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.banners.destroy', $banner->id) }}"
                                        id="delete-form-{{ $banner->id }}" class="inline delete-category-form">
                                        @csrf
                                        @method('delete')
                                        <button title="Delete" type="button" data-banner-name="{{ $banner->name }}"
                                            class="inline-flex delete-banner-btn items-center px-3 py-1.5 text-xs font-medium text-white rounded-lg bg-[#ff3131] hover:opacity-90 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 7l16 0"></path>
                                                <path d="M10 11l0 6"></path>
                                                <path d="M14 11l0 6"></path>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



    {{-- Delete Confirmation Modal --}}
    <div x-data="{ open: false, form: null, category: '' }" x-init="document.querySelectorAll('.delete-banner-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            $data.open = true;
            $data.form = btn.closest('form');
            $data.category = btn.getAttribute('data-banner-name');
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
