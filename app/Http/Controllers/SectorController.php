<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectorController extends Controller
{
    public function index()
    {
        // Urutkan berdasarkan hasil drag & drop
        $sectors = Sector::orderBy('sort_order', 'asc')->get();
        return view('admin.sectors.index', compact('sectors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:50',
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'features' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $lastOrder = Sector::max('sort_order') ?? 0;
        $imagePath = $request->file('image')->store('sectors', 'public');

        Sector::create([
            'category' => $request->category,
            'title' => $request->title,
            'description' => $request->description,
            'features' => $request->features,
            'image' => $imagePath,
            'sort_order' => $lastOrder + 1,
            'is_active' => true,
        ]);

        return back()->with('success', 'Solusi Sektor berhasil ditambahkan!');
    }

    // FUNGSI BARU: Update/Edit Sektor
    public function update(Request $request, Sector $sector)
    {
        $request->validate([
            'category' => 'required|string|max:50',
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'features' => 'required|string',
            // Gambar boleh kosong (nullable) saat edit jika tidak ingin diganti
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('image');

        // Jika admin mengunggah gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if (Storage::disk('public')->exists($sector->image)) {
                Storage::disk('public')->delete($sector->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('sectors', 'public');
        }

        $sector->update($data);

        return back()->with('success', 'Solusi Sektor berhasil diperbarui!');
    }

    // FUNGSI BARU: Simpan urutan Drag & Drop
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:sectors,id',
        ]);

        foreach ($request->order as $index => $id) {
            Sector::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Sector $sector)
    {
        if (Storage::disk('public')->exists($sector->image)) {
            Storage::disk('public')->delete($sector->image);
        }
        $sector->delete();

        return back()->with('success', 'Solusi Sektor berhasil dihapus!');
    }
}
