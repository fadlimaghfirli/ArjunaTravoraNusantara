<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $blog->excerpt }}">
    <title>{{ $blog->title }} - Arjuna Travora Nusantara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tipografi Profesional untuk Konten Rich Text (Quill) -->
    <style>
        .article-content {
            color: #334155;
            font-size: 16.5px;
            line-height: 1.9;
        }

        .article-content p {
            margin-bottom: 1.25rem;
        }

        .article-content h1 {
            font-size: 2rem;
            font-weight: 800;
            color: #102238;
            line-height: 1.3;
            margin: 2rem 0 1rem;
        }

        .article-content h2 {
            font-size: 1.55rem;
            font-weight: 700;
            color: #102238;
            line-height: 1.35;
            margin: 1.85rem 0 0.85rem;
        }

        .article-content h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #102238;
            line-height: 1.4;
            margin: 1.5rem 0 0.75rem;
        }

        .article-content strong {
            font-weight: 700;
            color: #102238;
        }

        .article-content em {
            font-style: italic;
        }

        .article-content u {
            text-decoration: underline;
        }

        .article-content s {
            text-decoration: line-through;
        }

        .article-content a {
            color: #113883;
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .article-content a:hover {
            color: #0c2a66;
        }

        .article-content ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .article-content ol {
            list-style-type: decimal;
            padding-left: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .article-content li {
            margin-bottom: 0.45rem;
        }

        .article-content blockquote {
            border-left: 4px solid #113883;
            background: #F8FAFC;
            padding: 1.15rem 1.5rem;
            margin: 1.75rem 0;
            border-radius: 0 16px 16px 0;
            font-style: italic;
            color: #1E293B;
        }

        .article-content pre.ql-syntax {
            background: #102238;
            color: #F8FAFC;
            padding: 1.25rem 1.5rem;
            border-radius: 14px;
            overflow-x: auto;
            font-size: 0.875rem;
            margin: 1.5rem 0;
        }

        .article-content img {
            border-radius: 18px;
            margin: 1.75rem auto;
            max-width: 100%;
            height: auto;
            box-shadow: 0 8px 24px -10px rgba(16, 34, 56, 0.15);
        }

        .article-content .ql-align-center {
            text-align: center;
        }

        .article-content .ql-align-right {
            text-align: right;
        }

        .article-content .ql-align-justify {
            text-align: justify;
        }

        .article-content .ql-indent-1 {
            padding-left: 2rem;
        }

        .article-content .ql-indent-2 {
            padding-left: 4rem;
        }
    </style>
</head>

<body class="overflow-x-hidden bg-white text-bodytext antialiased">

    <x-navbar />

    <main class="pt-[120px] lg:pt-[150px] pb-24">
        <article class="mx-auto w-full max-w-[860px] px-6">

            <!-- Breadcrumb & Kategori -->
            <div class="flex flex-wrap items-center gap-3 text-sm mb-5">
                <a href="{{ route('blog.public.index') }}" class="inline-flex items-center gap-1.5 font-semibold text-primary hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Blog & Berita
                </a>
                <span class="text-gray-300">/</span>
                <a href="{{ route('blog.public.index', ['kategori' => $blog->category]) }}" class="px-3 py-1 rounded-full bg-blue-50 text-primary text-xs font-bold hover:bg-blue-100 transition-colors">
                    {{ $blog->category }}
                </a>
            </div>

            <!-- Judul -->
            <h1 class="text-3xl sm:text-4xl lg:text-[44px] font-extrabold text-[#102238] leading-[1.2] tracking-tight">
                {{ $blog->title }}
            </h1>

            <!-- Lead / Ringkasan -->
            <p class="mt-4 text-base sm:text-lg text-gray-500 leading-relaxed">
                {{ $blog->excerpt }}
            </p>

            <!-- Baris Metadata Penulis & Bagikan -->
            <div class="mt-7 py-4 border-y border-gray-100 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-full bg-[#113883] text-white font-bold text-sm flex items-center justify-center uppercase">
                        {{ strtoupper(substr($blog->author ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-[#102238]">{{ $blog->author ?? 'Tim Redaksi ATN' }}</p>
                        <p class="text-xs text-gray-400">
                            {{ $blog->published_at->format('d F Y') }} • {{ $blog->reading_time }} menit baca • {{ number_format($blog->views) }} kali dibaca
                        </p>
                    </div>
                </div>

                <!-- Tombol Bagikan -->
                <div class="flex items-center gap-2" x-data="{ copied: false }">
                    <a href="https://wa.me/?text={{ urlencode($blog->title . ' - ' . url()->current()) }}" target="_blank"
                        class="px-3 py-1.5 rounded-lg border border-gray-200 text-xs font-semibold text-gray-600 hover:border-[#25D366] hover:text-[#25D366] transition-colors">
                        WhatsApp
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank"
                        class="px-3 py-1.5 rounded-lg border border-gray-200 text-xs font-semibold text-gray-600 hover:border-[#0A66C2] hover:text-[#0A66C2] transition-colors">
                        LinkedIn
                    </a>
                    <button type="button" @click="navigator.clipboard.writeText(window.location.href); copied = true; setTimeout(() => copied = false, 2000)"
                        class="px-3 py-1.5 rounded-lg border border-gray-200 text-xs font-semibold text-gray-600 hover:border-primary hover:text-primary transition-colors cursor-pointer">
                        <span x-text="copied ? 'Link Disalin!' : 'Salin Link'"></span>
                    </button>
                </div>
            </div>

            <!-- Cover Image -->
            <div class="mt-8 overflow-hidden rounded-[26px] aspect-[16/9] bg-slate-100">
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
            </div>

            <!-- Isi Artikel (Rich Text HTML) -->
            <div class="article-content mt-10">
                {!! $blog->content !!}
            </div>

            <!-- Tag Topik -->
            @if($blog->tags)
            @php
            $tagList = array_values(array_filter(array_map('trim', explode(',', $blog->tags))));
            @endphp
            @if(count($tagList) > 0)
            <div class="mt-12 pt-6 border-t border-gray-100 flex flex-wrap items-center gap-2">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider mr-2">Topik:</span>
                @foreach($tagList as $tag)
                <a href="{{ route('blog.public.index', ['tag' => $tag]) }}" class="px-3.5 py-1.5 rounded-full bg-gray-100 hover:bg-blue-50 text-gray-600 hover:text-primary text-xs font-semibold transition-colors">
                    #{{ $tag }}
                </a>
                @endforeach
            </div>
            @endif
            @endif

        </article>

        <!-- Artikel Terkait -->
        @if($relatedBlogs->count() > 0)
        <section class="mx-auto w-full max-w-[1400px] px-6 mt-20 pt-14 border-t border-gray-100">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-[#102238]">Berita & Artikel Lainnya</h2>
                <a href="{{ route('blog.public.index') }}" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($relatedBlogs as $item)
                <a href="{{ route('blog.public.show', $item->slug) }}" class="group flex flex-col">
                    <div class="relative overflow-hidden rounded-[20px] mb-4 aspect-[16/10] bg-slate-100">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute bottom-0 left-0 bg-white rounded-tr-[16px] px-3 py-1.5 flex items-center gap-1.5">
                            <span class="text-[11px] font-bold text-primary">{{ $item->category }}</span>
                            <span class="text-gray-300">•</span>
                            <span class="text-[11px] font-semibold text-slate-600">{{ $item->published_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    <h3 class="text-base font-bold text-[#102238] mb-1.5 group-hover:text-primary transition-colors line-clamp-2">{{ $item->title }}</h3>
                    <p class="text-xs text-bodytext leading-relaxed line-clamp-2">{{ $item->excerpt }}</p>
                </a>
                @endforeach
            </div>
        </section>
        @endif
    </main>

</body>

</html>