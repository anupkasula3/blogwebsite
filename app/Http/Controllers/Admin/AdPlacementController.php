<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdPlacement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdPlacementController extends Controller
{
    public function index(): View
    {
        $placements = AdPlacement::latest()->paginate(15);
        return view('admin.nepads.placements.index', compact('placements'));
    }

    public function create(): View
    {
        return view('admin.nepads.placements.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'key' => ['required','string','max:255','unique:ad_placements,key'],
            'description' => ['nullable','string','max:500'],
            'width' => ['nullable','integer','min:1'],
            'height' => ['nullable','integer','min:1'],
            'is_auto' => ['nullable','boolean'],
        ]);

        AdPlacement::create([
            'name' => $data['name'],
            'key' => $data['key'],
            'description' => $data['description'] ?? null,
            'width' => $data['width'] ?? null,
            'height' => $data['height'] ?? null,
            'is_auto' => (bool)($data['is_auto'] ?? true),
        ]);

        return redirect()->route('admin.placements.index')->with('status', 'Placement created');
    }

    public function edit(AdPlacement $placement): View
    {
        return view('admin.nepads.placements.edit', compact('placement'));
    }

    public function update(Request $request, AdPlacement $placement): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'key' => ['required','string','max:255','unique:ad_placements,key,'.$placement->id],
            'description' => ['nullable','string','max:500'],
            'width' => ['nullable','integer','min:1'],
            'height' => ['nullable','integer','min:1'],
            'is_auto' => ['nullable','boolean'],
        ]);

        $placement->update([
            'name' => $data['name'],
            'key' => $data['key'],
            'description' => $data['description'] ?? null,
            'width' => $data['width'] ?? null,
            'height' => $data['height'] ?? null,
            'is_auto' => (bool)($data['is_auto'] ?? true),
        ]);

        return redirect()->route('admin.placements.index')->with('status', 'Placement updated');
    }

    public function destroy(AdPlacement $placement): RedirectResponse
    {
        $placement->delete();
        return redirect()->route('admin.placements.index')->with('status', 'Placement deleted');
    }
}
