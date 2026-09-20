<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AcademicCalendarRequest;
use App\Models\AcademicCalendar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AcademicCalendarController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate([
            'tahun' => ['nullable', 'string', 'max:20'],
            'semester' => ['nullable', 'string', 'max:20'],
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $query = AcademicCalendar::orderByDesc('academic_year')->orderBy('sort_order');

        if ($request->filled('tahun')) {
            $query->where('academic_year', $request->input('tahun'));
        }

        if ($request->filled('semester')) {
            $query->where('semester', $request->input('semester'));
        }

        if ($request->filled('q')) {
            $query->where('activity', 'like', '%'.$request->input('q').'%');
        }

        $items = $query->paginate(15)->withQueryString();
        $years = AcademicCalendar::select('academic_year')->distinct()->orderByDesc('academic_year')->pluck('academic_year');

        return view('admin.academic-calendars.index', compact('items', 'years'));
    }

    public function create(): View
    {
        $latestYear = AcademicCalendar::max('academic_year') ?? '2026/2027';

        return view('admin.academic-calendars.form', ['item' => new AcademicCalendar, 'latestYear' => $latestYear]);
    }

    public function store(AcademicCalendarRequest $request): RedirectResponse
    {
        $item = AcademicCalendar::create($request->validated());

        $this->audit('created', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.academic-calendars.index')->with('success', 'Kegiatan kalender berhasil ditambahkan. Data tahun lama tetap tersimpan sebagai arsip.');
    }

    public function edit(AcademicCalendar $academic_calendar): View
    {
        return view('admin.academic-calendars.form', ['item' => $academic_calendar, 'latestYear' => $academic_calendar->academic_year]);
    }

    public function update(AcademicCalendarRequest $request, AcademicCalendar $academic_calendar): RedirectResponse
    {
        $old = $academic_calendar->toArray();
        $academic_calendar->update($request->validated());

        $this->audit('updated', $academic_calendar, $academic_calendar->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.academic-calendars.index')->with('success', 'Kegiatan kalender berhasil diperbarui.');
    }

    public function destroy(AcademicCalendar $academic_calendar): RedirectResponse
    {
        $old = $academic_calendar->toArray();
        $academic_calendar->delete();

        $this->audit('deleted', $academic_calendar, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.academic-calendars.index')->with('success', 'Kegiatan kalender dihapus.');
    }
}
