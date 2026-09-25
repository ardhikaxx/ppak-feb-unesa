<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CurriculumRequest;
use App\Models\AcademicCurriculum;
use App\Models\LearningOutcome;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\View\View;

class CurriculumController extends BaseAdminController implements HasMiddleware
{
    /**
     * Otorisasi resource (Laravel Policy) per aksi CMS.
     */
    public static function middleware(): array
    {
        return self::resourceMiddleware(AcademicCurriculum::class, 'curriculum');
    }

    public function index(Request $request): View
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'semester' => ['nullable', 'integer', 'min:1', 'max:8'],
        ]);

        $query = AcademicCurriculum::orderBy('semester')->orderBy('sort_order');

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(fn ($w) => $w->where('name_id', 'like', "%{$q}%")->orWhere('course_code', 'like', "%{$q}%"));
        }

        if ($request->filled('semester')) {
            $query->where('semester', $request->input('semester'));
        }

        $courses = $query->paginate(15)->withQueryString();
        $semesters = AcademicCurriculum::select('semester')->distinct()->orderBy('semester')->pluck('semester');

        return view('admin.curricula.index', compact('courses', 'semesters'));
    }

    public function create(): View
    {
        $cpls = LearningOutcome::orderBy('sort_order')->get(['code', 'title']);

        return view('admin.curricula.form', ['course' => new AcademicCurriculum, 'cpls' => $cpls]);
    }

    public function store(CurriculumRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['instructors'] = $this->parseInstructors($data['instructors'] ?? null);

        $course = AcademicCurriculum::create($data);

        $this->audit('created', $course, $course->toArray());
        $this->flushContentCache();

        return redirect()->route('admin.curricula.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(AcademicCurriculum $curriculum): View
    {
        $cpls = LearningOutcome::orderBy('sort_order')->get(['code', 'title']);

        return view('admin.curricula.form', ['course' => $curriculum, 'cpls' => $cpls]);
    }

    public function update(CurriculumRequest $request, AcademicCurriculum $curriculum): RedirectResponse
    {
        $old = $curriculum->toArray();
        $data = $request->validated();
        $data['instructors'] = $this->parseInstructors($data['instructors'] ?? null);

        $curriculum->update($data);

        $this->audit('updated', $curriculum, $curriculum->fresh()->toArray(), $old);
        $this->flushContentCache();

        return redirect()->route('admin.curricula.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(AcademicCurriculum $curriculum): RedirectResponse
    {
        $old = $curriculum->toArray();
        $curriculum->delete();

        $this->audit('deleted', $curriculum, [], $old);
        $this->flushContentCache();

        return redirect()->route('admin.curricula.index')->with('success', 'Mata kuliah dihapus.');
    }

    private function parseInstructors(?string $value): ?array
    {
        if (! $value) {
            return null;
        }

        $parsed = collect(preg_split('/[\r\n,;]+/', $value))->map(fn ($v) => trim($v))->filter()->take(20)->values()->all();

        return empty($parsed) ? null : $parsed;
    }
}
