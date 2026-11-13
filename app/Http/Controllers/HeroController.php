<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::latest()->get();
        return view('admin.heroes.index', compact('heroes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:50',
            'description' => 'required|string|max:100',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'side_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $mainPath = $request->file('main_image')->store('heroes', 'public');
        $sidePath = $request->file('side_image')->store('heroes', 'public');

        Hero::create([
            'label' => $request->label,
            'description' => $request->description,
            'main_image' => $mainPath,
            'side_image' => $sidePath,
            'is_active' => true,
        ]);

        return back()->with('success', 'Slide Hero berhasil ditambahkan!');
    }

    public function destroy(Hero $hero)
    {
        // Hapus kedua gambar fisik dari storage
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
