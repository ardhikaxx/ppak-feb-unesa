<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PublicationRequest;
use App\Models\Publication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\View\View;

class PublicationController extends BaseAdminController implements HasMiddleware
{
    /**
     * Otorisasi resource (Laravel Policy) per aksi CMS.
     */
    public static function middleware(): array
    {
        return self::resourceMiddleware(Publication::class);
    }

    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'tahun' => ['nullable', 'string', 'max:10'],
        ]);

        $query = Publication::orderByDesc('publish_date')->orderByDesc('id');

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(fn ($w) => $w->where('title', 'like', "%{$q}%")->orWhere('authors', 'like', "%{$q}%"));
        }

        if ($request->filled('tahun')) {
            $query->where('year', $request->input('tahun'));
        }

        $items = $query->paginate(12)->withQueryString();
        $years = Publication::select('year')->distinct()->orderByDesc('year')->pluck('year');

        return view('admin.publications.index', compact('items', 'years'));
    }

    public function create(): View
    {
        return view('admin.publications.form', ['item' => new Publication]);
    }

    public function store(PublicationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['year'] = $data['year'] ?? ($data['publish_date'] ? substr($data['publish_date'], 0, 4) : null);

        $item = Publication::create($data);

        $this->audit('created', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.publications.index')->with('success', 'Publikasi berhasil ditambahkan.');
    }

    public function edit(Publication $publication): View
    {
        return view('admin.publications.form', ['item' => $publication]);
    }

    public function update(PublicationRequest $request, Publication $publication): RedirectResponse
    {
        $old = $publication->toArray();
        $data = $request->validated();
        $data['year'] = $data['year'] ?? ($data['publish_date'] ? substr($data['publish_date'], 0, 4) : $publication->year);

        $publication->update($data);

        $this->audit('updated', $publication, $publication->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.publications.index')->with('success', 'Publikasi berhasil diperbarui.');
    }

    public function destroy(Publication $publication): RedirectResponse
    {
        $old = $publication->toArray();
        $publication->delete();

        $this->audit('deleted', $publication, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.publications.index')->with('success', 'Publikasi dihapus.');
    }
}
