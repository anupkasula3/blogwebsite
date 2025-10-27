@extends('admin.layouts.app')

@section('title', 'Create Category - Admin')
@section('page-title', 'Create Category')

@section('content')
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-[#ff3131] to-[#ff6b6b] px-5 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 backdrop-blur-sm p-2 rounded-lg">
                        <i class="fas fa-folder-plus text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">
                            @if ($category)
                                Create Sub Category
                            @else
                                Create New Category
                            @endif
                        </h2>
                        @if ($category)
                            <p class="text-white/90 text-sm mt-1">
                                Under: <span class="font-semibold">{{ $category->name }}</span>
                            </p>
                        @endif
                    </div>
                </div>
                <a
                @if ($category)
                    href="{{ route('admin.categories.index', ['parent_id' => $category->id]) }}"
                @else
                    href="{{ route('admin.categories.index') }}"
                @endif
                    class="bg-white text-[#ff3131] px-4 py-2 rounded-lg hover:shadow-lg transition-all duration-300 font-medium group text-sm">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Back
                </a>
            </div>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="p-5" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $category->id ?? 0 }}">

            <!-- Section 1: Basic Information -->
            <div class="mb-6 pb-5 border-b border-gray-200">
                <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-[#ff3131]"></i>
                    Basic Information
                </h3>
                <div class="">
                    <!-- Name -->
                    <div class="group">
                        <label for="name" class="flex items-center text-sm font-semibold text-gray-700 mb-1">
                            <span class="mr-2 text-[#ff3131]"><i class="fas fa-tag"></i></span>
                            Category Name <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ff3131]/20 focus:border-[#ff3131] hover:border-gray-400 transition-all duration-200 placeholder:text-gray-400"
                            placeholder="Enter category name">
                        <p class="mt-1 flex items-center text-xs text-gray-500">
                            <i class="fas fa-lightbulb mr-1 text-amber-500"></i>
                            Choose a clear, descriptive name
                        </p>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="group mt-5">
                        <label for="description" class="flex items-center text-sm font-semibold text-gray-700 mb-1">
                            <span class="mr-2 text-[#ff3131]"><i class="fas fa-align-left"></i></span>
                            Description
                        </label>
                        <textarea name="description" id="description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#ff3131]/20 focus:border-[#ff3131] hover:border-gray-400 transition-all duration-200 placeholder:text-gray-400 resize-none"
                            placeholder="Brief description of this category">{{ old('description') }}</textarea>
                        <p class="mt-1 flex items-center text-xs text-gray-500">
                            <i class="fas fa-info-circle mr-1 text-blue-500"></i>
                            Helps with SEO
                        </p>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Section 2: Visual Appearance -->
            <div class="mb-6 pb-5 border-b border-gray-200">
                <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-paint-brush mr-2 text-[#ff3131]"></i>
                    Visual Appearance
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Image Upload Field -->
                    <div class="mt-4">
                        <label class="text-sm font-semibold text-gray-800">Image</label>

                        <div class="relative flex flex-col items-center justify-center w-full mt-3 p-4 border-2 border-dashed rounded-2xl transition-all duration-200 hover:border-[#ff2953] focus-within:border-[#ff2953] shadow-sm bg-white">
                            <input type="file" name="image"
                                class="absolute inset-0 opacity-0 cursor-pointer"
                                onchange="loadFile(event)" />

                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto text-[#ff2953]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5.002 5.002 0 0115 8h1a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-600">Click or drag an image here to upload</p>
                            </div>
                        </div>


                        <!-- Preview -->
                        <div class="mt-3">
                            <img id="output" style="width: 70px; margin-bottom: 2px;" class=" rounded-lg object-cover " />
                        </div>

                        <!-- Validation Error -->
                        @error('image')
                            <div class="text-sm text-[#ff2953] mt-1 font-medium">
                                * {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Section 3: Category Settings -->
                <div class="mb-6 mt-3 pb-5 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-cog mr-2 text-[#ff3131]"></i>
                        Category Settings
                    </h3>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <!-- Visibility Settings -->
                        <div
                            class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-lg border border-gray-200 shadow-sm">
                            <h4 class="text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-eye mr-2 text-blue-600"></i>
                                Visibility
                            </h4>
                            <div class="space-y-3">
                                <div class="flex items-center bg-white p-2 rounded-lg">
                                    <input type="checkbox" name="is_active" id="is_active" value="1"
                                        {{ old('is_active', true) ? 'checked' : '' }}
                                        class="h-4 w-4 text-[#ff3131] focus:ring-[#ff3131] border-gray-300 rounded cursor-pointer">
                                    <label for="is_active"
                                        class="ml-2 text-sm font-medium text-gray-900 cursor-pointer flex items-center">
                                        <i class="fas fa-toggle-on mr-1 text-green-500"></i>
                                        Active Category
                                    </label>
                                </div>

                                <div class="flex items-center bg-white p-2 rounded-lg">
                                    <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                        {{ old('is_featured') ? 'checked' : '' }}
                                        class="h-4 w-4 text-[#ff3131] focus:ring-[#ff3131] border-gray-300 rounded cursor-pointer">
                                    <label for="is_featured"
                                        class="ml-2 text-sm font-medium text-gray-900 cursor-pointer flex items-center">
                                        <i class="fas fa-star mr-1 text-yellow-500"></i>
                                        Featured Category
                                    </label>
                                </div>

                                <div class="flex items-center bg-white p-2 rounded-lg">
                                    <input type="checkbox" name="show_in_menu" id="show_in_menu" value="1"
                                        {{ old('show_in_menu', true) ? 'checked' : '' }}
                                        class="h-4 w-4 text-[#ff3131] focus:ring-[#ff3131] border-gray-300 rounded cursor-pointer">
                                    <label for="show_in_menu"
                                        class="ml-2 text-sm font-medium text-gray-900 cursor-pointer flex items-center">
                                        <i class="fas fa-bars mr-1 text-blue-500"></i>
                                        Show in Menu
                                    </label>
                                </div>
                            </div>

                        </div>
                        <!-- SEO Settings -->
                        <div
                            class="bg-gradient-to-br from-amber-50 to-orange-50 p-4 rounded-lg border border-amber-200 shadow-sm">
                            <h4 class="text-sm font-semibold text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-search-dollar mr-2 text-amber-600"></i>
                                SEO Settings
                            </h4>

                            <div class="space-y-3">
                                <div>
                                    <label for="meta_title"
                                        class="flex items-center text-xs font-medium text-gray-700 mb-1">
                                        <i class="fas fa-heading mr-1 text-amber-600"></i>
                                        Meta Title
                                    </label>
                                    <input type="text" name="meta_title" id="meta_title"
                                        value="{{ old('meta_title') }}"
                                        class="w-full px-2 py-1.5 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 hover:border-gray-400 transition-all duration-200 text-sm"
                                        placeholder="SEO title">
                                </div>

                                <div>
                                    <label for="meta_description"
                                        class="flex items-center text-xs font-medium text-gray-700 mb-1">
                                        <i class="fas fa-file-alt mr-1 text-amber-600"></i>
                                        Meta Description
                                    </label>
                                    <textarea name="meta_description" id="meta_description" rows="2"
                                        class="w-full px-2 py-1.5 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 hover:border-gray-400 transition-all duration-200 resize-none text-sm"
                                        placeholder="SEO description">{{ old('meta_description') }}</textarea>
                                </div>

                                <div>
                                    <label for="meta_keywords"
                                        class="flex items-center text-xs font-medium text-gray-700 mb-1">
                                        <i class="fas fa-key mr-1 text-amber-600"></i>
                                        Meta Keywords
                                    </label>
                                    <input type="text" name="meta_keywords" id="meta_keywords"
                                        value="{{ old('meta_keywords') }}"
                                        class="w-full px-2 py-1.5 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 hover:border-gray-400 transition-all duration-200 text-sm"
                                        placeholder="keyword1, keyword2">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div
                        class="mt-5 flex items-center justify-between pt-4 border-t border-gray-200 bg-gray-50 -mx-5 -mb-5 px-5 pb-5">
                        <div class="flex items-center space-x-3">
                            <button type="submit" name="action" value="create"
                                class="bg-gradient-to-r from-[#ff3131] to-[#ff6b6b] text-white px-6 py-2 rounded-lg hover:shadow-lg hover:scale-105 transition-all duration-300 font-semibold group text-sm">
                                <i class="fas fa-check-circle mr-2 group-hover:scale-110 transition-transform"></i>
                                Create Category
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </form>
    </div>


@endsection
