<?php

namespace App\Http\Controllers\Admin;

use App\Models\AcademicCalendar;
use App\Models\AcademicCurriculum;
use App\Models\AdmissionSchedule;
use App\Models\Agenda;
use App\Models\AuditLog;
use App\Models\Document;
use App\Models\FAQ;
use App\Models\Gallery;
use App\Models\HelpdeskInquiry;
use App\Models\LearningOutcome;
use App\Models\Lecturer;
use App\Models\News;
use App\Models\Publication;
use App\Models\Testimonial;
use App\Models\TuitionFee;
use Illuminate\View\View;

class DashboardController extends BaseAdminController
{
    public function index(): View
    {
        $newsTotal = News::count();
        $newsPublished = News::where('status', 'published')->count();
        $newsDraft = News::where('status', 'draft')->count();

        $stats = [
            ['label' => 'Berita Terbit', 'value' => $newsPublished, 'icon' => 'fa-newspaper', 'url' => route('admin.news.index'), 'class' => ''],
            ['label' => 'Berita Draft', 'value' => $newsDraft, 'icon' => 'fa-pen-to-square', 'url' => route('admin.news.index', ['status' => 'draft']), 'class' => 'gold'],
            ['label' => 'Agenda / Event', 'value' => Agenda::count(), 'icon' => 'fa-calendar-check', 'url' => route('admin.agendas.index'), 'class' => 'green'],
            ['label' => 'Dosen Aktif', 'value' => Lecturer::where('status', 'active')->count(), 'icon' => 'fa-chalkboard-user', 'url' => route('admin.lecturers.index'), 'class' => ''],
            ['label' => 'Mata Kuliah', 'value' => AcademicCurriculum::count(), 'icon' => 'fa-book-open', 'url' => route('admin.curricula.index'), 'class' => ''],
            ['label' => 'CPL', 'value' => LearningOutcome::count(), 'icon' => 'fa-bullseye', 'url' => route('admin.learning-outcomes.index'), 'class' => 'gold'],
            ['label' => 'Dokumen', 'value' => Document::count(), 'icon' => 'fa-file-pdf', 'url' => route('admin.documents.index'), 'class' => ''],
            ['label' => 'Galeri', 'value' => Gallery::count(), 'icon' => 'fa-images', 'url' => route('admin.galleries.index'), 'class' => 'green'],
            ['label' => 'Publikasi', 'value' => Publication::count(), 'icon' => 'fa-file-lines', 'url' => route('admin.publications.index'), 'class' => ''],
            ['label' => 'FAQ', 'value' => FAQ::count(), 'icon' => 'fa-circle-question', 'url' => route('admin.faqs.index'), 'class' => ''],
            ['label' => 'Testimoni Terbit', 'value' => Testimonial::where('status', 'published')->count(), 'icon' => 'fa-quote-left', 'url' => route('admin.testimonials.index'), 'class' => 'gold'],
            ['label' => 'Helpdesk Terbuka', 'value' => HelpdeskInquiry::where('status', 'open')->count(), 'icon' => 'fa-headset', 'url' => route('admin.helpdesk.index'), 'class' => 'red'],
        ];

        $periods = [
            'Tahun akademik kalender' => AcademicCalendar::select('academic_year')->distinct()->orderByDesc('academic_year')->limit(5)->pluck('academic_year')->all(),
            'Gelombang admisi aktif' => AdmissionSchedule::where('status', 'active')->count(),
            'Periode biaya' => TuitionFee::select('academic_year')->distinct()->orderByDesc('academic_year')->limit(5)->pluck('academic_year')->all(),
        ];

        $recentLogs = AuditLog::orderByDesc('id')->limit(10)->get();
        $recentNews = News::orderByDesc('updated_at')->limit(5)->get(['id', 'title', 'status', 'updated_at']);

        $lastUpdates = collect([
            ['entity' => 'Berita', 'at' => News::max('updated_at')],
            ['entity' => 'Agenda', 'at' => Agenda::max('updated_at')],
            ['entity' => 'Dosen', 'at' => Lecturer::max('updated_at')],
            ['entity' => 'Dokumen', 'at' => Document::max('updated_at')],
            ['entity' => 'Kurikulum', 'at' => AcademicCurriculum::max('updated_at')],
        ])->sortByDesc('at')->take(5);

        return view('admin.dashboard', compact(
            'stats', 'periods', 'recentLogs', 'recentNews', 'lastUpdates',
            'newsTotal', 'newsPublished', 'newsDraft'
        ));
    }
}
