<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first() ?? new About([
            'description' => "PT. Arjuna Travora Nusantara merupakan perusahaan yang bergerak di bidang teknologi informasi dan pengadaan perangkat teknologi dengan menyediakan solusi software, hardware, infrastruktur IT, sistem keamanan dan perangkat digital display.\nKami membantu perusahaan, instansi pemerintah, fasilitas kesehatan, institusi pendidikan, maupun organisasi dalam memenuhi kebutuhan teknologi melalui layanan yang terintegrasi, mulai dari konsultasi, perencanaan, pengadaan, pengembangan, instalasi, implementasi hingga dukungan teknis.",
            'vision' => 'Menjadi penyedia solusi IT dan pengadaan perangkat terintegrasi yang terdepan dan terpercaya.',
            'missions' => "Solusi IT Lengkap: Menyediakan software, hardware, infrastruktur IT, keamanan, dan digital display.\nLayanan Terpadu: Memberikan layanan dari konsultasi, pengadaan, hingga dukungan teknis.\nMitra Sektor: Membantu percepatan digitalisasi sektor bisnis, pemerintah, kesehatan, dan pendidikan.",
        ]);

        $galleries = AboutGallery::orderBy('sort_order', 'asc')->get();

        return view('admin.about.index', compact('about', 'galleries'));
    }

    public function updateContent(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'vision' => 'required|string',
            'missions' => 'required|string',
        ]);

        $about = About::first();

        if ($about) {
            $about->update($request->only(['description', 'vision', 'missions']));
        } else {
            About::create($request->only(['description', 'vision', 'missions']));
        }

        return back()->with('success', 'Profil perusahaan, Visi & Misi berhasil diperbarui!');
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'caption' => 'required|string|max:120',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $lastOrder = AboutGallery::max('sort_order') ?? 0;
        $imagePath = $request->file('image')->store('about-galleries', 'public');

        AboutGallery::create([
            'caption' => $request->caption,
            'image' => $imagePath,
            'is_active' => true,
            'sort_order' => $lastOrder + 1,
        ]);

        return back()->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function updateGallery(Request $request, AboutGallery $gallery)
    {
        $request->validate([
            'caption' => 'required|string|max:120',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = ['caption' => $request->caption];

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $request->file('image')->store('about-galleries', 'public');
        }

        $gallery->update($data);

        return back()->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function reorderGalleries(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:about_galleries,id',
        ]);

        foreach ($request->order as $index => $id) {
            AboutGallery::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroyGallery(AboutGallery $gallery)
    {
        if (Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return back()->with('success', 'Foto galeri berhasil dihapus!');
    }
}
