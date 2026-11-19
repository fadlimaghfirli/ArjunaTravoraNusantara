<x-app-layout>
    <!-- Quill Rich Text Editor CSS -->
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">

    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <a href="{{ route('blogs.index') }}" class="p-2 rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-[#113883] hover:border-[#113883] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="font-bold text-xl text-[#102238] leading-tight">
                    {{ $blog->exists ? 'Edit Artikel Berita' : 'Tulis Artikel Baru' }}
                </h2>
            </div>

            @if($blog->exists && $blog->is_active)
            <a href="{{ route('blog.public.show', $blog->slug) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#113883] bg-blue-50 hover:bg-blue-100 px-3.5 py-2 rounded-xl transition-colors">
                Pratinjau Artikel
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
            </a>
            @endif
        </div>
    </x-slot>

    <form id="blog-editor-form" action="{{ $blog->exists ? route('blogs.update', $blog->id) : route('blogs.store') }}" method="POST" enctype="multipart/form-data" x-data="blogEditorForm()" @submit="syncContent()">
        @csrf
        @if($blog->exists)
        @method('PUT')
        @endif

        <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_380px] gap-8 items-start">

            <!-- KOLOM KIRI (70%): AREA PENULISAN ARTIKEL -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8 space-y-6">

                    <!-- Judul Artikel -->
                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Judul Berita / Artikel</label>
                        <input type="text" name="title" value="{{ old('title', $blog->title) }}" required placeholder="Tulis judul berita yang jelas dan menarik..."
                            class="w-full rounded-xl border border-gray-200 px-4 py-3 text-lg font-bold text-[#102238] focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">
                        @error('title') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Ringkasan Singkat (Lead / Excerpt) -->
                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Ringkasan Berita (Lead / Excerpt)</label>
                        <textarea name="excerpt" required rows="2" placeholder="Tulis ringkasan 1–2 kalimat yang tampil pada kartu beranda dan bagian pembuka artikel..."
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm leading-relaxed focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none transition-all">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        @error('excerpt') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Rich Text Editor (WYSIWYG) -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-[13px] font-bold text-gray-700">Isi Konten Berita</label>
                            <span x-show="uploadingInline" x-cloak class="text-xs font-semibold text-[#113883] animate-pulse">Mengunggah gambar ke server...</span>
                        </div>

                        <!-- Input tersembunyi untuk mengirim HTML ke Laravel -->
                        <textarea name="content" id="content-hidden" class="hidden">{{ old('content', $blog->content) }}</textarea>

                        <!-- Wadah Editor Quill -->
                        <div class="rounded-xl overflow-hidden border border-gray-200 focus-within:border-[#113883] focus-within:ring-1 focus-within:ring-[#113883] transition-all">
                            <div id="quill-editor" class="bg-white min-h-[420px] text-[15px] text-gray-800"></div>
                        </div>
                        <p class="text-[11px] text-gray-500 mt-2">
                            Tips: Gunakan <strong>Heading 2 / 3</strong> untuk sub-judul artikel, <strong>Quote</strong> untuk pernyataan narasumber, dan ikon <strong>Gambar</strong> untuk menyisipkan foto di tengah tulisan.
                        </p>
                        @error('content') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                </div>
            </div>

            <!-- KOLOM KANAN (30%): PANEL PUBLIKASI & METADATA -->
            <div class="space-y-6 xl:sticky xl:top-6">

                <!-- Kartu Publikasi -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
                    <h3 class="text-base font-bold text-[#102238] pb-3 border-b border-gray-100">Pengaturan Publikasi</h3>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Status Tayang</label>
                        <select name="is_active" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none">
                            <option value="1" {{ old('is_active', $blog->is_active ? '1' : '0') == '1' ? 'selected' : '' }}>Tayang (Publik)</option>
                            <option value="0" {{ old('is_active', $blog->is_active ? '1' : '0') == '0' ? 'selected' : '' }}>Draft (Disimpan Saja)</option>
                        </select>
                        @error('is_active') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Tanggal Publikasi</label>
                        <input type="date" name="published_at" value="{{ old('published_at', optional($blog->published_at)->format('Y-m-d') ?? now()->format('Y-m-d')) }}" required
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none">
                        @error('published_at') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Kategori</label>
                        <input type="text" name="category" value="{{ old('category', $blog->category) }}" required placeholder="Contoh: Infrastruktur, Keamanan, Berita"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none">
                        @error('category') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Penulis (Author)</label>
                        <input type="text" name="author" value="{{ old('author', $blog->author) }}" required placeholder="Contoh: Tim Redaksi ATN"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none">
                        @error('author') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Tag Topik (Pisahkan dengan koma)</label>
                        <input type="text" name="tags" value="{{ old('tags', $blog->tags) }}" placeholder="Contoh: Data Center, Fiber Optik, B2B"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#113883] focus:ring-1 focus:ring-[#113883] outline-none">
                        @error('tags') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-3 flex gap-3">
                        <button type="submit" class="w-full py-3 px-4 bg-[#113883] hover:bg-[#0c2a66] text-white text-sm font-bold rounded-xl transition-colors shadow-md cursor-pointer">
                            {{ $blog->exists ? 'Simpan Perubahan' : 'Publikasikan Berita' }}
                        </button>
                    </div>
                </div>

                <!-- Kartu Gambar Cover -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="text-base font-bold text-[#102238] mb-3">Gambar Cover Utama</h3>

                    <div x-show="previewUrl" class="mb-3 relative rounded-xl overflow-hidden border border-gray-200 h-40 bg-gray-50" x-cloak>
                        <img :src="previewUrl" alt="Cover Preview" class="w-full h-full object-cover">
                        <span class="absolute top-2 right-2 bg-white/95 text-[10px] font-bold px-2.5 py-1 rounded shadow-sm text-gray-700" x-text="fileName ? 'Cover Baru' : 'Cover Saat Ini'"></span>
                    </div>

                    <div class="flex justify-center px-5 pt-5 pb-6 border-2 border-dashed rounded-xl transition-colors relative group" :class="isDragging ? 'border-[#113883] bg-blue-50' : 'border-gray-200 bg-gray-50 hover:border-[#113883]'"
                        @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false" @drop.prevent="handleDrop($event)">

                        <label for="cover-upload" class="absolute inset-0 w-full h-full cursor-pointer z-20"></label>

                        <div class="space-y-1 text-center pointer-events-none z-10">
                            <svg class="mx-auto h-9 w-9 transition-colors" :class="isDragging ? 'text-[#113883]' : 'text-gray-400 group-hover:text-[#113883]'" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center mt-2">
                                <span class="font-medium text-[#113883] truncate max-w-[240px]" x-text="fileName ? fileName : ({{ $blog->exists ? 'true' : 'false' }} ? 'Ganti gambar cover (opsional)' : 'Unggah gambar cover')"></span>
                            </div>
                            <p class="text-[11px] text-gray-500" x-show="!fileName">Rasio 16:9 / 16:10. Maks 2MB.</p>
                        </div>

                        <input id="cover-upload" name="image" type="file" class="sr-only" accept="image/*" x-ref="coverInput" @change="handleFileSelect($event)" {{ $blog->exists ? '' : 'required' }}>
                    </div>
                    @error('image') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

            </div>
        </div>
    </form>

    <!-- Styling Tambahan agar Toolbar Quill Nyatu dengan UI ATN -->
    <style>
        .ql-toolbar.ql-snow {
            border: none !important;
            border-bottom: 1px solid #E5E7EB !important;
            background: #F9FAFB;
            padding: 10px 12px !important;
        }

        .ql-container.ql-snow {
            border: none !important;
            font-family: inherit !important;
        }

        .ql-editor {
            min-height: 420px;
            padding: 20px 24px !important;
            line-height: 1.8;
            font-size: 15px;
        }

        .ql-editor h1 {
            font-size: 1.85em;
            font-weight: 800;
            color: #102238;
            margin: 1rem 0 0.5rem;
        }

        .ql-editor h2 {
            font-size: 1.45em;
            font-weight: 700;
            color: #102238;
            margin: 1rem 0 0.5rem;
        }

        .ql-editor h3 {
            font-size: 1.2em;
            font-weight: 700;
            color: #102238;
            margin: 0.75rem 0 0.4rem;
        }

        .ql-editor blockquote {
            border-left: 4px solid #113883 !important;
            background: #F8FAFC;
            padding: 12px 16px !important;
            border-radius: 0 12px 12px 0;
            color: #334155;
            font-style: italic;
        }

        .ql-editor img {
            border-radius: 14px;
            margin: 1rem 0;
            max-width: 100%;
        }
    </style>

    <!-- Quill Rich Text Editor JS -->
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('blogEditorForm', () => ({
                quill: null,
                uploadingInline: false,
                isDragging: false,
                fileName: '',
                previewUrl: @json($blog->exists && $blog->image ? asset('storage/' . $blog->image) : ''),

                init() {
                    const toolbarOptions = [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'align': [] }],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'indent': '-1' }, { 'indent': '+1' }],
                        ['blockquote', 'code-block'],
                        ['link', 'image'],
                        ['clean']
                    ];

                    this.quill = new Quill('#quill-editor', {
                        theme: 'snow',
                        placeholder: 'Mulai tulis berita lengkap di sini...',
                        modules: {
                            toolbar: {
                                container: toolbarOptions,
                                handlers: {
                                    image: () => this.selectInlineImage()
                                }
                            }
                        }
                    });

                    // Muat konten lama (saat mode Edit atau setelah validasi gagal)
                    const initialHtml = document.getElementById('content-hidden').value;
                    if (initialHtml) {
                        this.quill.clipboard.dangerouslyPasteHTML(initialHtml);
                    }

                    // Sinkronisasi otomatis setiap ada perubahan teks
                    this.quill.on('text-change', () => {
                        this.syncContent();
                    });
                },

                syncContent() {
                    const html = this.quill.root.innerHTML;
                    document.getElementById('content-hidden').value = html === '<p><br></p>' ? '' : html;
                },

                // Upload gambar ke server saat tombol gambar di toolbar diklik
                selectInlineImage() {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.click();

                    input.onchange = async () => {
                        const file = input.files[0];
                        if (!file) return;

                        const formData = new FormData();
                        formData.append('image', file);

                        this.uploadingInline = true;
                        try {
                            const response = await fetch('{{ route("blogs.uploadImage") }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json'
                                },
                                body: formData
                            });

                            const data = await response.json();
                            if (response.ok && data.url) {
                                const range = this.quill.getSelection(true);
                                this.quill.insertEmbed(range.index, 'image', data.url);
                                this.quill.setSelection(range.index + 1);
                            } else {
                                alert(data.message || 'Gagal mengunggah gambar (maksimal 2MB).');
                            }
                        } catch (error) {
                            alert('Terjadi kesalahan saat mengunggah gambar.');
                        } finally {
                            this.uploadingInline = false;
                        }
                    };
                },

                handleDrop(e) {
                    this.isDragging = false;
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        this.$refs.coverInput.files = files;
                        this.setPreview(files[0]);
                    }
                },

                handleFileSelect(e) {
                    const files = e.target.files;
                    if (files.length > 0) {
                        this.setPreview(files[0]);
                    }
                },

                setPreview(file) {
                    this.fileName = file.name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.previewUrl = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }));
        });
    </script>
</x-app-layout>