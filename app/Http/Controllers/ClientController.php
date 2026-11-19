<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('sort_order', 'asc')->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'logo' => 'required|file|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $lastOrder = Client::max('sort_order') ?? 0;
        $logoPath = $request->file('logo')->store('clients', 'public');

        Client::create([
            'name' => $request->name,
            'logo' => $logoPath,
            'is_active' => true,
            'sort_order' => $lastOrder + 1,
        ]);

        return back()->with('success', 'Partner & Klien baru berhasil ditambahkan!');
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,svg,webp|max:2048',
        ]);

        $data = ['name' => $request->name];

        if ($request->hasFile('logo')) {
            if (Storage::disk('public')->exists($client->logo)) {
                Storage::disk('public')->delete($client->logo);
            }
            $data['logo'] = $request->file('logo')->store('clients', 'public');
        }

        $client->update($data);

        return back()->with('success', 'Data Partner & Klien berhasil diperbarui!');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:clients,id',
        ]);

        foreach ($request->order as $index => $id) {
            Client::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Client $client)
    {
        if (Storage::disk('public')->exists($client->logo)) {
            Storage::disk('public')->delete($client->logo);
        }

        $client->delete();

        return back()->with('success', 'Partner & Klien berhasil dihapus!');
    }
}
