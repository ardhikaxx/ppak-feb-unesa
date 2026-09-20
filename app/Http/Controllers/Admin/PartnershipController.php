<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PartnershipRequest;
use App\Models\Partnership;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PartnershipController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:draft,unpublished,active,archived'],
        ]);

        $query = Partnership::orderByDesc('id');

        if ($request->filled('q')) {
            $query->where('partner_name', 'like', '%'.$request->input('q').'%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $items = $query->paginate(12)->withQueryString();

        return view('admin.partnerships.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.partnerships.form', ['item' => new Partnership]);
    }

    public function store(PartnershipRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->storeImage($request->file('logo'), 'partners');
        }

        unset($data['remove_logo']);

        $item = Partnership::create($data);

        $this->audit('created', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.partnerships.index')->with('success', 'Data kerja sama berhasil ditambahkan.');
    }

    public function edit(Partnership $partnership): View
    {
        return view('admin.partnerships.form', ['item' => $partnership]);
    }

    public function update(PartnershipRequest $request, Partnership $partnership): RedirectResponse
    {
        $old = $partnership->toArray();
        $data = $request->validated();

        if ($request->boolean('remove_logo') && $partnership->logo) {
            $this->guardFileUsage($partnership->logo, []);
            $data['logo'] = null;
        } elseif ($request->hasFile('logo')) {
            if ($partnership->logo) {
                $this->guardFileUsage($partnership->logo, []);
            }
            $data['logo'] = $this->storeImage($request->file('logo'), 'partners');
        } else {
            unset($data['logo']);
        }

        unset($data['remove_logo']);

        $partnership->update($data);

        $this->audit('updated', $partnership, $partnership->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.partnerships.index')->with('success', 'Data kerja sama berhasil diperbarui.');
    }

    public function destroy(Partnership $partnership): RedirectResponse
    {
        $old = $partnership->toArray();
        $partnership->delete();

        $this->audit('deleted', $partnership, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.partnerships.index')->with('success', 'Data kerja sama dihapus.');
    }
}
