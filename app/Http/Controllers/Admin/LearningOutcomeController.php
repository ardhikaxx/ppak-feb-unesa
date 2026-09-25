<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\LearningOutcomeRequest;
use App\Models\LearningOutcome;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\View\View;

class LearningOutcomeController extends BaseAdminController implements HasMiddleware
{
    /**
     * Otorisasi resource (Laravel Policy) per aksi CMS.
     */
    public static function middleware(): array
    {
        return self::resourceMiddleware(LearningOutcome::class);
    }

    public function index(): View
    {
        $outcomes = LearningOutcome::orderBy('sort_order')->paginate(15);

        return view('admin.learning-outcomes.index', compact('outcomes'));
    }

    public function create(): View
    {
        return view('admin.learning-outcomes.form', ['outcome' => new LearningOutcome]);
    }

    public function store(LearningOutcomeRequest $request): RedirectResponse
    {
        $outcome = LearningOutcome::create($request->validated());

        $this->audit('created', $outcome, $outcome->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.learning-outcomes.index')->with('success', 'CPL berhasil ditambahkan.');
    }

    public function edit(LearningOutcome $learning_outcome): View
    {
        return view('admin.learning-outcomes.form', ['outcome' => $learning_outcome]);
    }

    public function update(LearningOutcomeRequest $request, LearningOutcome $learning_outcome): RedirectResponse
    {
        $old = $learning_outcome->toArray();
        $learning_outcome->update($request->validated());

        $this->audit('updated', $learning_outcome, $learning_outcome->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.learning-outcomes.index')->with('success', 'CPL berhasil diperbarui.');
    }

    public function destroy(LearningOutcome $learning_outcome): RedirectResponse
    {
        $old = $learning_outcome->toArray();
        $learning_outcome->delete();

        $this->audit('deleted', $learning_outcome, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.learning-outcomes.index')->with('success', 'CPL dihapus.');
    }
}
