<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CommunityServiceRequest;
use App\Models\CommunityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CommunityServiceController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:draft,unpublished,published'],
        ]);

        $query = CommunityService::orderByDesc('year')->orderByDesc('id');

        if ($request->filled('q')) {
            $query->where('title', 'like', '%'.$request->input('q').'%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $items = $query->paginate(12)->withQueryString();

        return view('admin.community-services.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.community-services.form', ['item' => new CommunityService]);
    }

    public function store(CommunityServiceRequest $request): RedirectResponse
    {
        $item = CommunityService::create($request->validated());

        $this->audit('created', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.community-services.index')->with('success', 'Kegiatan PKM berhasil ditambahkan. Setelah berstatus published, otomatis tampil di website.');
    }

    public function edit(CommunityService $community_service): View
    {
        return view('admin.community-services.form', ['item' => $community_service]);
    }

    public function update(CommunityServiceRequest $request, CommunityService $community_service): RedirectResponse
    {
        $old = $community_service->toArray();
        $community_service->update($request->validated());

        $this->audit('updated', $community_service, $community_service->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.community-services.index')->with('success', 'Kegiatan PKM berhasil diperbarui.');
    }

    public function destroy(CommunityService $community_service): RedirectResponse
    {
        $old = $community_service->toArray();
        $community_service->delete();

        $this->audit('deleted', $community_service, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.community-services.index')->with('success', 'Kegiatan PKM dihapus.');
    }
}
