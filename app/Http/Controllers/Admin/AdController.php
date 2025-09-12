<?php

namespace App\Http\Controllers\Admin;

use App\FileService\ImageService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\AdPlacement;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class AdController extends Controller
{
    public function __construct(
        protected ImageService $imageService

    ) {
    }
    public function index(): View
    {
        $ads = Ad::latest()->paginate(15);
        return view('admin.nepads.ads.index', compact('ads'));
    }

    public function create(): View
    {
        $placements = AdPlacement::orderBy('name')->get();
        return view('admin.nepads.ads.create', compact('placements'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:image,html'],
            'status' => ['required', 'in:draft,active,paused,archived'],
            'image' => ['nullable', 'image', 'max:2048'],
            'html_code' => ['nullable', 'string'],
            'destination_url' => ['nullable', 'url'],
            'start_at' => ['nullable', 'date'],
            'end_at' => ['nullable', 'date', 'after_or_equal:start_at'],
            'is_active' => ['nullable', 'boolean'],
            'placements' => ['array'],
            'placements.*.id' => ['exists:ad_placements,id'],
            'placements.*.weight' => ['nullable', 'integer', 'min:1'],
        ]);

        $ad = new Ad();
        $ad->title = $data['title'];
        $ad->type = $data['type'];
        $ad->status = $data['status'];
        $ad->html_code = $data['html_code'] ?? null;
        $ad->destination_url = $data['destination_url'] ?? null;
        $ad->start_at = $data['start_at'] ?? null;
        $ad->end_at = $data['end_at'] ?? null;
        $ad->is_active = (bool) ($data['is_active'] ?? false);
        if (!$ad->manual_embed_token) {
            $ad->manual_embed_token = Str::uuid()->toString();
        }

        if ($ad->type === 'image' && $request->hasFile('image')) {
            $path = $this->imageService->fileUpload($request->image, "ads");
            // $path = $request->file('image')->store('ads', 'public');
            $ad->image_path = $path;
        }

        $ad->save();

        // sync placements with weights
        $sync = [];
        foreach (($data['placements'] ?? []) as $row) {
            $sync[$row['id']] = [
                'weight' => $row['weight'] ?? 1,
                'priority' => 0,
                'is_active' => true,
            ];
        }
        if (!empty($sync)) {
            $ad->placements()->sync($sync);
        }

        return redirect()->route('admin.ads.index')->with('status', 'Ad created');
    }

    public function edit(Ad $ad): View
    {
        $placements = AdPlacement::orderBy('name')->get();
        $pivot = $ad->placements->keyBy('id')->map->pivot;
        return view('admin.nepads.ads.edit', compact('ad', 'placements', 'pivot'));
    }

    public function update(Request $request, Ad $ad): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:image,html'],
            'status' => ['required', 'in:draft,active,paused,archived'],
            'image' => ['nullable', 'image', 'max:2048'],
            'html_code' => ['nullable', 'string'],
            'destination_url' => ['nullable', 'url'],
            'start_at' => ['nullable', 'date'],
            'end_at' => ['nullable', 'date', 'after_or_equal:start_at'],
            'is_active' => ['nullable', 'boolean'],
            'placements' => ['array'],
            'placements.*.id' => ['exists:ad_placements,id'],
            'placements.*.weight' => ['nullable', 'integer', 'min:1'],
        ]);

        $ad->fill([
            'title' => $data['title'],
            'type' => $data['type'],
            'status' => $data['status'],
            'html_code' => $data['html_code'] ?? null,
            'destination_url' => $data['destination_url'] ?? null,
            'start_at' => $data['start_at'] ?? null,
            'end_at' => $data['end_at'] ?? null,
            'is_active' => (bool) ($data['is_active'] ?? false),
        ]);

        if ($ad->type === 'image' && $request->hasFile('image')) {
            if ($ad->image_path) {
                $this->imageService->imageDelete($ad->image_path);

            }
            $path = $this->imageService->fileUpload($request->image, "ads");

            // $path = $request->file('image')->store('ads', 'public');
            $ad->image_path = $path;
        }

        if (!$ad->manual_embed_token) {
            $ad->manual_embed_token = Str::uuid()->toString();
        }

        $ad->save();

        $sync = [];
        foreach (($data['placements'] ?? []) as $row) {
            $sync[$row['id']] = [
                'weight' => $row['weight'] ?? 1,
                'priority' => 0,
                'is_active' => true,
            ];
        }
        $ad->placements()->sync($sync);

        return redirect()->route('admin.ads.index')->with('status', 'Ad updated');
    }

    public function destroy(Ad $ad): RedirectResponse
    {
        if ($ad->image_path) {
            $this->imageService->imageDelete($ad->image_path);

        }
        $ad->delete();
        return redirect()->route('admin.ads.index')->with('status', 'Ad deleted');
    }

    public function embedCode(Ad $ad): View
    {
        return view('admin.nepads.ads.embed', compact('ad'));
    }
}
