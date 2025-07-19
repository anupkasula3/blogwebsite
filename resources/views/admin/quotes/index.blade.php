@extends('admin.layouts.app')

@section('content')
    <div class="container py-4">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Quotes</h2>
            <a href="{{ route('admin.quotes.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i> Add Quote
            </a>
        </div>
        {{-- @if (session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-200">{{ session('success') }}</div>
    @endif --}}
        <div class="bg-white rounded-xl shadow p-4 overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider rounded-tl-xl">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider">Quote</th>
                        <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider rounded-tr-xl">
                            Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quotes as $key => $quote)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-3 align-top text-sm text-gray-600">{{ ($quotes->firstItem() ?? 0) + $key }}</td>
                            <td class="px-4 py-3 align-top text-gray-900 max-w-2xl text-sm">{{ $quote->quote }}</td>
                            <td class="px-4 py-3 align-top text-center">
                                <a href="{{ route('admin.quotes.show', $quote) }}"
                                    class="inline-flex items-center px-2 py-1 text-xs text-blue-600 hover:text-blue-800"
                                    title="View"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.quotes.edit', $quote) }}"
                                    class="inline-flex items-center px-2 py-1 text-xs text-yellow-500 hover:text-yellow-700"
                                    title="Edit"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.quotes.destroy', $quote) }}" method="POST"
                                    class="inline delete-quote-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="inline-flex items-center px-2 py-1 text-xs text-red-600 hover:text-red-800 delete-quote-btn"
                                        title="Delete" data-quote-id="{{ $quote->id }}"
                                        data-quote="{{ Str::limit($quote->quote, 60) }}"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-gray-500">No quotes found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $quotes->links('vendor.pagination.tailwind') }}
        </div>

        {{-- Delete Confirmation Modal --}}
        <div x-data="{ open: false, form: null, quote: '' }" x-init="document.querySelectorAll('.delete-quote-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                $data.open = true;
                $data.form = btn.closest('form');
                $data.quote = btn.getAttribute('data-quote');
            });
        });" x-show="open" style="display: none;"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
            <div class="bg-white rounded-lg shadow-lg p-8 max-w-sm w-full">
                <h2 class="text-xl font-bold mb-4 text-gray-900">Delete Quote</h2>
                <p class="mb-6 text-gray-700">Are you sure you want to delete the quote <span
                        class="font-semibold text-red-600" x-text="quote"></span>? This action cannot be undone.</p>
                <div class="flex justify-end gap-3">
                    <button @click="open = false"
                        class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300">Cancel</button>
                    <button @click="form.submit(); open = false"
                        class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Delete</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @endpush
@endsection
