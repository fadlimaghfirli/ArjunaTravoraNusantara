<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('sort_order', 'asc')->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'category' => 'required|string|max:100',
            'year' => 'required|digits:4',
            'type' => 'required|in:Project,Portfolio',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $lastOrder = Portfolio::max('sort_order') ?? 0;
        $imagePath = $request->file('image')->store('portfolios', 'public');

        Portfolio::create([
            'title' => $request->title,
            'category' => $request->category,
            'year' => $request->year,
            'type' => $request->type,
            'image' => $imagePath,
            'sort_order' => $lastOrder + 1,
        ]);

        return back()->with('success', 'Portofolio baru berhasil ditambahkan!');
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'category' => 'required|string|max:100',
            'year' => 'required|digits:4',
            'type' => 'required|in:Project,Portfolio',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['title', 'category', 'year', 'type']);

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($portfolio->image)) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $data['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $portfolio->update($data);

        return back()->with('success', 'Data portofolio berhasil diperbarui!');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:portfolios,id',
        ]);

        foreach ($request->order as $index => $id) {
            Portfolio::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Portfolio $portfolio)
    {
        if (Storage::disk('public')->exists($portfolio->image)) {
            Storage::disk('public')->delete($portfolio->image);
        }

        $portfolio->delete();

        return back()->with('success', 'Portofolio berhasil dihapus!');
    }
}
