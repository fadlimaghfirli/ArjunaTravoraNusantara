<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        // Mengambil semua data klien, diurutkan dari yang terbaru
        $clients = Client::latest()->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ]);

        // Simpan gambar ke folder storage/app/public/clients
        $logoPath = $request->file('logo')->store('clients', 'public');

        Client::create([
            'name' => $request->name,
            'logo' => $logoPath,
            'is_active' => true,
        ]);

        return back()->with('success', 'Data klien berhasil ditambahkan!');
    }

    public function destroy(Client $client)
    {
        // Hapus file gambar fisik dari storage jika ada
        if (Storage::disk('public')->exists($client->logo)) {
            Storage::disk('public')->delete($client->logo);
        }

        // Hapus data dari database
        $client->delete();

        return back()->with('success', 'Data klien berhasil dihapus!');
    }
}
