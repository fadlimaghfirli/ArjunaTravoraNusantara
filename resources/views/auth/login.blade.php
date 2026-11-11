<x-guest-layout>
    <div class="min-h-screen flex text-bodytext font-sans bg-white">

        {{-- PANEL KIRI: VISUAL BRANDING (Hanya tampil di Desktop) --}}
        <div class="hidden lg:flex lg:w-1/2 relative bg-[#113883] overflow-hidden items-center justify-center">
            <!-- Background Image dengan efek Overlay Biru -->
            <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=1200&q=80" alt="Background" class="absolute inset-0 w-full h-full object-cover opacity-20 mix-blend-multiply">

            <!-- Ornamen Dekorasi -->
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-[#F8B41C] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>

            <div class="relative z-10 px-16 text-white max-w-xl">
                <a href="/">
                    <img src="{{ asset('images/logo-atn.png') }}" alt="ATN Logo" class="h-16 bg-white p-3 rounded-xl mb-10 shadow-lg">
                </a>
                <h2 class="text-[40px] font-extrabold mb-5 leading-[1.1] tracking-tight">Sistem Informasi<br>Manajemen ATN</h2>
                <p class="text-white/80 text-[16px] leading-relaxed">
                    Akses portal terpusat untuk mengelola seluruh konten website, portofolio proyek, berita perusahaan, dan data operasional PT. Arjuna Travora Nusantara dengan aman.
                </p>
            </div>
        </div>

        {{-- PANEL KANAN: FORM LOGIN --}}
        <div class="w-full lg:w-1/2 flex flex-col relative bg-white px-6 sm:px-12 md:px-20 lg:px-24">

            <!-- Tombol Kembali ke Landing Page -->
            <div class="absolute top-8 left-6 sm:left-12 lg:left-24">
                <a href="/" class="group inline-flex items-center gap-2 text-[14px] font-semibold text-[#667085] hover:text-[#113883] transition-colors">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            <!-- Area Form Utama -->
            <div class="flex-1 flex flex-col justify-center w-full max-w-[420px] mx-auto mt-16 lg:mt-0">

                <!-- Header Form (Mobile Logo & Text) -->
                <div class="mb-10 text-center lg:text-left">
                    <img src="{{ asset('images/logo-atn.png') }}" alt="ATN Logo" class="lg:hidden h-12 mx-auto mb-6">
                    <h3 class="text-3xl font-extrabold text-[#102238] mb-2 tracking-tight">Selamat Datang</h3>
                    <p class="text-[15px] text-bodytext">Silakan masuk ke akun Admin Anda.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-[14px] font-bold text-[#102238] mb-2">Alamat Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@atn.com"
                            class="w-full rounded-[11px] border border-[#D8DDE7] bg-white px-4 py-3.5 text-[#102238] focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all placeholder:text-gray-400 shadow-sm" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-[14px] font-bold text-[#102238] mb-2">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
                            class="w-full rounded-[11px] border border-[#D8DDE7] bg-white px-4 py-3.5 text-[#102238] focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all placeholder:text-gray-400 shadow-sm" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-[#D8DDE7] text-[#113883] shadow-sm focus:ring-[#113883] cursor-pointer">
                            <span class="ms-2 text-[14px] font-medium text-bodytext group-hover:text-[#102238] transition-colors">Ingat Saya</span>
                        </label>

                        @if (Route::has('password.request'))
                        <a class="text-[14px] font-semibold text-[#113883] hover:underline" href="{{ route('password.request') }}">
                            Lupa password?
                        </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-4 px-4 rounded-[11px] text-[16px] font-bold text-white bg-[#113883] hover:bg-[#0c2a66] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#113883] transition-all shadow-md hover:-translate-y-0.5">
                            Masuk ke Dashboard
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </div>
                </form>

                {{-- Footer Area Form --}}
                <div class="mt-12 text-center">
                    <p class="text-xs text-bodytext">© 2026 PT. Arjuna Travora Nusantara.<br>Terlindungi & Terenkripsi.</p>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>