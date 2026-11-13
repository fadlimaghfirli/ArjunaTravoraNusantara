<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // Pastikan selalu ada 1 baris data
        $setting = Setting::firstOrCreate(
            ['id' => 1],
            [
                'stat_projects' => '500+',
                'stat_clients' => '40+',
                'stat_certification' => 'ISO/IEC',
                'phone' => '0821-4243-0296',
                'email' => 'info@arjunatravora.co.id',
                'address' => 'Mojokerto, Jawa Timur, Indonesia.'
            ]
        );

        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'stat_projects' => 'required|string|max:50',
            'stat_clients' => 'required|string|max:50',
            'stat_certification' => 'required|string|max:50',
            'phone' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'address' => 'required|string',
        ]);

        $setting = Setting::first();
        $setting->update($request->all());

        return back()->with('success', 'Pengaturan Umum berhasil diperbarui!');
    }
}
