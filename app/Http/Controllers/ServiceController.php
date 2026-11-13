<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Urutkan berdasarkan sort_order terkecil ke terbesar
        $services = Service::orderBy('sort_order', 'asc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:250',
            'icon' => 'required|string',
        ]);

        // Berikan nomor urut terakhir + 1
        $lastOrder = Service::max('sort_order') ?? 0;

        Service::create([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
            'sort_order' => $lastOrder + 1,
            'is_active' => true,
        ]);

        return back()->with('success', 'Layanan baru berhasil ditambahkan!');
    }

    // Fungsi Baru untuk Edit/Update
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:250',
            'icon' => 'required|string',
        ]);

        $service->update([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        return back()->with('success', 'Data Layanan berhasil diperbarui!');
    }

    // Fungsi Baru untuk menyimpan urutan Drag & Drop
    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:services,id',
        ]);

        // Looping array urutan ID dan update database
        foreach ($request->order as $index => $id) {
            Service::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan berhasil disimpan!']);
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Layanan berhasil dihapus!');
    }
}
