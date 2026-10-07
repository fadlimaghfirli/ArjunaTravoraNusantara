{{-- resources/views/components/navbar.blade.php --}}

<nav x-data="{
        mobileOpen: false,
        languageOpen: false,
        scrolled: false
    }" x-init="
        window.addEventListener('scroll', () => {
            scrolled = window.scrollY > 30
        })
    " class="fixed inset-x-0 top-0 z-[100] px-4 pt-3 sm:px-6 lg:px-8">
    <div class="mx-auto w-full max-w-[1400px]">

        <div class="relative rounded-[16px] lg:rounded-[20px] border border-white/60 bg-white/50 shadow-[0_10px_40px_rgba(17,56,131,0.08)] backdrop-blur-md transition-all duration-300" :class="scrolled
                ? 'bg-white/80 shadow-[0_12px_40px_rgba(17,56,131,0.13)]'
                : 'bg-white/75'">

            {{-- ================= DESKTOP ================= --}}
            <div class="hidden h-[86px] items-center px-8 lg:flex xl:px-10">

                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex shrink-0 items-center">
                    <img src="{{ asset('images/logo-atn.png') }}" alt="Arjuna Travora Nusantara" class="h-[40px] w-auto">
                </a>


                {{-- Navigation --}}
                <div class="m-auto flex items-center gap-8 xl:gap-9">

                    <a href="#beranda" class="relative text-[14px] font-medium text-primary">
                        Beranda

                        <span class="absolute -bottom-3 left-1/2 h-[2px] w-5 -translate-x-1/2 rounded-full bg-primary"></span>
                    </a>

                    <a href="#tentang" class="text-[14px] font-medium text-bodytext transition-colors hover:text-primary">
                        Tentang
                    </a>

                    <a href="#layanan" class="text-[14px] font-medium text-bodytext transition-colors hover:text-primary">
                        Layanan
                    </a>

                    <a href="#portofolio" class="text-[14px] font-medium text-bodytext transition-colors hover:text-primary">
                        Portofolio
                    </a>

                    <a href="#blog" class="text-[14px] font-medium text-bodytext transition-colors hover:text-primary">
                        Blog
                    </a>


                    {{-- Bahasa --}}
                    <div class="relative" @click.outside="languageOpen = false">

                        <button type="button" @click="languageOpen = !languageOpen" class="flex items-center gap-2 text-[14px] font-medium text-bodytext transition-colors hover:text-primary">
                            Bahasa

                            <svg class="h-3.5 w-3.5 transition-transform duration-200" :class="{ 'rotate-180': languageOpen }" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.51a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="languageOpen" x-cloak x-transition class="absolute right-0 top-full mt-4 w-32 rounded-xl border border-slate-100 bg-white p-1.5 shadow-xl">
                            <button type="button" class="w-full rounded-lg px-3 py-2 text-left text-xs font-medium text-primary hover:bg-slate-50">
                                Indonesia
                            </button>

                            <button type="button" class="w-full rounded-lg px-3 py-2 text-left text-xs font-medium text-bodytext hover:bg-slate-50">
                                English
                            </button>
                        </div>

                    </div>

                </div>


                {{-- Contact --}}
                <a href="#kontak"
                    class="ml-10 inline-flex shrink-0 items-center gap-3 rounded-full bg-primary px-6 py-3 text-[13px] font-semibold text-white shadow-[0_8px_20px_rgba(17,56,131,0.20)] transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_12px_25px_rgba(17,56,131,0.25)]">
                    Hubungi Kami

                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                        <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>

            </div>


            {{-- ================= MOBILE ================= --}}
            <div class="flex h-[68px] items-center justify-between px-5 lg:hidden">

                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo-atn.png') }}" alt="Arjuna Travora Nusantara" class="h-[38px] w-auto">
                </a>

                <button type="button" @click="mobileOpen = !mobileOpen" class="flex h-10 w-10 items-center justify-center rounded-xl text-primary" aria-label="Menu">

                    <svg x-show="!mobileOpen" class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                        <path d="M4 7H20M4 12H20M4 17H20" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>

                    <svg x-show="mobileOpen" x-cloak class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                        <path d="M6 6L18 18M18 6L6 18" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
                    </svg>

                </button>

            </div>


            {{-- Mobile menu --}}
            <div x-show="mobileOpen" x-cloak x-transition class="border-t border-white/50 px-5 pb-5 lg:hidden">

                <div class="flex flex-col gap-1 pt-3">

                    <a href="#beranda" @click="mobileOpen = false" class="rounded-xl bg-primary/5 px-4 py-3 text-sm font-semibold text-primary">
                        Beranda
                    </a>

                    <a href="#tentang" @click="mobileOpen = false" class="rounded-xl px-4 py-3 text-sm text-bodytext hover:bg-white/70">
                        Tentang
                    </a>

                    <a href="#layanan" @click="mobileOpen = false" class="rounded-xl px-4 py-3 text-sm text-bodytext hover:bg-white/70">
                        Layanan
                    </a>

                    <a href="#portofolio" @click="mobileOpen = false" class="rounded-xl px-4 py-3 text-sm text-bodytext hover:bg-white/70">
                        Portofolio
                    </a>

                    <a href="#blog" @click="mobileOpen = false" class="rounded-xl px-4 py-3 text-sm text-bodytext hover:bg-white/70">
                        Blog
                    </a>

                    <a href="#kontak" @click="mobileOpen = false" class="mt-2 flex items-center justify-center gap-2 rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white">
                        Hubungi Kami

                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                            <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>

                </div>

            </div>

        </div>

    </div>
</nav>