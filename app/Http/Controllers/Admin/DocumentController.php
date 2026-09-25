<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\DocumentRequest;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DocumentController extends BaseAdminController implements HasMiddleware
{
    /**
     * Otorisasi resource (Laravel Policy) per aksi CMS.
     */
    public static function middleware(): array
    {
        return self::resourceMiddleware(Document::class);
    }

    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:draft,published,archived'],
            'kategori' => ['nullable', 'integer', 'exists:categories,id'],
            'tahun' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'trashed' => ['nullable', 'boolean'],
        ]);

        $query = Document::query()->with('category:id,name')->orderByDesc('year')->orderByDesc('id');

        if ($request->boolean('trashed')) {
            $query->onlyTrashed();
        }

        if ($request->filled('q')) {
            $query->where('title', 'like', '%'.$request->input('q').'%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('kategori')) {
            $query->where('category_id', $request->input('kategori'));
        }

        if ($request->filled('tahun')) {
            $query->where('year', $request->input('tahun'));
        }

        $documents = $query->paginate(12)->withQueryString();
        $categories = Category::where('type', 'document')->orderBy('name')->get(['id', 'name']);
        $years = Document::select('year')->distinct()->orderByDesc('year')->pluck('year');

        return view('admin.documents.index', compact('documents', 'categories', 'years'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'document')->orderBy('name')->get(['id', 'name']);

        return view('admin.documents.form', ['document' => new Document, 'categories' => $categories]);
    }

    public function store(DocumentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);

        $stored = $this->storeDocument($request->file('file'));
        $data = array_merge($data, $stored);
        $data['published_at'] = ($data['status'] ?? null) === 'published' ? now() : null;
        unset($data['file']);

        $document = Document::create($data);

        $this->audit('created', $document, $document->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diupload.');
    }

    public function edit(Document $document): View
    {
        $categories = Category::where('type', 'document')->orderBy('name')->get(['id', 'name']);

        return view('admin.documents.form', compact('document', 'categories'));
    }

    public function update(DocumentRequest $request, Document $document): RedirectResponse
    {
        $old = $document->toArray();
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);

        if ($request->hasFile('file')) {
            // File lama TIDAK dihapus otomatis: tetap tersimpan sebagai arsip
            // kecuali admin menghapus record-nya. Catat di audit.
            $stored = $this->storeDocument($request->file('file'));
            $data = array_merge($data, $stored);
        }

        unset($data['file']);

        $document->update($data);

        $this->audit('updated', $document, $document->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(Document $document): RedirectResponse
    {
        $old = $document->toArray();
        $document->delete();

        $this->audit('deleted', $document, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen diarsipkan. File fisik tetap tersimpan dan dapat dipulihkan.');
    }

    public function restore(string|int $document): RedirectResponse
    {
        $item = Document::withTrashed()->where('id', $document)->orWhere('slug', (string) $document)->firstOrFail();
        $item->restore();

        $this->audit('restored', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil dipulihkan.');
    }
}
