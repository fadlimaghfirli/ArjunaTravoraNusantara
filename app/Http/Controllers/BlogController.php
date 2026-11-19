<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    // === AREA ADMIN ===

    public function index()
    {
        $blogs = Blog::orderBy('sort_order', 'asc')->orderByDesc('published_at')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $blog = new Blog([
            'author' => auth()->user()->name ?? 'Tim Redaksi ATN',
            'category' => 'Teknologi',
            'published_at' => now(),
            'is_active' => true,
        ]);

        return view('admin.blogs.form', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.form', compact('blog'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:180',
            'category' => 'required|string|max:60',
            'author' => 'required|string|max:80',
            'tags' => 'nullable|string|max:255',
            'published_at' => 'required|date',
            'excerpt' => 'required|string|max:350',
            'content' => 'required|string',
            'is_active' => 'required|boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $lastOrder = Blog::max('sort_order') ?? 0;
        $imagePath = $request->file('image')->store('blogs', 'public');

        Blog::create([
            'title' => $request->title,
            'slug' => $this->generateUniqueSlug($request->title),
            'category' => $request->category,
            'author' => $request->author,
            'tags' => $request->tags,
            'published_at' => $request->published_at,
            'reading_time' => $this->calculateReadingTime($request->content),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $imagePath,
            'is_active' => (bool) $request->is_active,
            'sort_order' => $lastOrder + 1,
        ]);

        return redirect()->route('blogs.index')->with('success', 'Artikel berita berhasil diterbitkan!');
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:180',
            'category' => 'required|string|max:60',
            'author' => 'required|string|max:80',
            'tags' => 'nullable|string|max:255',
            'published_at' => 'required|date',
            'excerpt' => 'required|string|max:350',
            'content' => 'required|string',
            'is_active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'category' => $request->category,
            'author' => $request->author,
            'tags' => $request->tags,
            'published_at' => $request->published_at,
            'reading_time' => $this->calculateReadingTime($request->content),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'is_active' => (bool) $request->is_active,
        ];

        if ($blog->title !== $request->title) {
            $data['slug'] = $this->generateUniqueSlug($request->title, $blog->id);
        }

        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($data);

        return redirect()->route('blogs.index')->with('success', 'Artikel berita berhasil diperbarui!');
    }

    // Upload gambar inline dari dalam Rich Text Editor
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = $request->file('image')->store('blogs/content', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:blogs,id',
        ]);

        foreach ($request->order as $index => $id) {
            Blog::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(Blog $blog)
    {
        if (Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return back()->with('success', 'Artikel berita berhasil dihapus!');
    }

    // === AREA PUBLIK ===

    public function publicIndex(Request $request)
    {
        $query = Blog::where('is_active', true)->orderBy('sort_order', 'asc')->orderByDesc('published_at');

        if ($request->filled('kategori')) {
            $query->where('category', $request->kategori);
        }

        if ($request->filled('tag')) {
            $query->where('tags', 'like', '%' . $request->tag . '%');
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $blogs = $query->paginate(9)->withQueryString();
        $categories = Blog::where('is_active', true)->distinct()->pluck('category');
        $setting = Setting::first() ?? new Setting();

        return view('blog.index', compact('blogs', 'categories', 'setting'));
    }

    public function publicShow(Blog $blog)
    {
        abort_unless($blog->is_active, 404);

        // Tambah jumlah pembaca
        $blog->increment('views');

        $relatedBlogs = Blog::where('is_active', true)
            ->where('id', '!=', $blog->id)
            ->orderBy('sort_order', 'asc')
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        $setting = Setting::first() ?? new Setting();

        return view('blog.show', compact('blog', 'relatedBlogs', 'setting'));
    }

    private function calculateReadingTime(string $htmlContent): int
    {
        $wordCount = str_word_count(strip_tags($htmlContent));
        return max(1, (int) ceil($wordCount / 200));
    }

    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 2;

        while (
            Blog::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
