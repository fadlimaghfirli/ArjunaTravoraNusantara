<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#102238] leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Welcome Card -->
    <div class="bg-white rounded-2xl p-6 lg:p-8 border border-gray-100 shadow-sm mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div>
            <h3 class="text-2xl font-extrabold text-[#102238] mb-2">Selamat Datang, {{ Auth::user()->name }}!</h3>
            <p class="text-gray-500 text-[15px]">Anda berada di pusat kendali konten website PT. Arjuna Travora Nusantara.</p>
        </div>
        <a href="/" target="_blank" class="px-5 py-2.5 bg-[#113883] text-white text-sm font-bold rounded-xl hover:bg-[#0c2a66] transition-colors shadow-md shrink-0">
            Tinjau Website
        </a>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Stat: Portofolio -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-xl bg-blue-50 text-[#113883] flex items-center justify-center shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Portofolio Project</p>
                <h4 class="text-2xl font-extrabold text-[#102238]">4</h4>
            </div>
        </div>

        <!-- Stat: Layanan -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Layanan Aktif</p>
                <h4 class="text-2xl font-extrabold text-[#102238]">5</h4>
            </div>
        </div>

        <!-- Stat: Klien -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-xl bg-orange-50 text-[#F8B41C] flex items-center justify-center shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Partner & Klien</p>
                <h4 class="text-2xl font-extrabold text-[#102238]">8</h4>
            </div>
        </div>

        <!-- Stat: Blog -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Artikel Blog</p>
                <h4 class="text-2xl font-extrabold text-[#102238]">5</h4>
            </div>
        </div>
    </div>
</x-app-layout>