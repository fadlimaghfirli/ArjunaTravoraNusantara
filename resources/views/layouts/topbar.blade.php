<header class="bg-white border-b border-gray-100 h-20 flex items-center justify-between px-6 lg:px-8 z-30 shrink-0 shadow-sm">
    <!-- Kiri: Tombol Hamburger Mobile & Page Title -->
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-500 hover:text-[#113883] focus:outline-none p-2 -ml-2 rounded-xl hover:bg-gray-50 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
            </svg>
        </button>

        @if (isset($header))
        <div class="hidden sm:block">
            {{ $header }}
        </div>
        @endif
    </div>

    <!-- Kanan: Profil User -->
    <div class="flex items-center gap-5">
        <a href="/" target="_blank" class="text-sm font-semibold text-[#113883] hover:text-[#0c2a66] transition-colors hidden sm:flex items-center gap-1.5 bg-blue-50 px-4 py-2 rounded-lg">
            Lihat Website
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
            </svg>
        </a>

        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="flex items-center gap-3 pl-2 pr-3 py-1.5 border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors focus:outline-none">
                    <div class="w-8 h-8 rounded-lg bg-[#F8B41C] text-[#102238] flex items-center justify-center font-bold text-sm">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="text-sm font-semibold text-gray-700 hidden md:block">{{ Auth::user()->name }}</div>
                    <svg class="fill-current h-4 w-4 text-gray-400 hidden md:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')" class="font-medium text-gray-700">
                    Pengaturan Profil
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>
    </div>
</header>