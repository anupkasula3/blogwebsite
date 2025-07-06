<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\FileService\ImageService;

class AdvertisementController extends Controller
{

    public function __construct(
        protected ImageService $imageService
    ) {}

    public function index()
    {
        $advertisements = Advertisement::latest()->paginate(15);
        return view('admin.advertisements.index', compact('advertisements'));
    }

    public function create()
    {
        return view('admin.advertisements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|url',
            'position' => 'required|in:header,sidebar,footer,content',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $imagePath = $this->imageService->fileUpload($request->image, "advertisement");
            $data['image'] = $imagePath;
        }

        Advertisement::create($data);

        return redirect()->route('admin.advertisements.index')
            ->with('success', 'Advertisement created successfully!');
    }

    public function show(Advertisement $advertisement)
    {
        return view('admin.advertisements.show', compact('advertisement'));
    }

    public function edit(Advertisement $advertisement)
    {
        return view('admin.advertisements.edit', compact('advertisement'));
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'required|url',
            'position' => 'required|in:header,sidebar,footer,content',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($advertisement->image) {
                $this->imageService->imageDelete($advertisement->image);
            }
            $imagePath = $this->imageService->fileUpload($request->image, "advertisement");
            $data['image'] = $imagePath;
        }

        $advertisement->update($data);

        return redirect()->route('admin.advertisements.index')
            ->with('success', 'Advertisement updated successfully!');
    }

    public function destroy(Advertisement $advertisement)
    {
        if ($advertisement->image) {
                $this->imageService->imageDelete($advertisement->image);
        }

        $advertisement->delete();
        return redirect()->route('admin.advertisements.index')
            ->with('success', 'Advertisement deleted successfully!');
    }

    public function activate(Advertisement $advertisement)
    {
        $advertisement->update(['is_active' => true]);

        return redirect()->back()
            ->with('success', 'Advertisement activated successfully!');
    }

    public function deactivate(Advertisement $advertisement)
    {
        $advertisement->update(['is_active' => false]);

        return redirect()->back()
            ->with('success', 'Advertisement deactivated successfully!');
    }
}
