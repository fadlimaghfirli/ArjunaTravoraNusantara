<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="font-bold text-xl text-[#102238] leading-tight">
                {{ __('Kelola Blog & Berita') }}
            </h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('blog.public.index') }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 px-3.5 py-2.5 rounded-xl transition-colors">
                    Lihat Portal Blog
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
                <a href="{{ route('blogs.create') }}" class="inline-flex items-center gap-2 text-xs font-bold text-white bg-[#113883] hover:bg-[#0c2a66] px-4 py-2.5 rounded-xl transition-colors shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tulis Artikel Baru
                </a>
            </div>
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

    <div x-data="blogListManager()" class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden relative">

        <div x-show="showReorderAlert" style="display: none;" class="absolute top-0 left-0 right-0 bg-emerald-500 text-white text-center py-2 text-sm font-bold z-10 transition-all" x-transition.opacity>
            Urutan Artikel berhasil diperbarui!
        </div>

        <div class="p-6 border-b border-gray-100 flex flex-wrap justify-between items-center gap-4">
            <div>
                <h3 class="text-lg font-bold text-[#102238]">Daftar Artikel & Berita</h3>
                <p class="text-xs text-gray-400 mt-0.5">Geser ikon titik enam di kiri untuk mengatur urutan tampil artikel di beranda.</p>
            </div>
            <span class="bg-blue-50 text-[#113883] text-xs font-bold px-3 py-1 rounded-full">{{ $blogs->count() }} Artikel</span>
        </div>

        <div class="overflow-x-auto pb-8">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-4 py-4 font-bold text-center w-10">Urutan</th>
                        <th class="px-4 py-4 font-bold">Cover</th>
                        <th class="px-6 py-4 font-bold">Artikel</th>
                        <th class="px-4 py-4 font-bold">Penulis & Tanggal</th>
                        <th class="px-4 py-4 font-bold text-center">Statistik</th>
                        <th class="px-4 py-4 font-bold">Status</th>
                        <th class="px-6 py-4 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody id="sortable-blogs" class="divide-y divide-gray-100">
                    @forelse($blogs as $blog)
                    <tr class="hover:bg-gray-50/50 transition-colors bg-white group" data-id="{{ $blog->id }}">
                        <td class="px-4 py-4 text-center drag-handle cursor-grab active:cursor-grabbing text-gray-300 hover:text-gray-500 transition-colors">
                            <svg class="w-6 h-6 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 9a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm4-14a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4zm0 7a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </td>

                        <td class="px-4 py-4 w-28">
                            <div class="w-24 h-16 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 relative">
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                                <div class="absolute inset-x-0 bottom-0 bg-black/60 text-white text-[9px] font-bold px-1 py-0.5 text-center truncate">
                                    {{ $blog->category }}
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 max-w-md">
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="font-bold text-[#102238] hover:text-[#113883] transition-colors line-clamp-1">
                                {{ $blog->title }}
                            </a>
                            <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $blog->excerpt }}</p>
                        </td>

                        <td class="px-4 py-4 whitespace-nowrap">
                            <p class="text-xs font-semibold text-gray-700">{{ $blog->author }}</p>
                            <p class="text-[11px] text-gray-400 mt-0.5">{{ $blog->published_at->format('d M Y') }}</p>
                        </td>

                        <td class="px-4 py-4 text-center whitespace-nowrap">
                            <p class="text-xs font-bold text-[#102238]">{{ number_format($blog->views) }} dibaca</p>
                            <p class="text-[11px] text-gray-400 mt-0.5">{{ $blog->reading_time }} mnt baca</p>
                        </td>

                        <td class="px-4 py-4">
                            @if($blog->is_active)
                            <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Tayang</span>
                            @else
                            <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase">Draft</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                @if($blog->is_active)
                                <a href="{{ route('blog.public.show', $blog->slug) }}" target="_blank" class="text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 p-2 rounded-lg transition-colors" title="Lihat Artikel">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                @endif

                                <a href="{{ route('blogs.edit', $blog->id) }}" class="text-gray-400 hover:text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition-colors" title="Edit Artikel">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>

                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus artikel ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600 hover:bg-red-50 p-2 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center text-gray-400">
                            <p class="text-sm font-medium text-gray-500">Belum ada artikel berita.</p>
                            <a href="{{ route('blogs.create') }}" class="inline-flex items-center gap-1.5 mt-3 text-xs font-bold text-[#113883] hover:underline">
                                + Mulai tulis artikel pertama Anda
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('blogListManager', () => ({
                showReorderAlert: false,
                init() {
                    const tbody = document.getElementById('sortable-blogs');
                    if (tbody) {
                        Sortable.create(tbody, {
                            handle: '.drag-handle',
                            animation: 150,
                            ghostClass: 'bg-blue-50',
                            onEnd: () => {
                                let order = Array.from(tbody.querySelectorAll('tr[data-id]')).map(row => row.dataset.id);
                                fetch('{{ route("blogs.reorder") }}', {
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
                }
            }));
        });
    </script>
</x-app-layout>