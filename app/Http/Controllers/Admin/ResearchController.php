<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ResearchRequest;
use App\Models\Research;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ResearchController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:draft,unpublished,published'],
        ]);

        $query = Research::orderByDesc('year')->orderByDesc('id');

        if ($request->filled('q')) {
            $query->where('title', 'like', '%'.$request->input('q').'%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $items = $query->paginate(12)->withQueryString();

        return view('admin.researches.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.researches.form', ['item' => new Research]);
    }

    public function store(ResearchRequest $request): RedirectResponse
    {
        $item = Research::create($request->validated());

        $this->audit('created', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.researches.index')->with('success', 'Data riset berhasil ditambahkan.');
    }

    public function edit(Research $research): View
    {
        return view('admin.researches.form', ['item' => $research]);
    }

    public function update(ResearchRequest $request, Research $research): RedirectResponse
    {
        $old = $research->toArray();
        $research->update($request->validated());

        $this->audit('updated', $research, $research->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.researches.index')->with('success', 'Data riset berhasil diperbarui.');
    }

    public function destroy(Research $research): RedirectResponse
    {
        $old = $research->toArray();
        $research->delete();

        $this->audit('deleted', $research, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.researches.index')->with('success', 'Data riset dihapus.');
    }
}
