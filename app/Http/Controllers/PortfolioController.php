<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'type' => 'required|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('portfolios', 'public');

        Portfolio::create([
            'title' => $request->title,
            'category' => $request->category,
            'year' => $request->year,
            'type' => $request->type,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Data portofolio berhasil ditambahkan!');
    }

    public function destroy(Portfolio $portfolio)
    {
        if (Storage::disk('public')->exists($portfolio->image)) {
            Storage::disk('public')->delete($portfolio->image);
        }

        $portfolio->delete();

        return back()->with('success', 'Data portofolio berhasil dihapus!');
    }
}
