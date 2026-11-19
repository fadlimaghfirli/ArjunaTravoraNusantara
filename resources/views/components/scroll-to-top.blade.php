{{-- resources/views/components/scroll-to-top.blade.php --}}

<div x-data="{
        visible: false,
        progress: 0,
        circumference: 132,
        updateScroll() {
            const scrollTop = window.scrollY || document.documentElement.scrollTop;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            this.visible = scrollTop > 350;
            this.progress = docHeight > 0 ? Math.min(100, Math.max(0, (scrollTop / docHeight) * 100)) : 0;
        },
        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }" x-init="updateScroll(); window.addEventListener('scroll', () => updateScroll(), { passive: true })" x-show="visible" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 scale-90"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-4 scale-90"
    class="fixed bottom-6 right-5 sm:bottom-8 sm:right-8 z-[90]">

    <button type="button" @click="scrollToTop()" aria-label="Kembali ke atas" title="Kembali ke atas"
        class="group relative flex h-12 w-12 sm:h-[52px] sm:w-[52px] items-center justify-center rounded-full bg-white text-primary shadow-[0_10px_28px_rgba(16,34,56,0.16)] transition-all duration-300 hover:-translate-y-1 hover:bg-primary hover:text-white hover:shadow-[0_14px_32px_rgba(17,56,131,0.30)] cursor-pointer">

        {{-- Lingkaran Progres Scroll --}}
        <svg class="pointer-events-none absolute inset-0 h-full w-full -rotate-90" viewBox="0 0 48 48" aria-hidden="true">
            <circle cx="24" cy="24" r="21" fill="none" stroke="currentColor" stroke-width="2.2" class="text-slate-200/80 group-hover:text-white/20 transition-colors" />
            <circle cx="24" cy="24" r="21" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" class="text-primary group-hover:text-[#F8B41C] transition-colors duration-300" :stroke-dasharray="circumference"
                :stroke-dashoffset="circumference - (circumference * progress / 100)" />
        </svg>

        {{-- Ikon Panah Atas --}}
        <svg class="relative z-10 h-5 w-5 transition-transform duration-300 group-hover:-translate-y-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <path d="M12 19V5M5 12L12 5L19 12" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>
</div>