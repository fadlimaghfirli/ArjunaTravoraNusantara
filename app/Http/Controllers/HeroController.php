<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::orderBy('sort_order', 'asc')->get();
        return view('admin.heroes.index', compact('heroes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'side_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $lastOrder = Hero::max('sort_order') ?? 0;
        $mainPath = $request->file('main_image')->store('heroes', 'public');
        $sidePath = $request->file('side_image')->store('heroes', 'public');

        Hero::create([
            'label' => $request->label,
            'description' => $request->description,
            'main_image' => $mainPath,
            'side_image' => $sidePath,
            'sort_order' => $lastOrder + 1,
            'is_active' => true,
        ]);

        return back()->with('success', 'Slide Hero berhasil ditambahkan!');
    }

    public function update(Request $request, Hero $hero)
    {
        $request->validate([
            'label' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'side_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'label' => $request->label,
            'description' => $request->description,
        ];

        if ($request->hasFile('main_image')) {
            if (Storage::disk('public')->exists($hero->main_image)) {
                Storage::disk('public')->delete($hero->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('heroes', 'public');
        }

        if ($request->hasFile('side_image')) {
            if (Storage::disk('public')->exists($hero->side_image)) {
                Storage::disk('public')->delete($hero->side_image);
            }
            $data['side_image'] = $request->file('side_image')->store('heroes', 'public');
        }

        $hero->update($data);

        return back()->with('success', 'Slide Hero berhasil diperbarui!');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:heroes,id',
        ]);

        foreach ($request->order as $index => $id) {
            Hero::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Hero $hero)
    {
        if (Storage::disk('public')->exists($hero->main_image)) {
            Storage::disk('public')->delete($hero->main_image);
        }
        if (Storage::disk('public')->exists($hero->side_image)) {
            Storage::disk('public')->delete($hero->side_image);
        }

        $hero->delete();

        return back()->with('success', 'Slide Hero berhasil dihapus!');
    }
}
