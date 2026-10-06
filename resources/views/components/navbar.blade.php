<!-- Navigation Bar (Floating & Glassmorphism) -->
<nav class="fixed top-6 left-0 right-0 z-50 px-4 md:px-8 transition-all duration-300">
    <div class="max-w-7xl mx-auto">
        <!-- Inner Container (Bentuk Pil melengkung dan efek kaca transparan) -->
        <div class="bg-white/70 backdrop-blur-md rounded-full px-8 py-3 flex items-center justify-between shadow-sm border border-white/50">
            
            <!-- Bagian Kiri: Logo & Nama Perusahaan -->
            <div class="flex items-center gap-3 cursor-pointer">
                <!-- Ikon Logo (Ganti src dengan path logo ATN Anda, misal: asset('images/logo.png')) -->
                <div class="w-35 text-[#1E3A8A] flex items-center justify-center">
                    <img src="{{ asset('image/Frame 5.png') }}" alt="">
                </div>
                <!-- Teks Nama Perusahaan (Dibuat dua baris) -->
                <!-- <div class="flex flex-col text-sm font-bold text-[#0F2A66] leading-tight tracking-wide">
                    <span>Arjuna Travora</span>
                    <span>Nusantara</span>
                </div> -->
            </div>

            <!-- Bagian Tengah: Menu Navigasi Utama -->
            <div class="hidden md:flex items-center space-x-10">
                <a href="#beranda" class="text-gray-500 hover:text-[#0F2A66] font-medium text-sm transition-colors duration-200">Beranda</a>
                <a href="#tentang" class="text-gray-500 hover:text-[#0F2A66] font-medium text-sm transition-colors duration-200">Tentang</a>
                <a href="#layanan" class="text-gray-500 hover:text-[#0F2A66] font-medium text-sm transition-colors duration-200">Layanan</a>
                <a href="#portofolio" class="text-gray-500 hover:text-[#0F2A66] font-medium text-sm transition-colors duration-200">Portofolio</a>
                <a href="#blog" class="text-gray-500 hover:text-[#0F2A66] font-medium text-sm transition-colors duration-200">Blog</a>
            </div>

            <!-- Bagian Kanan: Dropdown Bahasa -->
            <div class="hidden md:flex items-center">
                <button type="button" class="flex items-center gap-1.5 text-gray-500 hover:text-[#0F2A66] font-medium text-sm transition-colors duration-200 focus:outline-none">
                    Bahasa
                    <!-- Ikon panah ke bawah (Chevron down) -->
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>

            <!-- Tombol Hamburger untuk Layar HP (Mobile) -->
            <div class="md:hidden flex items-center">
                <button type="button" class="text-gray-500 hover:text-[#0F2A66] focus:outline-none">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

        </div>
    </div>
</nav>