<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Workflow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkflowController extends Controller
{
    public function index()
    {
        $workflows = Workflow::orderBy('sort_order', 'asc')->get();
        $setting = Setting::first() ?? new Setting();

        return view('admin.workflows.index', compact('workflows', 'setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:255',
        ]);

        $lastOrder = Workflow::max('sort_order') ?? 0;

        Workflow::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => true,
            'sort_order' => $lastOrder + 1,
        ]);

        return back()->with('success', 'Langkah kerja baru berhasil ditambahkan!');
    }

    public function update(Request $request, Workflow $workflow)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:255',
        ]);

        $workflow->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Langkah kerja berhasil diperbarui!');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:workflows,id',
        ]);

        foreach ($request->order as $index => $id) {
            Workflow::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Workflow $workflow)
    {
        $workflow->delete();

        return back()->with('success', 'Langkah kerja berhasil dihapus!');
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'workflow_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([
                'stat_projects' => '500+',
                'stat_clients' => '40+',
                'stat_certification' => 'ISO/IEC',
                'phone' => '0821-4243-0296',
                'email' => 'info@arjunatravora.co.id',
                'address' => 'Mojokerto, Jawa Timur, Indonesia.',
            ]);
        }

        if ($setting->workflow_image && Storage::disk('public')->exists($setting->workflow_image)) {
            Storage::disk('public')->delete($setting->workflow_image);
        }

        $imagePath = $request->file('workflow_image')->store('workflows', 'public');
        $setting->update(['workflow_image' => $imagePath]);

        return back()->with('success', 'Gambar section Cara Kami Bekerja berhasil diperbarui!');
    }
}
