<?php

namespace App\Http\Controllers;

use App\Models\Legality;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LegalityController extends Controller
{
    // === AREA ADMIN ===

    public function index()
    {
        $legalities = Legality::orderBy('sort_order', 'asc')->get();
        return view('admin.legalities.index', compact('legalities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'document_number' => 'nullable|string|max:120',
            'description' => 'nullable|string|max:255',
            'image' => 'required|file|mimes:jpeg,png,jpg,webp,pdf|max:10240',
        ]);

        $lastOrder = Legality::max('sort_order') ?? 0;
        $imagePath = $request->file('image')->store('legalities', 'public');

        Legality::create([
            'title' => $request->title,
            'document_number' => $request->document_number,
            'description' => $request->description,
            'image' => $imagePath,
            'is_active' => true,
            'sort_order' => $lastOrder + 1,
        ]);

        return back()->with('success', 'Dokumen legalitas berhasil ditambahkan!');
    }

    public function update(Request $request, Legality $legality)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'document_number' => 'nullable|string|max:120',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,webp,pdf|max:10240',
        ]);

        $data = $request->only(['title', 'document_number', 'description']);

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($legality->image)) {
                Storage::disk('public')->delete($legality->image);
            }
            $data['image'] = $request->file('image')->store('legalities', 'public');
        }

        $legality->update($data);

        return back()->with('success', 'Dokumen legalitas berhasil diperbarui!');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:legalities,id',
        ]);

        foreach ($request->order as $index => $id) {
            Legality::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Legality $legality)
    {
        if (Storage::disk('public')->exists($legality->image)) {
            Storage::disk('public')->delete($legality->image);
        }

        $legality->delete();

        return back()->with('success', 'Dokumen legalitas berhasil dihapus!');
    }

    // === AREA PUBLIK ===

    public function publicIndex()
    {
        $legalities = Legality::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $setting = Setting::first() ?? new Setting();

        return view('legality.index', compact('legalities', 'setting'));
    }
}
