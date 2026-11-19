<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdvantageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WorkflowController;
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
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $clients = Client::where('is_active', true)->orderBy('sort_order', 'asc')->get();
    $portfolios = Portfolio::orderBy('sort_order', 'asc')->take(4)->get();
    $heroes = Hero::where('is_active', true)->orderBy('sort_order', 'asc')->get();
    $setting = Setting::first() ?? new Setting();
    $services = Service::where('is_active', true)->orderBy('sort_order', 'asc')->get();
    $sectors = Sector::where('is_active', true)->orderBy('sort_order', 'asc')->get();
    $advantages = Advantage::where('is_active', true)->orderBy('sort_order', 'asc')->get();
    $workflows = Workflow::where('is_active', true)->orderBy('sort_order', 'asc')->get();
    $about = About::first();
    $aboutGalleries = AboutGallery::where('is_active', true)->orderBy('sort_order', 'asc')->get();
    $blogs = Blog::where('is_active', true)->orderBy('sort_order', 'asc')->orderByDesc('published_at')->take(8)->get();

    return view('welcome', compact(
        'clients',
        'portfolios',
        'heroes',
        'setting',
        'services',
        'sectors',
        'advantages',
        'workflows',
        'about',
        'aboutGalleries',
        'blogs'
    ));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Partner & Klien
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::post('/clients/reorder', [ClientController::class, 'reorder'])->name('clients.reorder');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

    // Portofolio Project
    Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
    Route::post('/portfolios', [PortfolioController::class, 'store'])->name('portfolios.store');
    Route::put('/portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolios.update');
    Route::post('/portfolios/reorder', [PortfolioController::class, 'reorder'])->name('portfolios.reorder');
    Route::delete('/portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');

    // Hero & Beranda
    Route::get('/heroes', [HeroController::class, 'index'])->name('heroes.index');
    Route::post('/heroes', [HeroController::class, 'store'])->name('heroes.store');
    Route::put('/heroes/{hero}', [HeroController::class, 'update'])->name('heroes.update');
    Route::post('/heroes/reorder', [HeroController::class, 'reorder'])->name('heroes.reorder');
    Route::delete('/heroes/{hero}', [HeroController::class, 'destroy'])->name('heroes.destroy');

    // Pengaturan Umum
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Layanan Kami
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::post('/services/reorder', [ServiceController::class, 'reorder'])->name('services.reorder');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // Solusi Sektor
    Route::get('/sectors', [SectorController::class, 'index'])->name('sectors.index');
    Route::post('/sectors', [SectorController::class, 'store'])->name('sectors.store');
    Route::put('/sectors/{sector}', [SectorController::class, 'update'])->name('sectors.update');
    Route::post('/sectors/reorder', [SectorController::class, 'reorder'])->name('sectors.reorder');
    Route::delete('/sectors/{sector}', [SectorController::class, 'destroy'])->name('sectors.destroy');

    // Keunggulan (Mengapa Memilih ATN)
    Route::get('/advantages', [AdvantageController::class, 'index'])->name('advantages.index');
    Route::post('/advantages', [AdvantageController::class, 'store'])->name('advantages.store');
    Route::put('/advantages/{advantage}', [AdvantageController::class, 'update'])->name('advantages.update');
    Route::post('/advantages/reorder', [AdvantageController::class, 'reorder'])->name('advantages.reorder');
    Route::delete('/advantages/{advantage}', [AdvantageController::class, 'destroy'])->name('advantages.destroy');

    // Cara Kami Bekerja
    Route::get('/workflows', [WorkflowController::class, 'index'])->name('workflows.index');
    Route::post('/workflows', [WorkflowController::class, 'store'])->name('workflows.store');
    Route::put('/workflows/image', [WorkflowController::class, 'updateImage'])->name('workflows.updateImage');
    Route::put('/workflows/{workflow}', [WorkflowController::class, 'update'])->name('workflows.update');
    Route::post('/workflows/reorder', [WorkflowController::class, 'reorder'])->name('workflows.reorder');
    Route::delete('/workflows/{workflow}', [WorkflowController::class, 'destroy'])->name('workflows.destroy');

    // Tentang Kami (Profil, Visi & Misi, Galeri Foto)
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::put('/about/content', [AboutController::class, 'updateContent'])->name('about.updateContent');
    Route::post('/about/galleries', [AboutController::class, 'storeGallery'])->name('about.galleries.store');
    Route::post('/about/galleries/reorder', [AboutController::class, 'reorderGalleries'])->name('about.galleries.reorder');
    Route::put('/about/galleries/{gallery}', [AboutController::class, 'updateGallery'])->name('about.galleries.update');
    Route::delete('/about/galleries/{gallery}', [AboutController::class, 'destroyGallery'])->name('about.galleries.destroy');

    // Blog & Berita
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::post('/blogs/reorder', [BlogController::class, 'reorder'])->name('blogs.reorder');
    Route::post('/blogs/upload-image', [BlogController::class, 'uploadImage'])->name('blogs.uploadImage');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    // Kelola Footer
    Route::get('/footer', [FooterController::class, 'index'])->name('footer.index');
    Route::put('/footer', [FooterController::class, 'update'])->name('footer.update');
});

// Halaman Publik Blog & Berita
Route::get('/blog', [BlogController::class, 'publicIndex'])->name('blog.public.index');
Route::get('/blog/{blog:slug}', [BlogController::class, 'publicShow'])->name('blog.public.show');

require __DIR__ . '/auth.php';
