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

                        <img src="{{ asset('images/shapes/hero-cutout.svg') }}" alt="" aria-hidden="true" class="max-md:hidden absolute md:bottom-[54px] lg:bottom-[80px] right-[-4px] h-[131px] w-[112px] pointer-events-none">
                        <img src="{{ asset('images/shapes/hero-cutout-2.svg') }}" alt="" aria-hidden="true" class="md:hidden absolute bottom-[46px] right-[-1px] w-50 pointer-events-none">


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

                        <img src="{{ asset('images/shapes/hero-cutout.svg') }}" alt="" aria-hidden="true" class="absolute bottom-[-7px] left-[-3px] h-[131px] w-[112px] -scale-x-100 pointer-events-none">

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
                                <article class="advantage-item is-active relative border-l-2 border-[#D8DDE7] pl-4 sm:pl-5" data-index="0" data-aos="fade-up" data-aos-duration="700" data-aos-delay="500">
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
                                <article class="advantage-item relative mt-5 border-l-2 border-[#D8DDE7] pl-4 transition-all duration-500 sm:pl-5" data-index="1" data-aos="fade-up" data-aos-duration="700" data-aos-delay="600">
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
                                <article class="advantage-item relative mt-5 border-l-2 border-[#D8DDE7] pl-4 transition-all duration-500 sm:pl-5" data-index="2" data-aos="fade-up" data-aos-duration="700" data-aos-delay="700">
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
                                <article class="advantage-item relative mt-5 border-l-2 border-[#D8DDE7] pl-4 transition-all duration-500 sm:pl-5" data-index="3" data-aos="fade-up" data-aos-duration="700" data-aos-delay="800">
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

                            {{-- <img src="{{ asset('images/shapes/hero-cutout.svg') }}" alt="" aria-hidden="true" class="max-md:hidden absolute md:bottom-[54px] lg:bottom-[80px] right-[-4px] h-[131px] w-[112px] pointer-events-none"> --}}
                            <div class="absolute bottom-[-4px] right-[100px] h-[84.5px] sm:h-[101px] max-sm:w-40 w-48 pointer-events-none overflow-hidden flex items-end justify-end">
                                <img src="{{ asset('images/shapes/hero-cutout-2.svg') }}" aria-hidden="true" class="w-48 pointer-events-none">
                            </div>
                            <div class="absolute bottom-[-4px] right-[140px] sm:right-[150px] h-[84.5px] sm:h-[101px] max-sm:w-40 w-48 pointer-events-none overflow-hidden flex items-end justify-end">
                                <img src="{{ asset('images/shapes/hero-cutout-2.svg') }}" aria-hidden="true" class="w-48 pointer-events-none">
                            </div>
                            <img src="{{ asset('images/shapes/hero-cutout-2.svg') }}" aria-hidden="true" class="absolute bottom-[-4px] right-[-1px] max-sm:w-40 w-48 pointer-events-none">
                        </div>
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
    </script>

</body>

</html>