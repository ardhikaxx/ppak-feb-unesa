<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AlumniRequest;
use App\Models\AlumniRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\View\View;

class AlumniController extends BaseAdminController implements HasMiddleware
{
    /**
     * Otorisasi resource (Laravel Policy) per aksi CMS.
     */
    public static function middleware(): array
    {
        return self::resourceMiddleware(AlumniRecord::class, 'alumnus');
    }

    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:draft,unpublished,published'],
        ]);

        $query = AlumniRecord::orderByDesc('graduation_year')->orderBy('full_name');

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(fn ($w) => $w->where('full_name', 'like', "%{$q}%")->orWhere('current_company', 'like', "%{$q}%"));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $items = $query->paginate(12)->withQueryString();

        return view('admin.alumni.index', compact('items'));
    }

    public function create(): View
    {
        return view('admin.alumni.form', ['item' => new AlumniRecord]);
    }

    public function store(AlumniRequest $request): RedirectResponse
    {
        $item = AlumniRecord::create($request->validated());

        $this->audit('created', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil ditambahkan.');
    }

    public function edit(AlumniRecord $alumnus): View
    {
        return view('admin.alumni.form', ['item' => $alumnus]);
    }

    public function update(AlumniRequest $request, AlumniRecord $alumnus): RedirectResponse
    {
        $old = $alumnus->toArray();
        $alumnus->update($request->validated());

        $this->audit('updated', $alumnus, $alumnus->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function destroy(AlumniRecord $alumnus): RedirectResponse
    {
        $old = $alumnus->toArray();
        $alumnus->delete();

        $this->audit('deleted', $alumnus, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni dihapus.');
    }
}
