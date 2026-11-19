<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="font-bold text-xl text-[#102238] leading-tight">
                {{ __('Dashboard Overview') }}
            </h2>
            {{-- <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 hover:border-[#113883] hover:text-[#113883] text-gray-700 text-xs font-bold rounded-xl transition-all
            shadow-xs">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
            Lihat Landing Page
            </a>
            <a href="{{ route('blogs.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#113883] hover:bg-[#0c2a66] text-white text-xs font-bold rounded-xl transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tulis Berita Baru
            </a>
        </div> --}}
        </div>
    </x-slot>

    <div class="space-y-8">

        <!-- BANNER SELAMAT DATANG & PROGRESS KELENGKAPAN -->
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#102238] via-[#113883] to-[#1749a8] p-6 lg:p-8 text-white shadow-md">
            <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-[#F8B41C] text-[11px] font-bold uppercase tracking-wider mb-3">
                        <span class="w-2 h-2 rounded-full bg-[#F8B41C]"></span>
                        CMS Arjuna Travora Nusantara
                    </span>
                    <h3 class="text-2xl lg:text-3xl font-extrabold tracking-tight">
                        Selamat datang, {{ auth()->user()->name }}!
                    </h3>
                    <p class="mt-2 text-sm text-white/80 max-w-2xl leading-relaxed">
                        Pantau seluruh konten dinamis landing page, publikasi berita, dan profil perusahaan PT. Arjuna Travora Nusantara dari satu panel terpadu.
                    </p>
                </div>

                <!-- Indikator Kelengkapan Section -->
                <div class="bg-white/10 backdrop-blur-md border border-white/15 rounded-2xl p-5 min-w-[260px] shrink-0">
                    <div class="flex items-center justify-between text-xs font-bold mb-2">
                        <span class="text-white/80">Kelengkapan Landing Page</span>
                        <span class="text-[#F8B41C]">{{ $completionPercent }}%</span>
                    </div>
                    <div class="w-full h-2.5 bg-white/15 rounded-full overflow-hidden">
                        <div class="h-full bg-[#F8B41C] rounded-full transition-all duration-500" style="width: {{ $completionPercent }}%"></div>
                    </div>
                    <p class="mt-2.5 text-[11px] text-white/75">
                        <strong class="text-white">{{ $readyCount }} dari {{ $totalSections }}</strong> section sudah terisi data dinamis.
                    </p>
                </div>
            </div>

            <!-- Dekorasi Latar -->
            <div class="pointer-events-none absolute -right-12 -top-12 w-56 h-56 rounded-full bg-white/5"></div>
            <div class="pointer-events-none absolute right-24 -bottom-16 w-40 h-40 rounded-full bg-[#F8B41C]/10"></div>
        </div>

        <!-- 4 KARTU STATISTIK UTAMA -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

            <!-- Card 1: Portofolio -->
            <a href="{{ route('portfolios.index') }}" class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:border-[#113883]/40 hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#113883] flex items-center justify-center group-hover:bg-[#113883] group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                        </svg>
                    </div>
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Portofolio</span>
                </div>
                <p class="mt-5 text-3xl font-extrabold text-[#102238]">{{ $stats['portfolios'] }}</p>
                <p class="mt-1 text-xs text-gray-500">Project aktif tersimpan</p>
            </a>

            <!-- Card 2: Layanan & Sektor -->
            <a href="{{ route('services.index') }}" class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:border-[#113883]/40 hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:bg-[#F8B41C] group-hover:text-gray-900 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Layanan</span>
                </div>
                <p class="mt-5 text-3xl font-extrabold text-[#102238]">{{ $stats['services'] }}</p>
                <p class="mt-1 text-xs text-gray-500">Layanan & {{ $stats['sectors'] }} Solusi Sektor</p>
            </a>

            <!-- Card 3: Partner & Klien -->
            <a href="{{ route('clients.index') }}" class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:border-[#113883]/40 hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Partner & Klien</span>
                </div>
                <p class="mt-5 text-3xl font-extrabold text-[#102238]">{{ $stats['clients'] }}</p>
                <p class="mt-1 text-xs text-gray-500">Logo mitra pada marquee beranda</p>
            </a>

            <!-- Card 4: Blog & Total Pembaca -->
            <a href="{{ route('blogs.index') }}" class="group bg-white rounded-2xl border border-gray-100 shadow-sm p-6 hover:border-[#113883]/40 hover:shadow-md transition-all">
                <div class="flex items-center justify-between">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path>
                        </svg>
                    </div>
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Blog & Berita</span>
                </div>
                <p class="mt-5 text-3xl font-extrabold text-[#102238]">{{ $stats['blogs_published'] }}</p>
                <p class="mt-1 text-xs text-gray-500">
                    {{ number_format($stats['blog_views']) }} total pembaca • {{ $stats['blogs_draft'] }} draft
                </p>
            </a>
        </div>

        <!-- GRID UTAMA (KIRI 2/3, KANAN 1/3) -->
        <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_380px] gap-8 items-start">

            <!-- KOLOM KIRI: STATUS SECTION & ARTIKEL TERBARU -->
            <div class="space-y-8">

                <!-- Status Kelengkapan Section Landing Page -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-[#102238]">Status Konten Landing Page</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Klik tombol Kelola untuk mengedit atau mengurutkan konten setiap bagian.</p>
                        </div>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @foreach($sections as $section)
                        <div class="px-6 py-4 flex flex-wrap items-center justify-between gap-4 hover:bg-gray-50/60 transition-colors">
                            <div class="flex items-center gap-3.5">
                                <span class="w-2.5 h-2.5 rounded-full {{ $section['ready'] ? 'bg-emerald-500' : 'bg-amber-400' }}"></span>
                                <div>
                                    <p class="text-sm font-bold text-[#102238]">{{ $section['name'] }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $section['count'] }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                @if($section['ready'])
                                <span class="bg-emerald-50 text-emerald-700 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Aktif</span>
                                @else
                                <span class="bg-amber-50 text-amber-700 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Belum Diisi</span>
                                @endif

                                <a href="{{ $section['route'] }}" class="text-xs font-bold text-[#113883] hover:text-white bg-blue-50 hover:bg-[#113883] px-3.5 py-1.5 rounded-lg transition-colors">
                                    Kelola
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Artikel Berita Terbaru -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-[#102238]">Artikel & Berita Terbaru</h3>
                            <p class="text-xs text-gray-400 mt-0.5">5 artikel terakhir yang ditulis pada portal berita ATN.</p>
                        </div>
                        <a href="{{ route('blogs.index') }}" class="text-xs font-bold text-[#113883] hover:underline">Lihat Semua</a>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse($recentBlogs as $blog)
                        <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-gray-50/60 transition-colors">
                            <div class="flex items-center gap-4 min-w-0">
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-16 h-12 rounded-xl object-cover border border-gray-200 shrink-0">
                                <div class="min-w-0">
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="text-sm font-bold text-[#102238] hover:text-[#113883] transition-colors line-clamp-1">
                                        {{ $blog->title }}
                                    </a>
                                    <p class="text-xs text-gray-400 mt-0.5">
                                        {{ $blog->category }} • {{ $blog->published_at->format('d M Y') }} • {{ number_format($blog->views) }} dibaca
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2 shrink-0">
                                @if($blog->is_active)
                                <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Tayang</span>
                                @else
                                <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Draft</span>
                                @endif
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit Artikel">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="px-6 py-10 text-center text-sm text-gray-400">
                            Belum ada artikel yang diterbitkan.
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- KOLOM KANAN: PINTASAN CEPAT & RINGKASAN INFO WEBSITE -->
            <div class="space-y-6">

                <!-- Pintasan Cepat -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="text-base font-bold text-[#102238] mb-4">Pintasan Cepat</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('blogs.create') }}" class="flex flex-col items-start gap-2 p-4 rounded-xl bg-gray-50 hover:bg-blue-50 border border-gray-100 hover:border-[#113883]/30 transition-all group">
                            <span class="w-9 h-9 rounded-lg bg-white text-[#113883] shadow-xs flex items-center justify-center group-hover:bg-[#113883] group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </span>
                            <span class="text-xs font-bold text-[#102238]">Tulis Berita</span>
                        </a>

                        <a href="{{ route('portfolios.index') }}" class="flex flex-col items-start gap-2 p-4 rounded-xl bg-gray-50 hover:bg-blue-50 border border-gray-100 hover:border-[#113883]/30 transition-all group">
                            <span class="w-9 h-9 rounded-lg bg-white text-[#113883] shadow-xs flex items-center justify-center group-hover:bg-[#113883] group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </span>
                            <span class="text-xs font-bold text-[#102238]">Tambah Project</span>
                        </a>

                        <a href="{{ route('footer.index') }}" class="flex flex-col items-start gap-2 p-4 rounded-xl bg-gray-50 hover:bg-blue-50 border border-gray-100 hover:border-[#113883]/30 transition-all group">
                            <span class="w-9 h-9 rounded-lg bg-white text-[#113883] shadow-xs flex items-center justify-center group-hover:bg-[#113883] group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </span>
                            <span class="text-xs font-bold text-[#102238]">Edit Footer & Peta</span>
                        </a>

                        <a href="{{ route('settings.index') }}" class="flex flex-col items-start gap-2 p-4 rounded-xl bg-gray-50 hover:bg-blue-50 border border-gray-100 hover:border-[#113883]/30 transition-all group">
                            <span class="w-9 h-9 rounded-lg bg-white text-[#113883] shadow-xs flex items-center justify-center group-hover:bg-[#113883] group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </span>
                            <span class="text-xs font-bold text-[#102238]">Pengaturan Umum</span>
                        </a>
                    </div>
                </div>

                <!-- Ringkasan Statistik & Kontak Beranda -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-base font-bold text-[#102238]">Info Aktif di Website</h3>
                        <a href="{{ route('settings.index') }}" class="text-xs font-bold text-[#113883] hover:underline">Ubah</a>
                    </div>

                    <div class="grid grid-cols-3 gap-2 text-center">
                        <div class="p-3 rounded-xl bg-gray-50 border border-gray-100">
                            <p class="text-base font-extrabold text-[#113883]">{{ $setting->stat_projects ?? '500+' }}</p>
                            <p class="text-[10px] text-gray-500 mt-0.5">Projek</p>
                        </div>
                        <div class="p-3 rounded-xl bg-gray-50 border border-gray-100">
                            <p class="text-base font-extrabold text-[#113883]">{{ $setting->stat_clients ?? '40+' }}</p>
                            <p class="text-[10px] text-gray-500 mt-0.5">Klien</p>
                        </div>
                        <div class="p-3 rounded-xl bg-gray-50 border border-gray-100">
                            <p class="text-base font-extrabold text-[#113883]">{{ $setting->stat_certification ?? 'ISO/IEC' }}</p>
                            <p class="text-[10px] text-gray-500 mt-0.5">Standar</p>
                        </div>
                    </div>

                    <div class="space-y-3 pt-2 border-t border-gray-100 text-xs">
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-400">WhatsApp</span>
                            <span class="font-semibold text-[#102238] text-right">{{ $setting->phone ?? '0821-4243-0296' }}</span>
                        </div>
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-400">Email</span>
                            <span class="font-semibold text-[#102238] text-right truncate">{{ $setting->email ?? 'info@arjunatravora.co.id' }}</span>
                        </div>
                        <div class="flex justify-between gap-2">
                            <span class="text-gray-400 shrink-0">Alamat</span>
                            <span class="font-semibold text-[#102238] text-right">{{ $setting->address ?? 'Mojokerto, Jawa Timur, Indonesia.' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Portofolio Unggulan (4 Teratas di Beranda) -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base font-bold text-[#102238]">Portofolio Tampil di Beranda</h3>
                        <a href="{{ route('portfolios.index') }}" class="text-xs font-bold text-[#113883] hover:underline">Atur Urutan</a>
                    </div>

                    <div class="space-y-3">
                        @forelse($recentPortfolios as $item)
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-12 h-10 rounded-lg object-cover border border-gray-200 shrink-0">
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-[#102238] truncate">{{ $item->title }}</p>
                                <p class="text-[11px] text-gray-400 truncate">{{ $item->category }} • {{ $item->year }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-xs text-gray-400 text-center py-4">Belum ada portofolio.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>