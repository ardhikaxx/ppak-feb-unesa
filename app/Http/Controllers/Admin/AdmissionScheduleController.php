<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdmissionScheduleRequest;
use App\Models\AdmissionSchedule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdmissionScheduleController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate([
            'tahun' => ['nullable', 'string', 'max:20'],
            'status' => ['nullable', 'in:active,upcoming,archived'],
        ]);

        $query = AdmissionSchedule::orderByDesc('academic_year')->orderBy('sort_order');

        if ($request->filled('tahun')) {
            $query->where('academic_year', $request->input('tahun'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $items = $query->paginate(12)->withQueryString();
        $years = AdmissionSchedule::select('academic_year')->distinct()->orderByDesc('academic_year')->pluck('academic_year');

        return view('admin.admission-schedules.index', compact('items', 'years'));
    }

    public function create(): View
    {
        return view('admin.admission-schedules.form', ['item' => new AdmissionSchedule]);
    }

    public function store(AdmissionScheduleRequest $request): RedirectResponse
    {
        $item = AdmissionSchedule::create($request->validated());

        $this->audit('created', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.admission-schedules.index')->with('success', 'Gelombang pendaftaran berhasil ditambahkan. Periode lama tetap tersimpan sebagai arsip.');
    }

    public function edit(AdmissionSchedule $admission_schedule): View
    {
        return view('admin.admission-schedules.form', ['item' => $admission_schedule]);
    }

    public function update(AdmissionScheduleRequest $request, AdmissionSchedule $admission_schedule): RedirectResponse
    {
        $old = $admission_schedule->toArray();
        $admission_schedule->update($request->validated());

        $this->audit('updated', $admission_schedule, $admission_schedule->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.admission-schedules.index')->with('success', 'Gelombang pendaftaran berhasil diperbarui.');
    }

    public function destroy(AdmissionSchedule $admission_schedule): RedirectResponse
    {
        $old = $admission_schedule->toArray();
        $admission_schedule->delete();

        $this->audit('deleted', $admission_schedule, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.admission-schedules.index')->with('success', 'Gelombang pendaftaran dihapus.');
    }
}
