<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AgendaRequest;
use App\Models\Agenda;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AgendaController extends BaseAdminController
{
    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'string', 'max:20'],
            'tahun' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'trashed' => ['nullable', 'boolean'],
        ]);

        $query = Agenda::query()->with('category:id,name')->orderBy('event_date');

        if ($request->boolean('trashed')) {
            $query->onlyTrashed();
        }

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(fn ($w) => $w->where('title', 'like', "%{$q}%")->orWhere('venue', 'like', "%{$q}%"));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('tahun')) {
            $query->whereYear('event_date', $request->input('tahun'));
        }

        $agendas = $query->paginate(12)->withQueryString();
        $years = Agenda::orderByDesc('event_date')->pluck('event_date')
            ->map(fn ($d) => Carbon::parse($d)->format('Y'))
            ->unique()->values()->all();

        return view('admin.agendas.index', compact('agendas', 'years'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'agenda')->orderBy('name')->get(['id', 'name']);

        return view('admin.agendas.form', ['agenda' => new Agenda, 'categories' => $categories]);
    }

    public function store(AgendaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug']);
        $data['is_upcoming'] = $request->boolean('is_upcoming', true);
        $data['published_at'] = now();

        $agenda = Agenda::create($data);

        $this->audit('created', $agenda, $agenda->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function show(Agenda $agenda): View
    {
        $agenda->load('category');

        return view('admin.agendas.show', compact('agenda'));
    }

    public function edit(Agenda $agenda): View
    {
        $categories = Category::where('type', 'agenda')->orderBy('name')->get(['id', 'name']);

        return view('admin.agendas.form', compact('agenda', 'categories'));
    }

    public function update(AgendaRequest $request, Agenda $agenda): RedirectResponse
    {
        $old = $agenda->toArray();
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug']);
        $data['is_upcoming'] = $request->boolean('is_upcoming');

        $agenda->update($data);

        $this->audit('updated', $agenda, $agenda->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda): RedirectResponse
    {
        $old = $agenda->toArray();
        $agenda->delete();

        $this->audit('deleted', $agenda, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda diarsipkan dan tidak tampil di publik.');
    }

    public function restore(string|int $agenda): RedirectResponse
    {
        $item = Agenda::withTrashed()->where('id', $agenda)->orWhere('slug', (string) $agenda)->firstOrFail();
        $item->restore();

        $this->audit('restored', $item, $item->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.agendas.index')->with('success', 'Agenda berhasil dipulihkan.');
    }
}
