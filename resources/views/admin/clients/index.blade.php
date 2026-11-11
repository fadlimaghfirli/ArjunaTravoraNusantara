<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#102238] leading-tight">
            {{ __('Kelola Partner & Klien') }}
        </h2>
    </x-slot>

    <!-- Notifikasi Sukses -->
    @if (session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl relative flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span class="font-medium text-sm">{{ session('success') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-[350px_minmax(0,1fr)] gap-8">

        <!-- Form Tambah Klien -->
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-6">
                <h3 class="text-lg font-bold text-[#102238] mb-5">Tambah Klien Baru</h3>

                <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <!-- Nama Klien -->
                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Nama Perusahaan / Klien</label>
                        <input type="text" name="name" required class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Logo Klien -->
                    <div x-data="fileUpload()">
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Logo Klien</label>

                        <!-- Area Drag & Drop -->
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-xl transition-colors relative group" :class="isDragging ? 'border-[#113883] bg-blue-50' : 'border-gray-200 bg-gray-50 hover:border-[#113883]'"
                            @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false" @drop.prevent="handleDrop($event)">
                            <!-- Label absolut ini membuat seluruh area kotak bisa diklik -->
                            <label for="file-upload" class="absolute inset-0 w-full h-full cursor-pointer z-20"></label>

                            <!-- Konten di dalam kotak (pointer-events-none agar tidak mengganggu drag & drop) -->
                            <div class="space-y-1 text-center pointer-events-none z-10">
                                <svg class="mx-auto h-10 w-10 transition-colors" :class="isDragging ? 'text-[#113883]' : 'text-gray-400 group-hover:text-[#113883]'" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center mt-2">
                                    <span class="font-medium text-[#113883]">
                                        <span x-text="fileName ? fileName : 'Unggah file atau drag & drop'"></span>
                                    </span>
                                </div>
                                <p class="text-[11px] text-gray-500" x-show="!fileName">PNG, JPG, SVG maks 2MB.</p>
                            </div>

                            <!-- Input File tersembunyi -->
                            <input id="file-upload" name="logo" type="file" class="sr-only" required accept="image/*" x-ref="fileInput" @change="handleFileSelect($event)">
                        </div>
                        @error('logo') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 bg-[#113883] hover:bg-[#0c2a66] text-white text-sm font-bold rounded-xl transition-colors shadow-md cursor-pointer">
                        Simpan Klien
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel Daftar Klien -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-[#102238]">Daftar Partner & Klien</h3>
                <span class="bg-blue-50 text-[#113883] text-xs font-bold px-3 py-1 rounded-full">{{ $clients->count() }} Klien</span>
            </div>

            <div class="overflow-x-auto flex-1">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-bold">Logo</th>
                            <th class="px-6 py-4 font-bold">Nama Klien</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($clients as $client)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-16 h-10 bg-white border border-gray-200 rounded-lg p-1 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="max-h-full max-w-full object-contain">
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $client->name }}</td>
                            <td class="px-6 py-4">
                                <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Aktif</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus klien ini?');">
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
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                Belum ada data klien. Silakan tambahkan di form sebelah kiri.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('fileUpload', () => ({
                isDragging: false,
                fileName: '',
                
                handleDrop(e) {
                    this.isDragging = false;
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        // Memasukkan file yang di-drop ke dalam input file HTML
                        this.$refs.fileInput.files = files;
                        this.fileName = files[0].name;
                    }
                },
                
                handleFileSelect(e) {
                    const files = e.target.files;
                    if (files.length > 0) {
                        this.fileName = files[0].name;
                    } else {
                        this.fileName = '';
                    }
                }
            }));
        });
    </script>
</x-app-layout>