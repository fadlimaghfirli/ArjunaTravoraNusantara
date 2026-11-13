<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Models\Client;
use App\Models\Hero;
use App\Models\Portfolio;
use App\Models\Sector;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $clients = Client::where('is_active', true)->latest()->get();
    $portfolios = Portfolio::latest()->take(4)->get();
    $heroes = Hero::where('is_active', true)->latest()->get();
    $setting = Setting::first() ?? new Setting();
    $services = Service::where('is_active', true)->orderBy('sort_order', 'asc')->get();
    $sectors = Sector::where('is_active', true)->latest()->get();

    return view('welcome', compact('clients', 'portfolios', 'heroes', 'setting', 'services', 'sectors'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. Tambahkan rute CRUD Klien di sini
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

    Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
    Route::post('/portfolios', [PortfolioController::class, 'store'])->name('portfolios.store');
    Route::delete('/portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');

    // CRUD Hero (Beranda)
    Route::get('/heroes', [HeroController::class, 'index'])->name('heroes.index');
    Route::post('/heroes', [HeroController::class, 'store'])->name('heroes.store');
    Route::delete('/heroes/{hero}', [HeroController::class, 'destroy'])->name('heroes.destroy');

    // Pengaturan Umum
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Layanan Kami
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    // Rute Baru: Update & Reorder
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::post('/services/reorder', [ServiceController::class, 'reorder'])->name('services.reorder');

    // Solusi Sektor
    Route::get('/sectors', [SectorController::class, 'index'])->name('sectors.index');
    Route::post('/sectors', [SectorController::class, 'store'])->name('sectors.store');
    Route::delete('/sectors/{sector}', [SectorController::class, 'destroy'])->name('sectors.destroy');

    // Rute Baru: Update & Reorder
    Route::put('/sectors/{sector}', [SectorController::class, 'update'])->name('sectors.update');
    Route::post('/sectors/reorder', [SectorController::class, 'reorder'])->name('sectors.reorder');
});

require __DIR__ . '/auth.php';
