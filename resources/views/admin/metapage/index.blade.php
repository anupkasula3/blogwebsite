@extends('admin.layouts.app')

@section('title', 'Metapages - Admin')
@section('page-title', 'Metapages')

@section('content')

    <!-- Header Section -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Metapages</h1>
            <p class="text-sm text-gray-600">Manage meta data for static pages</p>
        </div>
        <div>
            <a href="{{ route('admin.metapages.create') }}"
                class="flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-[#ff3131] hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-[#ff3131]/50 focus:ring-offset-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 5l0 14"></path>
                    <path d="M5 12l14 0"></path>
                </svg>
                Add Metapage
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Page
                            Name</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">OG Image
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Created
                            Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($metapages as $metapage)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $metapage->page_name }}</div>
                                <div class="text-xs text-gray-500">{{ $metapage->meta_title }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if($metapage->ogimage)
                                    <img class="w-20 h-14 object-cover rounded-lg border border-gray-200 shadow-sm"
                                         src="{{ asset('uploads/' . $metapage->ogimage) }}" alt="{{ $metapage->img_alt }}">
                                @else
                                    <span class="text-xs text-gray-400">No image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $metapage->created_at->format('M d, Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $metapage->created_at->format('g:i A') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.metapages.edit', $metapage->id) }}"
                                       class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white rounded-lg bg-[#050a30] hover:opacity-90 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" viewBox="0 0 24 24"
                                             stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                             stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.metapages.destroy', $metapage->id) }}" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white rounded-lg bg-[#ff3131] hover:opacity-90 transition-colors"
                                                onclick="return confirm('Are you sure you want to delete this metapage?')">
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

    <div class="mt-4">{{ $metapages->links() }}</div>
@endsection
