<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#102238] leading-tight">
            {{ __('Kelola Solusi Sektor') }}
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
    <div x-data="sectorManager()" class="grid grid-cols-1 xl:grid-cols-[500px_minmax(0,1fr)] gap-8">

        <!-- PANEL KIRI (Form Tambah / Edit) -->
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-6 transition-all" :class="editMode ? 'ring-2 ring-[#F8B41C]' : ''">

                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-lg font-bold text-[#102238]" x-text="editMode ? 'Edit Solusi Sektor' : 'Tambah Sektor Baru'"></h3>
                    <button type="button" x-show="editMode" @click="cancelEdit()" class="text-sm font-semibold text-red-500 hover:text-red-700 bg-red-50 px-3 py-1 rounded-lg transition-colors" x-cloak>Batal Edit</button>
                </div>

                <form :action="formAction" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Kategori (Label)</label>
                        <input type="text" name="category" x-model="formData.category" required placeholder="Contoh: HealthCare"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('category') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Judul Solusi</label>
                        <textarea name="title" x-model="formData.title" required rows="2" placeholder="Contoh: Sistem Manajemen Rumah Sakit..."
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all"></textarea>
                        @error('title') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Deskripsi Paragraf</label>
                        <textarea name="description" x-model="formData.description" required rows="3" placeholder="Contoh: Membangun ekosistem digital rumah sakit..."
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all"></textarea>
                        @error('description') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Daftar Fitur (Satu per baris)</label>
                        <textarea name="features" x-model="formData.features" required rows="4" placeholder="- Integrasi SatuSehat&#10;- Jaringan Dual ISP"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all"></textarea>
                        <p class="text-[11px] text-gray-500 mt-1">Gunakan tombol 'Enter' untuk memisahkan setiap poin.</p>
                        @error('features') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Upload Gambar Dinamis -->
                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2 mt-2">Gambar Visual Sektor</label>

                        <!-- Tampil jika sedang edit dan belum pilih gambar baru -->
                        <div x-show="editMode && !fileName && existingImage" class="mb-3 relative rounded-xl overflow-hidden border border-gray-200 h-32 bg-gray-50 flex items-center justify-center group" x-cloak>
                            <img :src="existingImage" class="absolute inset-0 w-full h-full object-cover opacity-60">
                            <span class="relative z-10 bg-white/90 text-xs font-bold px-3 py-1 rounded shadow-sm text-gray-700">Gambar Saat Ini</span>
                        </div>

                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-xl transition-colors relative group" :class="isDragging ? 'border-[#113883] bg-blue-50' : 'border-gray-200 bg-gray-50 hover:border-[#113883]'"
                            @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false" @drop.prevent="handleDrop($event)">

                            <label for="file-upload" class="absolute inset-0 w-full h-full cursor-pointer z-20"></label>

                            <div class="space-y-1 text-center pointer-events-none z-10">
                                <svg class="mx-auto h-10 w-10 transition-colors" :class="isDragging ? 'text-[#113883]' : 'text-gray-400 group-hover:text-[#113883]'" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center mt-2">
                                    <span class="font-medium text-[#113883]" x-text="fileName ? fileName : (editMode ? 'Pilih gambar baru (opsional)' : 'Unggah gambar sektor')"></span>
                                </div>
                                <p class="text-[11px] text-gray-500" x-show="!fileName">Rasio 4:3. Maks 2MB.</p>
                            </div>
                            <!-- Jika mode edit, tidak required. Jika nambah baru, required -->
                            <input id="file-upload" name="image" type="file" class="sr-only" accept="image/*" x-ref="fileInput" @change="handleFileSelect($event)" :required="!editMode">
                        </div>
                        @error('image') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 text-white text-sm font-bold rounded-xl transition-all shadow-md mt-2 flex justify-center items-center gap-2"
                        :class="editMode ? 'bg-[#F8B41C] hover:bg-yellow-500 text-gray-900' : 'bg-[#113883] hover:bg-[#0c2a66]'">
                        <svg x-show="editMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span x-text="editMode ? 'Perbarui Sektor' : 'Simpan Sektor Baru'"></span>
                    </button>
                </form>
            </div>
        </div>

        <!-- PANEL KANAN (Tabel Daftar Sektor & Sortable) -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col relative">

            <div x-show="showReorderAlert" style="display: none;" class="absolute top-0 left-0 right-0 bg-emerald-500 text-white text-center py-2 text-sm font-bold z-10 transition-all" x-transition.opacity>
                Urutan Sektor berhasil diperbarui!
            </div>

            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-[#102238]">Daftar Solusi Aktif</h3>
                <span class="bg-blue-50 text-[#113883] text-xs font-bold px-3 py-1 rounded-full">{{ $sectors->count() }} Sektor</span>
            </div>

            <div class="overflow-x-auto flex-1 pb-16">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-4 font-bold text-center w-10">Urutan</th>
                            <th class="px-4 py-4 font-bold">Gambar</th>
                            <th class="px-6 py-4 font-bold">Konten</th>
                            <th class="px-6 py-4 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-sectors" class="divide-y divide-gray-100">
                        @forelse($sectors as $sector)
                        <tr class="hover:bg-gray-50/50 transition-colors bg-white group" data-id="{{ $sector->id }}">

                            <td class="px-4 py-4 text-center drag-handle cursor-grab active:cursor-grabbing text-gray-300 hover:text-gray-500 transition-colors">
                                <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 9a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm4-14a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </td>

                            <td class="px-4 py-4 w-28">
                                <div class="w-24 h-16 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 relative">
                                    <img src="{{ asset('storage/' . $sector->image) }}" alt="Bg" class="w-full h-full object-cover">
                                    <div class="absolute inset-x-0 bottom-0 bg-black/50 text-white text-[9px] font-bold px-1 py-0.5 text-center truncate">
                                        {{ $sector->category }}
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <p class="font-bold text-[#102238]">{{ $sector->title }}</p>
                                <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $sector->description }}</p>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <!-- Tombol Edit (Kirim object Sector dan URL Gambar ke Alpine) -->
                                    <button type="button" @click="setEditMode({{ json_encode($sector) }}, '{{ asset('storage/' . $sector->image) }}')" class="text-gray-400 hover:text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-colors"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    <form action="{{ route('sectors.destroy', $sector->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus solusi sektor ini?');">
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
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">Belum ada data sektor.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('sectorManager', () => ({
                editMode: false,
                formAction: '{{ route("sectors.store") }}',
                showReorderAlert: false,
                
                // Form Data State
                formData: {
                    category: '',
                    title: '',
                    description: '',
                    features: ''
                },

                // File Upload State
                isDragging: false,
                fileName: '',
                existingImage: '',

                init() {
                    // Inisialisasi Drag & Drop Baris Tabel
                    const tbody = document.getElementById('sortable-sectors');
                    if (tbody) {
                        Sortable.create(tbody, {
                            handle: '.drag-handle',
                            animation: 150,
                            ghostClass: 'bg-blue-50',
                            onEnd: (evt) => {
                                let order = Array.from(tbody.querySelectorAll('tr')).map(row => row.dataset.id);
                                fetch('{{ route("sectors.reorder") }}', {
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

                // File Upload Handlers
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
                },

                // Edit Mode Handlers
                setEditMode(sector, imageUrl) {
                    this.editMode = true;
                    this.formAction = `/sectors/${sector.id}`;
                    this.formData.category = sector.category;
                    this.formData.title = sector.title;
                    this.formData.description = sector.description;
                    this.formData.features = sector.features;
                    
                    this.existingImage = imageUrl; // Simpan preview gambar lama
                    this.fileName = ''; // Reset pilihan gambar baru
                    if(this.$refs.fileInput) this.$refs.fileInput.value = ''; // Kosongkan input file
                    
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                cancelEdit() {
                    this.editMode = false;
                    this.formAction = '{{ route("sectors.store") }}';
                    this.formData.category = '';
                    this.formData.title = '';
                    this.formData.description = '';
                    this.formData.features = '';
                    
                    this.existingImage = '';
                    this.fileName = '';
                    if(this.$refs.fileInput) this.$refs.fileInput.value = '';
                }
            }));
        });
    </script>
</x-app-layout>