<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LecturerRequest;
use App\Models\Lecturer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LecturerController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:active,inactive'],
            'kategori' => ['nullable', 'string', 'max:50'],
            'trashed' => ['nullable', 'boolean'],
        ]);

        $query = Lecturer::query()->orderBy('sort_order')->orderBy('name');

        if ($request->boolean('trashed')) {
            $query->onlyTrashed();
        }

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(fn ($w) => $w->where('name', 'like', "%{$q}%")->orWhere('bidang', 'like', "%{$q}%"));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('kategori')) {
            $query->where('category', $request->input('kategori'));
        }

        $lecturers = $query->paginate(12)->withQueryString();

        return view('admin.lecturers.index', compact('lecturers'));
    }

    public function create(): View
    {
        return view('admin.lecturers.form', ['lecturer' => new Lecturer]);
    }

    public function store(LecturerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
        $data['matkul'] = $this->parseList($data['matkul'] ?? null);
        $data['sertifikasi'] = $this->parseList($data['sertifikasi'] ?? null);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeImage($request->file('image'), 'lecturers');
        }

        unset($data['remove_image']);

        $lecturer = Lecturer::create($data);

        $this->audit('created', $lecturer, $lecturer->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.lecturers.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function show(Lecturer $lecturer): View
    {
        return view('admin.lecturers.show', compact('lecturer'));
    }

    public function edit(Lecturer $lecturer): View
    {
        return view('admin.lecturers.form', compact('lecturer'));
    }

    public function update(LecturerRequest $request, Lecturer $lecturer): RedirectResponse
    {
        $old = $lecturer->toArray();
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
        $data['matkul'] = $this->parseList($data['matkul'] ?? null);
        $data['sertifikasi'] = $this->parseList($data['sertifikasi'] ?? null);

        if ($request->boolean('remove_image') && $lecturer->image) {
            $this->guardFileUsage($lecturer->image, []);
            $data['image'] = null;
        } elseif ($request->hasFile('image')) {
            if ($lecturer->image) {
                $this->guardFileUsage($lecturer->image, []);
            }
            $data['image'] = $this->storeImage($request->file('image'), 'lecturers');
        } else {
            unset($data['image']);
        }

        unset($data['remove_image']);

        $lecturer->update($data);

        $this->audit('updated', $lecturer, $lecturer->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.lecturers.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Lecturer $lecturer): RedirectResponse
    {
        $old = $lecturer->toArray();
        $lecturer->delete();

        $this->audit('deleted', $lecturer, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.lecturers.index')->with('success', 'Data dosen diarsipkan dan tidak tampil di publik.');
    }

    public function restore(string|int $lecturer): RedirectResponse
    {
        $item = Lecturer::withTrashed()->where('id', $lecturer)->orWhere('slug', (string) $lecturer)->firstOrFail();
        $item->restore();

        $this->audit('restored', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.lecturers.index')->with('success', 'Data dosen berhasil dipulihkan.');
    }

    private function parseList(?string $value): ?array
    {
        if (! $value) {
            return null;
        }

        $parsed = collect(preg_split('/[\r\n,;]+/', $value))->map(fn ($v) => trim($v))->filter()->take(20)->values()->all();

        return empty($parsed) ? null : $parsed;
    }
}
