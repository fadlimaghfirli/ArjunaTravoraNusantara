<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#102238] leading-tight">
            {{ __('Kelola Footer & Lokasi Kantor') }}
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

    <form action="{{ route('footer.update') }}" method="POST" enctype="multipart/form-data" x-data="footerManager()" class="space-y-8 max-w-6xl">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

            <!-- KOLOM KIRI: KONTAK, SOSIAL MEDIA & COPYRIGHT -->
            <div class="space-y-6">

                <!-- Card Kontak & Legal -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                    <div class="pb-3 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-[#102238]">Kontak Utama & Hak Cipta</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Otomatis tersinkronisasi dengan Pengaturan Umum.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[13px] font-bold text-gray-700 mb-2">Nomor WhatsApp</label>
                            <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}" required placeholder="0821-4243-0296"
                                class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                            @error('phone') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[13px] font-bold text-gray-700 mb-2">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email', $setting->email) }}" required placeholder="info@arjunatravora.co.id"
                                class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                            @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Teks Copyright</label>
                        <input type="text" name="copyright_text" value="{{ old('copyright_text', $setting->copyright_text ?? '© 2026 PT. Arjuna Travora Nusantara. All Rights Reserved.') }}" required
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('copyright_text') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Tautan Halaman Karir (Opsional)</label>
                        <input type="url" name="career_url" value="{{ old('career_url', $setting->career_url) }}" placeholder="https://linkedin.com/company/atn/jobs"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        <p class="text-[11px] text-gray-500 mt-1">Jika dikosongkan, tautan Karir otomatis mengarah ke WhatsApp HRD/kontak utama.</p>
                        @error('career_url') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Card Sosial Media -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                    <div class="pb-3 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-[#102238]">Tautan Sosial Media</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Kosongkan kolom jika platform tersebut tidak ingin ditampilkan.</p>
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Facebook URL</label>
                        <input type="url" name="facebook_url" value="{{ old('facebook_url', $setting->facebook_url) }}" placeholder="https://facebook.com/arjunatravora"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('facebook_url') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Instagram URL</label>
                        <input type="url" name="instagram_url" value="{{ old('instagram_url', $setting->instagram_url) }}" placeholder="https://instagram.com/arjunatravora"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('instagram_url') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $setting->linkedin_url) }}" placeholder="https://linkedin.com/company/arjunatravora"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('linkedin_url') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">YouTube URL</label>
                        <input type="url" name="youtube_url" value="{{ old('youtube_url', $setting->youtube_url) }}" placeholder="https://youtube.com/@arjunatravora"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('youtube_url') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: KANTOR OPERASIONAL & GOOGLE MAPS -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
                <div class="pb-3 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-[#102238]">Kantor Operasional & Peta Lokasi</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Mendukung embed Google Maps interaktif maupun gambar peta statis.</p>
                </div>

                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-2">Alamat Kantor Operasional</label>
                    <textarea name="address" required rows="2" placeholder="Mojokerto, Jawa Timur, Indonesia."
                        class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">{{ old('address', $setting->address) }}</textarea>
                    @error('address') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-2">Link Buka di Google Maps</label>
                    <input type="url" name="maps_url" value="{{ old('maps_url', $setting->maps_url ?? 'https://maps.google.com') }}" placeholder="https://maps.app.goo.gl/..."
                        class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                    @error('maps_url') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-2">Embed Google Maps (Opsional — Prioritas Utama)</label>
                    <textarea name="maps_embed" rows="3" placeholder='Tempelkan kode <iframe src="https://www.google.com/maps/embed?..."> atau URL embed-nya langsung...'
                        class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-xs font-mono focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">{{ old('maps_embed', $setting->maps_embed) }}</textarea>
                    <p class="text-[11px] text-gray-500 mt-1">Cara ambil: Buka Google Maps → klik <strong>Bagikan (Share)</strong> → pilih tab <strong>Sematkan peta (Embed a map)</strong> → Salin HTML.</p>
                    @error('maps_embed') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Gambar Peta Statis (Fallback jika Embed kosong) -->
                <div>
                    <label class="block text-[13px] font-bold text-gray-700 mb-2">Gambar Peta Alternatif (Dipakai jika Embed dikosongkan)</label>

                    @if($setting->maps_image)
                    <div class="mb-3 relative rounded-xl overflow-hidden border border-gray-200 h-36 bg-gray-100">
                        <img src="{{ asset('storage/' . $setting->maps_image) }}" alt="Peta Saat Ini" class="w-full h-full object-cover">
                        <span class="absolute top-2 right-2 bg-white/95 text-[10px] font-bold px-2.5 py-1 rounded shadow-sm text-gray-700">Gambar Peta Saat Ini</span>
                    </div>
                    <label class="inline-flex items-center gap-2 text-xs text-red-600 font-semibold mb-3 cursor-pointer">
                        <input type="checkbox" name="remove_maps_image" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                        Hapus gambar peta kustom ini
                    </label>
                    @endif

                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-xl transition-colors relative group" :class="isDragging ? 'border-[#113883] bg-blue-50' : 'border-gray-200 bg-gray-50 hover:border-[#113883]'"
                        @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false" @drop.prevent="handleDrop($event)">

                        <label for="maps-image-upload" class="absolute inset-0 w-full h-full cursor-pointer z-20"></label>

                        <div class="space-y-1 text-center pointer-events-none z-10">
                            <svg class="mx-auto h-9 w-9 transition-colors" :class="isDragging ? 'text-[#113883]' : 'text-gray-400 group-hover:text-[#113883]'" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center mt-2">
                                <span class="font-medium text-[#113883]" x-text="fileName ? fileName : 'Unggah gambar peta (opsional)'"></span>
                            </div>
                            <p class="text-[11px] text-gray-500" x-show="!fileName">Rasio 2:1 (landscape). PNG, JPG, WEBP maks 2MB.</p>
                        </div>

                        <input id="maps-image-upload" name="maps_image" type="file" class="sr-only" accept="image/*" x-ref="fileInput" @change="handleFileSelect($event)">
                    </div>
                    @error('maps_image') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                @if($setting->maps_embed && str_starts_with($setting->maps_embed, 'https://www.google.com/maps/embed'))
                <div>
                    <p class="text-[12px] font-bold text-gray-500 mb-2">Pratinjau Embed Aktif:</p>
                    <div class="w-full h-44 rounded-xl overflow-hidden border border-gray-200">
                        <iframe src="{{ $setting->maps_embed }}" class="w-full h-full border-0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                @endif

                <div class="pt-2">
                    <button type="submit" class="w-full py-3 px-6 bg-[#113883] hover:bg-[#0c2a66] text-white text-sm font-bold rounded-xl transition-colors shadow-md cursor-pointer">
                        Simpan Pengaturan Footer
                    </button>
                </div>
            </div>

        </div>
    </form>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('footerManager', () => ({
                isDragging: false,
                fileName: '',

                handleDrop(e) {
                    this.isDragging = false;
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        this.$refs.fileInput.files = files;
                        this.fileName = files[0].name;
                    }
                },

                handleFileSelect(e) {
                    const files = e.target.files;
                    this.fileName = files.length > 0 ? files[0].name : '';
                }
            }));
        });
    </script>
</x-app-layout>