<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-bold text-xl text-[#102238] leading-tight">
                {{ __('Kelola Legalitas & Sertifikat Perusahaan') }}
            </h2>
            <a href="{{ route('legality.public.index') }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#113883] bg-blue-50 hover:bg-blue-100 px-3.5 py-2 rounded-xl transition-colors">
                Lihat Halaman Legalitas
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
            </a>
        </div>
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
    <div x-data="legalityManager()" class="grid grid-cols-1 xl:grid-cols-[500px_minmax(0,1fr)] gap-8">

        <!-- PANEL KIRI (Form Tambah / Edit) -->
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-6 transition-all" :class="editMode ? 'ring-2 ring-[#F8B41C]' : ''">

                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-lg font-bold text-[#102238]" x-text="editMode ? 'Edit Dokumen Legalitas' : 'Tambah Dokumen Baru'"></h3>
                    <button type="button" x-show="editMode" @click="cancelEdit()" class="text-sm font-semibold text-red-500 hover:text-red-700 bg-red-50 px-3 py-1 rounded-lg transition-colors" x-cloak>Batal Edit</button>
                </div>

                <form :action="formAction" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Nama Dokumen / Sertifikat</label>
                        <input type="text" name="title" x-model="formData.title" required placeholder="Contoh: NOMOR INDUK BERUSAHA"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">

                        <!-- Pilihan Cepat Judul Dokumen -->
                        <div class="flex flex-wrap gap-1.5 mt-2">
                            <template x-for="preset in presets" :key="preset">
                                <button type="button" @click="formData.title = preset" class="text-[10px] font-semibold px-2 py-1 rounded-md bg-gray-100 hover:bg-blue-50 text-gray-600 hover:text-[#113883] transition-colors cursor-pointer"
                                    x-text="preset"></button>
                            </template>
                        </div>
                        @error('title') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Nomor Surat / SK (Opsional)</label>
                        <input type="text" name="document_number" x-model="formData.document_number" placeholder="Contoh: No. AHU-0012345.AH.01.01"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('document_number') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Keterangan Singkat (Opsional)</label>
                        <textarea name="description" x-model="formData.description" rows="2" placeholder="Contoh: Diterbitkan oleh Lembaga OSS Republik Indonesia."
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all"></textarea>
                        @error('description') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- File Dokumen (PDF atau Gambar) -->
                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2 mt-2">File Dokumen / Sertifikat (PDF atau Gambar)</label>

                        <div x-show="editMode && !fileName && existingImage" class="mb-3 relative rounded-xl overflow-hidden border border-gray-200 h-36 bg-gray-50 flex items-center justify-center p-2" x-cloak>
                            <template x-if="existingIsPdf">
                                <div class="flex flex-col items-center justify-center gap-2 text-center">
                                    <div class="w-12 h-12 rounded-xl bg-red-50 text-red-600 flex items-center justify-center border border-red-100">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <a :href="existingImage" target="_blank" class="text-xs font-bold text-[#113883] hover:underline">Buka File PDF Saat Ini</a>
                                </div>
                            </template>
                            <template x-if="!existingIsPdf">
                                <img :src="existingImage" class="max-h-full max-w-full object-contain">
                            </template>
                            <span class="absolute top-2 right-2 bg-white/95 border border-gray-200 text-[10px] font-bold px-2.5 py-0.5 rounded shadow-sm text-gray-600" x-text="existingIsPdf ? 'PDF Saat Ini' : 'Gambar Saat Ini'"></span>
                        </div>

                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-xl transition-colors relative group" :class="isDragging ? 'border-[#113883] bg-blue-50' : 'border-gray-200 bg-gray-50 hover:border-[#113883]'"
                            @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false" @drop.prevent="handleDrop($event)">

                            <label for="legality-file-upload" class="absolute inset-0 w-full h-full cursor-pointer z-20"></label>

                            <div class="space-y-1 text-center pointer-events-none z-10">
                                <svg class="mx-auto h-10 w-10 transition-colors" :class="isDragging ? 'text-[#113883]' : 'text-gray-400 group-hover:text-[#113883]'" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center mt-2">
                                    <span class="font-medium text-[#113883] truncate max-w-[340px]" x-text="fileName ? fileName : (editMode ? 'Pilih file baru (opsional)' : 'Unggah file PDF atau Gambar')"></span>
                                </div>
                                <p class="text-[11px] text-gray-500" x-show="!fileName">PDF, PNG, JPG, WEBP maks 10MB.</p>
                            </div>
                            <input id="legality-file-upload" name="image" type="file" class="sr-only" accept="image/*,.pdf,application/pdf" x-ref="fileInput" @change="handleFileSelect($event)" :required="!editMode">
                        </div>
                        @error('image') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 text-white text-sm font-bold rounded-xl transition-all shadow-md mt-2 flex justify-center items-center gap-2 cursor-pointer"
                        :class="editMode ? 'bg-[#F8B41C] hover:bg-yellow-500 text-gray-900' : 'bg-[#113883] hover:bg-[#0c2a66]'">
                        <svg x-show="editMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span x-text="editMode ? 'Perbarui Dokumen' : 'Simpan Dokumen'"></span>
                    </button>
                </form>
            </div>
        </div>

        <!-- PANEL KANAN (Tabel Daftar Legalitas & Sortable) -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col relative self-start">

            <div x-show="showReorderAlert" style="display: none;" class="absolute top-0 left-0 right-0 bg-emerald-500 text-white text-center py-2 text-sm font-bold z-10 transition-all" x-transition.opacity>
                Urutan Dokumen Legalitas berhasil diperbarui!
            </div>

            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-[#102238]">Daftar Dokumen Legalitas</h3>
                <span class="bg-blue-50 text-[#113883] text-xs font-bold px-3 py-1 rounded-full">{{ $legalities->count() }} Dokumen</span>
            </div>

            <div class="overflow-x-auto flex-1 pb-16">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-4 font-bold text-center w-10">Urutan</th>
                            <th class="px-4 py-4 font-bold">File</th>
                            <th class="px-6 py-4 font-bold">Nama & Detail</th>
                            <th class="px-6 py-4 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-legalities" class="divide-y divide-gray-100">
                        @forelse($legalities as $legality)
                        <tr class="hover:bg-gray-50/50 transition-colors bg-white group" data-id="{{ $legality->id }}">

                            <td class="px-4 py-4 text-center drag-handle cursor-grab active:cursor-grabbing text-gray-300 hover:text-gray-500 transition-colors">
                                <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 9a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm4-14a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </td>

                            <td class="px-4 py-4 w-24">
                                @if($legality->isPdf())
                                <a href="{{ asset('storage/' . $legality->image) }}" target="_blank"
                                    class="w-16 h-20 bg-red-50 rounded-lg border border-red-200 flex flex-col items-center justify-center gap-1 text-red-600 hover:bg-red-100 transition-colors" title="Lihat PDF">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-[10px] font-extrabold tracking-wider">PDF</span>
                                </a>
                                @else
                                <div class="w-16 h-20 bg-gray-50 rounded-lg overflow-hidden border border-gray-200 p-1 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $legality->image) }}" alt="{{ $legality->title }}" class="max-h-full max-w-full object-contain">
                                </div>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <p class="font-bold text-[#102238]">{{ $legality->title }}</p>
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $legality->isPdf() ? 'bg-red-50 text-red-600' : 'bg-blue-50 text-[#113883]' }}">
                                        {{ $legality->isPdf() ? 'PDF' : 'GAMBAR' }}
                                    </span>
                                </div>
                                @if($legality->document_number)
                                <p class="text-xs font-semibold text-[#113883] mt-0.5">{{ $legality->document_number }}</p>
                                @endif
                                @if($legality->description)
                                <p class="text-xs text-gray-500 mt-0.5 line-clamp-1">{{ $legality->description }}</p>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" @click="setEditMode({{ json_encode($legality) }}, '{{ asset('storage/' . $legality->image) }}', {{ $legality->isPdf() ? 'true' : 'false' }})"
                                        class="text-gray-400 hover:text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    <form action="{{ route('legalities.destroy', $legality->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus dokumen legalitas ini?');">
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
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                Belum ada dokumen legalitas. Silakan unggah file PDF atau gambar sertifikat di panel kiri.
                            </td>
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
            Alpine.data('legalityManager', () => ({
                editMode: false,
                formAction: '{{ route("legalities.store") }}',
                showReorderAlert: false,

                presets: [
                    'SIUP & TDP',
                    'Surat Pengukuhan Pengusaha Kena Pajak',
                    'SK NOTARIS',
                    'SPT TAHUN 2019',
                    'SURAT KETERANGAN TERDAFTAR',
                    'NOMOR INDUK BERUSAHA'
                ],

                formData: {
                    title: @json(old('title', '')),
                    document_number: @json(old('document_number', '')),
                    description: @json(old('description', ''))
                },

                isDragging: false,
                fileName: '',
                existingImage: '',
                existingIsPdf: false,

                init() {
                    const tbody = document.getElementById('sortable-legalities');
                    if (tbody) {
                        Sortable.create(tbody, {
                            handle: '.drag-handle',
                            animation: 150,
                            ghostClass: 'bg-blue-50',
                            onEnd: () => {
                                let order = Array.from(tbody.querySelectorAll('tr[data-id]')).map(row => row.dataset.id);
                                fetch('{{ route("legalities.reorder") }}', {
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

                setEditMode(legality, fileUrl, isPdf) {
                    this.editMode = true;
                    this.formAction = `/legalities/${legality.id}`;
                    this.formData.title = legality.title;
                    this.formData.document_number = legality.document_number ?? '';
                    this.formData.description = legality.description ?? '';

                    this.existingImage = fileUrl;
                    this.existingIsPdf = Boolean(isPdf);
                    this.fileName = '';
                    if (this.$refs.fileInput) this.$refs.fileInput.value = '';

                    document.querySelector('main')?.scrollTo({ top: 0, behavior: 'smooth' });
                },

                cancelEdit() {
                    this.editMode = false;
                    this.formAction = '{{ route("legalities.store") }}';
                    this.formData.title = '';
                    this.formData.document_number = '';
                    this.formData.description = '';

                    this.existingImage = '';
                    this.existingIsPdf = false;
                    this.fileName = '';
                    if (this.$refs.fileInput) this.$refs.fileInput.value = '';
                }
            }));
        });
    </script>
</x-app-layout>