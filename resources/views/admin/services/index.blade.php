<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#102238] leading-tight">
            {{ __('Kelola Layanan Kami') }}
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

    <!-- Alpine Wrapper Utama -->
    <div x-data="serviceManager()" class="grid grid-cols-1 xl:grid-cols-[380px_minmax(0,1fr)] gap-8">

        <!-- PANEL KIRI (Form Tambah / Edit) -->
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-6 transition-all" :class="editMode ? 'ring-2 ring-[#F8B41C]' : ''">

                <!-- Header Form Dinamis -->
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-lg font-bold text-[#102238]" x-text="editMode ? 'Edit Layanan' : 'Tambah Layanan Baru'"></h3>
                    <button type="button" x-show="editMode" @click="cancelEdit()" class="text-sm font-semibold text-red-500 hover:text-red-700 bg-red-50 px-3 py-1 rounded-lg transition-colors" x-cloak>Batal Edit</button>
                </div>

                <!-- Form Utama -->
                <form :action="formAction" method="POST" class="space-y-5">
                    @csrf
                    <!-- Inject Method PUT via Alpine jika sedang Edit -->
                    <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Judul Layanan</label>
                        <input type="text" name="title" x-model="formData.title" required placeholder="Contoh: Software Development"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('title') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Deskripsi Layanan</label>
                        <textarea name="description" x-model="formData.description" required rows="3" placeholder="Contoh: Pengembangan sistem ERP..."
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all"></textarea>
                        @error('description') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Pustaka Ikon Modal Alpine Dinamis -->
                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Ikon Layanan</label>
                        <input type="hidden" name="icon" x-model="formData.icon" required>

                        <div class="flex items-center gap-4">
                            <!-- Preview Kotak Ikon -->
                            <button type="button" @click="showModal = true" class="w-16 h-16 shrink-0 bg-blue-50 border border-blue-100 rounded-xl flex items-center justify-center text-[#113883] p-3 hover:bg-blue-100 transition-colors shadow-sm">
                                <template x-if="formData.icon">
                                    <div x-html="formData.icon" class="w-full h-full flex items-center justify-center [&>svg]:w-full [&>svg]:h-full [&>svg]:max-w-[32px] [&>svg]:max-h-[32px] [&>svg]:stroke-[1.5]"></div>
                                </template>
                                <template x-if="!formData.icon">
                                    <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </template>
                            </button>

                            <!-- Tombol Buka Galeri -->
                            <div>
                                <button type="button" @click="showModal = true" class="px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors shadow-sm flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                                        </path>
                                    </svg>
                                    Pilih Ikon Galeri
                                </button>
                            </div>
                        </div>
                        @error('icon') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 text-white text-sm font-bold rounded-xl transition-all shadow-md mt-2 flex justify-center items-center gap-2"
                        :class="editMode ? 'bg-[#F8B41C] hover:bg-yellow-500 text-gray-900' : 'bg-[#113883] hover:bg-[#0c2a66]'">
                        <svg x-show="editMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span x-text="editMode ? 'Perbarui Layanan' : 'Simpan Layanan Baru'"></span>
                    </button>
                </form>
            </div>
        </div>

        <!-- PANEL KANAN (Tabel Daftar Layanan & Sortable) -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col relative">

            <!-- Notifikasi Reorder Berhasil -->
            <div x-show="showReorderAlert" style="display: none;" class="absolute top-0 left-0 right-0 bg-emerald-500 text-white text-center py-2 text-sm font-bold z-10 transition-all" x-transition.opacity>
                Urutan layanan berhasil diperbarui!
            </div>

            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-[#102238]">Daftar Layanan Aktif</h3>
                <span class="bg-blue-50 text-[#113883] text-xs font-bold px-3 py-1 rounded-full">{{ $services->count() }} Layanan</span>
            </div>

            <div class="overflow-x-auto flex-1 pb-16">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-4 font-bold text-center w-10">Urutan</th>
                            <th class="px-4 py-4 font-bold">Ikon</th>
                            <th class="px-6 py-4 font-bold">Judul & Deskripsi</th>
                            <th class="px-6 py-4 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>

                    <!-- ID ini penting untuk ditangkap oleh SortableJS -->
                    <tbody id="sortable-list" class="divide-y divide-gray-100">
                        @forelse($services as $service)
                        <tr class="hover:bg-gray-50/50 transition-colors bg-white group" data-id="{{ $service->id }}">

                            <!-- Drag Handle (Ikon Titik Enam) -->
                            <td class="px-4 py-4 text-center drag-handle cursor-grab active:cursor-grabbing text-gray-300 hover:text-gray-500 transition-colors">
                                <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 9a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm4-14a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </td>

                            <td class="px-4 py-4 w-20">
                                <div class="w-12 h-12 bg-blue-50 text-[#113883] rounded-xl flex items-center justify-center p-2.5 [&>svg]:w-full [&>svg]:h-full [&>svg]:stroke-[1.5]">
                                    {!! $service->icon !!}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <p class="font-bold text-[#102238]">{{ $service->title }}</p>
                                <p class="text-xs text-gray-500 mt-1 max-w-[280px] line-clamp-2">{{ $service->description }}</p>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <!-- Tombol Edit (Memicu Alpine JS) -->
                                    <button type="button" @click="setEditMode({{ json_encode($service) }})" class="text-gray-400 hover:text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus layanan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">Belum ada data layanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MODAL GALERI IKON (Disisipkan di luar area agar tidak berantakan) -->
        <div x-show="showModal" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/50 backdrop-blur-sm p-4 lg:p-0" @click.self="showModal = false" x-transition.opacity>
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl h-[80vh] flex flex-col overflow-hidden">
                <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                    <h3 class="font-bold text-[#102238] text-lg">Pustaka Ikon ATN</h3>
                    <button type="button" @click="showModal = false" class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-200 text-gray-500 hover:bg-red-100 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4 border-b border-gray-100">
                    <div class="relative">
                        <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" x-model="search" placeholder="Cari ikon (cth: kode, server, kamera)..."
                            class="w-full rounded-xl border border-gray-200 pl-11 pr-4 py-3 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                    </div>
                </div>
                <div class="p-5 overflow-y-auto flex-1 bg-white custom-scrollbar">
                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 gap-4">
                        <template x-for="icon in filteredIcons" :key="icon.name">
                            <button type="button" @click="selectIcon(icon.svg)"
                                class="flex flex-col items-center justify-center aspect-square p-2 rounded-xl border hover:border-[#113883] hover:bg-blue-50 transition-all text-gray-500 hover:text-[#113883]"
                                :class="formData.icon === icon.svg ? 'border-[#113883] bg-blue-50 text-[#113883]' : 'border-gray-100'">
                                <div x-html="icon.svg" class="w-7 h-7 mb-2 [&>svg]:w-full [&>svg]:h-full [&>svg]:stroke-[1.5]"></div>
                                <span class="text-[10px] truncate w-full text-center font-medium leading-tight" x-text="icon.name"></span>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Utama: SortableJS & Alpine Component -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('serviceManager', () => ({
                // Mode Form (Tambah/Edit)
                editMode: false,
                formAction: '{{ route("services.store") }}',
                formData: {
                    title: '{{ old("title") }}',
                    description: '{{ old("description") }}',
                    icon: `{!! addslashes(old("icon")) !!}`
                },

                // Konfigurasi Modal Ikon
                showModal: false,
                search: '',
                showReorderAlert: false,
                // Database Ikon Bawaan (Format SVG)
                iconLibrary: [
                    // IT & Software
                    { name: 'Koding / Web', keywords: 'code web software program', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>' },
                    { name: 'Terminal', keywords: 'cmd bash server terminal', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>' },
                    { name: 'Database', keywords: 'database server storage data', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>' },
                    { name: 'Cloud Server', keywords: 'cloud awan server', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>' },
                    { name: 'Mobile App', keywords: 'hp mobile smartphone handphone', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>' },
                    { name: 'API / Plugin', keywords: 'api plugin integrasi', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"></path></svg>' },
                    
                    // Hardware & Network
                    { name: 'Server Rack', keywords: 'server hardware rack infrastruktur', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>' },
                    { name: 'CPU / Chip', keywords: 'chip processor hardware komputer', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>' },
                    { name: 'Wi-Fi Network', keywords: 'wifi jaringan network sinyal internet', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>' },
                    { name: 'Komputer Desktop', keywords: 'komputer pc desktop', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>' },
                    { name: 'Laptop', keywords: 'laptop notebook', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>' }, // Catatan: Anda bisa mengganti dengan icon laptop spesifik jika ada
                    { name: 'Printer / Cetak', keywords: 'printer cetak pos', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>' },
                    
                    // Keamanan & Akses
                    { name: 'Kamera CCTV', keywords: 'cctv kamera keamanan security', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>' },
                    { name: 'Perisai (Aman)', keywords: 'shield aman security perlindungan', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>' },
                    { name: 'Kunci Akses', keywords: 'key kunci akses pintu', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>' },
                    { name: 'Gembok', keywords: 'lock gembok enkripsi aman', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>' },
                    { name: 'Sidik Jari', keywords: 'sidik jari biometrik absen', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>' },
                    { name: 'ID Card / Badge', keywords: 'id card kartu identitas rfid', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>' },
                    
                    // Display & Analitik
                    { name: 'Videotron / Signage', keywords: 'layar monitor tv videotron display', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>' },
                    { name: 'Chart / Grafik', keywords: 'chart grafik analisis data', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>' },
                    { name: 'Dashboard / Tata Letak', keywords: 'dashboard panel ui layout', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>' },
                    
                    // Tambahan Bisnis & Operasional
                    { name: 'Pengaturan / Gear', keywords: 'pengaturan gear setting', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>' },
                    { name: 'Dokumen / Laporan', keywords: 'dokumen file kertas laporan', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>' },
                    { name: 'Konsultasi / Chat', keywords: 'chat konsultasi pesan', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>' },
                    { name: 'Pengguna / User', keywords: 'user pengguna orang akun', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>' },
                    { name: 'Check / Sukses', keywords: 'check centang sukses berhasil', svg: '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>' }
                ],

                init() {
                    // Inisialisasi SortableJS
                    const tbody = document.getElementById('sortable-list');
                    if (tbody) {
                        Sortable.create(tbody, {
                            handle: '.drag-handle', // Hanya bisa didrag lewat tombol titik
                            animation: 150,
                            ghostClass: 'bg-blue-50', // Efek visual saat didrag
                            onEnd: (evt) => {
                                // Ambil ID baris berurutan setelah di-drag
                                let order = Array.from(tbody.querySelectorAll('tr')).map(row => row.dataset.id);
                                
                                // Kirim ke Backend secara gaib (AJAX/Fetch)
                                fetch('{{ route("services.reorder") }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify({ order: order })
                                }).then(res => res.json())
                                  .then(data => {
                                      if (data.success) {
                                          this.showReorderAlert = true;
                                          setTimeout(() => this.showReorderAlert = false, 3000);
                                      }
                                  });
                            }
                        });
                    }
                },

                // Fungsi Search Galeri Ikon
                get filteredIcons() {
                    if (this.search === '') return this.iconLibrary;
                    const term = this.search.toLowerCase();
                    return this.iconLibrary.filter(icon => icon.name.toLowerCase().includes(term) || icon.keywords.includes(term));
                },
                
                selectIcon(svgCode) {
                    this.formData.icon = svgCode;
                    this.showModal = false;
                },

                // Fungsi Edit (Injeksi Data ke Form)
                setEditMode(service) {
                    this.editMode = true;
                    this.formAction = `/services/${service.id}`; // Ubah tujuan URL Form ke Update
                    this.formData.title = service.title;
                    this.formData.description = service.description;
                    this.formData.icon = service.icon;
                    // Auto-scroll ke atas agar pengguna sadar formnya berubah
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                cancelEdit() {
                    this.editMode = false;
                    this.formAction = '{{ route("services.store") }}'; // Kembalikan ke Store
                    this.formData.title = '';
                    this.formData.description = '';
                    this.formData.icon = '';
                }
            }));
        });
    </script>
</x-app-layout>