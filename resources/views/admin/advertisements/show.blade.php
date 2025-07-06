@extends('admin.layouts.app')

@section('title', 'Advertisement Details - Admin')
@section('page-title', 'Advertisement Details')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8 mt-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-900">{{ $advertisement->title }}</h2>
        <div class="flex space-x-2">
            <a href="{{ route('admin.advertisements.edit', $advertisement) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm flex items-center"><i class="fas fa-edit mr-1"></i>Edit</a>
            <a href="{{ route('admin.advertisements.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 text-sm flex items-center"><i class="fas fa-arrow-left mr-1"></i>Back</a>
        </div>
    </div>
    @if($advertisement->image)
    <div class="mb-6 flex justify-center">
        <img src="{{ asset('/uploads/' . $advertisement->image) }}" alt="Advertisement image" class="rounded-lg shadow w-full max-w-md object-cover" style="max-height: 220px;">
    </div>
    @endif
    <div class="mb-4">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
            {{ $advertisement->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
            <i class="fas fa-circle mr-1 text-xs"></i>
            {{ $advertisement->is_active ? 'Active' : 'Inactive' }}
        </span>
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 ml-2">
            <i class="fas fa-map-marker-alt mr-1 text-xs"></i>
            {{ ucfirst($advertisement->position) }}
        </span>
    </div>
    <div class="mb-4">
        <p class="text-gray-700 text-base mb-2"><i class="fas fa-align-left mr-2"></i>{{ $advertisement->description ?: 'No description provided.' }}</p>
    </div>
    <div class="mb-4 flex items-center">
        <span class="text-gray-500 text-sm mr-2"><i class="fas fa-link mr-1"></i>Link:</span>
        <a href="{{ $advertisement->link }}" target="_blank" class="text-blue-600 hover:underline break-all">{{ $advertisement->link }}</a>
        <button onclick="navigator.clipboard.writeText('{{ $advertisement->link }}')" class="ml-2 px-2 py-1 bg-gray-100 hover:bg-gray-200 rounded text-xs text-gray-700" title="Copy link"><i class="fas fa-copy"></i></button>
    </div>
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <span class="text-gray-500 text-xs">Start Date</span>
            <div class="text-gray-800 text-sm font-medium">{{ $advertisement->start_date ? \Carbon\Carbon::parse($advertisement->start_date)->format('Y-m-d') : 'N/A' }}</div>
        </div>
        <div>
            <span class="text-gray-500 text-xs">End Date</span>
            <div class="text-gray-800 text-sm font-medium">{{ $advertisement->end_date ? \Carbon\Carbon::parse($advertisement->end_date)->format('Y-m-d') : 'N/A' }}</div>
        </div>
    </div>
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <span class="text-gray-500 text-xs">Created</span>
            <div class="text-gray-800 text-sm font-medium">{{ $advertisement->created_at->format('Y-m-d') }}</div>
        </div>
        <div>
            <span class="text-gray-500 text-xs">Updated</span>
            <div class="text-gray-800 text-sm font-medium">{{ $advertisement->updated_at->format('Y-m-d') }}</div>
        </div>
    </div>
</div>
@endsection
