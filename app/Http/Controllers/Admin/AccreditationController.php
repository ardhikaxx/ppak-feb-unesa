<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AccreditationRequest;
use App\Models\Accreditation;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AccreditationController extends BaseAdminController
{
    public function index(): View
    {
        $accreditations = Accreditation::orderByDesc('effective_until')->paginate(10);

        return view('admin.accreditations.index', compact('accreditations'));
    }

    public function create(): View
    {
        return view('admin.accreditations.form', ['accreditation' => new Accreditation]);
    }

    public function store(AccreditationRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('certificate_file')) {
            $stored = $this->storeDocument($request->file('certificate_file'), 'documents/accreditations');
            $data['certificate_file'] = $stored['path'];
        }

        $accreditation = Accreditation::create($data);

        $this->audit('created', $accreditation, $accreditation->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.accreditations.index')->with('success', 'Data akreditasi berhasil ditambahkan.');
    }

    public function edit(Accreditation $accreditation): View
    {
        return view('admin.accreditations.form', compact('accreditation'));
    }

    public function update(AccreditationRequest $request, Accreditation $accreditation): RedirectResponse
    {
        $old = $accreditation->toArray();
        $data = $request->validated();

        if ($request->hasFile('certificate_file')) {
            $stored = $this->storeDocument($request->file('certificate_file'), 'documents/accreditations');
            $data['certificate_file'] = $stored['path'];
        } else {
            unset($data['certificate_file']);
        }

        $accreditation->update($data);

        $this->audit('updated', $accreditation, $accreditation->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.accreditations.index')->with('success', 'Data akreditasi berhasil diperbarui.');
    }

    public function destroy(Accreditation $accreditation): RedirectResponse
    {
        $old = $accreditation->toArray();
        $accreditation->delete();

        $this->audit('deleted', $accreditation, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.accreditations.index')->with('success', 'Data akreditasi dihapus.');
    }
}
