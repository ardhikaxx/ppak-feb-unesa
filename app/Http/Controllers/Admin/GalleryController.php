<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryController extends BaseAdminController implements HasMiddleware
{
    /**
     * Otorisasi resource (Laravel Policy) per aksi CMS.
     */
    public static function middleware(): array
    {
        return self::resourceMiddleware(Gallery::class);
    }

    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:draft,published,archived'],
            'trashed' => ['nullable', 'boolean'],
        ]);

        $query = Gallery::query()->with('category:id,name')->orderByDesc('event_date')->orderByDesc('id');

        if ($request->boolean('trashed')) {
            $query->onlyTrashed();
        }

        if ($request->filled('q')) {
            $query->where('title', 'like', '%'.$request->input('q').'%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $items = $query->paginate(12)->withQueryString();

        return view('admin.galleries.index', compact('items'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'gallery')->orderBy('name')->get(['id', 'name']);

        return view('admin.galleries.form', ['item' => new Gallery, 'categories' => $categories]);
    }

    public function store(GalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['image'] = $this->storeImage($request->file('image'), 'gallery');

        $item = Gallery::create($data);

        $this->audit('created', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery): View
    {
        $categories = Category::where('type', 'gallery')->orderBy('name')->get(['id', 'name']);

        return view('admin.galleries.form', ['item' => $gallery, 'categories' => $categories]);
    }

    public function update(GalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $old = $gallery->toArray();
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                $this->guardFileUsage($gallery->image, []);
            }
            $data['image'] = $this->storeImage($request->file('image'), 'gallery');
        } else {
            unset($data['image']);
        }

        $gallery->update($data);

        $this->audit('updated', $gallery, $gallery->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $old = $gallery->toArray();
        $gallery->delete();

        $this->audit('deleted', $gallery, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri diarsipkan.');
    }

    public function restore(string|int $gallery): RedirectResponse
    {
        $item = Gallery::withTrashed()->where('id', $gallery)->orWhere('slug', (string) $gallery)->firstOrFail();
        $item->restore();

        $this->audit('restored', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.galleries.index')->with('success', 'Foto galeri berhasil dipulihkan.');
    }
}
