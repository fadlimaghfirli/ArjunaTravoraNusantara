{{-- resources/views/components/navbar.blade.php --}}

@php
$isHome = request()->is('/');

$initialActive = match (true) {
request()->routeIs('portfolio.public.*') => 'portofolio',
request()->routeIs('blog.public.*') => 'blog',
request()->routeIs('legality.public.*') => 'legalitas',
request()->routeIs('organization.public.*') => 'struktur',
default => 'beranda',
};

$navLinks = [
[
'id' => 'beranda',
'label' => 'Beranda',
'href' => $isHome ? '#beranda' : url('/'),
],
[
'id' => 'tentang-kami',
'label' => 'Tentang',
'href' => $isHome ? '#tentang-kami' : url('/#tentang-kami'),
],
[
'id' => 'layanan',
'label' => 'Layanan',
'href' => $isHome ? '#layanan' : url('/#layanan'),
],
[
'id' => 'solusi-sektor',
'label' => 'Solusi',
'href' => $isHome ? '#solusi-sektor' : url('/#solusi-sektor'),
],
[
'id' => 'portofolio',
'label' => 'Portofolio',
'href' => $isHome ? '#portofolio' : route('portfolio.public.index'),
],
[
'id' => 'blog',
'label' => 'Blog',
'href' => $isHome ? '#blog' : route('blog.public.index'),
],
[
'id' => 'legalitas',
'label' => 'Legalitas',
'href' => route('legality.public.index'),
],
[
'id' => 'struktur',
'label' => 'Tim Kami',
'href' => route('organization.public.index'),
],
];
@endphp

