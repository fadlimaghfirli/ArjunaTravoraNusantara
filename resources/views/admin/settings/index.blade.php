<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#102238] leading-tight">
            {{ __('Pengaturan Umum Website') }}
        </h2>
    </x-slot>

    @if (session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl relative flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span class="font-medium text-sm">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8 max-w-4xl">
        <form action="{{ route('settings.update') }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Area Statistik -->
            <div>
                <h3 class="text-lg font-bold text-[#102238] mb-1">Angka Statistik Beranda</h3>
                <p class="text-[13px] text-gray-500 mb-5">Ditampilkan di bawah area gambar slider Hero utama.</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Projek Selesai</label>
                        <input type="text" name="stat_projects" value="{{ old('stat_projects', $setting->stat_projects) }}" required
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('stat_projects') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Klien Terpercaya</label>
                        <input type="text" name="stat_clients" value="{{ old('stat_clients', $setting->stat_clients) }}" required
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('stat_clients') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Sertifikasi / Garansi</label>
                        <input type="text" name="stat_certification" value="{{ old('stat_certification', $setting->stat_certification) }}" required
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('stat_certification') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <hr class="border-gray-100">

            <!-- Area Kontak -->
            <div>
                <h3 class="text-lg font-bold text-[#102238] mb-1">Informasi Kontak & Footer</h3>
                <p class="text-[13px] text-gray-500 mb-5">Digunakan pada tombol hubungi kami dan informasi di area bawah website.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" required
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('phone') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $setting->email) }}" required
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-2">Alamat Kantor Operasional</label>
                    <textarea name="address" required rows="3"
                        class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">{{ old('address', $setting->address) }}</textarea>
                    @error('address') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="py-3 px-6 bg-[#113883] hover:bg-[#0c2a66] text-white text-sm font-bold rounded-xl transition-colors shadow-md">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>