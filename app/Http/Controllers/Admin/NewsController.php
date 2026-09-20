<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\NewsRequest;
use App\Models\Category;
use App\Models\News;
use App\Support\CacheKeys;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:20'],
            'kategori' => ['nullable', 'integer', 'exists:categories,id'],
            'trashed' => ['nullable', 'boolean'],
        ]);

        $query = News::query()->with(['category:id,name', 'author:id,name'])->orderByDesc('published_at')->orderByDesc('id');

        if ($request->boolean('trashed')) {
            $query->onlyTrashed();
        }

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(fn ($w) => $w->where('title', 'like', "%{$q}%")->orWhere('excerpt', 'like', "%{$q}%"));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('kategori')) {
            $query->where('category_id', $request->input('kategori'));
        }

        $news = $query->paginate(12)->withQueryString();
        $categories = Category::where('type', 'news')->orderBy('name')->get(['id', 'name']);

        return view('admin.news.index', compact('news', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'news')->orderBy('name')->get(['id', 'name']);

        return view('admin.news.form', ['article' => new News, 'categories' => $categories]);
    }

    public function store(NewsRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug']);
        // author_id mengacu ke tabel users (relasi existing); konten CMS
        // memakai fallback nama penulis pada tampilan publik.
        $data['content'] = $this->sanitizeHtml($data['content']);
        $data['tags'] = $this->parseTags($data['tags'] ?? null);
        $data['published_at'] = $data['published_at'] ?? ($data['status'] === 'published' ? now() : null);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'), 'news');
        }

        unset($data['remove_image']);

        $article = News::create($data);

        $this->audit('created', $article, $article->toArray());
        $this->flushContentCache();
        Cache::forget(CacheKeys::beritaSlug($article->slug));

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(News $news): View
    {
        $news->load(['category', 'author']);

        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news): View
    {
        $categories = Category::where('type', 'news')->orderBy('name')->get(['id', 'name']);

        return view('admin.news.form', ['article' => $news, 'categories' => $categories]);
    }

    public function update(NewsRequest $request, News $news): RedirectResponse
    {
        $old = $news->toArray();
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug']);
        $data['content'] = $this->sanitizeHtml($data['content']);
        $data['tags'] = $this->parseTags($data['tags'] ?? null);

        if ($request->boolean('remove_image') && $news->image) {
            $this->guardFileUsage($news->image, []);
            $data['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($news->image) {
                $this->guardFileUsage($news->image, []);
            }
            $data['image'] = $this->storeImage($request->file('image'), 'news');
        } else {
            unset($data['image']);
        }

        unset($data['remove_image']);

        if (($data['status'] ?? null) === 'published' && ! $news->published_at && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $news->update($data);

        $this->audit('updated', $news, $news->fresh()->toArray(), $old);
        $this->flushContentCache();
        Cache::forget(CacheKeys::beritaSlug($old['slug'] ?? $news->slug));
        Cache::forget(CacheKeys::beritaSlug($news->slug));

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news): RedirectResponse
    {
        $old = $news->toArray();
        $news->delete();

        $this->audit('deleted', $news, [], $old);
        $this->flushContentCache();
        Cache::forget(CacheKeys::beritaSlug($news->slug));

        return redirect()->route('admin.news.index')->with('success', 'Berita diarsipkan (soft delete) dan tidak tampil di publik.');
    }

    public function restore(string|int $news): RedirectResponse
    {
        $article = News::withTrashed()
            ->where('id', $news)
            ->orWhere('slug', (string) $news)
            ->firstOrFail();

        $article->restore();

        $this->audit('restored', $article, $article->toArray());
        $this->flushContentCache();
        Cache::forget(CacheKeys::beritaSlug($article->slug));

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dipulihkan.');
    }

    private function parseTags(?string $tags): ?array
    {
        if (! $tags) {
            return null;
        }

        $parsed = collect(explode(',', $tags))->map(fn ($t) => trim($t))->filter()->take(10)->values()->all();

        return empty($parsed) ? null : $parsed;
    }
}
