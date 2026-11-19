<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dokumen legalitas dan sertifikasi resmi PT. Arjuna Travora Nusantara.">
    <title>Legalitas Perusahaan - Arjuna Travora Nusantara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-x-hidden bg-white text-bodytext antialiased">

    <x-navbar />

    @php
    $rawPhone = preg_replace('/[^0-9]/', '', $setting->phone ?? '082142430296');
    $waNumber = preg_replace('/^0/', '62', $rawPhone);
    @endphp

    <main class="pt-[120px] lg:pt-[150px] pb-24" x-data="legalityViewer()" @keydown.escape.window="close()">

        <div class="mx-auto w-full max-w-[1400px] px-6">

            <!-- Header -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12 pb-8 border-b border-gray-100">
                <div>
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:underline mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                    <div class="flex flex-wrap items-center gap-3">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#102238] tracking-tight">
                            Legalitas Perusahaan
                        </h1>
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Resmi & Terdaftar
                        </span>
                    </div>
                    <p class="mt-3 max-w-[680px] text-[15px] leading-7 text-bodytext">
                        Komitmen transparansi dan kepatuhan hukum <strong>PT. Arjuna Travora Nusantara</strong> sebagai mitra pengadaan perangkat teknologi dan pengembangan sistem informasi yang akuntabel bagi instansi pemerintah, BUMN, maupun
                        korporasi.
                    </p>
                </div>

                <div class="flex items-center gap-3 shrink-0 bg-[#F7F8FA] border border-gray-100 rounded-2xl px-5 py-3.5">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 font-semibold">Total Dokumen Resmi</p>
                        <p class="text-base font-extrabold text-[#102238]">{{ $legalities->count() }} Sertifikat & Surat</p>
                    </div>
                </div>
            </div>

            <!-- Grid Kartu Dokumen Legalitas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @forelse($legalities as $legality)
                @php
                $isPdf = $legality->isPdf();
                $fileUrl = asset('storage/' . $legality->image);
                @endphp

                <div role="button" tabindex="0" @click="open({{ json_encode([
                        'title' => $legality->title,
                        'document_number' => $legality->document_number,
                        'description' => $legality->description,
                        'url' => $fileUrl,
                        'is_pdf' => $isPdf,
                    ]) }})" @keydown.enter.prevent="open({{ json_encode([
                        'title' => $legality->title,
                        'document_number' => $legality->document_number,
                        'description' => $legality->description,
                        'url' => $fileUrl,
                        'is_pdf' => $isPdf,
                    ]) }})"
                    class="group flex flex-col text-left rounded-[22px] bg-white border border-gray-200/80 hover:border-primary/40 hover:shadow-[0_14px_36px_-14px_rgba(17,56,131,0.18)] overflow-hidden transition-all duration-300 cursor-pointer">

                    <!-- Area Bingkai Dokumen (PDF langsung tampil atau Gambar) -->
                    <div class="relative w-full aspect-[4/3] bg-[#F5F7FA] {{ $isPdf ? 'p-2.5' : 'p-5' }} flex items-center justify-center overflow-hidden border-b border-gray-100">
                        @if($isPdf)
                        <iframe src="{{ $fileUrl }}#toolbar=0&navpanes=0&scrollbar=0&view=FitH" class="w-full h-full rounded-xl border border-gray-200/70 bg-white shadow-xs pointer-events-none" loading="lazy" title="{{ $legality->title }}"></iframe>

                        <span class="absolute top-4 left-4 z-10 inline-flex items-center gap-1 bg-red-600 text-white text-[10px] font-extrabold tracking-wider px-2.5 py-1 rounded-full shadow-sm">
                            PDF
                        </span>
                        @else
                        <img src="{{ $fileUrl }}" alt="{{ $legality->title }}" class="max-h-full max-w-full object-contain rounded-lg shadow-sm transition-transform duration-500 group-hover:scale-[1.04]">
                        @endif

                        <!-- Overlay Hover Perbesar -->
                        <div class="absolute inset-0 z-20 bg-[#102238]/35 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[1px]">
                            <span class="inline-flex items-center gap-2 bg-white text-[#102238] text-xs font-bold px-4 py-2.5 rounded-full shadow-lg">
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                                {{ $isPdf ? 'Baca PDF Penuh' : 'Perbesar Dokumen' }}
                            </span>
                        </div>
                    </div>

                    <!-- Informasi Dokumen -->
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-start justify-between gap-3">
                            <h2 class="text-base sm:text-lg font-extrabold text-[#102238] group-hover:text-primary transition-colors leading-snug">
                                {{ $legality->title }}
                            </h2>
                            <span class="shrink-0 w-8 h-8 rounded-full bg-blue-50 text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </span>
                        </div>

                        @if($legality->document_number)
                        <p class="mt-2 text-xs font-bold text-primary bg-blue-50/70 inline-block self-start px-2.5 py-1 rounded-md">
                            {{ $legality->document_number }}
                        </p>
                        @endif

                        @if($legality->description)
                        <p class="mt-2.5 text-xs sm:text-sm text-bodytext leading-relaxed">
                            {{ $legality->description }}
                        </p>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-full py-16 text-center rounded-[24px] border-2 border-dashed border-gray-200 text-gray-400">
                    <p class="text-sm font-medium">Dokumen legalitas belum diunggah. Silakan tambahkan melalui Dasbor Admin pada menu Legalitas.</p>
                </div>
                @endforelse
            </div>

            <!-- Banner Permintaan Dokumen Tender / Pengadaan -->
            <div class="mt-20 rounded-[28px] bg-[#102238] px-8 py-10 sm:px-12 sm:py-12 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#F8B41C] mb-2">Kebutuhan Administrasi & Tender</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight">
                        Membutuhkan Salinan Company Profile atau Berkas Legalitas Lengkap?
                    </h2>
                    <p class="mt-2 text-sm text-white/75 max-w-2xl">
                        Hubungi tim administrasi PT. Arjuna Travora Nusantara untuk permintaan salinan dokumen resmi terkait proses verifikasi vendor atau pengadaan B2B.
                    </p>
                </div>
                <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo Tim ATN, saya ingin meminta informasi / salinan dokumen legalitas perusahaan untuk keperluan pengadaan.') }}" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl bg-[#F8B41C] hover:bg-yellow-400 text-[#102238] text-sm font-extrabold transition-colors shrink-0">
                    Hubungi Tim Administrasi
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- MODAL LIGHTBOX DOKUMEN LEGALITAS (PDF & GAMBAR) -->
        <div x-show="selected" x-cloak class="fixed inset-0 z-[110] flex items-center justify-center bg-gray-950/80 backdrop-blur-sm p-4" @click.self="close()" x-transition.opacity>
            <div class="bg-white rounded-[26px] shadow-2xl w-full max-w-5xl max-h-[92vh] flex flex-col overflow-hidden" x-show="selected" x-transition>

                <!-- Header Modal -->
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between gap-4 shrink-0">
                    <div class="min-w-0">
                        <div class="flex items-center gap-2">
                            <h3 class="text-base sm:text-lg font-extrabold text-[#102238] truncate" x-text="selected?.title"></h3>
                            <span x-show="selected?.is_pdf" class="shrink-0 bg-red-50 text-red-600 text-[10px] font-extrabold px-2 py-0.5 rounded-full">PDF</span>
                        </div>
                        <p x-show="selected?.document_number" class="text-xs font-bold text-primary mt-0.5" x-text="selected?.document_number"></p>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <a :href="selected?.url" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-blue-50 hover:bg-primary text-primary hover:text-white text-xs font-bold transition-colors">
                            <span x-text="selected?.is_pdf ? 'Buka / Unduh PDF' : 'Buka Penuh'"></span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                        <button type="button" @click="close()" aria-label="Tutup" class="w-9 h-9 rounded-xl bg-gray-100 text-gray-600 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Area Pratinjau (PDF Interaktif atau Gambar) -->
                <div class="flex-1 overflow-auto bg-[#F5F7FA] p-4 sm:p-6 flex items-center justify-center">
                    <template x-if="selected?.is_pdf">
                        <iframe :src="selected.url + '#view=FitH'" class="w-full h-[74vh] rounded-xl border border-gray-200 bg-white shadow-md" :title="selected.title"></iframe>
                    </template>

                    <template x-if="selected && !selected.is_pdf">
                        <img :src="selected.url" :alt="selected.title" class="max-h-[74vh] w-auto object-contain rounded-xl shadow-md">
                    </template>
                </div>

                <!-- Keterangan Bawah -->
                <div x-show="selected?.description" class="px-6 py-3.5 border-t border-gray-100 bg-white text-xs sm:text-sm text-bodytext shrink-0" x-text="selected?.description"></div>
            </div>
        </div>

    </main>

    <script>
        function legalityViewer() {
            return {
                selected: null,
                open(item) {
                    this.selected = item;
                    document.body.classList.add('overflow-hidden');
                },
                close() {
                    this.selected = null;
                    document.body.classList.remove('overflow-hidden');
                }
            }
        }
    </script>

</body>

</html>