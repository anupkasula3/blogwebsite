@extends('admin.layouts.app')

@section('title', 'Edit Category - Admin')
@section('page-title', 'Edit Category')

@section('content')
    <div class="flex items-center gap-x-4 mb-6">
        <a @if ($category->parent_id != 0) href="{{ route('admin.categories.index', ['parent_id' => $category->parent_id]) }}" @else href="{{ route('admin.categories.index') }}" @endif>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 12l14 0"></path>
                <path d="M5 12l6 6"></path>
                <path d="M5 12l6 -6"></path>
            </svg>
        </a>
        <div class="text-xl font-semibold ">Edit Category</div>
    </div>

    <div class="bg-white rounded-lg shadow-lg row text-slate-600">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-6 mt-3">
                <div>
                    <!-- Name -->
                    <div>
                        <label class="w-full text-sm font-semibold" htmlFor="name">Category Name *</label>
                        <div>
                            <input
                                class="w-full p-3 mt-3 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                name="name" id="name" placeholder="Enter category name" type="text" value="{{ old('name', $category->name) }}" required />
                            @error('name')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                    * {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-3">
                        <label class="w-full text-sm font-semibold" htmlFor="description">Description</label>
                        <div>
                            <textarea
                                class="w-full p-3 mt-3 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                name="description" id="description" rows="3" placeholder="Brief description of this category">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                    * {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Image Upload Field -->
                <div class="mt-3">
                    <label class='text-sm font-semibold'>Image</label>
                    <div class='w-full p-2 mt-2 mb-1 text-sm border rounded-md shadow-sm form-control border-grey-400'>
                        <input type="file" name="image"
                            class="image hover:border-blue-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 "
                            onchange="loadFile(event)" />
                    </div>
                    <img class="oldimage" src="{{ asset('/uploads/' . $category->image) }}" alt="Card"
                        style="width: 70px; margin-bottom: 2px;" />
                    <img id="output" style="width: 70px; margin-bottom: 2px;" />
                    @error('image')
                        <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                            * {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Category Settings -->
                <div class="mt-3">
                    <label class="w-full text-sm font-semibold">Category Settings</label>
                    <div class="space-y-3 mt-3">
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                                class="text-blue-600 focus:ring-blue-500 rounded">
                            <label for="is_active" class="ml-2 text-sm font-semibold text-gray-700 cursor-pointer">
                                Active Category
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                {{ old('is_featured', $category->is_featured) ? 'checked' : '' }}
                                class="text-blue-600 focus:ring-blue-500 rounded">
                            <label for="is_featured" class="ml-2 text-sm font-semibold text-gray-700 cursor-pointer">
                                Featured Category
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="show_in_menu" id="show_in_menu" value="1"
                                {{ old('show_in_menu', $category->show_in_menu) ? 'checked' : '' }}
                                class="text-blue-600 focus:ring-blue-500 rounded">
                            <label for="show_in_menu" class="ml-2 text-sm font-semibold text-gray-700 cursor-pointer">
                                Show in Menu
                            </label>
                        </div>
                    </div>
                </div>
                <!-- SEO Settings -->
                <div class="mt-3">
                    <label class="w-full text-sm font-semibold">SEO Settings</label>
                    <div class="space-y-3 mt-3">
                        <div>
                            <label class="text-xs font-semibold text-gray-600">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $category->meta_title) }}"
                                class="w-full p-2 mt-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                placeholder="SEO title" />
                            @error('meta_title')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                    * {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-600">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" rows="2"
                                class="w-full p-2 mt-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                placeholder="SEO description">{{ old('meta_description', $category->meta_description) }}</textarea>
                            @error('meta_description')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                    * {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-gray-600">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords) }}"
                                class="w-full p-2 mt-1 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                placeholder="keyword1, keyword2" />
                            @error('meta_keywords')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">
                                    * {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div>
                    <button type="submit" name="action" value="update"
                        class="px-4 py-1 mt-3 mr-2 text-white bg-[#ff3131] rounded-md hover:bg-[#ff3135] hover:text-white">
                        Update Category
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
