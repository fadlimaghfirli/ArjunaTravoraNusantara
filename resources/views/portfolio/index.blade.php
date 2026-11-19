<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Daftar lengkap portofolio dan project teknologi yang telah diselesaikan oleh PT. Arjuna Travora Nusantara.">
    <title>Portofolio & Project - Arjuna Travora Nusantara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-x-hidden bg-white text-bodytext antialiased">

    <x-navbar />

    @php
    $rawPhone = preg_replace('/[^0-9]/', '', $setting->phone ?? '082142430296');
    $waNumber = preg_replace('/^0/', '62', $rawPhone);
    @endphp

    <main class="pt-[120px] lg:pt-[150px] pb-24" x-data="portfolioPublicModal('{{ $waNumber }}')" @keydown.escape.window="closeModal()">

        <div class="mx-auto w-full max-w-[1400px] px-6">

            <!-- Header & Pencarian -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10 pb-8 border-b border-gray-100">
                <div>
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:underline mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                    <div class="flex flex-wrap items-center gap-3">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#102238] tracking-tight">
                            Portofolio & Project
                        </h1>
                        <span class="px-3.5 py-1 rounded-full bg-blue-50 text-primary text-xs font-bold">
                            {{ $totalCount }} Total Project
                        </span>
                    </div>
                    <p class="mt-3 max-w-[640px] text-[15px] leading-7 text-bodytext">
                        Rekam jejak instalasi infrastruktur IT, pengembangan perangkat lunak, pengadaan hardware, hingga sistem keamanan yang telah kami selesaikan di berbagai sektor.
                    </p>
                </div>

                <!-- Form Pencarian -->
                <form action="{{ route('portfolio.public.index') }}" method="GET" class="flex w-full lg:w-[380px] gap-2">
                    @if(request('tipe'))
                    <input type="hidden" name="tipe" value="{{ request('tipe') }}">
                    @endif
                    @if(request('tahun'))
                    <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                    @endif
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama project, kategori, atau lokasi..."
                        class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                    <button type="submit" class="px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-[#0c2a66] transition-colors shrink-0 cursor-pointer">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Baris Filter Tipe & Tahun -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-10">
                <!-- Filter Tipe -->
                <div class="flex flex-wrap items-center gap-2.5">
                    <a href="{{ route('portfolio.public.index', array_filter(['tahun' => request('tahun'), 'q' => request('q')])) }}"
                        class="px-4 py-2 rounded-full text-xs font-bold transition-colors border {{ !request('tipe') ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                        Semua Tipe
                    </a>
                    @foreach(['Project', 'Portfolio'] as $typeOption)
                    <a href="{{ route('portfolio.public.index', array_filter(['tipe' => $typeOption, 'tahun' => request('tahun'), 'q' => request('q')])) }}"
                        class="px-4 py-2 rounded-full text-xs font-bold transition-colors border {{ request('tipe') === $typeOption ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                        {{ $typeOption }}
                    </a>
                    @endforeach

                    @if(request()->anyFilled(['tipe', 'tahun', 'q']))
                    <a href="{{ route('portfolio.public.index') }}" class="ml-2 text-xs font-semibold text-red-500 hover:underline">
                        Reset Filter
                    </a>
                    @endif
                </div>

                <!-- Filter Tahun -->
                @if($years->count() > 0)
                <form action="{{ route('portfolio.public.index') }}" method="GET" class="flex items-center gap-2.5">
                    @if(request('tipe'))
                    <input type="hidden" name="tipe" value="{{ request('tipe') }}">
                    @endif
                    @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif
                    <label for="filter-tahun" class="text-xs font-bold text-gray-500">Tahun:</label>
                    <select id="filter-tahun" name="tahun" onchange="this.form.submit()"
                        class="rounded-xl border border-gray-200 px-3.5 py-2 text-xs font-semibold text-[#102238] focus:border-primary focus:ring-1 focus:ring-primary outline-none cursor-pointer">
                        <option value="">Semua Tahun</option>
                        @foreach($years as $year)
                        <option value="{{ $year }}" {{ (string) request('tahun') === (string) $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                        @endforeach
                    </select>
                </form>
                @endif
            </div>

            <!-- Grid Kartu Portofolio -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @forelse($portfolios as $portfolio)
                <button type="button" @click="openModal({{ json_encode([
                        'title' => $portfolio->title,
                        'category' => $portfolio->category,
                        'year' => $portfolio->year,
                        'type' => $portfolio->type,
                        'image' => asset('storage/' . $portfolio->image),
                    ]) }})"
                    class="group relative flex flex-col text-left overflow-hidden rounded-[22px] bg-[#F7F8FA] border border-transparent hover:border-primary/20 hover:shadow-[0_14px_34px_-14px_rgba(17,56,131,0.18)] transition-all duration-500 cursor-pointer">

                    <!-- Gambar Mockup -->
                    <div class="relative w-full aspect-[16/10] overflow-hidden bg-slate-200">
                        <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                        <span class="absolute top-3.5 left-3.5 bg-white/95 backdrop-blur-xs text-primary text-[11px] font-bold px-3 py-1 rounded-full shadow-xs">
                            {{ $portfolio->type }}
                        </span>
                    </div>

                    <!-- Detail Kartu -->
                    <div class="relative flex min-h-[168px] flex-1 flex-col p-6">
                        <h2 class="max-w-[320px] text-lg font-bold leading-snug text-[#102238] group-hover:text-primary transition-colors">
                            {{ $portfolio->title }}
                        </h2>
                        <p class="mt-2 text-sm text-bodytext">
                            {{ $portfolio->category }}
                        </p>

                        <!-- Watermark Tahun & Tipe (Gaya Khas ATN) -->
                        <span class="pointer-events-none absolute bottom-3 left-6 text-[44px] font-bold leading-none tracking-tight text-[#E1E4E8] transition-all duration-300 group-hover:opacity-0">
                            {{ $portfolio->year }}
                        </span>
                        <span class="pointer-events-none absolute bottom-3 left-6 text-[44px] font-bold leading-none tracking-tight text-[#E1E4E8] opacity-0 transition-all duration-300 group-hover:opacity-100">
                            {{ $portfolio->type }}
                        </span>
                    </div>

                    <!-- Ornamen Lengkung Kanan Bawah -->
                    <div>
                        <img src="{{ asset('images/shapes/svg-white-square.svg') }}" aria-hidden="true" class="absolute bottom-0 right-[-1px] w-24 pointer-events-none">
                        <svg class="absolute bottom-[16px] right-[16px] h-7 w-7 text-[#102238] transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 group-hover:text-primary" viewBox="0 0 32 32" fill="none">
                            <path d="M8 24L24 8M10 8H24V22" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </button>
                @empty
                <div class="col-span-full py-16 text-center rounded-[24px] border-2 border-dashed border-gray-200 text-gray-400">
                    <p class="text-sm font-medium">Tidak ada portofolio yang sesuai dengan pencarian atau filter Anda.</p>
                    @if(request()->anyFilled(['tipe', 'tahun', 'q']))
                    <a href="{{ route('portfolio.public.index') }}" class="inline-block mt-3 text-xs font-bold text-primary hover:underline">
                        Tampilkan semua portofolio
                    </a>
                    @endif
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $portfolios->links() }}
            </div>

            <!-- Banner CTA Konsultasi -->
            <div class="mt-20 rounded-[28px] bg-[#102238] px-8 py-10 sm:px-12 sm:py-12 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#F8B41C] mb-2">Mulai Proyek Anda</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight">
                        Butuh Solusi Teknologi Serupa untuk Organisasi Anda?
                    </h2>
                    <p class="mt-2 text-sm text-white/75 max-w-2xl">
                        Diskusikan kebutuhan perangkat lunak, pengadaan hardware, atau infrastruktur IT bersama tim teknis PT. Arjuna Travora Nusantara.
                    </p>
                </div>
                <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo Tim ATN, saya tertarik berkonsultasi mengenai kebutuhan solusi teknologi/project.') }}" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl bg-[#F8B41C] hover:bg-yellow-400 text-[#102238] text-sm font-extrabold transition-colors shrink-0">
                    Konsultasi via WhatsApp
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- MODAL DETAIL PORTOFOLIO (LIGHTBOX) -->
        <div x-show="selected" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-950/70 backdrop-blur-sm p-4" @click.self="closeModal()" x-transition.opacity>
            <div class="bg-white rounded-[26px] shadow-2xl w-full max-w-3xl overflow-hidden" x-show="selected" x-transition>
                <!-- Gambar Full -->
                <div class="relative aspect-[16/9] bg-slate-100">
                    <img :src="selected?.image" :alt="selected?.title" class="w-full h-full object-cover">
                    <button type="button" @click="closeModal()" aria-label="Tutup pratinjau"
                        class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/95 text-gray-700 hover:bg-red-500 hover:text-white flex items-center justify-center shadow-md transition-colors cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Informasi Project -->
                <div class="p-6 sm:p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2.5 mb-2">
                            <span class="px-3 py-1 rounded-full bg-blue-50 text-primary text-xs font-bold" x-text="selected?.type"></span>
                            <span class="text-xs font-bold text-gray-400" x-text="'Tahun ' + (selected?.year ?? '')"></span>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-extrabold text-[#102238]" x-text="selected?.title"></h3>
                        <p class="mt-1 text-sm text-bodytext" x-text="selected?.category"></p>
                    </div>

                    <a :href="waLink" target="_blank" rel="noopener" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-primary hover:bg-[#0c2a66] text-white text-sm font-bold transition-colors shrink-0">
                        Konsultasi Project Serupa
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </main>

    <script>
        function portfolioPublicModal(waNumber) {
            return {
                selected: null,
                waNumber: waNumber,
                openModal(item) {
                    this.selected = item;
                    document.body.classList.add('overflow-hidden');
                },
                closeModal() {
                    this.selected = null;
                    document.body.classList.remove('overflow-hidden');
                },
                get waLink() {
                    if (!this.selected) return '#';
                    const message = `Halo Tim ATN, saya tertarik berkonsultasi mengenai project serupa dengan "${this.selected.title}" (${this.selected.category}).`;
                    return `https://wa.me/${this.waNumber}?text=${encodeURIComponent(message)}`;
                }
            }
        }
    </script>

</body>

</html>