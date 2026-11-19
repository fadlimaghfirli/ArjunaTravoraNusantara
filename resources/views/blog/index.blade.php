<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog & Berita - Arjuna Travora Nusantara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-x-hidden bg-white text-bodytext antialiased">

    <x-navbar />

    <main class="pt-[120px] lg:pt-[150px] pb-24">
        <div class="mx-auto w-full max-w-[1400px] px-6">

            <!-- Header & Pencarian -->
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10 pb-8 border-b border-gray-100">
                <div>
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:underline mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#102238] tracking-tight">Blog & Berita</h1>
                    <p class="mt-3 max-w-[600px] text-[15px] leading-7 text-bodytext">
                        Wawasan, studi kasus, dan perkembangan terbaru infrastruktur teknologi dari tim Arjuna Travora Nusantara.
                    </p>
                </div>

                <form action="{{ route('blog.public.index') }}" method="GET" class="flex w-full lg:w-[360px] gap-2">
                    @if(request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari artikel..." class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                    <button type="submit" class="px-5 py-2.5 bg-primary text-white text-sm font-semibold rounded-xl hover:bg-[#0c2a66] transition-colors shrink-0">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Filter Kategori -->
            @if($categories->count() > 0)
            <div class="flex flex-wrap gap-2.5 mb-10">
                <a href="{{ route('blog.public.index') }}"
                    class="px-4 py-2 rounded-full text-xs font-bold transition-colors border {{ !request('kategori') ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                    Semua
                </a>
                @foreach($categories as $category)
                <a href="{{ route('blog.public.index', ['kategori' => $category]) }}"
                    class="px-4 py-2 rounded-full text-xs font-bold transition-colors border {{ request('kategori') === $category ? 'bg-primary text-white border-primary' : 'bg-white text-gray-600 border-gray-200 hover:border-primary hover:text-primary' }}">
                    {{ $category }}
                </a>
                @endforeach
            </div>
            @endif

            <!-- Grid Artikel -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($blogs as $blog)
                <a href="{{ route('blog.public.show', $blog->slug) }}" class="group flex flex-col">
                    <div class="relative overflow-hidden rounded-[22px] mb-4 aspect-[16/10] bg-slate-100">
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute bottom-0 left-0 bg-white rounded-tr-[16px] px-3.5 py-1.5 flex items-center gap-2">
                            <span class="text-[11px] font-bold text-primary">{{ $blog->category }}</span>
                            <span class="text-gray-300">•</span>
                            <span class="text-[11px] font-semibold text-slate-600">{{ $blog->published_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    <h2 class="text-lg font-bold text-[#102238] mb-2 group-hover:text-primary transition-colors line-clamp-2">
                        {{ $blog->title }}
                    </h2>
                    <p class="text-sm text-bodytext leading-relaxed line-clamp-3">
                        {{ $blog->excerpt }}
                    </p>
                </a>
                @empty
                <div class="col-span-full py-16 text-center rounded-[24px] border-2 border-dashed border-gray-200 text-gray-400">
                    Belum ada artikel yang ditemukan.
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $blogs->links() }}
            </div>

        </div>
    </main>

</body>

</html>