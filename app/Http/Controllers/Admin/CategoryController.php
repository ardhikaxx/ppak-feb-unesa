<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Agenda;
use App\Models\Category;
use App\Models\Document;
use App\Models\Gallery;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends BaseAdminController implements HasMiddleware
{
    /**
     * Otorisasi resource (Laravel Policy) per aksi CMS.
     */
    public static function middleware(): array
    {
        return self::resourceMiddleware(Category::class);
    }

    public function index(Request $request): View
    {
        $request->validate(['type' => ['nullable', 'in:news,agenda,document,gallery']]);

        $query = Category::orderBy('type')->orderBy('sort_order');

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        $categories = $query->paginate(15)->withQueryString();

        // Hitung pemakaian per kategori untuk proteksi hapus.
        $usage = [];
        foreach ($categories as $cat) {
            $usage[$cat->id] = match ($cat->type) {
                'news' => News::where('category_id', $cat->id)->count(),
                'agenda' => Agenda::where('category_id', $cat->id)->count(),
                'document' => Document::where('category_id', $cat->id)->count(),
                'gallery' => Gallery::where('category_id', $cat->id)->count(),
                default => 0,
            };
        }

        return view('admin.categories.index', compact('categories', 'usage'));
    }

    public function create(): View
    {
        return view('admin.categories.form', ['category' => new Category]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);

        $category = Category::create($data);

        $this->audit('created', $category, $category->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.form', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $old = $category->toArray();
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);

        $category->update($data);

        $this->audit('updated', $category, $category->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $used = match ($category->type) {
            'news' => News::where('category_id', $category->id)->count(),
            'agenda' => Agenda::where('category_id', $category->id)->count(),
            'document' => Document::where('category_id', $category->id)->count(),
            'gallery' => Gallery::where('category_id', $category->id)->count(),
            default => 0,
        };

        if ($used > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', "Kategori masih digunakan oleh {$used} konten. Pindahkan konten ke kategori lain terlebih dahulu.");
        }

        $old = $category->toArray();
        $category->delete();

        $this->audit('deleted', $category, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori dihapus.');
    }
}
