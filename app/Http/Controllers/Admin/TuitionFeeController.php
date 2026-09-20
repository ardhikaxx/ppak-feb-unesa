<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TuitionFeeRequest;
use App\Models\TuitionFee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TuitionFeeController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate(['tahun' => ['nullable', 'string', 'max:20']]);

        $query = TuitionFee::orderByDesc('academic_year')->orderBy('id');

        if ($request->filled('tahun')) {
            $query->where('academic_year', $request->input('tahun'));
        }

        $items = $query->paginate(12)->withQueryString();
        $years = TuitionFee::select('academic_year')->distinct()->orderByDesc('academic_year')->pluck('academic_year');

        return view('admin.tuition-fees.index', compact('items', 'years'));
    }

    public function create(): View
    {
        return view('admin.tuition-fees.form', ['item' => new TuitionFee]);
    }

    public function store(TuitionFeeRequest $request): RedirectResponse
    {
        // Nominal lama dipertahankan sebagai historis: selalu buat record baru.
        $item = TuitionFee::create($request->validated());

        $this->audit('created', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.tuition-fees.index')->with('success', 'Data biaya berhasil ditambahkan sebagai periode baru. Nominal lama tetap tersimpan.');
    }

    public function edit(TuitionFee $tuition_fee): View
    {
        return view('admin.tuition-fees.form', ['item' => $tuition_fee]);
    }

    public function update(TuitionFeeRequest $request, TuitionFee $tuition_fee): RedirectResponse
    {
        $old = $tuition_fee->toArray();
        $tuition_fee->update($request->validated());

        $this->audit('updated', $tuition_fee, $tuition_fee->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.tuition-fees.index')->with('success', 'Data biaya berhasil diperbarui.');
    }

    public function destroy(TuitionFee $tuition_fee): RedirectResponse
    {
        $old = $tuition_fee->toArray();
        $tuition_fee->delete();

        $this->audit('deleted', $tuition_fee, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.tuition-fees.index')->with('success', 'Data biaya dihapus.');
    }
}
