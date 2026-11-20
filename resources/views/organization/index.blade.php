<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Struktur organisasi dan tim profesional PT. Arjuna Travora Nusantara.">
    <title>Struktur Organisasi - Arjuna Travora Nusantara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-x-hidden bg-white text-bodytext antialiased">

    <x-navbar />

    @php
    $rawPhone = preg_replace('/[^0-9]/', '', $setting->phone ?? '082142430296');
    $waNumber = preg_replace('/^0/', '62', $rawPhone);
    @endphp

    <main class="pt-[120px] lg:pt-[150px] pb-24" x-data="{ activeRole: 'Semua' }">
        <div class="mx-auto w-full max-w-[1400px] px-6">

            <!-- Header -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-14 pb-8 border-b border-gray-100">
                <div>
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:underline mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                    <div class="flex flex-wrap items-center gap-3">
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#102238] tracking-tight">
                            Struktur Organisasi
                        </h1>
                        <span class="px-3.5 py-1 rounded-full bg-blue-50 text-primary text-xs font-bold">
                            {{ $members->count() }} Anggota Tim
                        </span>
                    </div>
                    <p class="mt-3 max-w-[680px] text-[15px] leading-7 text-bodytext">
                        Mengenal jajaran pimpinan, manajemen, serta tenaga ahli teknologi di balik setiap proyek dan solusi digital <strong>PT. Arjuna Travora Nusantara</strong>.
                    </p>
                </div>
            </div>

            @if($members->isEmpty())
            <div class="py-16 text-center rounded-[24px] border-2 border-dashed border-gray-200 text-gray-400">
                <p class="text-sm font-medium">Data struktur organisasi belum diisi. Silakan tambahkan melalui Dasbor Admin pada menu Struktur Organisasi.</p>
            </div>
            @else

            <!-- LEVEL 1: PIMPINAN / DIREKSI -->
            @if($leaders->count() > 0)
            <section class="relative">
                <div class="text-center mb-8">
                    <span class="inline-block px-4 py-1.5 rounded-full bg-amber-50 border border-amber-200/80 text-amber-800 text-xs font-extrabold uppercase tracking-wider">
                        Jajaran Pimpinan & Direksi
                    </span>
                </div>

                <div class="flex flex-wrap justify-center gap-7">
                    @foreach($leaders as $leader)
                    <div class="group w-full sm:w-[300px] rounded-[24px] bg-white border border-gray-200/80 hover:border-primary/40 hover:shadow-[0_16px_40px_-16px_rgba(17,56,131,0.22)] overflow-hidden transition-all duration-300">
                        <div class="relative aspect-[4/4] bg-[#F5F7FA] overflow-hidden">
                            @if($leader->photo)
                            <img src="{{ asset('storage/' . $leader->photo) }}" alt="{{ $leader->name }}" class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
                            @else
                            <div class="w-full h-full bg-gradient-to-br from-[#102238] to-[#113883] flex items-center justify-center text-white text-5xl font-extrabold">
                                {{ strtoupper(substr($leader->name, 0, 2)) }}
                            </div>
                            @endif
                            <span class="absolute top-3.5 left-3.5 bg-[#F8B41C] text-[#102238] text-[10px] font-extrabold uppercase tracking-wider px-3 py-1 rounded-full shadow-xs">
                                {{ $leader->division ?: 'Direksi' }}
                            </span>
                        </div>
                        <div class="p-6 text-center">
                            <h2 class="text-lg font-extrabold text-[#102238] group-hover:text-primary transition-colors">
                                {{ $leader->name }}
                            </h2>
                            <p class="mt-1 text-sm font-bold text-primary">
                                {{ $leader->role }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Garis Penghubung Hierarki -->
                @if($managers->count() > 0 || $staff->count() > 0)
                <div class="mx-auto my-8 h-12 w-[2px] bg-gradient-to-b from-primary/40 to-gray-200"></div>
                @endif
            </section>
            @endif

            <!-- LEVEL 2: MANAJEMEN & HRD -->
            @if($managers->count() > 0)
            <section class="relative">
                <div class="text-center mb-8">
                    <span class="inline-block px-4 py-1.5 rounded-full bg-blue-50 border border-blue-200/80 text-primary text-xs font-extrabold uppercase tracking-wider">
                        Manajemen & HRD
                    </span>
                </div>

                <div class="flex flex-wrap justify-center gap-6">
                    @foreach($managers as $manager)
                    <div class="group w-full sm:w-[270px] rounded-[22px] bg-white border border-gray-200/80 hover:border-primary/40 hover:shadow-[0_14px_34px_-14px_rgba(17,56,131,0.18)] overflow-hidden transition-all duration-300">
                        <div class="relative aspect-[4/4] bg-[#F5F7FA] overflow-hidden">
                            @if($manager->photo)
                            <img src="{{ asset('storage/' . $manager->photo) }}" alt="{{ $manager->name }}" class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
                            @else
                            <div class="w-full h-full bg-gradient-to-br from-[#113883] to-[#2354b5] flex items-center justify-center text-white text-4xl font-extrabold">
                                {{ strtoupper(substr($manager->name, 0, 2)) }}
                            </div>
                            @endif
                            @if($manager->division)
                            <span class="absolute top-3 left-3 bg-white/95 text-primary text-[10px] font-bold px-2.5 py-1 rounded-full shadow-xs">
                                {{ $manager->division }}
                            </span>
                            @endif
                        </div>
                        <div class="p-5 text-center">
                            <h3 class="text-base font-extrabold text-[#102238] group-hover:text-primary transition-colors">
                                {{ $manager->name }}
                            </h3>
                            <p class="mt-1 text-xs font-bold text-primary">
                                {{ $manager->role }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Garis Penghubung Hierarki -->
                @if($staff->count() > 0)
                <div class="mx-auto my-8 h-12 w-[2px] bg-gradient-to-b from-primary/30 to-gray-200"></div>
                @endif
            </section>
            @endif

            <!-- LEVEL 3: TIM & KARYAWAN -->
            @if($staff->count() > 0)
            <section class="relative">
                <div class="text-center mb-6">
                    <span class="inline-block px-4 py-1.5 rounded-full bg-slate-100 border border-slate-200 text-[#102238] text-xs font-extrabold uppercase tracking-wider">
                        Tim Teknis & Karyawan
                    </span>
                </div>

                <!-- Filter Instan Berdasarkan Role -->
                @if($staffRoles->count() > 1)
                <div class="flex flex-wrap justify-center gap-2 mb-9">
                    <button type="button" @click="activeRole = 'Semua'" class="px-4 py-2 rounded-full text-xs font-bold border transition-colors cursor-pointer" :class="activeRole === 'Semua'
                                ? 'bg-primary text-white border-primary'
                                : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary'">
                        Semua Role ({{ $staff->count() }})
                    </button>
                    @foreach($staffRoles as $roleName)
                    <button type="button" @click="activeRole = @js($roleName)" class="px-4 py-2 rounded-full text-xs font-bold border transition-colors cursor-pointer" :class="activeRole === @js($roleName)
                                    ? 'bg-primary text-white border-primary'
                                    : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary'">
                        {{ $roleName }}
                    </button>
                    @endforeach
                </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($staff as $person)
                    <div x-show="activeRole === 'Semua' || activeRole === @js($person->role)" x-transition.opacity
                        class="group rounded-[22px] bg-[#F7F8FA] border border-transparent hover:bg-white hover:border-primary/30 hover:shadow-[0_14px_34px_-14px_rgba(17,56,131,0.16)] overflow-hidden transition-all duration-300">
                        <div class="relative aspect-[4/4] bg-slate-200 overflow-hidden">
                            @if($person->photo)
                            <img src="{{ asset('storage/' . $person->photo) }}" alt="{{ $person->name }}" class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-105">
                            @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-600 to-slate-800 flex items-center justify-center text-white text-4xl font-extrabold">
                                {{ strtoupper(substr($person->name, 0, 2)) }}
                            </div>
                            @endif
                            @if($person->division)
                            <span class="absolute top-3 left-3 bg-white/95 text-[#102238] text-[10px] font-bold px-2.5 py-1 rounded-full shadow-xs">
                                {{ $person->division }}
                            </span>
                            @endif
                        </div>
                        <div class="p-5">
                            <h3 class="text-base font-extrabold text-[#102238] group-hover:text-primary transition-colors">
                                {{ $person->name }}
                            </h3>
                            <p class="mt-1 text-xs font-bold text-primary">
                                {{ $person->role }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            @endif

            <!-- Banner CTA Bergabung / Konsultasi -->
            <div class="mt-20 rounded-[28px] bg-[#102238] px-8 py-10 sm:px-12 sm:py-12 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#F8B41C] mb-2">Kolaborasi & Karir</p>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white leading-tight">
                        Ingin Bekerja Sama atau Bergabung dengan Tim Kami?
                    </h2>
                    <p class="mt-2 text-sm text-white/75 max-w-2xl">
                        Tim profesional PT. Arjuna Travora Nusantara siap berdiskusi mengenai proyek teknologi maupun peluang karir di bidang pengembangan software dan infrastruktur IT.
                    </p>
                </div>
                <a href="{{ $setting->career_url ?: 'https://wa.me/' . $waNumber . '?text=' . urlencode('Halo Tim ATN, saya ingin menghubungi tim HRD / manajemen PT. Arjuna Travora Nusantara.') }}" target="_blank" rel="noopener"
                    class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-xl bg-[#F8B41C] hover:bg-yellow-400 text-[#102238] text-sm font-extrabold transition-colors shrink-0">
                    Hubungi Tim Kami
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </main>

</body>

</html>