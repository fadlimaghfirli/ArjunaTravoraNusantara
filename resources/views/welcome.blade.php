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

    <main class="h-[10000px]">

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

                        <img src="{{ asset('images/shapes/svg-white-potrait.svg') }}" alt="" aria-hidden="true" class="max-md:hidden absolute md:bottom-[54px] lg:bottom-[80px] right-[-4px] h-[131px] w-[112px] pointer-events-none">
                        <img src="{{ asset('images/shapes/svg-white-landscape.svg') }}" alt="" aria-hidden="true" class="md:hidden absolute bottom-[46px] right-[-1px] w-50 pointer-events-none">


                        {{-- Tombol slider --}}
                        <div class="absolute bottom-[60px] md:bottom-[75px] lg:bottom-[100px] max-md:right-[10px] right-[-76px] z-50 flex items-center gap-1.5">
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

                        <img src="{{ asset('images/shapes/svg-white-potrait.svg') }}" alt="" aria-hidden="true" class="absolute bottom-[-7px] left-[-3px] h-[131px] w-[112px] -scale-x-100 pointer-events-none">

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
                                    500+
                                </p>
                                <p class="mt-1.5 text-[12px] md:text-[16px]  text-bodytext">
                                    Projek Selesai
                                </p>
                            </div>
                            <div>
                                <p class="text-[27px] font-bold leading-none tracking-[-0.03em] text-primary sm:text-[30px]">
                                    40+
                                </p>
                                <p class="mt-1.5 text-[12px] md:text-[16px]  text-bodytext">
                                    Klien Terpercaya
                                </p>
                            </div>
                            <div>
                                <p class="text-[27px] font-bold leading-none tracking-[-0.03em] text-primary sm:text-[30px]">
                                    ISO/IEC
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
                    <div id="advantages-card" class="sticky top-24 grid min-h-[680px] overflow-hidden rounded-[22px] bg-[#F5F6F8] md:top-32 md:min-h-[560px] md:grid-cols-2 lg:top-40 lg:min-h-[560px]" data-aos="fade-up" data-aos-duration="900"
                        data-aos-easing="ease-out-cubic">
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
                    <div id="services-viewport" class="mt-8 overflow-hidden pl-6 lg:pl-[max(24px,calc((100vw-1400px)/2))]">
                        <div id="services-track" class="flex w-max gap-7 pr-6 lg:gap-8 pr-[240px] lg:pr-[440px]">
                            {{-- SOFTWARE DEVELOPMENT --}}
                            <article class="service-card relative flex h-[273px] w-[280px] shrink-0 flex-col rounded-[20px] bg-white p-6 sm:w-[320px] lg:w-[360px] xl:w-[380px]">
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#EEF1F6] text-[#102238]">
                                    <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none">
                                        <rect x="5" y="4" width="22" height="18" rx="2" stroke="currentColor" stroke-width="2" />
                                        <path d="M11 28H21M16 22V28M11 14L14 17L11 20M21 14L18 17L21 20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-[18px] font-bold text-[#102238]">
                                    Software Development
                                </h3>
                                <p class="mt-3 text-[14px] leading-5 text-bodytext">
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
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#EEF1F6] text-[#102238]">
                                    <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none">
                                        <rect x="8" y="8" width="16" height="16" rx="2" stroke="currentColor" stroke-width="2" />
                                        <rect x="12" y="12" width="8" height="8" rx="1" stroke="currentColor" stroke-width="2" />
                                        <path d="M8 12H4M8 16H4M8 20H4M28 12H24M28 16H24M28 20H24M12 8V4M16 8V4M20 8V4M12 28V24M16 28V24M20 28V24" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-[18px] font-bold text-[#102238]">
                                    Hardware Procurement
                                </h3>
                                <p class="mt-3 text-[14px] leading-5 text-bodytext">
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
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#EEF1F6] text-[#102238]">
                                    <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none">
                                        <path d="M6 25H26M8 25V16H13V25M13 16L17 12L21 16M21 16V25M21 11C23 11 25 9 25 7M21 7C22 7 23 6 23 5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-[18px] font-bold text-[#102238]">
                                    IT Infrastructure
                                </h3>
                                <p class="mt-3 text-[14px] leading-5 text-bodytext">
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
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#EEF1F6] text-[#102238]">
                                    <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none">
                                        <rect x="5" y="10" width="16" height="11" rx="2" stroke="currentColor" stroke-width="2" />
                                        <path d="M21 14L27 11V21L21 18M10 24H22M16 21V24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-[18px] font-bold text-[#102238]">
                                    CCTV & Security
                                </h3>
                                <p class="mt-3 text-[14px] leading-5 text-bodytext">
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
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-[#EEF1F6] text-[#102238]">
                                    <svg class="h-8 w-8" viewBox="0 0 32 32" fill="none">
                                        <rect x="4" y="6" width="24" height="17" rx="2" stroke="currentColor" stroke-width="2" />
                                        <path d="M11 27H21M16 23V27M9 11H23M9 15H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-[18px] font-bold text-[#102238]">
                                    Videotron & Digital Display
                                </h3>
                                <p class="mt-3 text-[14px] leading-5 text-bodytext">
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
    </main>



    <script>
        function heroSlider() {
            return {
                activeSlide: 0,
                slides: [
                    {
                        main: 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1600&q=85',
                        side: 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=900&q=85',
                        alt: 'Teknologi dan infrastruktur digital',
                        label: 'B2B Technology',
                        description: 'Solution & Procurement Partner.'
                    },
                    {
                        main: 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1600&q=85',
                        side: 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=900&q=85',
                        alt: 'Solusi teknologi untuk berbagai sektor',
                        label: 'Technology Solution',
                        description: 'Solusi teknologi terintegrasi.'
                    }
                ],
                next() {
                    this.activeSlide =
                        (this.activeSlide + 1) % this.slides.length
                },
                previous() {
                    this.activeSlide =
                        (this.activeSlide - 1 + this.slides.length)
                        % this.slides.length
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