@extends('user.layouts.app')

@section('title', 'Analytics')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <!-- Page header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Analytics Overview</h1>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center gap-4 transition-transform transform hover:-translate-y-1">
            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-100">
                <i class="fas fa-eye text-blue-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Views</div>
                <div class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_views'] ?? 0) }}</div>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center gap-4 transition-transform transform hover:-translate-y-1">
            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-green-100">
                <i class="fas fa-file-alt text-green-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium uppercase tracking-wider">Total Posts</div>
                <div class="text-3xl font-bold text-gray-800">{{ $stats['total_posts'] ?? 0 }}</div>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center gap-4 transition-transform transform hover:-translate-y-1">
            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-yellow-100">
                <i class="fas fa-clock text-yellow-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium uppercase tracking-wider">Pending</div>
                <div class="text-3xl font-bold text-gray-800">{{ $stats['pending_posts'] ?? 0 }}</div>
            </div>
        </div>
        <div class="bg-white shadow-lg rounded-2xl p-6 flex items-center gap-4 transition-transform transform hover:-translate-y-1">
            <div class="w-12 h-12 flex items-center justify-center rounded-xl bg-purple-100">
                <i class="fas fa-check-circle text-purple-600 text-2xl"></i>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium uppercase tracking-wider">Approved</div>
                <div class="text-3xl font-bold text-gray-800">{{ $stats['approved_posts'] ?? 0 }}</div>
            </div>
        </div>
    </div>

    <!-- Main content grid -->
    <div class="grid grid-cols-12 gap-6">
        <!-- Views Chart -->
        <div class="col-span-12 xl:col-span-8 bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Views Over Time <span class="text-sm text-gray-500 font-normal">(Last 7 Months)</span></h2>
            <div class="h-80">
                <canvas id="viewsChart"></canvas>
            </div>
            <p class="text-xs text-gray-400 mt-2 text-center">Note: This is dummy data for demonstration purposes.</p>
        </div>

        <!-- Popular Posts -->
        <div class="col-span-12 xl:col-span-4 bg-white shadow-lg rounded-2xl p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Most Popular</h2>
            @if($popularPosts->count() > 0)
            <ul class="space-y-4">
                @foreach($popularPosts as $post)
                <li class="flex items-start space-x-3">
                    <div class="w-16 h-16 rounded-lg bg-gray-200 overflow-hidden flex-shrink-0">
                        @if($post->featured_image)
                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300">
                            <i class="fas fa-image text-2xl text-gray-400"></i>
                        </div>
                        @endif
                    </div>
                    <div>
                        <a href="{{ route('user.posts.show', $post) }}" class="font-semibold text-gray-800 hover:text-purple-600 text-sm leading-tight line-clamp-2">{{ $post->title }}</a>
                        <div class="text-xs text-gray-500 mt-1">{{ number_format($post->views_count) }} views</div>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <div class="text-center py-8">
                <i class="fas fa-chart-bar text-4xl mb-4 text-gray-300"></i>
                <p class="text-gray-500">No popular posts to show yet.</p>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    const ctx = document.getElementById('viewsChart').getContext('2d');
    const viewsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartData['labels']),
            datasets: [{
                label: 'Post Views',
                data: @json($chartData['data']),
                backgroundColor: 'rgba(129, 140, 248, 0.2)',
                borderColor: 'rgba(129, 140, 248, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endpush

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush
@endsection

