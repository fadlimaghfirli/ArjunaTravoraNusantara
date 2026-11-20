<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?? new Setting([
            'phone' => '0821-4243-0296',
            'email' => 'info@arjunatravora.co.id',
            'address' => 'Mojokerto, Jawa Timur, Indonesia.',
            'copyright_text' => '© 2026 PT. Arjuna Travora Nusantara. All Rights Reserved.',
            'maps_url' => 'https://maps.google.com',
        ]);

        return view('admin.footer.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:120',
            'address' => 'required|string|max:255',
            'copyright_text' => 'required|string|max:180',
            'career_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'maps_url' => 'nullable|url|max:500',
            'maps_embed' => 'nullable|string|max:1500',
            'maps_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $setting = Setting::first();

        if (!$setting) {
            $setting = Setting::create([
                'stat_projects' => '500+',
                'stat_clients' => '40+',
                'stat_certification' => 'ISO/IEC',
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ]);
        }

        // Jika admin menempelkan full <iframe src="...">, ambil URL src-nya saja secara otomatis
        $mapsEmbed = trim((string) $request->maps_embed);
        if ($mapsEmbed !== '' && preg_match('/src=["\']([^"\']+)["\']/i', $mapsEmbed, $matches)) {
            $mapsEmbed = $matches[1];
        }

        $data = [
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'copyright_text' => $request->copyright_text,
            'career_url' => $request->career_url,
            'facebook_url' => $request->facebook_url,
            'instagram_url' => $request->instagram_url,
            'linkedin_url' => $request->linkedin_url,
            'youtube_url' => $request->youtube_url,
            'tiktok_url' => $request->tiktok_url,
            'maps_url' => $request->maps_url,
            'maps_embed' => $mapsEmbed ?: null,
        ];

        // Hapus gambar peta jika admin mencentang opsi hapus
        if ($request->boolean('remove_maps_image') && $setting->maps_image) {
            if (Storage::disk('public')->exists($setting->maps_image)) {
                Storage::disk('public')->delete($setting->maps_image);
            }
            $data['maps_image'] = null;
        }

        // Upload gambar peta kustom baru
        if ($request->hasFile('maps_image')) {
            if ($setting->maps_image && Storage::disk('public')->exists($setting->maps_image)) {
                Storage::disk('public')->delete($setting->maps_image);
            }
            $data['maps_image'] = $request->file('maps_image')->store('footer', 'public');
        }

        $setting->update($data);

        return back()->with('success', 'Pengaturan Footer berhasil diperbarui!');
    }
}
