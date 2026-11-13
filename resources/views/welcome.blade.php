<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Arjuna Travora Nusantara - Solusi Software & Hardware">
    <title>Arjuna Travora Nusantara</title>

    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

</head>

<body class="overflow-x-hidden bg-white text-bodytext antialiased">

    <x-navbar />

    <main>

        {{-- HERO --}}
        <section id="beranda" x-data="heroSlider()" class="relative overflow-hidden bg-white">

            {{-- <div class="mx-auto w-full max-w-[1400px] max-lg:pt-[120px] lg:pt-[160px] max-xl:px-6 xl:px-0"> --}}
            <div class="mx-auto w-full max-w-[1400px] max-lg:pt-[120px] lg:pt-[160px] px-6">
                <div class="relative grid grid-cols-1 gap-4 md:grid-cols-[minmax(0,2.65fr)_minmax(0,1fr)]">
                    <div class="relative sm:w-full sm:max-w-full">
                        <div class="relative overflow-hidden rounded-[24px] h-[400px]">
                            <template x-for="(slide, index) in slides" :key="index">
                                <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-[1.03]" x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-500 absolute inset-0" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                                    <img :src="slide.main" :alt="slide.alt" class="h-full w-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/20 to-transparent"></div>
                                </div>
                            </template>

                            {{-- Hero title --}}
                            <div class="absolute -bottom-2 left-0 lg:left-4 z-20 px-7 pb-4">
                                <p class="mb-2 text-lg lg:text-3xl font-medium text-white">
                                    <span class="text-[#F8B41C]">#</span>SolusiSoftware&Hardware
                                </p>
                                <h1 class="max-md:w-[100px] max-md:text-[44px] md:text-[60px] lg:text-[90px] font-extrabold leading-[1.1] max-md:tracking-normal tracking-[-0.05em] text-white">
                                    Arjuna Travora
                                </h1>
                            </div>
                        </div>

                        {{-- Nusantara --}}
                        <h2 class="max-md:text-[44px] md:text-[60px] lg:text-[90px] relative z-30 mt-2 px-6 lg:px-10 font-extrabold leading-[0.88] max-md:tracking-normal tracking-[-0.05em] text-primary">
                            Nusantara
                        </h2>

                        <img src="{{ asset('images/shapes/svg-white-potrait.svg') }}" aria-hidden="true" class="max-md:hidden absolute md:bottom-[54px] lg:bottom-[80px] right-[-4px] h-[131px] w-[112px] pointer-events-none">
                        <img src="{{ asset('images/shapes/svg-white-landscape.svg') }}" aria-hidden="true" class="md:hidden absolute bottom-[46px] right-[-1px] w-50 pointer-events-none">


                        {{-- Tombol slider --}}
                        <div class="absolute bottom-[60px] md:bottom-[75px] lg:bottom-[100px] max-md:right-[10px] right-[-74px] z-50 flex items-center gap-1.5">
                            <button type="button" @click="previous()" aria-label="Slide sebelumnya"
                                class="group flex h-[62px] w-[62px] items-center justify-center rounded-l-xl border border-[#D8DDE7] bg-white transition-all duration-300 hover:border-primary hover:bg-primary disabled:cursor-not-allowed disabled:opacity-50">
                                <svg class="h-6 w-6 text-[#667085] transition-colors duration-300 group-hover:text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M15 18L9 12L15 6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>

                            <button type="button" @click="next()" aria-label="Slide berikutnya"
                                class="group flex h-[62px] w-[62px] items-center justify-center rounded-r-xl border border-[#D8DDE7] bg-white transition-all duration-300 hover:border-primary hover:bg-primary disabled:cursor-not-allowed disabled:opacity-50">
                                <svg class="h-6 w-6 text-[#667085] transition-colors duration-300 group-hover:text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M9 18L15 12L9 6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>


                    <div class="max-md:hidden relative h-[400px] min-w-0 self-start overflow-hidden rounded-[24px]">
                        <template x-for="(slide, index) in slides" :key="'side-' + index">
                            <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-[1.03]" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-500 absolute inset-0" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 overflow-hidden">
                                <img :src="slide.side" :alt="slide.alt" class="h-full w-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent"></div>
                                <div class="absolute max-lg:hidden bottom-0 left-20 p-6 lg:p-7">
                                    <h3 class="text-[14px] font-bold text-white sm:text-[16px]" x-text="slide.label"></h3>
                                    <p class="mt-1 max-w-[230px] text-[10px] leading-[1.5] text-white/85 sm:text-[11px]" x-text="slide.description"></p>
                                </div>
                            </div>
                        </template>

                        <img src="{{ asset('images/shapes/svg-white-potrait.svg') }}" aria-hidden="true" class="absolute bottom-[-7px] left-[-4px] h-[131px] w-[112px] -scale-x-100 pointer-events-none">

                    </div>
                </div>


                <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1.25fr_0.75fr] lg:gap-16">
                    {{-- LEFT --}}
                    <div data-aos="fade-up" data-aos-delay="100" class="max-w-[750px] pt-5 lg:pt-10">
                        <p class="ml-7 lg:ml-12 text-[16px] lg:text-[18px] leading-[1.75] text-bodytext">
                            Menyediakan solusi teknologi mulai dari pengembangan software,
                            pengadaan perangkat keras, sistem keamanan, hingga infrastruktur
                            digital untuk mendukung kebutuhan bisnis, instansi, dan organisasi.
                        </p>
                    </div>

                    {{-- RIGHT --}}
                    <div class="flex flex-col gap-5 lg:gap-7">
                        {{-- Statistics --}}
                        <div data-aos="fade-up" data-aos-delay="150" class="grid grid-cols-3 gap-5 max-lg:text-center text-end">
                            <div>
                                <p class="text-[27px] font-bold leading-none tracking-[-0.03em] text-primary sm:text-[30px]">
                                    {{ $setting->stat_projects ?? '500+' }}
                                </p>
                                <p class="mt-1.5 text-[12px] md:text-[16px]  text-bodytext">
                                    Projek Selesai
                                </p>
                            </div>
                            <div>
                                <p class="text-[27px] font-bold leading-none tracking-[-0.03em] text-primary sm:text-[30px]">
                                    {{ $setting->stat_clients ?? '40+' }}
                                </p>
                                <p class="mt-1.5 text-[12px] md:text-[16px]  text-bodytext">
                                    Klien Terpercaya
                                </p>
                            </div>
                            <div>
                                <p class="text-[27px] font-bold leading-none tracking-[-0.03em] text-primary sm:text-[30px]">
                                    {{ $setting->stat_certification ?? 'ISO/IEC' }}
                                </p>
                                <p class="mt-1.5 text-[12px] md:text-[16px]  text-bodytext">
                                    Resmi & Bergaransi
                                </p>
                            </div>
                        </div>

                        {{-- CTA --}}
                        <div data-aos="fade-up" data-aos-delay="220" class="mt-7 grid grid-cols-2 gap-3">
                            <a href="#layanan"
                                class="text-[12px] md:text-[16px] group inline-flex h-12 lg:h-14 items-center justify-center gap-2 rounded-[11px] border border-primary font-semibold text-primary transition-all duration-300 hover:bg-primary hover:text-white">
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                    <circle cx="10" cy="10" r="8" stroke="currentColor" stroke-width="1.5" />
                                    <path d="M7 9L10 12L13 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Lihat Layanan
                            </a>

                            <a href="#kontak" class="text-[12px] md:text-[16px] group inline-flex h-12 lg:h-14 items-center justify-center gap-2 rounded-[11px] bg-primary font-semibold text-white transition-all duration-300 hover:-translate-y-0.5">
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                    <path d="M4 5.5C4 4.67 4.67 4 5.5 4H14.5C15.33 4 16 4.67 16 5.5V14.5C16 15.33 15.33 16 14.5 16H5.5C4.67 16 4 15.33 4 14.5V5.5Z" stroke="currentColor" stroke-width="1.4" />
                                    <path d="M7 8H13M7 11H10" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" />
                                </svg>
                                Konsultasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- KEUNGGULAN --}}
        <section id="keunggulan" class="bg-white max-lg:py-14 xl:py-20">
            <div class="mx-auto w-full max-w-[1400px] px-6">
                <div id="advantages-story" class="relative min-h-[2800px] md:min-h-[2800px] lg:min-h-[2400px]">
                    {{-- CONTAINER KEUNGGULAN --}}
                    <div id="advantages-card" class="sticky top-[max(5rem,calc(50vh-340px))] md:top-[max(6rem,calc(50vh-280px))] grid w-full min-h-[680px] overflow-hidden rounded-[22px] bg-[#F5F6F8] md:min-h-[560px] md:grid-cols-2 lg:min-h-[560px]"
                        data-aos="fade-up" data-aos-duration="900" data-aos-easing="ease-out-cubic">
                        {{-- GAMBAR --}}
                        <div class="relative h-[320px] min-h-0 overflow-hidden sm:h-[360px] md:h-[560px] lg:h-[620px]" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="150" data-aos-easing="ease-out-cubic">
                            {{-- Image 01 --}}
                            <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1400&q=85" alt="Solusi teknologi terintegrasi" class="advantage-image absolute inset-0 h-full w-full object-cover" data-image="0">
                            {{-- Image 02 --}}
                            <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1400&q=85" alt="Teknologi untuk kebutuhan bisnis" class="advantage-image absolute inset-0 h-full w-full object-cover opacity-0"
                                data-image="1">
                            {{-- Image 03 --}}
                            <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1400&q=85" alt="Dukungan teknis" class="advantage-image absolute inset-0 h-full w-full object-cover opacity-0" data-image="2">
                            {{-- Image 04 --}}
                            <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=1400&q=85" alt="Layanan profesional" class="advantage-image absolute inset-0 h-full w-full object-cover opacity-0"
                                data-image="3">
                        </div>
                        {{-- KONTEN --}}
                        <div class="relative flex min-h-0 flex-col justify-center overflow-hidden px-6 py-6 sm:px-8 sm:py-7 md:px-9 md:py-8 lg:px-12 lg:py-10 xl:px-14" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="250"
                            data-aos-easing="ease-out-cubic">
                            {{-- Heading --}}
                            <div class="mb-8" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                                <h2 class="text-2xl font-bold leading-tight text-[#102238] sm:text-3xl">
                                    Mengapa Memilih ATN?
                                </h2>
                                <p class="mt-3 max-w-[580px] text-[16px] leading-6 text-bodytext">
                                    Fondasi operasional teruji untuk memastikan pengadaan tepat sasaran, akuntabel, dan berkesinambungan jangka panjang.
                                </p>
                            </div>
                            {{-- DAFTAR KEUNGGULAN --}}
                            <div class="advantages-items">
                                {{-- ITEM 01 --}}
                                {{-- <article class="advantage-item is-active relative border-l-2 border-[#D8DDE7] pl-4 sm:pl-5" data-index="0" data-aos="fade-up" data-aos-duration="700" data-aos-delay="500"> --}}
                                <article class="advantage-item is-active relative border-l-2 border-[#D8DDE7] pl-4 sm:pl-5" data-index="0">
                                    {{-- Active line --}}
                                    <span class="advantage-line absolute -left-[2px] top-0 h-full w-[2px] bg-primary"></span>
                                    <span class="advantage-title block text-[15px] font-bold lg:text-[18px]">
                                        Sesuai Kebutuhan
                                    </span>
                                    <div class="advantage-description mt-2 max-w-[580px]">
                                        <p class="max-md:text-[14px] text-[16px] leading-6 text-bodytext">
                                            Spesifikasi dan arsitektur disesuaikan tepat sasaran dengan kapasitas anggaran, alur kerja nyata, dan skala pertumbuhan bisnis Anda.
                                        </p>
                                    </div>
                                </article>
                                {{-- ITEM 02 --}}
                                {{-- <article class="advantage-item relative mt-5 border-l-2 border-[#D8DDE7] pl-4 transition-all duration-500 sm:pl-5" data-index="1" data-aos="fade-up" data-aos-duration="700" data-aos-delay="600"> --}}
                                <article class="advantage-item relative mt-5 border-l-2 border-[#D8DDE7] pl-4 transition-all duration-500 sm:pl-5" data-index="1">
                                    <span class="advantage-line absolute -left-[2px] top-0 h-0 w-[2px] bg-primary"></span>
                                    <span class="advantage-title block text-[15px] font-bold lg:text-[18px]">
                                        Solusi Terintegrasi
                                    </span>
                                    <div class="advantage-description mt-2 max-w-[580px]">
                                        <p class="max-md:text-[14px] text-[16px] leading-6 text-bodytext">
                                            Setiap solusi dirancang agar dapat terintegrasi dengan kebutuhan sistem dan proses bisnis secara menyeluruh.
                                        </p>
                                    </div>
                                </article>
                                {{-- ITEM 03 --}}
                                {{-- <article class="advantage-item relative mt-5 border-l-2 border-[#D8DDE7] pl-4 transition-all duration-500 sm:pl-5" data-index="2" data-aos="fade-up" data-aos-duration="700" data-aos-delay="700"> --}}
                                <article class="advantage-item relative mt-5 border-l-2 border-[#D8DDE7] pl-4 transition-all duration-500 sm:pl-5" data-index="2">
                                    <span class="advantage-line absolute -left-[2px] top-0 h-0 w-[2px] bg-primary"></span>
                                    <span class="advantage-title block text-[15px] font-bold lg:text-[18px]">
                                        Dukungan Teknis
                                    </span>
                                    <div class="advantage-description mt-2 max-w-[580px]">
                                        <p class="max-md:text-[14px] text-[16px] leading-6 text-bodytext">
                                            Dukungan teknis diberikan untuk memastikan solusi berjalan optimal sesuai kebutuhan operasional.
                                        </p>
                                    </div>
                                </article>
                                {{-- ITEM 04 --}}
                                {{-- <article class="advantage-item relative mt-5 border-l-2 border-[#D8DDE7] pl-4 transition-all duration-500 sm:pl-5" data-index="3" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800"> --}}
                                <article class="advantage-item relative mt-5 border-l-2 border-[#D8DDE7] pl-4 transition-all duration-500 sm:pl-5" data-index="3">
                                    <span class="advantage-line absolute -left-[2px] top-0 h-0 w-[2px] bg-primary"></span>
                                    <span class="advantage-title block text-[15px] font-bold lg:text-[18px]">
                                        Profesional & Terukur
                                    </span>
                                    <div class="advantage-description mt-2 max-w-[580px]">
                                        <p class="max-md:text-[14px] text-[16px] leading-6 text-bodytext">
                                            Proses kerja dilakukan secara profesional dengan pendekatan terukur untuk memberikan hasil yang jelas.
                                        </p>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- TENTANG KAMI --}}
        <section id="tentang-kami" class="overflow-hidden bg-white py-14 sm:py-16 lg:py-20">
            <div class="mx-auto w-full max-w-[1400px] px-6">
                <div x-data="aboutUsSlider()" x-init="init()" class="grid items-center gap-10 lg:grid-cols-[0.92fr_1.08fr] lg:gap-14 xl:gap-20">
                    {{-- =================================================
            LEFT: CONTENT
            ================================================== --}}
                    <div class="relative min-w-0" data-aos="fade-right" data-aos-duration="800" data-aos-offset="100">
                        {{-- Content slider --}}
                        <div class="relative overflow-hidden">
                            {{-- Tentang Kami --}}
                            <div x-show="activeSlide === 0" x-transition:enter="transition duration-500 ease-out" x-transition:enter-start="translate-x-8 opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
                                x-transition:leave="absolute inset-0 transition duration-300 ease-in" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="-translate-x-8 opacity-0" x-cloak>
                                <h2 class="text-3xl font-bold leading-tight text-[#102238] sm:text-4xl">
                                    Tentang Kami
                                </h2>
                                <div class="mt-7 max-w-[580px] space-y-5 text-[15px] leading-7 text-bodytext sm:text-base sm:leading-7">
                                    <p>
                                        <strong class="font-bold text-[#667085]">PT. Arjuna Travora Nusantara</strong>
                                        merupakan perusahaan yang bergerak di bidang teknologi informasi dan pengadaan perangkat teknologi dengan menyediakan solusi software, hardware, infrastruktur IT, sistem keamanan dan perangkat digital display.
                                    </p>
                                    <p>
                                        Kami membantu perusahaan, instansi pemerintah, fasilitas kesehatan, institusi pendidikan, maupun organisasi dalam memenuhi kebutuhan teknologi melalui layanan yang terintegrasi, mulai dari konsultasi,
                                        perencanaan, pengadaan, pengembangan, instalasi, implementasi hingga dukungan teknis.
                                    </p>
                                </div>
                            </div>
                            {{-- Visi & Misi --}}
                            <div x-show="activeSlide === 1" x-transition:enter="transition duration-500 ease-out" x-transition:enter-start="translate-x-8 opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
                                x-transition:leave="absolute inset-0 transition duration-300 ease-in" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="-translate-x-8 opacity-0" x-cloak>
                                <h2 class="text-3xl font-bold leading-tight text-[#102238] sm:text-4xl">
                                    Visi & Misi
                                </h2>
                                <div class="mt-8 max-w-[650px] text-bodytext">
                                    <div>
                                        <h3 class="text-2xl font-bold text-[#667085]">
                                            Visi
                                        </h3>
                                        <p class="mt-3 text-[15px] leading-7 sm:text-base">
                                            Menjadi penyedia solusi IT dan pengadaan perangkat terintegrasi yang terdepan dan terpercaya.
                                        </p>
                                    </div>
                                    <div class="mt-8">
                                        <h3 class="text-2xl font-bold text-[#667085]">
                                            Misi
                                        </h3>
                                        <ul class="mt-4 space-y-3 text-[15px] leading-7 sm:text-base">
                                            <li class="flex gap-3">
                                                <span class="mt-[11px] h-1.5 w-1.5 shrink-0 rounded-full bg-bodytext"></span>
                                                <span><strong>Solusi IT Lengkap:</strong> Menyediakan software, hardware, infrastruktur IT, keamanan, dan digital display.</span>
                                            </li>
                                            <li class="flex gap-3">
                                                <span class="mt-[11px] h-1.5 w-1.5 shrink-0 rounded-full bg-bodytext"></span>
                                                <span><strong>Layanan Terpadu:</strong> Memberikan layanan dari konsultasi, pengadaan, hingga dukungan teknis.</span>
                                            </li>
                                            <li class="flex gap-3">
                                                <span class="mt-[11px] h-1.5 w-1.5 shrink-0 rounded-full bg-bodytext"></span>
                                                <span><strong>Mitra Sektor:</strong> Membantu percepatan digitalisasi sektor bisnis, pemerintah, kesehatan, dan pendidikan.</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Navigation --}}
                        <div class="mt-10 flex items-center gap-2 sm:mt-12" data-aos="fade-up" data-aos-delay="150" data-aos-duration="700">
                            <button type="button" @click="previous()" :disabled="activeSlide === 0"
                                class="group flex h-[62px] w-[62px] items-center justify-center rounded-l-xl border border-[#E5E7EB] bg-white transition-all duration-300 hover:border-primary hover:bg-primary disabled:cursor-not-allowed disabled:opacity-50"
                                aria-label="Konten sebelumnya">
                                <svg class="h-6 w-6 text-[#667085] transition-colors duration-300 group-hover:text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M15 18L9 12L15 6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button type="button" @click="next()" :disabled="activeSlide === slides.length - 1"
                                class="group flex h-[62px] w-[62px] items-center justify-center rounded-r-xl border border-[#D8DDE7] bg-white transition-all duration-300 hover:border-primary hover:bg-primary disabled:cursor-not-allowed disabled:opacity-50"
                                aria-label="Konten berikutnya">
                                <svg class="h-6 w-6 text-[#667085] transition-colors duration-300 group-hover:text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M9 18L15 12L9 6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    {{-- =================================================
            RIGHT: GALLERY
            ================================================== --}}
                    <div class="relative" data-aos="fade-left" data-aos-duration="900" data-aos-delay="100" data-aos-offset="100">
                        <div class="relative aspect-[1.28/1] overflow-hidden rounded-[26px] bg-[#F5F6F8] sm:aspect-[1.35/1]">
                            {{-- Main images --}}
                            <template x-for="(image, index) in gallery" :key="index">
                                <img x-show="activeGallery === index" x-transition:enter="transition duration-700 ease-out" x-transition:enter-start="scale-105 opacity-0" x-transition:enter-end="scale-100 opacity-100" :src="image.src"
                                    :alt="image.alt" class="absolute inset-0 h-full w-full object-cover" x-cloak>
                            </template>
                            {{-- Gallery thumbnails --}}
                            <div class="absolute bottom-3 right-3 z-20 flex gap-2 sm:bottom-4 sm:right-4 sm:gap-2.5">
                                <template x-for="(image, index) in gallery" :key="`thumb-${index}`">
                                    <button type="button" @click="selectGallery(index)" class="relative h-[54px] w-[54px] overflow-hidden rounded-xl border-2 bg-white shadow-sm transition-all duration-300 sm:h-[60px] sm:w-[60px]"
                                        :class="activeGallery === index ? 'border-primary' : 'border-white/80'" :aria-label="`Lihat foto ${index + 1}`">
                                        <img :src="image.src" :alt="image.alt" class="h-full w-full object-cover">
                                        <span x-show="activeGallery !== index" class="absolute inset-0 bg-white/10"></span>
                                    </button>
                                </template>
                            </div>

                            {{-- <img src="{{ asset('images/shapes/svg-white-potrait.svg') }}" alt="" aria-hidden="true" class="max-md:hidden absolute md:bottom-[54px] lg:bottom-[80px] right-[-4px] h-[131px] w-[112px] pointer-events-none"> --}}
                            <div class="absolute bottom-[-4px] right-[100px] h-[84.5px] sm:h-[101px] max-sm:w-40 w-48 pointer-events-none overflow-hidden flex items-end justify-end">
                                <img src="{{ asset('images/shapes/svg-white-landscape.svg') }}" aria-hidden="true" class="w-48 pointer-events-none">
                            </div>
                            <div class="absolute bottom-[-4px] right-[140px] sm:right-[150px] h-[84.5px] sm:h-[101px] max-sm:w-40 w-48 pointer-events-none overflow-hidden flex items-end justify-end">
                                <img src="{{ asset('images/shapes/svg-white-landscape.svg') }}" aria-hidden="true" class="w-48 pointer-events-none">
                            </div>
                            <img src="{{ asset('images/shapes/svg-white-landscape.svg') }}" aria-hidden="true" class="absolute bottom-[-4px] right-[-1px] max-sm:w-40 w-48 pointer-events-none">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- LAYANAN KAMI --}}
        <section id="layanan" class="bg-white">
            <div id="services-story" class="relative">
                <div id="services-pin" class="overflow-hidden bg-[#F9FAFB] py-16 sm:py-20 lg:py-24">
                    {{-- HEADER --}}
                    <div class="mx-auto w-full max-w-[1400px] px-6">
                        <div data-aos="fade-up" data-aos-duration="800">
                            <h2 class="text-3xl font-bold leading-tight text-[#102238] sm:text-4xl">
                                Layanan Kami
                            </h2>
                            <p class="mt-3 max-w-[720px] text-[15px] leading-6 text-bodytext sm:text-base">
                                Penyedia teknologi B2B: dari baris kode aplikasi hingga kabel optik dan rak server data center.
                            </p>
                        </div>
                    </div>

                    {{-- CARD TRACK --}}
                    <div id="services-viewport" class="mt-8 overflow-hidden pl-6 lg:pl-[max(24px,calc((100vw-1400px)/2))]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <div id="services-track" class="flex w-max gap-7 pr-6 lg:gap-8 pr-[240px] lg:pr-[440px]">
                            {{-- SOFTWARE DEVELOPMENT --}}
                            <article class="service-card relative flex h-[273px] w-[280px] shrink-0 flex-col rounded-[20px] bg-white p-6 sm:w-[320px] lg:w-[360px] xl:w-[380px]">
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#EEF1F6] text-primary">
                                    <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none">
                                        <rect x="5" y="4" width="22" height="18" rx="2" stroke="currentColor" stroke-width="2" />
                                        <path d="M11 28H21M16 22V28M11 14L14 17L11 20M21 14L18 17L21 20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-[18px] md:text-[20px] font-bold text-primary">
                                    Software Development
                                </h3>
                                <p class="mt-3 text-[14px] leading-6 text-bodytext">
                                    Pengembangan sistem ERP, CRM, portal web, serta aplikasi mobile kustom untuk otomatisasi alur kerja korporat dan integrasi API instansi.
                                </p>
                                <a href="#kontak" class="absolute bottom-[10px] right-[20px] sm:bottom-[18px] sm:right-[35px] text-[15px] sm:text-[17px] z-10 group mt-auto inline-flex items-center justify-end gap-3 font-semibold text-primary">
                                    Konsultasi
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 10.6429V1H1.71429M11 1L1 11" stroke-width="2" stroke-linecap="round" stroke="#113883" />
                                    </svg>
                                </a>

                                <img src="{{ asset('images/shapes/svg-F9FAFB-landscape.svg') }}" aria-hidden="true" class="absolute bottom-[-4px] right-[-1px] max-sm:w-40 w-48 pointer-events-none">
                            </article>
                            {{-- HARDWARE PROCUREMENT --}}
                            <article class="service-card relative flex h-[273px] w-[280px] shrink-0 flex-col rounded-[20px] bg-white p-6 sm:h-[273px] sm:w-[320px] lg:w-[360px] xl:w-[380px]">
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#EEF1F6] text-primary">
                                    <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none">
                                        <rect x="8" y="8" width="16" height="16" rx="2" stroke="currentColor" stroke-width="2" />
                                        <rect x="12" y="12" width="8" height="8" rx="1" stroke="currentColor" stroke-width="2" />
                                        <path d="M8 12H4M8 16H4M8 20H4M28 12H24M28 16H24M28 20H24M12 8V4M16 8V4M20 8V4M12 28V24M16 28V24M20 28V24" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-[18px] md:text-[20px] font-bold text-primary">
                                    Hardware Procurement
                                </h3>
                                <p class="mt-3 text-[14px] leading-6 text-bodytext">
                                    Pengadaan PC, laptop enterprise, server berdaya tahan tinggi, printer industri, serta perangkat kasir POS bergaransi distributor resmi.
                                </p>
                                <a href="#kontak" class="absolute bottom-[10px] right-[20px] sm:bottom-[18px] sm:right-[35px] text-[15px] sm:text-[17px] z-10 group mt-auto inline-flex items-center justify-end gap-3 font-semibold text-primary">
                                    Konsultasi
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 10.6429V1H1.71429M11 1L1 11" stroke-width="2" stroke-linecap="round" stroke="#113883" />
                                    </svg>
                                </a>

                                <img src="{{ asset('images/shapes/svg-F9FAFB-landscape.svg') }}" aria-hidden="true" class="absolute bottom-[-4px] right-[-1px] max-sm:w-40 w-48 pointer-events-none">
                            </article>
                            {{-- IT INFRASTRUCTURE --}}
                            <article class="service-card relative flex h-[273px] w-[280px] shrink-0 flex-col rounded-[20px] bg-white p-6 sm:h-[273px] sm:w-[320px] lg:w-[360px] xl:w-[380px]">
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#EEF1F6] text-primary">
                                    <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none">
                                        <path d="M6 25H26M8 25V16H13V25M13 16L17 12L21 16M21 16V25M21 11C23 11 25 9 25 7M21 7C22 7 23 6 23 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-[18px] md:text-[20px] font-bold text-primary">
                                    IT Infrastructure
                                </h3>
                                <p class="mt-3 text-[14px] leading-6 text-bodytext">
                                    Pemasangan kabel fiber optic, data center rack, router gateway, switch manageable L2/L3, serta managed Wi-Fi kantor skala ribuan user.
                                </p>
                                <a href="#kontak" class="absolute bottom-[10px] right-[20px] sm:bottom-[18px] sm:right-[35px] text-[15px] sm:text-[17px] z-10 group mt-auto inline-flex items-center justify-end gap-3 font-semibold text-primary">
                                    Konsultasi
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 10.6429V1H1.71429M11 1L1 11" stroke-width="2" stroke-linecap="round" stroke="#113883" />
                                    </svg>
                                </a>

                                <img src="{{ asset('images/shapes/svg-F9FAFB-landscape.svg') }}" aria-hidden="true" class="absolute bottom-[-4px] right-[-1px] max-sm:w-40 w-48 pointer-events-none">
                            </article>
                            {{-- CCTV & SECURITY --}}
                            <article class="service-card relative flex h-[273px] w-[280px] shrink-0 flex-col rounded-[20px] bg-white p-6 sm:h-[273px] sm:w-[320px] lg:w-[360px] xl:w-[380px]">
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#EEF1F6] text-primary">
                                    <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none">
                                        <rect x="5" y="10" width="16" height="11" rx="2" stroke="currentColor" stroke-width="2" />
                                        <path d="M21 14L27 11V21L21 18M10 24H22M16 21V24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-[18px] md:text-[20px] font-bold text-primary">
                                    CCTV & Security
                                </h3>
                                <p class="mt-3 text-[14px] leading-6 text-bodytext">
                                    Solusi IP camera surveillance resolusi tinggi, access control pintu biometric & RFID, alarm kebakaran, dan perimeter security alert.
                                </p>
                                <a href="#kontak" class="absolute bottom-[10px] right-[20px] sm:bottom-[18px] sm:right-[35px] text-[15px] sm:text-[17px] z-10 group mt-auto inline-flex items-center justify-end gap-3 font-semibold text-primary">
                                    Konsultasi
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 10.6429V1H1.71429M11 1L1 11" stroke-width="2" stroke-linecap="round" stroke="#113883" />
                                    </svg>
                                </a>

                                <img src="{{ asset('images/shapes/svg-F9FAFB-landscape.svg') }}" aria-hidden="true" class="absolute bottom-[-4px] right-[-1px] max-sm:w-40 w-48 pointer-events-none">
                            </article>
                            {{-- VIDEOTRON & DIGITAL DISPLAY --}}
                            <article class="service-card relative flex h-[273px] w-[280px] shrink-0 flex-col rounded-[20px] bg-white p-6 sm:h-[273px] sm:w-[320px] lg:w-[360px] xl:w-[380px]">
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#EEF1F6] text-primary">
                                    <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none">
                                        <rect x="4" y="6" width="24" height="17" rx="2" stroke="currentColor" stroke-width="2" />
                                        <path d="M11 27H21M16 23V27M9 11H23M9 15H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-[18px] md:text-[20px] font-bold text-primary">
                                    Videotron & Digital Display
                                </h3>
                                <p class="mt-3 text-[14px] leading-6 text-bodytext">
                                    Instalasi LED Videotron, interactive flat panel display meeting room, dan commercial digital signage.
                                </p>
                                <a href="#kontak" class="absolute bottom-[10px] right-[20px] sm:bottom-[18px] sm:right-[35px] text-[15px] sm:text-[17px] z-10 group mt-auto inline-flex items-center justify-end gap-3 font-semibold text-primary">
                                    Konsultasi
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 10.6429V1H1.71429M11 1L1 11" stroke-width="2" stroke-linecap="round" stroke="#113883" />
                                    </svg>
                                </a>

                                <img src="{{ asset('images/shapes/svg-F9FAFB-landscape.svg') }}" aria-hidden="true" class="absolute bottom-[-4px] right-[-1px] max-sm:w-40 w-48 pointer-events-none">
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- SOLUSI BERBAGAI SEKTOR --}}
        <section id="solusi-sektor" class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto w-full max-w-[1400px] px-6">
                {{-- BARIS 1: HEADER --}}
                <div class="mb-8 sm:mb-10" data-aos="fade-up">
                    <h2 class="text-3xl font-bold leading-tight text-[#102238] sm:text-4xl">
                        Solusi untuk Berbagai Sektor
                    </h2>
                    <p class="mt-3 max-w-[650px] text-[15px] leading-6 text-bodytext sm:text-base">
                        Solusi infrastruktur dan perangkat lunak yang dirancang khusus untuk memenuhi standar industri dan menyederhanakan operasional harian Anda.
                    </p>
                </div>

                {{-- BARIS 2: GAMBAR DAN KONTEN --}}
                <div x-data="sectorSolutions()" class="grid grid-cols-1 items-start gap-10 lg:grid-cols-2 xl:gap-20">
                    {{-- KOLOM KIRI: GAMBAR --}}
                    <div class="relative aspect-[4/3] w-full overflow-hidden rounded-[24px] sm:aspect-[5/4] lg:aspect-[4/3]" data-aos="fade-right">
                        <template x-for="(slide, index) in slides" :key="slide.category">
                            <div x-show="activeSlide === index" class="absolute inset-0" x-transition:enter="transition-opacity duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                <img :src="slide.image" :alt="slide.title" class="h-full w-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#113883]/95 via-[#113883]/20 to-transparent"></div>
                                <div class="absolute inset-x-0 bottom-0 p-6 text-white sm:p-8">
                                    <p class="text-xl font-bold sm:text-2xl" x-text="slide.category"></p>
                                    <p class="mt-2 max-w-sm text-sm leading-5 sm:text-[15px]" x-text="slide.title"></p>
                                </div>
                            </div>
                        </template>


                        {{-- NAVIGASI GAMBAR --}}
                        <img src="{{ asset('images/shapes/svg-white-landscape.svg') }}" aria-hidden="true" class="absolute bottom-[0px] right-[0px] max-sm:w-44 w-50 pointer-events-none">

                        <div class="absolute bottom-[17px] right-[10px] z-10 flex items-center gap-2">
                            <button type="button" @click="previous()" aria-label="Sektor sebelumnya"
                                class="group flex max-sm:h-[54px] max-sm:w-[54px] h-[62px] w-[62px] items-center justify-center rounded-l-xl border border-[#D8DDE7] bg-white transition-all duration-300 hover:border-primary hover:bg-primary disabled:cursor-not-allowed disabled:opacity-50">
                                <svg class="h-6 w-6 text-[#667085] transition-colors duration-300 group-hover:text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M15 18L9 12L15 6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <button type="button" @click="next()" aria-label="Sektor berikutnya"
                                class="group flex max-sm:h-[54px] max-sm:w-[54px] h-[62px] w-[62px] items-center justify-center rounded-r-xl border border-[#D8DDE7] bg-white transition-all duration-300 hover:border-primary hover:bg-primary disabled:cursor-not-allowed disabled:opacity-50">
                                <svg class="h-6 w-6 text-[#667085] transition-colors duration-300 group-hover:text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                    <path d="M9 18L15 12L9 6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: KONTEN --}}
                    <div data-aos="fade-left">
                        <h3 class="text-xl font-semibold leading-snug text-primary sm:text-2xl" x-text="slides[activeSlide].heading"></h3>
                        <p class="mt-4 text-sm leading-6 text-bodytext sm:text-[15px]" x-text="slides[activeSlide].description"></p>

                        <ul class="mt-5 space-y-5">
                            <template x-for="(feature, index) in slides[activeSlide].features" :key="index">
                                <li class="flex items-start gap-4">
                                    <span class="mt-1 flex h-[18px] w-[18px] shrink-0 items-center justify-center rounded-full bg-[#FFB800] text-white">
                                        <svg class="h-3 w-3" viewBox="0 0 16 16" fill="none">
                                            <path d="M3.5 8L6.5 11L12.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span class="text-sm leading-6 text-bodytext sm:text-[15px]" x-text="feature"></span>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- PORTOFOLIO & PROJECT --}}
        <section id="portofolio" class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto grid w-full max-w-[1400px] grid-cols-1 items-start gap-7 px-6 lg:grid-cols-[300px_minmax(0,1fr)] lg:gap-8 xl:grid-cols-[320px_minmax(0,1fr)] xl:gap-10">
                {{-- KOLOM KIRI: INTRODUCTION --}}
                <div class="relative flex min-h-[420px] flex-col overflow-hidden rounded-[26px] bg-[#F7F8FA] p-6 sm:min-h-[460px] sm:p-7 lg:sticky lg:top-28 lg:min-h-[440px] xl:p-8" data-aos="fade-up" data-aos-duration="800">
                    <h2 class="relative z-10 text-2xl font-extrabold leading-tight text-[#102238] sm:text-4xl">
                        Portofolio
                        <br>
                        & Project
                    </h2>
                    <p class="relative z-10 mt-4 max-w-[520px] text-[15px] leading-7 text-bodytext">
                        Pengalaman menangani instalasi skala menengah hingga proyek infrastruktur kritikal di seluruh wilayah Indonesia.
                    </p>
                    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-[220px] overflow-hidden sm:h-[250px]">
                        <img src="{{ asset('images/portfolio/illustration.png') }}" alt="" aria-hidden="true" class="absolute bottom-0 left-1/2 w-full -translate-x-1/2 object-cover">
                    </div>

                    <div class="">
                        <img src="{{ asset('images/shapes/svg-white-landscape-2.svg') }}" aria-hidden="true" class="absolute bottom-[0px] right-[-1px] w-48 pointer-events-none">

                        <a href="#daftar-portofolio" class="group absolute bottom-5 right-5 z-20 inline-flex items-center gap-1.5 text-md font-semibold text-primary">
                            Selengkapnya
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 10.6429V1H1.71429M11 1L1 11" stroke-width="2" stroke-linecap="round" stroke="#113883" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- KOLOM KANAN: DAFTAR PROJECT --}}
                <div id="daftar-portofolio" class="grid min-w-0 grid-cols-1 items-start gap-5 sm:grid-cols-2 sm:gap-6">

                    @forelse($portfolios as $portfolio)
                    {{-- Animasi delay bergantian: ganjil 100ms, genap 200ms --}}
                    <a href="#kontak" class="portfolio-card group relative flex min-w-0 flex-col overflow-hidden rounded-[22px] bg-[#F7F8FA] duration-500" data-aos="fade-up" data-aos-duration="800"
                        data-aos-delay="{{ $loop->iteration % 2 == 0 ? '200' : '100' }}">
                        <div
                            class="relative h-0 w-full overflow-hidden transition-[height] duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:h-[220px] group-focus-visible:h-[220px] sm:group-hover:h-[250px] sm:group-focus-visible:h-[250px]">
                            <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}" class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-100">
                        </div>
                        <div class="relative flex min-h-[174px] flex-col p-6 transition-colors duration-500">
                            <h3 class="max-w-[300px] text-lg font-semibold leading-snug text-[#333333]">
                                {{ $portfolio->title }}
                            </h3>
                            <p class="mt-2 text-sm text-bodytext">{{ $portfolio->category }}</p>

                            <span class="pointer-events-none absolute bottom-3 left-6 text-[48px] font-bold leading-none tracking-tight text-[#E1E4E8] transition-all duration-300 group-hover:opacity-0 sm:text-[54px]">{{ $portfolio->year }}</span>
                            <span
                                class="pointer-events-none absolute bottom-3 left-6 text-[48px] font-bold leading-none tracking-tight text-[#E1E4E8] opacity-0 transition-all duration-300 group-hover:opacity-100 sm:text-[54px]">{{ $portfolio->type }}</span>
                        </div>

                        <div class="">
                            <img src="{{ asset('images/shapes/svg-white-square.svg') }}" aria-hidden="true" class="absolute bottom-[0px] right-[-1px] w-24 pointer-events-none">
                            <svg class="absolute bottom-[16px] right-[16px] h-8 w-8 transition-transform duration-300 text-black" viewBox="0 0 32 32" fill="none">
                                <path d="M8 24L24 8M10 8H24V22" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>
                    @empty
                    <div class="col-span-1 sm:col-span-2 py-12 text-center text-gray-400 text-sm border-2 border-dashed border-gray-200 rounded-[22px]">
                        Belum ada project yang ditambahkan di database.
                    </div>
                    @endforelse

                </div>
            </div>
        </section>

        {{-- CARA KAMI BEKERJA --}}
        <section id="cara-kerja" class="bg-white pb-16 sm:pb-20 lg:pb-24">
            <div class="mx-auto w-full max-w-[1400px] px-6">

                {{-- Container dengan tinggi pasti 2500px agar GSAP scroll berjalan mulus --}}
                <div id="workflow-story" class="relative h-[2500px]">

                    {{-- WRAPPER UTAMA --}}
                    {{-- Mobile: Flex & tinggi full 2500px. Desktop: Grid & Card otomatis menjadi sticky --}}
                    <div id="workflow-card" class="flex h-full flex-col gap-6 sm:gap-10 lg:h-auto lg:grid lg:sticky lg:top-[max(6rem,calc(50vh-280px))] lg:grid-cols-2 lg:gap-36 lg:min-h-[560px]" data-aos="fade-up" data-aos-duration="900">

                        {{-- KOLOM KIRI (Judul & Gambar) --}}
                        {{-- shrink-0 memastikan ukurannya tidak memuai, akan scroll normal ke atas di mobile --}}
                        <div class="shrink-0 flex flex-col justify-center pt-8 lg:pt-0" data-aos="fade-right" data-aos-delay="100">
                            <h2 class="text-3xl font-extrabold leading-tight text-[#102238] sm:text-4xl">
                                Bagaimana Cara Kami Bekerja?
                            </h2>
                            <p class="mt-4 max-w-[480px] text-[15px] leading-7 text-bodytext">
                                Pendekatan strategis untuk memastikan solusi teknologi yang tepat guna dan berkelanjutan untuk klien kami.
                            </p>

                            {{-- GAMBAR & TAUTAN --}}
                            <div class="relative mt-6 h-[240px] w-full overflow-hidden rounded-[26px] sm:mt-8 sm:h-[280px] lg:h-[350px]">
                                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=85" alt="Tim sedang berdiskusi" class="h-full w-full object-cover">

                                <div class="">
                                    <img src="{{ asset('images/shapes/svg-white-landscape-2.svg') }}" aria-hidden="true" class="absolute bottom-[0px] right-[-1px] w-48 pointer-events-none">

                                    <a href="#daftar-portofolio" class="group absolute bottom-5 right-9 z-20 inline-flex items-center gap-1.5 text-md font-semibold text-primary">
                                        Konsultasi
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11 10.6429V1H1.71429M11 1L1 11" stroke-width="2" stroke-linecap="round" stroke="#113883" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- JALUR LINTASAN KOLOM KANAN (Mobile) --}}
                        {{-- flex-1 mengambil sisa tinggi dari 2500px, memberi ruang sangat panjang untuk sticky --}}
                        <div class="flex-1 lg:flex-none">

                            {{-- KOLOM KANAN: DAFTAR LANGKAH (Sticky di Mobile) --}}
                            <div class="sticky top-[max(7rem,calc(50vh-230px))] sm:top-[max(9rem,calc(50vh-270px))] lg:static lg:top-auto flex w-full flex-col items-center justify-center pb-[60px] pt-5 sm:pb-[80px] lg:items-start lg:py-10"
                                data-aos="fade-left" data-aos-delay="200">

                                {{-- CONTAINER ABSOLUTE UNTUK PRESISI LENGKUNGAN --}}
                                <div class="relative h-[400px] w-[400px] sm:h-[480px] lg:h-[520px] lg:w-full">

                                    {{-- SVG Garis Lengkung Putus-putus --}}
                                    <div class="absolute top-[16px] h-full w-[70px] pointer-events-none left-[57px] sm:left-[61px]">
                                        <svg class="h-full w-full overflow-visible" preserveAspectRatio="none" viewBox="0 0 100 100">
                                            <path d="M 100 0 Q -100 50 100 100" fill="none" stroke="#D8DDE7" stroke-width="1.5" stroke-dasharray="6 6" stroke-linecap="round" vector-effect="non-scaling-stroke" />
                                        </svg>
                                    </div>

                                    {{-- LANGKAH 1 --}}
                                    <div class="workflow-item absolute left-[70px] w-full flex items-start gap-4 sm:gap-5" style="top: 0%;" data-index="0">
                                        <span class="workflow-number w-[35px] shrink-0 text-right text-3xl font-bold text-primary sm:text-[34px]">01</span>
                                        <div class="relative mt-[10px] flex shrink-0 items-center justify-center">
                                            <div class="workflow-dot relative z-10 h-3 w-3 rounded-full border-2 border-primary bg-primary ring-[6px] ring-white"></div>
                                        </div>
                                        <div class="pt-1">
                                            <h3 class="workflow-title text-xl font-bold text-[#102238]">Konsultasi</h3>
                                            <p class="workflow-description mt-1.5 text-[14px] sm:text-[15px] text-bodytext">Klien menyampaikan permasalahan.</p>
                                        </div>
                                    </div>

                                    {{-- LANGKAH 2 --}}
                                    <div class="workflow-item absolute left-[18px] w-full flex items-start gap-4 sm:gap-5 opacity-30" style="top: 25%;" data-index="1">
                                        <span class="workflow-number w-[35px] shrink-0 text-right text-3xl font-bold text-[#C9D2E3] sm:text-[34px]">02</span>
                                        <div class="relative mt-[10px] flex shrink-0 items-center justify-center">
                                            <div class="workflow-dot relative z-10 h-3 w-3 rounded-full border-2 border-[#E5E7EB] bg-white ring-[6px] ring-white"></div>
                                        </div>
                                        <div class="pt-1">
                                            <h3 class="workflow-title text-xl font-bold text-[#C9D2E3]">Analisis Kebutuhan</h3>
                                            <p class="workflow-description mt-1.5 text-[14px] sm:text-[15px] text-[#C9D2E3]">Tim merancang spesifikasi teknis.</p>
                                        </div>
                                    </div>

                                    {{-- LANGKAH 3 --}}
                                    <div class="workflow-item absolute left-0 w-full flex items-start gap-4 sm:gap-5 opacity-30" style="top: 50%;" data-index="2">
                                        <span class="workflow-number w-[35px] shrink-0 text-right text-3xl font-bold text-[#C9D2E3] sm:text-[34px]">03</span>
                                        <div class="relative mt-[10px] flex shrink-0 items-center justify-center">
                                            <div class="workflow-dot relative z-10 h-3 w-3 rounded-full border-2 border-[#E5E7EB] bg-white ring-[6px] ring-white"></div>
                                        </div>
                                        <div class="pt-1">
                                            <h3 class="workflow-title text-xl font-bold text-[#C9D2E3]">Perancangan</h3>
                                            <p class="workflow-description mt-1.5 text-[14px] sm:text-[15px] text-[#C9D2E3]">Pembuatan arsitektur sistem.</p>
                                        </div>
                                    </div>

                                    {{-- LANGKAH 4 --}}
                                    <div class="workflow-item absolute left-[18px] w-full flex items-start gap-4 sm:gap-5 opacity-30" style="top: 75%;" data-index="3">
                                        <span class="workflow-number w-[35px] shrink-0 text-right text-3xl font-bold text-[#C9D2E3] sm:text-[34px]">04</span>
                                        <div class="relative mt-[10px] flex shrink-0 items-center justify-center">
                                            <div class="workflow-dot relative z-10 h-3 w-3 rounded-full border-2 border-[#E5E7EB] bg-white ring-[6px] ring-white"></div>
                                        </div>
                                        <div class="pt-1">
                                            <h3 class="workflow-title text-xl font-bold text-[#C9D2E3]">Pengembangan</h3>
                                            <p class="workflow-description mt-1.5 text-[14px] sm:text-[15px] text-[#C9D2E3]">Implementasi & instalasi.</p>
                                        </div>
                                    </div>

                                    {{-- LANGKAH 5 --}}
                                    <div class="workflow-item absolute left-[70px] w-full flex items-start gap-4 sm:gap-5 opacity-30" style="top: 100%;" data-index="4">
                                        <span class="workflow-number w-[35px] shrink-0 text-right text-3xl font-bold text-[#C9D2E3] sm:text-[34px]">05</span>
                                        <div class="relative mt-[10px] flex shrink-0 items-center justify-center">
                                            <div class="workflow-dot relative z-10 h-3 w-3 rounded-full border-2 border-[#E5E7EB] bg-white ring-[6px] ring-white"></div>
                                        </div>
                                        <div class="pt-1">
                                            <h3 class="workflow-title text-xl font-bold text-[#C9D2E3]">Pemeliharaan</h3>
                                            <p class="workflow-description mt-1.5 text-[14px] sm:text-[15px] text-[#C9D2E3]">Dukungan SLA berkelanjutan.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- PARTNER & KLIEN KAMI --}}
        <section id="klien" class="bg-white py-16 sm:py-20 lg:py-24 overflow-hidden">
            <div class="mx-auto w-full max-w-[1400px] px-6 text-center" data-aos="fade-up" data-aos-duration="800">
                <h2 class="text-3xl font-bold leading-tight text-[#102238] sm:text-4xl">
                    Partner & Klien Kami
                </h2>
                <p class="mx-auto mt-4 max-w-[600px] text-[15px] leading-7 text-bodytext">
                    Mitra teknologi terpercaya bagi BUMN, instansi kementerian daerah, rumah sakit, dan swasta nasional.
                </p>
            </div>

            <!-- Marquee Container -->
            <!-- Class 'group' mendeteksi kursor untuk mengontrol animasi -->
            <div class="relative mt-12 flex overflow-x-hidden group" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <!-- Efek Blur Gradien (Kiri & Kanan) -->
                <div class="pointer-events-none absolute bottom-0 left-0 top-0 z-10 w-16 bg-gradient-to-r from-white to-transparent sm:w-32"></div>
                <div class="pointer-events-none absolute bottom-0 right-0 top-0 z-10 w-16 bg-gradient-to-l from-white to-transparent sm:w-32"></div>

                @if($clients->count() > 0)
                <!-- Marquee Track -->
                <!-- Animasi akan dijeda saat area ini di-hover berkat group-hover:[animation-play-state:paused] -->
                <div class="animate-marquee flex w-max items-center gap-6 py-1 pr-6 group-hover:[animation-play-state:paused]">

                    <!-- Set 1 (Data Asli dari Database) -->
                    @foreach($clients as $client)
                    <div
                        class="flex h-[110px] w-[180px] shrink-0 items-center justify-center rounded-[20px] border border-[#D8DDE7] bg-white p-4 transition-transform duration-300 hover:-translate-y-1 hover:border-primary hover:shadow-[0_4px_20px_-5px_rgba(6,81,237,0.15)] sm:h-[130px] sm:w-[220px]">
                        <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="max-h-full max-w-full object-contain grayscale transition-all duration-300 hover:grayscale-0">
                    </div>
                    @endforeach

                    <!-- Set 2 (Duplikat wajib untuk infinite loop animasi marquee) -->
                    @foreach($clients as $client)
                    <div
                        class="flex h-[110px] w-[180px] shrink-0 items-center justify-center rounded-[20px] border border-[#D8DDE7] bg-white p-4 transition-transform duration-300 hover:-translate-y-1 hover:border-primary hover:shadow-[0_4px_20px_-5px_rgba(6,81,237,0.15)] sm:h-[130px] sm:w-[220px]">
                        <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="max-h-full max-w-full object-contain grayscale transition-all duration-300 hover:grayscale-0">
                    </div>
                    @endforeach

                </div>
                @else
                <div class="w-full text-center py-8 text-gray-400 text-sm">
                    Belum ada data klien yang ditambahkan.
                </div>
                @endif
            </div>
        </section>

        {{-- BLOG / BERITA --}}
        <section id="blog" class="bg-white py-16 sm:py-20 lg:py-24 overflow-hidden">
            <div class="mx-auto w-full max-w-[1400px] px-6">

                <div x-data="blogSlider()" class="flex flex-col lg:flex-row gap-6 lg:gap-8 items-stretch">

                    {{-- PANEL JUDUL & DESKRIPSI (Kiri) --}}
                    {{-- Lebar panel diperkecil menjadi w-[320px] --}}
                    <div class="w-full lg:w-[280px] shrink-0" data-aos="fade-right" data-aos-duration="800">
                        <div class="relative bg-[#F9FAFB] rounded-[24px] p-7 md:p-8 h-full flex flex-col min-h-[300px]">
                            <h2 class="text-3xl font-extrabold text-[#102238] mb-3">Blog</h2>
                            <p class="text-[14px] leading-relaxed text-bodytext mb-8">
                                Sumber berita perkembangan infrastruktur teknologi dari tim ATN.
                            </p>

                            <div class="mt-auto flex items-end justify-between relative">
                                <a href="#" class="inline-flex items-center gap-1.5 text-[15px] text-primary font-semibold hover:underline">
                                    Selengkapnya
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>

                                <div class="absolute -right-7 -bottom-7 md:-right-8 md:-bottom-8 bg-white rounded-tl-[24px] p-3 flex gap-0 border-t border-l border-white">
                                    <button @click="prev()" :disabled="atStart" class="w-10 h-10 flex items-center justify-center border border-gray-200 rounded-l-lg bg-white hover:bg-gray-50 text-gray-600 disabled:opacity-50 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </button>
                                    <button @click="next()" :disabled="atEnd"
                                        class="w-10 h-10 flex items-center justify-center border-y border-r border-gray-200 rounded-r-lg bg-white hover:bg-gray-50 text-gray-600 disabled:opacity-50 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SLIDER ARTIKEL (Kanan) --}}
                    <div class="w-full overflow-hidden" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                        {{-- Gap antar card diubah menjadi gap-5 (20px) --}}
                        <div class="flex gap-5 transition-transform duration-500 ease-in-out" :style="`transform: translateX(-${scrollPosition}px)`" x-ref="sliderContainer">

                            <template x-for="(blog, index) in blogs" :key="index">
                                {{-- Ukuran card artikel diperkecil --}}
                                <article class="w-[220px] lg:w-[240px] shrink-0 group cursor-pointer">
                                    <div class="relative overflow-hidden rounded-[20px] mb-4 aspect-[16/10] bg-slate-100">
                                        <img :src="blog.img" :alt="blog.title" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        {{-- Desain irisan tanggal mirip dengan mockup --}}
                                        <div class="absolute bottom-0 left-0 bg-white rounded-tr-[16px] px-3 py-1.5">
                                            <span class="text-[11px] font-semibold text-slate-600" x-text="blog.date"></span>
                                        </div>
                                    </div>
                                    <h3 class="text-[16px] font-bold text-[#102238] mb-1.5 group-hover:text-primary transition-colors line-clamp-2" x-text="blog.title"></h3>
                                    <p class="text-[13px] text-bodytext leading-relaxed line-clamp-3" x-text="blog.desc"></p>
                                </article>
                            </template>

                        </div>
                    </div>
                </div>

            </div>
        </section>

        {{-- FOOTER --}}
        <footer class="bg-white pb-10 pt-4">
            <div class="mx-auto w-full max-w-[1400px] px-6">

                {{-- Container Utama Footer --}}
                <div class="relative bg-[#1A1C1F] rounded-[32px] px-8 py-10 md:px-12 md:py-14 lg:p-16 flex flex-col lg:flex-row gap-12 lg:gap-16 overflow-hidden" data-aos="fade-up" data-aos-duration="1000">

                    {{-- CUTOUT LOGO AREA --}}
                    {{-- Area putih yang menutupi sudut kiri atas footer gelap --}}
                    <div class="absolute top-0 left-0 bg-white rounded-br-[32px] z-10 pr-8 pb-6 max-md:pr-6 max-md:pb-5">
                        <img src="{{ asset('images/logo-atn.png') }}" alt="Arjuna Travora Nusantara" class="h-10 md:h-12 mt-6 ml-8 max-md:mt-5 max-md:ml-6">

                        {{-- Efek Lengkungan Sudut (Inverted Border Radius) --}}
                        <div class="absolute top-0 -right-6 w-6 h-6 bg-transparent rounded-tl-[24px] shadow-[-10px_-10px_0_0_#ffffff] pointer-events-none"></div>
                        <div class="absolute -bottom-6 left-0 w-6 h-6 bg-transparent rounded-tl-[24px] shadow-[-10px_-10px_0_0_#ffffff] pointer-events-none"></div>
                    </div>

                    {{-- KOLOM 1: KONTAK & SOSIAL MEDIA --}}
                    {{-- mt-24 pada mobile untuk memberi ruang pada logo cutout --}}
                    <div class="w-full lg:w-[380px] shrink-0 flex flex-col mt-20 lg:mt-4">

                        {{-- Card Kontak --}}
                        <div class="bg-[#24262A] rounded-2xl p-6 flex flex-col gap-6">

                            @php
                            // Format nomor untuk link WhatsApp (hilangkan spasi/strip, ganti 0 di depan jadi 62)
                            $rawPhone = preg_replace('/[^0-9]/', '', $setting->phone ?? '082142430296');
                            $waLink = preg_replace('/^0/', '62', $rawPhone);
                            @endphp

                            {{-- WhatsApp --}}
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 shrink-0 rounded-xl bg-[#0F291E] flex items-center justify-center text-[#25D366]">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12.031 0C5.385 0 0 5.385 0 12.031c0 2.12.553 4.17 1.604 5.986L.04 24l6.125-1.606a11.968 11.968 0 005.866 1.53h.005c6.645 0 12.03-5.385 12.03-12.03S18.676 0 12.031 0zm0 21.916a9.98 9.98 0 01-5.093-1.39l-.365-.217-3.784.992.99-3.69-.237-.378a9.96 9.96 0 01-1.523-5.334c0-5.534 4.502-10.037 10.037-10.037s10.036 4.503 10.036 10.037-4.501 10.02-10.036 10.02zm5.512-7.534c-.302-.15-1.787-.882-2.063-.983-.277-.101-.479-.151-.68.151-.202.302-.781.983-.957 1.184-.176.202-.353.227-.655.076-1.523-.761-2.617-1.428-3.606-3.136-.202-.349.198-.328.636-.882.08-.101.121-.202.161-.302.04-.101.02-.202-.02-.302-.04-.101-.68-1.64-.932-2.245-.245-.591-.495-.512-.68-.521-.176-.008-.378-.008-.579-.008s-.529.076-.806.378c-.277.302-1.058 1.033-1.058 2.518s1.083 2.921 1.234 3.123c.151.202 2.131 3.255 5.162 4.561 1.838.791 2.535.882 3.483.743.766-.113 2.368-.968 2.701-1.905.332-.937.332-1.74.232-1.905-.101-.166-.353-.267-.655-.418z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 mb-0.5">WhatsApp</p>
                                    <a href="https://wa.me/{{ $waLink }}" target="_blank" class="text-sm font-semibold text-white hover:text-[#25D366] transition-colors">
                                        {{ $setting->phone ?? '0821-4243-0296' }}
                                    </a>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 shrink-0 rounded-xl bg-[#2D1A1A] flex items-center justify-center text-[#EA4335]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 mb-0.5">Email</p>
                                    <a href="mailto:{{ $setting->email ?? 'info@arjunatravora.co.id' }}" class="text-sm font-semibold text-white hover:text-[#EA4335] transition-colors">
                                        {{ $setting->email ?? 'info@arjunatravora.co.id' }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Social Media --}}
                        <div class="mt-8">
                            <h4 class="text-xs font-bold text-gray-400 tracking-wider mb-4 uppercase">Connect With Us</h4>
                            <div class="flex gap-3">
                                <a href="#" class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center text-gray-300 hover:bg-[#113883] hover:border-[#113883] hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center text-gray-300 hover:bg-[#113883] hover:border-[#113883] hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center text-gray-300 hover:bg-[#113883] hover:border-[#113883] hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full border border-gray-600 flex items-center justify-center text-gray-300 hover:bg-[#113883] hover:border-[#113883] hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        {{-- Copyright --}}
                        <div class="mt-8 pt-6 border-t border-gray-700 w-full">
                            <p class="text-[13px] text-gray-400">© 2026 PT. Arjuna Travora Nusantara. All Rights Reserved.</p>
                        </div>
                    </div>

                    {{-- KOLOM 2: NAVIGASI --}}
                    <div class="w-full lg:w-[220px] shrink-0 lg:border-l lg:border-gray-700 lg:pl-12 flex flex-col mt-4 lg:mt-8">
                        <h4 class="text-xs font-bold text-gray-400 tracking-wider mb-6 uppercase">Navigasi Utama</h4>
                        <ul class="flex flex-col gap-4">
                            <li><a href="#layanan" class="text-gray-300 hover:text-white text-[15px] transition-colors">Layanan</a></li>
                            <li><a href="#solusi-sektor" class="text-gray-300 hover:text-white text-[15px] transition-colors">Solusi</a></li>
                            <li><a href="#tentang-kami" class="text-gray-300 hover:text-white text-[15px] transition-colors">Tentang Kami</a></li>
                            <li><a href="#portofolio" class="text-gray-300 hover:text-white text-[15px] transition-colors">Portofolio</a></li>
                            <li><a href="#blog" class="text-gray-300 hover:text-white text-[15px] transition-colors">Blog</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white text-[15px] transition-colors">Karir</a></li>
                            <li><a href="#kontak" class="text-gray-300 hover:text-white text-[15px] transition-colors">Hubungi Kami</a></li>
                        </ul>
                    </div>

                    {{-- KOLOM 3: KANTOR OPERASIONAL --}}
                    <div class="w-full flex-1 flex flex-col mt-4 lg:mt-8">
                        <div class="flex items-start gap-4 mb-5">
                            <div class="w-10 h-10 shrink-0 rounded-full bg-[#2D1A1A] flex items-center justify-center text-[#EA4335]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="pt-0.5">
                                <h4 class="text-xs font-bold text-gray-400 tracking-wider uppercase mb-1">Kantor Operasional</h4>
                                <p class="text-white text-[15px] font-semibold">{{ $setting->address ?? 'Mojokerto, Jawa Timur, Indonesia.' }}</p>
                            </div>
                        </div>

                        {{-- Google Maps Area --}}
                        <div class="w-full h-[200px] md:h-[220px] rounded-[20px] overflow-hidden bg-gray-800 relative group">
                            {{-- Placeholder Map, ganti src dengan asset map asli Anda jika ada --}}
                            <img src="https://placehold.co/800x400/24262A/667085?text=Peta+Lokasi+Mojokerto" alt="Peta Lokasi" class="w-full h-full object-cover">

                            {{-- Overlay CTA untuk Maps (Opsional untuk interaktifitas) --}}
                            <a href="https://maps.google.com" target="_blank" class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                                <span class="bg-white text-slate-900 px-5 py-2.5 rounded-xl text-sm font-semibold">Buka di Google Maps</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </main>



    <script>
        function heroSlider() {
            return {
                activeSlide: 0,
                // Mengambil data dinamis dari database menggunakan Blade
                slides: [
                    @forelse($heroes as $hero)
                    {
                        main: "{{ asset('storage/' . $hero->main_image) }}",
                        side: "{{ asset('storage/' . $hero->side_image) }}",
                        alt: "{{ $hero->label }}",
                        label: "{{ $hero->label }}",
                        description: "{{ $hero->description }}"
                    },
                    @empty
                    // Fallback (cadangan) jika database kosong agar slider tidak error
                    {
                        main: 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1600&q=85',
                        side: 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=900&q=85',
                        alt: 'Teknologi dan infrastruktur digital',
                        label: 'B2B Technology',
                        description: 'Belum ada data hero di database.'
                    }
                    @endforelse
                ],
                next() {
                    if (this.slides.length === 0) return;
                    this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                },
                previous() {
                    if (this.slides.length === 0) return;
                    this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
                }
            }
        }

        function sectorSolutions() {
            return {
                activeSlide: 0,
                slides: [
                    {
                        category: "HealthCare",
                        title: "Sistem Manajemen Rumah Sakit (SIMRS) & Keamanan Data Medis",
                        image: "{{ asset('images/solutions/healthcare.png') }}",
                        heading: "Sistem Manajemen Rumah Sakit (SIMRS) & Keamanan Data Medis",
                        description: "Membangun ekosistem digital rumah sakit yang aman dan terintegrasi. Kami memastikan sistem Rekam Medis Elektronik (RME) terhubung lancar dengan operasional klinis, didukung infrastruktur anti-down dan perlindungan data pasien standar Kemenkes.",
                        features: [
                            "Integrasi dengan platform SatuSehat Kemenkes RI serta enkripsi data end-to-end untuk keamanan maksimal.",
                            "Jaringan internet ganda (Dual-ISP) dengan failover otomatis untuk menjaga operasional rumah sakit tetap berjalan 24/7.",
                            "Pemantauan keamanan terpusat melalui Smart CCTV dan sensor suhu IoT untuk ruang farmasi."
                        ]
                    },
                    {
                        category: "Corporate",
                        title: "Global SD-WAN Mesh & Akses Private Multi-Cloud",
                        image: "{{ asset('images/solutions/corporate.png') }}",
                        heading: "Global SD-WAN Mesh & Akses Private Multi-Cloud",
                        description: "Optimalisasi konektivitas kantor cabang terdistribusi dengan orkestrasi software-defined WAN, koneksi cloud, dan perlindungan jaringan berbasis zero-trust.",
                        features: [
                            "Optimasi jalur koneksi jaringan untuk meningkatkan efisiensi dan mengurangi biaya operasional.",
                            "Integrasi Zero Trust Network Access (ZTNA) dan CASB untuk mendukung akses kerja yang aman.",
                            "Konektivitas cloud yang andal dengan pemantauan jaringan secara real-time."
                        ]
                    },
                    {
                        category: "Government",
                        title: "Intranet Berdaulat Tertutup & Integrasi SPBE Nasional",
                        image: "{{ asset('images/solutions/government.png') }}",
                        heading: "Intranet Berdaulat Tertutup & Integrasi SPBE Nasional",
                        description: "Infrastruktur komunikasi data tertutup untuk mendukung kedaulatan data, integrasi pusat data nasional, serta pengamanan informasi instansi pemerintah.",
                        features: [
                            "Arsitektur jaringan tertutup melalui Dedicated Private APN.",
                            "Dukungan infrastruktur untuk memenuhi kebutuhan keamanan dan regulasi SPBE.",
                            "Interkoneksi antarinstansi dengan perlindungan dan enkripsi jaringan."
                        ]
                    }
                ],
                next() {
                    this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                },
                previous() {
                    this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
                }
            };
        }
    </script>

</body>

</html>