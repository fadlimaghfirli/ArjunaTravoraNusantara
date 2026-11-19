<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutGallery;
use App\Models\Advantage;
use App\Models\Blog;
use App\Models\Client;
use App\Models\Hero;
use App\Models\Portfolio;
use App\Models\Sector;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Workflow;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'heroes' => Hero::count(),
            'advantages' => Advantage::count(),
            'about_ready' => About::exists(),
            'about_galleries' => AboutGallery::count(),
            'services' => Service::count(),
            'sectors' => Sector::count(),
            'portfolios' => Portfolio::count(),
            'workflows' => Workflow::count(),
            'clients' => Client::count(),
            'blogs_published' => Blog::where('is_active', true)->count(),
            'blogs_draft' => Blog::where('is_active', false)->count(),
            'blog_views' => (int) Blog::sum('views'),
        ];

        $recentBlogs = Blog::orderByDesc('published_at')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        $recentPortfolios = Portfolio::orderBy('sort_order', 'asc')
            ->take(4)
            ->get();

        $setting = Setting::first() ?? new Setting();

        // Daftar status kelengkapan seluruh section Landing Page
        $sections = [
            [
                'name' => 'Hero & Slider Beranda',
                'count' => $stats['heroes'] . ' Slide',
                'ready' => $stats['heroes'] > 0,
                'route' => route('heroes.index'),
            ],
            [
                'name' => 'Keunggulan (Mengapa ATN)',
                'count' => $stats['advantages'] . ' Poin',
                'ready' => $stats['advantages'] > 0,
                'route' => route('advantages.index'),
            ],
            [
                'name' => 'Tentang Kami, Visi & Galeri',
                'count' => ($stats['about_ready'] ? 'Profil OK' : 'Default') . ' • ' . $stats['about_galleries'] . ' Foto',
                'ready' => $stats['about_ready'] && $stats['about_galleries'] > 0,
                'route' => route('about.index'),
            ],
            [
                'name' => 'Layanan Kami',
                'count' => $stats['services'] . ' Layanan',
                'ready' => $stats['services'] > 0,
                'route' => route('services.index'),
            ],
            [
                'name' => 'Solusi Sektor',
                'count' => $stats['sectors'] . ' Sektor',
                'ready' => $stats['sectors'] > 0,
                'route' => route('sectors.index'),
            ],
            [
                'name' => 'Portofolio Project',
                'count' => $stats['portfolios'] . ' Project',
                'ready' => $stats['portfolios'] > 0,
                'route' => route('portfolios.index'),
            ],
            [
                'name' => 'Cara Kami Bekerja',
                'count' => $stats['workflows'] . ' Tahap',
                'ready' => $stats['workflows'] > 0,
                'route' => route('workflows.index'),
            ],
            [
                'name' => 'Partner & Klien',
                'count' => $stats['clients'] . ' Klien',
                'ready' => $stats['clients'] > 0,
                'route' => route('clients.index'),
            ],
            [
                'name' => 'Blog & Berita',
                'count' => $stats['blogs_published'] . ' Tayang • ' . $stats['blogs_draft'] . ' Draft',
                'ready' => $stats['blogs_published'] > 0,
                'route' => route('blogs.index'),
            ],
        ];

        $readyCount = collect($sections)->where('ready', true)->count();
        $totalSections = count($sections);
        $completionPercent = (int) round(($readyCount / $totalSections) * 100);

        return view('dashboard', compact(
            'stats',
            'recentBlogs',
            'recentPortfolios',
            'setting',
            'sections',
            'readyCount',
            'totalSections',
            'completionPercent'
        ));
    }
}
