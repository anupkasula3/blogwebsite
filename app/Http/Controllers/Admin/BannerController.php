<?php

namespace App\Http\Controllers\Admin;

use App\FileService\ImageService;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function __construct(
        protected ImageService $imageService

    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::latest()->paginate(10);
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'required',
            'order' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $imagePath = $this->imageService->fileUpload($request->image, "banner");
            $data['image'] = $imagePath;
        }
        Banner::create($data);
        return redirect()->route('admin.banners.index')->with('popsuccess', 'Banner created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'link' => 'required',
            'order' => 'required',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($banner->image) {
                $this->imageService->imageDelete($banner->image);
            }
            $imagePath = $this->imageService->fileUpload($request->image, "banner");
            $data['image'] = $imagePath;

        }
        $banner->update($data);
        return redirect()->route('admin.banners.index')->with('popsuccess', 'Banner updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        if ($banner->image) {
            $this->imageService->imageDelete($banner->image);
        }
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('popsuccess', 'Banner deleted successfully');
    }
}
