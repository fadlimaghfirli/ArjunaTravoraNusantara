<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arjuna Travora Nusantara</title>
    
    <!-- Memanggil Tailwind CSS melalui Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #ffffff; 
        }
        /* Trik CSS untuk membuat lekukan (cutout) yang menyambung di antara dua gambar */
        .curve-left {
            box-shadow: 20px 20px 0 0 white;
            border-bottom-right-radius: 1.5rem;
        }
        .curve-right {
            box-shadow: -20px 20px 0 0 white;
            border-bottom-left-radius: 1.5rem;
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">

    <!-- Memanggil komponen Navbar di sini -->
    <x-navbar />

    <!-- Bagian Hero / Konten Utama Halaman Welcome -->
    <main>
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Bagian Atas: Grid 2 Gambar dengan Cutout di Tengah -->
        <div class="flex flex-col lg:flex-row gap-6 mb-2 relative">
            
            <!-- Gambar Kiri -->
            <div class="w-full lg:w-[65%] relative bg-[#1e3a8a] rounded-[2rem] min-h-[420px] bg-cover bg-center" style="background-image: linear-gradient(to right, rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.1)), url('https://images.unsplash.com/photo-1573164713988-8665fc963095?q=80&w=1200&auto=format&fit=crop');">
                <div class="absolute bottom-4 left-">
                    <span class="text-white font-bold text-sm tracking-wide mb-2 block">#SolusiSoftware&Hardware</span>
                    <h1 class="text-6xl sm:text-7xl font-extrabold text-white leading-none tracking-tight">Arjuna Travora</h1>
                </div>
            </div>

            <!-- Gambar Kanan (B2B Technology) -->
            <div class="w-full lg:w-[35%] relative rounded-[2rem] overflow-hidden min-h-[420px] bg-cover bg-center" style="background-image: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=800&auto=format&fit=crop');">
                <div class="absolute bottom-8 left-24">
                    <h3 class="font-bold text-2xl text-white mb-1">B2B Technology</h3>
                    <p class="text-sm text-gray-300">Solution & Procurement Partner</p>
                </div>
            </div>

            <!-- BENTUK POTONGAN (CUTOUT) DI TENGAH-TENGAH GAMBAR -->
            <!-- Kotak ini diposisikan absolut menutupi celah antara kedua gambar -->
            <div class="hidden lg:flex absolute bottom-0 left-[63.8%] ml-3 -translate-x-1/2 bg-white pt-5 px-6 rounded-t-[2rem] z-10 gap-3">
                <!-- Tombol Panah Slider -->
                <button class="w-12 h-12 border border-gray-200 rounded-xl flex items-center justify-center text-gray-600 hover:text-[#11235A] hover:border-[#11235A] transition-colors bg-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button class="w-12 h-12 border border-gray-200 rounded-xl flex items-center justify-center text-gray-600 hover:text-[#11235A] hover:border-[#11235A] transition-colors bg-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>

        </div>

        <!-- Bagian Bawah: Teks Nusantara, Deskripsi, Statistik & Action Button -->
        <div class="flex flex-col lg:flex-row gap-6 mt-1">
            
            <!-- Kolom Teks Kiri -->
            <div class="w-full lg:w-[65%] pl-4 sm:pl-10 flex flex-col justify-start pt-2">
                <h1 class="text-6xl sm:text-[5.5rem] font-extrabold text-[#11235A] leading-none mb-6 tracking-tight">Nusantara</h1>
                <p class="text-gray-500 text-[15px] max-w-[500px] leading-relaxed">
                    Menyediakan solusi teknologi mulai dari pengembangan software, pengadaan perangkat keras, sistem keamanan, hingga infrastruktur digital untuk mendukung kebutuhan bisnis, instansi, dan organisasi.
                </p>
            </div>

            <!-- Kolom Statistik & Tombol Kanan -->
            <div class="w-full lg:w-[35%] flex flex-col pt-6">
                
                <!-- Deretan Angka (Statistik) -->
                <div class="flex justify-between items-center mb-6 px-1">
                    <div class="text-center">
                        <h4 class="text-3xl font-extrabold text-[#11235A]">500+</h4>
                        <p class="text-xs text-gray-400 font-medium mt-1">Projek Selesai</p>
                    </div>
                    <div class="text-center">
                        <h4 class="text-3xl font-extrabold text-[#11235A]">40+</h4>
                        <p class="text-xs text-gray-400 font-medium mt-1">Klien Terpercaya</p>
                    </div>
                    <div class="text-center">
                        <h4 class="text-3xl font-extrabold text-[#11235A]">ISO/IEC</h4>
                        <p class="text-xs text-gray-400 font-medium mt-1">Resmi & Bergaransi</p>
                    </div>
                </div>

                <!-- Tombol Aksi Sesuai Gambar -->
                <div class="flex gap-3">
                    <button class="flex-1 py-3 px-2 border-2 border-gray-200 rounded-[0.85rem] text-[13px] font-bold text-[#11235A] hover:bg-gray-50 flex items-center justify-center gap-2 transition-colors">
                        <!-- Ikon Lingkaran Centang -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Lihat Layanan
                    </button>
                    <button class="flex-1 py-3 px-2 bg-[#11235A] rounded-[0.85rem] text-[13px] font-bold text-white hover:bg-blue-950 flex items-center justify-center gap-2 transition-colors">
                        <!-- Ikon Kotak Tanda Tanya -->
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M4 4h16v16H4V4z"></path></svg>
                        Konsultasi Sekarang
                    </button>
                </div>
            </div>
        </div>

        <!-- Garis Putus-putus Biru di Bagian Paling Bawah -->
        <div class="mt-8 border-b border-dashed border-blue-400/50 w-full"></div>
        </section>
        
        <!-- Section lainnya (Layanan, Portofolio, dll) -->
    </main>


</body>
</html>