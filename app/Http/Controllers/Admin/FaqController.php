<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FaqRequest;
use App\Models\FAQ;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'kategori' => ['nullable', 'string', 'max:50'],
        ]);

        $query = FAQ::orderBy('sort_order')->orderBy('id');

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(fn ($w) => $w->where('question', 'like', "%{$q}%")->orWhere('answer', 'like', "%{$q}%"));
        }

        if ($request->filled('kategori')) {
            $query->where('category', $request->input('kategori'));
        }

        $faqs = $query->paginate(15)->withQueryString();
        $categories = FAQ::select('category')->distinct()->orderBy('category')->pluck('category');

        return view('admin.faqs.index', compact('faqs', 'categories'));
    }

    public function create(): View
    {
        return view('admin.faqs.form', ['faq' => new FAQ]);
    }

    public function store(FaqRequest $request): RedirectResponse
    {
        $faq = FAQ::create($request->validated());

        $this->audit('created', $faq, $faq->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(FAQ $faq): View
    {
        return view('admin.faqs.form', compact('faq'));
    }

    public function update(FaqRequest $request, FAQ $faq): RedirectResponse
    {
        $old = $faq->toArray();
        $faq->update($request->validated());

        $this->audit('updated', $faq, $faq->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(FAQ $faq): RedirectResponse
    {
        $old = $faq->toArray();
        $faq->delete();

        $this->audit('deleted', $faq, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ dihapus.');
    }
}
