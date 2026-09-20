<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PageContentRequest;
use App\Models\PageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageContentController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate([
            'page' => ['nullable', 'in:'.implode(',', array_keys(PageContent::PAGES))],
            'status' => ['nullable', 'in:published,draft'],
        ]);

        $page = $request->input('page', 'sejarah');

        $query = PageContent::ofPage($page)->ordered();

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $items = $query->paginate(20)->withQueryString();

        return view('admin.page-contents.index', compact('items', 'page'));
    }

    public function create(Request $request): View
    {
        $request->validate(['page' => ['nullable', 'in:'.implode(',', array_keys(PageContent::PAGES))]]);

        $item = new PageContent(['page' => $request->input('page', 'sejarah')]);

        return view('admin.page-contents.form', compact('item'));
    }

    public function store(PageContentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['body'] = $this->sanitizeHtml($data['body'] ?? null);

        $item = PageContent::create($data);

        $this->audit('created', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.page-contents.index', ['page' => $item->page])
            ->with('success', 'Section halaman berhasil ditambahkan.');
    }

    public function edit(PageContent $pageContent): View
    {
        return view('admin.page-contents.form', ['item' => $pageContent]);
    }

    public function update(PageContentRequest $request, PageContent $pageContent): RedirectResponse
    {
        $old = $pageContent->toArray();
        $data = $request->validated();
        $data['body'] = $this->sanitizeHtml($data['body'] ?? null);

        $pageContent->update($data);

        $this->audit('updated', $pageContent, $pageContent->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.page-contents.index', ['page' => $pageContent->page])
            ->with('success', 'Section halaman berhasil diperbarui dan langsung tampil di website.');
    }

    public function destroy(PageContent $pageContent): RedirectResponse
    {
        $page = $pageContent->page;
        $old = $pageContent->toArray();
        $pageContent->delete();

        $this->audit('deleted', $pageContent, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.page-contents.index', ['page' => $page])
            ->with('success', 'Section dihapus. Halaman memakai teks bawaan bila section tidak ada.');
    }
}
