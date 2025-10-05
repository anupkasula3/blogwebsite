<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\FileService\ImageService;
use App\Models\Metapage;
use Illuminate\Http\Request;

class MetapageController extends Controller
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
        $metapages = Metapage::paginate(10);
        return view('admin.metapage.index', compact('metapages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.metapage.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'ogimage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'img_alt' => 'nullable|string|max:255',
            'keywords' => 'nullable|string',
        ]);

        $data = $request->all();
        if ($request->hasFile('ogimage')) {
            $imagePath = $this->imageService->fileUpload($request->ogimage, 'metapage');
            $data['ogimage'] = $imagePath;
        }

        Metapage::create($data);
        return redirect()->route('admin.metapages.index')->with('popsuccess', 'Metapage created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Metapage $metapage)
    {
        return view('admin.metapage.edit', compact('metapage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Metapage $metapage)
    {
        $request->validate([
            'page_name' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'ogimage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'img_alt' => 'nullable|string|max:255',
            'keywords' => 'nullable|string',
        ]);

        $data = $request->all();
        if ($request->hasFile('ogimage')) {
            if ($metapage->ogimage) {
                $this->imageService->imageDelete($metapage->ogimage);
            }
            $imagePath = $this->imageService->fileUpload($request->ogimage, 'metapage');
            $data['ogimage'] = $imagePath;
        }

        $metapage->update($data);
        return redirect()->route('admin.metapages.index')->with('popsuccess', 'Metapage updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Metapage $metapage)
    {
        if ($metapage->ogimage) {
            $this->imageService->imageDelete($metapage->ogimage);
        }
        $metapage->delete();
        return redirect()->route('admin.metapages.index')->with('popsuccess', 'Metapage deleted successfully');
    }
}
