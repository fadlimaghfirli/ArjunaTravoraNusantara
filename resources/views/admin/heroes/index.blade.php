<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#102238] leading-tight">
            {{ __('Kelola Hero & Slider Beranda') }}
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

    <div class="grid grid-cols-1 xl:grid-cols-[400px_minmax(0,1fr)] gap-8">

        <!-- Form Tambah Hero -->
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-6">
                <h3 class="text-lg font-bold text-[#102238] mb-5">Tambah Slide Baru</h3>

                <form action="{{ route('heroes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Teks Label (Label Tag)</label>
                        <input type="text" name="label" value="{{ old('label') }}" required placeholder="Contoh: B2B Technology"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('label') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Deskripsi Singkat</label>
                        <textarea name="description" required rows="2" placeholder="Contoh: Solution & Procurement Partner."
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">{{ old('description') }}</textarea>
                        @error('description') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Gambar Utama -->
                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Gambar Utama (Landscape)</label>
                        <input type="file" name="main_image" required accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-[#113883] hover:file:bg-blue-100 transition-colors cursor-pointer border border-gray-200 rounded-xl p-2">
                        <p class="text-[11px] text-gray-500 mt-1">Rekomendasi rasio 16:9, Maks 2MB.</p>
                        @error('main_image') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Gambar Samping -->
                    <div class="pt-2">
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Gambar Samping (Portrait)</label>
                        <input type="file" name="side_image" required accept="image/*"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 transition-colors cursor-pointer border border-gray-200 rounded-xl p-2">
                        <p class="text-[11px] text-gray-500 mt-1">Rekomendasi untuk kotak di kanan. Maks 2MB.</p>
                        @error('side_image') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 bg-[#113883] hover:bg-[#0c2a66] text-white text-sm font-bold rounded-xl transition-colors shadow-md mt-4">
                        Simpan Slide Hero
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel Daftar Hero -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-[#102238]">Daftar Slide Aktif</h3>
                <span class="bg-blue-50 text-[#113883] text-xs font-bold px-3 py-1 rounded-full">{{ $heroes->count() }} Slide</span>
            </div>

            <div class="overflow-x-auto flex-1">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-bold">Preview (Utama & Samping)</th>
                            <th class="px-6 py-4 font-bold">Teks Konten</th>
                            <th class="px-6 py-4 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($heroes as $hero)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <img src="{{ asset('storage/' . $hero->main_image) }}" alt="Main" class="w-20 h-12 object-cover rounded border border-gray-200">
                                    <img src="{{ asset('storage/' . $hero->side_image) }}" alt="Side" class="w-8 h-12 object-cover rounded border border-gray-200">
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-[#102238]">{{ $hero->label }}</p>
                                <p class="text-xs text-gray-500 mt-0.5 max-w-[200px] truncate">{{ $hero->description }}</p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('heroes.destroy', $hero->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus slide ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 hover:bg-red-50 p-2 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-gray-400">
                                Belum ada slide hero. Slider di landing page mungkin akan kosong.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>