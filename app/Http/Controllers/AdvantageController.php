<?php

namespace App\Http\Controllers;

use App\Models\Advantage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvantageController extends Controller
{
    public function index()
    {
        $advantages = Advantage::orderBy('sort_order', 'asc')->get();
        return view('admin.advantages.index', compact('advantages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:120',
            'description' => 'required|string|max:350',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $lastOrder = Advantage::max('sort_order') ?? 0;
        $imagePath = $request->file('image')->store('advantages', 'public');

        Advantage::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'is_active' => true,
            'sort_order' => $lastOrder + 1,
        ]);

        return back()->with('success', 'Poin keunggulan berhasil ditambahkan!');
    }

    public function update(Request $request, Advantage $advantage)
    {
        $request->validate([
            'title' => 'required|string|max:120',
            'description' => 'required|string|max:350',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($advantage->image)) {
                Storage::disk('public')->delete($advantage->image);
            }
            $data['image'] = $request->file('image')->store('advantages', 'public');
        }

        $advantage->update($data);

        return back()->with('success', 'Poin keunggulan berhasil diperbarui!');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:advantages,id',
        ]);

        foreach ($request->order as $index => $id) {
            Advantage::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Advantage $advantage)
    {
        if (Storage::disk('public')->exists($advantage->image)) {
            Storage::disk('public')->delete($advantage->image);
        }

        $advantage->delete();

        return back()->with('success', 'Poin keunggulan berhasil dihapus!');
    }
}
