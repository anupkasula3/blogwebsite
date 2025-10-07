@extends('admin.layouts.app')

@section('title', 'Create Metapage - Admin')
@section('page-title', 'Create Metapage')

@section('content')
    <div class="flex items-center gap-x-4">
        <a href="{{ route('admin.metapages.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 12l14 0"></path>
                <path d="M5 12l6 6"></path>
                <path d="M5 12l6 -6"></path>
            </svg>
        </a>
        <div class="text-xl font-semibold ">Add Metapage</div>
    </div>
    <div class="bg-white rounded-lg shadow-lg row  text-slate-600">
        <form method="post" action="{{ route('admin.metapages.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="p-6 mt-3">
                <div class="flex flex-col ">
                    <div>
                        <label class="w-full text-sm font-semibold">Page Name</label>
                        <div>
                            <input
                                class="w-full p-3 mt-3 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                name="page_name" placeholder="e.g. about-us, blogs, contact" type="text"
                                value="{{ old('page_name') }}" />
                            @error('page_name')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">* {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="w-full text-sm font-semibold">Meta Title</label>
                        <div>
                            <input
                                class="w-full p-3 mt-3 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                name="meta_title" placeholder="Enter Meta Title" type="text"
                                value="{{ old('meta_title') }}" />
                            @error('meta_title')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">* {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="w-full text-sm font-semibold">Meta Description</label>
                        <div>
                            <textarea name="meta_description" rows="4"
                                class="w-full p-3 mt-3 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                placeholder="Enter meta description">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">* {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class='text-sm font-semibold'>OG Image</label>
                        <div class='w-full p-2 mt-2 mb-1 text-sm border rounded-md shadow-sm form-control border-grey-400'>
                            <input type="file" name="ogimage"
                                class="image hover:border-blue-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 "
                                onchange="loadFile(event)" />
                        </div>
                        <img id="output" style="width: 70px; margin-bottom: 2px;" />
                        @error('ogimage')
                            <div class="text-sm text-red-400 invalid-feedback" style="display: block;">* {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label class="w-full text-sm font-semibold">Image Alt Text</label>
                        <div>
                            <input
                                class="w-full p-3 mt-3 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                name="img_alt" placeholder="Describe the image" type="text" value="{{ old('img_alt') }}" />
                            @error('img_alt')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">* {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="w-full text-sm font-semibold">Keywords (comma separated)</label>
                        <div>
                            <input
                                class="w-full p-3 mt-3 text-xs border border-gray-300 rounded focus:outline-none focus:ring-blue-500 focus:border-blue-500 hover:border-blue-500"
                                name="keywords" placeholder="keyword1, keyword2" type="text" value="{{ old('keywords') }}" />
                            @error('keywords')
                                <div class="text-sm text-red-400 invalid-feedback" style="display: block;">* {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <button
                            class="px-4 py-1 mt-3 mr-2 text-white bg-[#ff3131] rounded-md  hover:bg-[#ff3135] hover:text-white">
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