<nav x-data="{
        ready: false,
        mobileOpen: false,
        scrolled: false,
        isHome: {{ $isHome ? 'true' : 'false' }},
        activeSection: '{{ $initialActive }}',
        sections: ['beranda', 'tentang-kami', 'layanan', 'solusi-sektor', 'portofolio', 'blog', 'kontak'],

        init() {
            this.onScroll();
            window.addEventListener('scroll', () => this.onScroll(), { passive: true });
            requestAnimationFrame(() => {
                this.ready = true;
            });
        },

        onScroll() {
            this.scrolled = window.scrollY > 30;
            if (!this.isHome) return;

            if (window.scrollY < 140) {
                this.activeSection = 'beranda';
                return;
            }

            const threshold = 190;
            let current = this.activeSection;

            for (const id of this.sections) {
                const el = document.getElementById(id);
                if (el && el.getBoundingClientRect().top <= threshold) {
                    current = id;
                }
            }

            this.activeSection = current;
        },

        navigateTo(event, id) {
            this.mobileOpen = false;
            if (!this.isHome) return;

            const target = document.getElementById(id);
            if (!target) return;

            event.preventDefault();
            const offset = id === 'beranda' ? 0 : -20;
            const targetTop = target.getBoundingClientRect().top + window.scrollY + offset;

            window.scrollTo({
                top: Math.max(0, targetTop),
                behavior: 'smooth'
            });

            this.activeSection = id;
        }
    }" @keydown.escape.window="mobileOpen = false" class="fixed inset-x-0 top-0 z-[100] pt-4" :class="{
        'transition-all duration-300': ready,
        'pt-3': scrolled,
        'pt-4': !scrolled
    }">

    {{-- Backdrop Mobile Menu --}}
    <div x-show="mobileOpen" x-cloak style="display: none;" x-transition.opacity @click="mobileOpen = false" class="fixed inset-0 -z-10 bg-[#102238]/25 backdrop-blur-xs lg:hidden"></div>

    <div class="mx-auto w-full max-w-[1400px] px-6">
        <div class="relative rounded-[20px] border border-transparent bg-transparent shadow-none ring-0 backdrop-blur-none" :class="{
                'transition-all duration-300': ready,
                'border-transparent bg-transparent shadow-none ring-0 backdrop-blur-none': !scrolled && !mobileOpen,
                'backdrop-blur-xl backdrop-saturate-150 ring-1 ring-slate-900/[0.04]': scrolled || mobileOpen,
                'border-white/70 bg-white/60 shadow-[0_14px_40px_rgba(16,34,56,0.11)]': scrolled && !mobileOpen,
                'border-white/80 bg-white/90 shadow-[0_18px_45px_rgba(16,34,56,0.14)]': mobileOpen
            }">

            {{-- ================= DESKTOP ================= --}}
            <div class="hidden h-[90px] items-center justify-between px-0 lg:flex" :class="{
                    'transition-all duration-300': ready,
                    'h-[80px] px-7 xl:px-9': scrolled,
                    'h-[90px] px-0': !scrolled
                }">

                {{-- Logo --}}
                <a href="{{ $isHome ? '#beranda' : url('/') }}" @click="navigateTo($event, 'beranda')" class="flex shrink-0 items-center transition-transform duration-300 hover:scale-[1.02]">
                    <img src="{{ asset('images/logo-atn.png') }}" alt="Arjuna Travora Nusantara" class="h-[42px] w-auto" :class="{
                            'transition-all duration-300': ready,
                            'h-[38px]': scrolled,
                            'h-[42px]': !scrolled
                        }">
                </a>

                {{-- Navigation Links --}}
                <div class="flex items-center gap-5 xl:gap-7">
                    @foreach($navLinks as $link)
                    @php $isActive = $initialActive === $link['id']; @endphp
                    <a href="{{ $link['href'] }}" @click="navigateTo($event, '{{ $link['id'] }}')"
                        class="group relative py-2 text-[15px] tracking-[-0.01em] transition-colors duration-300 {{ $isActive ? 'font-bold text-primary' : 'font-medium text-[#475467] hover:text-primary' }}" :class="{
                                'font-bold text-primary': activeSection === '{{ $link['id'] }}',
                                'font-medium text-[#475467] hover:text-primary': activeSection !== '{{ $link['id'] }}'
                            }">
                        {{ $link['label'] }}

                        {{-- Garis Indikator Aktif / Hover --}}
                        <span class="absolute -bottom-1 left-1/2 h-[2.5px] -translate-x-1/2 rounded-full bg-primary transition-all duration-300 {{ $isActive ? 'w-6 opacity-100' : 'w-0 opacity-0 group-hover:w-5 group-hover:opacity-40' }}" :class="{
                                    'w-6 opacity-100': activeSection === '{{ $link['id'] }}',
                                    'w-0 opacity-0 group-hover:w-5 group-hover:opacity-40': activeSection !== '{{ $link['id'] }}'
                                }"></span>
                    </a>
                    @endforeach
                </div>

                {{-- CTA Hubungi Kami --}}
                <a href="{{ $isHome ? '#kontak' : url('/#kontak') }}" @click="navigateTo($event, 'kontak')"
                    class="group inline-flex shrink-0 items-center gap-2.5 rounded-full bg-primary px-6 py-3 text-[13.5px] font-semibold text-white shadow-[0_8px_20px_rgba(17,56,131,0.22)] transition-all duration-300 hover:-translate-y-0.5 hover:bg-[#0c2a66] hover:shadow-[0_12px_26px_rgba(17,56,131,0.30)]">
                    Hubungi Kami
                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 20 20" fill="none">
                        <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

            {{-- ================= MOBILE HEADER ================= --}}
            <div class="flex h-[74px] items-center justify-between px-0 lg:hidden" :class="{
                    'transition-all duration-300': ready,
                    'h-[66px]': scrolled,
                    'h-[74px]': !scrolled,
                    'px-4 sm:px-5': scrolled || mobileOpen,
                    'px-0': !scrolled && !mobileOpen
                }">

                <a href="{{ $isHome ? '#beranda' : url('/') }}" @click="navigateTo($event, 'beranda')" class="flex items-center">
                    <img src="{{ asset('images/logo-atn.png') }}" alt="Arjuna Travora Nusantara" class="h-[36px] sm:h-[40px] w-auto">
                </a>

                <button type="button" @click="mobileOpen = !mobileOpen" class="flex h-11 w-11 items-center justify-center rounded-xl text-primary transition-colors hover:bg-primary/10 cursor-pointer" :aria-expanded="mobileOpen"
                    aria-label="Toggle Menu">

                    <svg x-show="!mobileOpen" class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                        <path d="M4 7H20M4 12H20M4 17H20" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" />
                    </svg>

                    <svg x-show="mobileOpen" x-cloak style="display: none;" class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                        <path d="M6 6L18 18M18 6L6 18" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" />
                    </svg>
                </button>
            </div>

            {{-- ================= MOBILE MENU DRAWER ================= --}}
            <div x-show="mobileOpen" x-cloak style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="border-t border-slate-200/60 px-5 pb-6 pt-3 lg:hidden">

                <div class="flex flex-col divide-y divide-slate-200/50">
                    @foreach($navLinks as $link)
                    @php $isActive = $initialActive === $link['id']; @endphp
                    <a href="{{ $link['href'] }}" @click="navigateTo($event, '{{ $link['id'] }}')"
                        class="flex items-center justify-between py-3.5 text-[15px] transition-colors {{ $isActive ? 'font-bold text-primary' : 'font-medium text-[#475467] hover:text-primary' }}" :class="{
                                'font-bold text-primary': activeSection === '{{ $link['id'] }}',
                                'font-medium text-[#475467] hover:text-primary': activeSection !== '{{ $link['id'] }}'
                            }">
                        <span>{{ $link['label'] }}</span>
                        <span x-show="activeSection === '{{ $link['id'] }}'" @if(!$isActive) style="display: none;" @endif class="h-2 w-2 rounded-full bg-primary"></span>
                    </a>
                    @endforeach
                </div>

                <a href="{{ $isHome ? '#kontak' : url('/#kontak') }}" @click="navigateTo($event, 'kontak')"
                    class="mt-4 flex items-center justify-center gap-2 rounded-full bg-primary px-5 py-3.5 text-sm font-semibold text-white shadow-[0_8px_20px_rgba(17,56,131,0.22)] transition-colors hover:bg-[#0c2a66]">
                    Hubungi Kami
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                        <path d="M4 10H16M16 10L11 5M16 10L11 15" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>

        </div>
    </div>
</nav>

{{-- Tombol Scroll to Top --}}
<x-scroll-to-top />