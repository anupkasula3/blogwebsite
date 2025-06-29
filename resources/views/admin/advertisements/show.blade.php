<div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6 mt-8">
    <h2 class="text-lg font-bold text-gray-800 mb-2 text-sm">{{ $advertisement->title }}</h2>
    <div class="mb-2 text-xs text-gray-500">Position: <span class="text-sm text-gray-700">{{ $advertisement->position }}</span></div>
    <div class="mb-2 text-xs text-gray-500">Status: <span class="text-sm text-gray-700">{{ $advertisement->status }}</span></div>
    <div class="mb-2 text-xs text-gray-500">Performance: <span class="text-sm text-gray-700">{{ $advertisement->performance }}</span></div>
    <div class="mb-2 text-xs text-gray-500">Created: <span class="text-sm text-gray-700">{{ $advertisement->created_at->format('Y-m-d') }}</span></div>
    <div class="mb-2 text-xs text-gray-500">Updated: <span class="text-sm text-gray-700">{{ $advertisement->updated_at->format('Y-m-d') }}</span></div>
    <div class="mt-4 flex space-x-2">
        <a href="{{ route('admin.advertisements.edit', $advertisement) }}" class="px-3 py-1 bg-blue-500 text-white rounded text-xs">Edit</a>
        <a href="{{ route('admin.advertisements.index') }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded text-xs">Back</a>
    </div>
</div>
