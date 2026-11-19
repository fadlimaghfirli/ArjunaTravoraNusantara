<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#102238] leading-tight">
            {{ __('Kelola Partner & Klien') }}
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
    <div x-data="clientManager()" class="grid grid-cols-1 xl:grid-cols-[500px_minmax(0,1fr)] gap-8">

        <!-- PANEL KIRI (Form Tambah / Edit) -->
        <div>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sticky top-6 transition-all" :class="editMode ? 'ring-2 ring-[#F8B41C]' : ''">

                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-lg font-bold text-[#102238]" x-text="editMode ? 'Edit Partner & Klien' : 'Tambah Klien Baru'"></h3>
                    <button type="button" x-show="editMode" @click="cancelEdit()" class="text-sm font-semibold text-red-500 hover:text-red-700 bg-red-50 px-3 py-1 rounded-lg transition-colors" x-cloak>Batal Edit</button>
                </div>

                <form :action="formAction" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    <template x-if="editMode"><input type="hidden" name="_method" value="PUT"></template>

                    <!-- Nama Klien -->
                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Nama Perusahaan / Klien</label>
                        <input type="text" name="name" x-model="formData.name" required placeholder="Contoh: PT Telkom Indonesia"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Logo Klien -->
                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Logo Klien</label>

                        <div x-show="editMode && !fileName && existingLogo" class="mb-3 relative rounded-xl overflow-hidden border border-gray-200 h-28 bg-gray-50 flex items-center justify-center p-4" x-cloak>
                            <img :src="existingLogo" class="max-h-full max-w-full object-contain">
                            <span class="absolute top-2 right-2 bg-white/95 border border-gray-200 text-[10px] font-bold px-2.5 py-0.5 rounded shadow-sm text-gray-600">Logo Saat Ini</span>
                        </div>

                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-xl transition-colors relative group" :class="isDragging ? 'border-[#113883] bg-blue-50' : 'border-gray-200 bg-gray-50 hover:border-[#113883]'"
                            @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false" @drop.prevent="handleDrop($event)">

                            <label for="client-file-upload" class="absolute inset-0 w-full h-full cursor-pointer z-20"></label>

                            <div class="space-y-1 text-center pointer-events-none z-10">
                                <svg class="mx-auto h-10 w-10 transition-colors" :class="isDragging ? 'text-[#113883]' : 'text-gray-400 group-hover:text-[#113883]'" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center mt-2">
                                    <span class="font-medium text-[#113883]" x-text="fileName ? fileName : (editMode ? 'Pilih logo baru (opsional)' : 'Unggah file atau drag & drop')"></span>
                                </div>
                                <p class="text-[11px] text-gray-500" x-show="!fileName">PNG, JPG, SVG, WEBP maks 2MB.</p>
                            </div>

                            <input id="client-file-upload" name="logo" type="file" class="sr-only" accept="image/*" x-ref="fileInput" @change="handleFileSelect($event)" :required="!editMode">
                        </div>
                        @error('logo') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full py-2.5 px-4 text-white text-sm font-bold rounded-xl transition-all shadow-md flex justify-center items-center gap-2 cursor-pointer"
                        :class="editMode ? 'bg-[#F8B41C] hover:bg-yellow-500 text-gray-900' : 'bg-[#113883] hover:bg-[#0c2a66]'">
                        <svg x-show="editMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span x-text="editMode ? 'Perbarui Klien' : 'Simpan Klien'"></span>
                    </button>
                </form>
            </div>
        </div>

        <!-- PANEL KANAN (Tabel Daftar Klien & Sortable) -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col relative">

            <div x-show="showReorderAlert" style="display: none;" class="absolute top-0 left-0 right-0 bg-emerald-500 text-white text-center py-2 text-sm font-bold z-10 transition-all" x-transition.opacity>
                Urutan Partner & Klien berhasil diperbarui!
            </div>

            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-lg font-bold text-[#102238]">Daftar Partner & Klien</h3>
                <span class="bg-blue-50 text-[#113883] text-xs font-bold px-3 py-1 rounded-full">{{ $clients->count() }} Klien</span>
            </div>

            <div class="overflow-x-auto flex-1 pb-16">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-4 font-bold text-center w-10">Urutan</th>
                            <th class="px-4 py-4 font-bold">Logo</th>
                            <th class="px-6 py-4 font-bold">Nama Klien</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-clients" class="divide-y divide-gray-100">
                        @forelse($clients as $client)
                        <tr class="hover:bg-gray-50/50 transition-colors bg-white group" data-id="{{ $client->id }}">

                            <td class="px-4 py-4 text-center drag-handle cursor-grab active:cursor-grabbing text-gray-300 hover:text-gray-500 transition-colors">
                                <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 9a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm4-14a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </td>

                            <td class="px-4 py-4 w-24">
                                <div class="w-16 h-10 bg-white border border-gray-200 rounded-lg p-1 flex items-center justify-center">
                                    <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" class="max-h-full max-w-full object-contain">
                                </div>
                            </td>

                            <td class="px-6 py-4 font-medium text-gray-900">{{ $client->name }}</td>

                            <td class="px-6 py-4">
                                <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Aktif</span>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" @click="setEditMode({{ json_encode($client) }}, '{{ asset('storage/' . $client->logo) }}')" class="text-gray-400 hover:text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-colors"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus klien ini?');">
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
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                Belum ada data klien. Silakan tambahkan di form sebelah kiri.
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
            Alpine.data('clientManager', () => ({
                editMode: false,
                formAction: '{{ route("clients.store") }}',
                showReorderAlert: false,

                formData: {
                    name: @json(old('name', ''))
                },

                isDragging: false,
                fileName: '',
                existingLogo: '',

                init() {
                    const tbody = document.getElementById('sortable-clients');
                    if (tbody) {
                        Sortable.create(tbody, {
                            handle: '.drag-handle',
                            animation: 150,
                            ghostClass: 'bg-blue-50',
                            onEnd: () => {
                                let order = Array.from(tbody.querySelectorAll('tr')).map(row => row.dataset.id);
                                fetch('{{ route("clients.reorder") }}', {
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

                setEditMode(client, logoUrl) {
                    this.editMode = true;
                    this.formAction = `/clients/${client.id}`;
                    this.formData.name = client.name;

                    this.existingLogo = logoUrl;
                    this.fileName = '';
                    if (this.$refs.fileInput) this.$refs.fileInput.value = '';

                    document.querySelector('main')?.scrollTo({ top: 0, behavior: 'smooth' });
                },

                cancelEdit() {
                    this.editMode = false;
                    this.formAction = '{{ route("clients.store") }}';
                    this.formData.name = '';

                    this.existingLogo = '';
                    this.fileName = '';
                    if (this.$refs.fileInput) this.$refs.fileInput.value = '';
                }
            }));
        });
    </script>
</x-app-layout>