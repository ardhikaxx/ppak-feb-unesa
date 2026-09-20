<?php

namespace App\Repositories;

use App\Contracts\ContentRepositoryInterface;
use App\Models\AcademicCalendar;
use App\Models\AcademicCurriculum;
use App\Models\Accreditation;
use App\Models\AdmissionSchedule;
use App\Models\Agenda;
use App\Models\CommunityService;
use App\Models\Document;
use App\Models\FAQ;
use App\Models\Gallery;
use App\Models\LearningOutcome;
use App\Models\Lecturer;
use App\Models\News;
use App\Models\Partnership;
use App\Models\ProgramProfile;
use App\Models\Publication;
use App\Models\Testimonial;
use App\Models\TuitionFee;
use App\Services\PpakData;
use App\Support\CacheKeys;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

/**
 * Eloquent-backed repository - sumber data frontend dari database.
 *
 * Kontrak: mengembalikan bentuk array yang IDENTIK dengan
 * ArrayContentRepository/PpakData sehingga TIDAK ADA perubahan Blade.
 * Frontend hanya berganti sumber data, bukan tampilan.
 */
class EloquentContentRepository implements ContentRepositoryInterface
{
    private int $ttlStatic = 3600;

    private int $ttlDynamic = 600;

    // ------------------------------------------------------------------
    // Helpers format tanggal Indonesia (tanpa dependensi locale server)
    // ------------------------------------------------------------------

    private const BULAN = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
    ];

    private const BULAN_SINGKAT = [
        1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
        5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
        9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
    ];

    private function tglIndo(string|Carbon $date): string
    {
        $d = $date instanceof Carbon ? $date : Carbon::parse($date);

        return $d->day.' '.self::BULAN[$d->month].' '.$d->year;
    }

    /**
     * Format rentang tanggal gaya dokumen resmi:
     * sebulan "01 - 31 Juli 2026", beda bulan "20 Juli - 15 Agustus 2026",
     * beda tahun "28 Desember 2026 - 08 Januari 2027".
     */
    private function formatRentang(Carbon $start, ?Carbon $end): string
    {
        if (! $end || $start->isSameDay($end)) {
            return $this->tglIndo($start);
        }

        if ($start->month === $end->month && $start->year === $end->year) {
            return $start->format('d').' - '.$this->tglIndo($end);
        }

        if ($start->year === $end->year) {
            return $start->format('d').' '.self::BULAN[$start->month]
                .' - '.$this->tglIndo($end);
        }

        return $start->format('d').' '.self::BULAN[$start->month].' '.$start->year
            .' - '.$end->format('d').' '.self::BULAN[$end->month].' '.$end->year;
    }

    /**
     * Format ukuran gaya dokumen resmi existing: KB desimal (1 angka),
     * MB desimal (2 angka), dipotong (truncate) seperti data awal.
     */
    private function humanSize(int $bytes): string
    {
        if ($bytes >= 1000000) {
            return number_format(floor($bytes / 1000000 * 100) / 100, 2, '.', '').' MB';
        }

        return number_format(floor($bytes / 1000 * 10) / 10, 1, '.', '').' KB';
    }

    private function project(array $data, array $onlyColumns): array
    {
        if (empty($onlyColumns)) {
            return $data;
        }

        return array_map(function ($item) use ($onlyColumns) {
            $projected = [];
            foreach ($onlyColumns as $col) {
                if (array_key_exists($col, $item)) {
                    $projected[$col] = $item[$col];
                }
            }
            foreach (['id', 'slug'] as $key) {
                if (isset($item[$key]) && ! isset($projected[$key])) {
                    $projected[$key] = $item[$key];
                }
            }

            return $projected;
        }, $data);
    }

    // ------------------------------------------------------------------
    // Profil umum & statistik (ProgramProfile + Accreditation + TuitionFee)
    // ------------------------------------------------------------------

    public function getGeneralInfo(): array
    {
        return Cache::remember(CacheKeys::INSTITUTION_INFO, $this->ttlStatic, function () {
            $fallback = PpakData::getGeneralInfo();

            $profile = ProgramProfile::query()->first();
            $accred = Accreditation::query()->orderByDesc('effective_until')->first();
            $ukt = TuitionFee::query()->where('fee_type', 'UKT')->orderByDesc('id')->first();

            if (! $profile && ! $accred && ! $ukt) {
                return $fallback;
            }

            $socials = $profile?->social_links ?? $fallback['socials'];
            if (is_string($socials)) {
                $socials = json_decode($socials, true) ?: $fallback['socials'];
            }

            $uktAmount = $ukt?->amount ?? $fallback['ukt_amount'];

            return [
                'name' => $profile?->program_name ?? $fallback['name'],
                'program_code' => $profile?->program_code ?? $fallback['program_code'],
                'short_name' => $profile?->short_name ?? $fallback['short_name'],
                'faculty' => $profile?->faculty ?? $fallback['faculty'],
                'university' => $profile?->university ?? $fallback['university'],
                'level' => $profile?->level ?? $fallback['level'],
                'established_date' => $profile?->established_date
                    ? $this->tglIndo($profile->established_date)
                    : $fallback['established_date'],
                'coordinator' => $profile?->coordinator_name ?? $fallback['coordinator'],
                'coordinator_role' => $fallback['coordinator_role'],
                'tagline' => $profile?->tagline ?? $fallback['tagline'],
                'email' => $profile?->email ?? $fallback['email'],
                'phone' => $profile?->phone ?? $fallback['phone'],
                'whatsapp' => $profile?->whatsapp ?? $fallback['whatsapp'],
                'address' => $profile?->address ?? $fallback['address'],
                'office_hours' => $profile?->office_hours ?? $fallback['office_hours'],
                'socials' => $socials,
                'akreditasi_status' => $accred?->status ?? $fallback['akreditasi_status'],
                'akreditasi_lembaga' => $accred?->agency ?? $fallback['akreditasi_lembaga'],
                'sk_akreditasi' => $accred?->decree_number ?? $fallback['sk_akreditasi'],
                'tanggal_sk_akreditasi' => $accred?->decree_date
                    ? $this->tglIndo($accred->decree_date)
                    : $fallback['tanggal_sk_akreditasi'],
                'masa_berlaku_akreditasi' => $accred?->effective_until
                    ? $this->tglIndo($accred->effective_until)
                    : $fallback['masa_berlaku_akreditasi'],
                'akreditasi_source_url' => $accred?->source_url ?? $fallback['akreditasi_source_url'],
                'akreditasi_source_name' => $accred?->source_name ?? $fallback['akreditasi_source_name'],
                'ukt_amount' => (int) $uktAmount,
                'ukt_formatted' => 'Rp'.number_format((int) $uktAmount, 0, ',', '.'),
                'ukt_period' => $ukt?->period ?? $fallback['ukt_period'],
                'ukt_source_url' => $ukt?->source_url ?? $fallback['ukt_source_url'],
                'ukt_source_name' => $ukt?->source_name ?? $fallback['ukt_source_name'],
                'sources' => $fallback['sources'],
            ];
        });
    }

    public function getStats(): array
    {
        return Cache::remember(CacheKeys::STATS, $this->ttlStatic, function () {
            $info = $this->getGeneralInfo();

            return [
                [
                    'number' => $info['program_code'],
                    'label' => 'Kode Program Studi',
                    'desc' => 'Kode resmi program studi pada Pangkalan Data Pendidikan Tinggi & SINDIG UNESA.',
                    'source' => 'SINDIG UNESA',
                ],
                [
                    'number' => substr($info['established_date'], -4),
                    'label' => 'Tahun Berdiri Program',
                    'desc' => 'Tercatat resmi berdiri pada '.$info['established_date'].' di lingkungan FEB UNESA.',
                    'source' => 'SINDIG UNESA',
                ],
                [
                    'number' => $info['akreditasi_status'],
                    'label' => 'Akreditasi '.$info['akreditasi_lembaga'],
                    'desc' => 'SK No. '.$info['sk_akreditasi'].', masa berlaku hingga '.$info['masa_berlaku_akreditasi'].'.',
                    'source' => 'SIMUTU UNESA',
                ],
                [
                    'number' => 'Rp'.number_format(((float) $info['ukt_amount']) / 1000000, 1, ',', '.').' Jt',
                    'label' => 'UKT per Semester',
                    'desc' => 'Biaya pendidikan resmi berdasarkan ketetapan Admisi UNESA.',
                    'source' => 'Admisi UNESA',
                ],
            ];
        });
    }

    public function getKeunggulan(): array
    {
        // Salinan institusional statis (tidak ada tabel; sama seperti sebelumnya).
        return Cache::remember(CacheKeys::KEUNGGULAN, $this->ttlStatic, fn () => PpakData::getKeunggulan());
    }

    public function getKompetensi(): array
    {
        return Cache::remember(CacheKeys::KOMPETENSI, $this->ttlStatic, function () {
            $rows = LearningOutcome::query()->orderBy('sort_order')->get();

            if ($rows->isEmpty()) {
                return PpakData::getKompetensi();
            }

            $icons = ['fa-hands-holding-child', 'fa-people-group', 'fa-brain', 'fa-arrows-spin'];

            return $rows->values()->map(fn ($r, $i) => [
                'code' => $r->code,
                'title' => $r->title ?? $r->code,
                'desc' => $r->description,
                'icon' => $icons[$i % count($icons)],
                'category' => $r->category,
                'source' => $r->source_name ?? 'SINDIG UNESA - Kurikulum Prodi 62902',
            ])->all();
        });
    }

    // ------------------------------------------------------------------
    // Berita
    // ------------------------------------------------------------------

    private function mapNews(News $n): array
    {
        $cat = $n->category;
        $catName = $cat?->name ?? 'Admisi';
        // Petakan ke kode kategori singkat yang dipakai filter Blade.
        $short = match (true) {
            stripos($cat?->slug ?? '', 'feb') !== false || stripos($catName, 'Ekonomika') !== false => 'FEB',
            stripos($catName, 'Universitas') !== false => 'Informasi Universitas',
            default => 'Admisi',
        };

        $pub = $n->published_at ? Carbon::parse($n->published_at) : $n->created_at;

        return [
            'id' => $n->id,
            'slug' => $n->slug,
            'title' => $n->title,
            'excerpt' => $n->excerpt,
            'content' => $n->content,
            'category' => $short,
            'category_label' => $catName,
            'date' => $pub ? $this->tglIndo($pub) : '-',
            'date_raw' => $pub ? $pub->format('Y-m-d') : null,
            'read_time' => $n->read_time ?? '3 Menit Baca',
            'author' => $n->author?->name ?? 'Humas FEB UNESA',
            'image' => $n->image ?? '/images/default-img.png',
            'tags' => $n->tags ?? [],
            'source' => $n->author?->name ?? 'Humas FEB UNESA',
        ];
    }

    public function getBerita(array $onlyColumns = []): array
    {
        $data = Cache::remember(CacheKeys::BERITA_ALL, $this->ttlDynamic, function () {
            return News::query()
                ->with(['category:id,name,slug', 'author:id,name'])
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->get()
                ->map(fn ($n) => $this->mapNews($n))
                ->all();
        });

        return $this->project($data, $onlyColumns);
    }

    public function getBeritaPaginated(int $perPage = 6, ?string $search = null, ?string $category = null): LengthAwarePaginator
    {
        // Tanpa cache: query langsung ke DB berindeks (slug/status/published_at),
        // sehingga perubahan Admin selalu langsung terlihat.
        $query = News::query()
            ->with(['category:id,name,slug', 'author:id,name'])
            ->where('status', 'published')
            ->orderByDesc('published_at');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($category) {
            // Filter berdasarkan kode singkat Blade.
            $query->whereHas('category', function ($q) use ($category) {
                if ($category === 'FEB') {
                    $q->where('slug', 'like', '%feb%');
                } elseif ($category === 'Informasi Universitas') {
                    $q->where('name', 'like', '%Universitas%');
                } else {
                    $q->where('slug', 'like', '%admisi%');
                }
            });
        }

        $paginator = $query->paginate($perPage)->withQueryString();
        $paginator->getCollection()->transform(fn ($n) => $this->mapNews($n));

        return $paginator;
    }

    public function findBeritaBySlug(string $slug): ?array
    {
        return Cache::remember(CacheKeys::beritaSlug($slug), $this->ttlDynamic, function () use ($slug) {
            $n = News::query()
                ->with(['category:id,name,slug', 'author:id,name'])
                ->where('slug', $slug)
                ->where('status', 'published')
                ->first();

            return $n ? $this->mapNews($n) : null;
        });
    }

    public function getRelatedBerita(string $excludeSlug, int $limit = 3): array
    {
        return News::query()
            ->where('slug', '!=', $excludeSlug)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->limit($limit)
            ->with(['category:id,name,slug', 'author:id,name'])
            ->get()
            ->map(fn ($n) => $this->mapNews($n))
            ->all();
    }

    // ------------------------------------------------------------------
    // Agenda
    // ------------------------------------------------------------------

    private function mapAgenda(Agenda $a): array
    {
        $start = Carbon::parse($a->event_date);
        $end = $a->event_end_date ? Carbon::parse($a->event_end_date) : null;

        return [
            'id' => $a->id,
            'title' => $a->title,
            'slug' => $a->slug,
            'day' => $start->format('d'),
            'month' => self::BULAN_SINGKAT[$start->month],
            'date' => $this->tglIndo($start),
            'date_end' => $end ? $this->tglIndo($end) : $this->tglIndo($start),
            'date_raw' => $start->format('Y-m-d'),
            'time' => $a->time ?? 'Sesuai Jadwal Kuliah',
            'venue' => $a->venue ?? 'FEB UNESA Kampus Ketintang',
            'speaker' => $a->speaker ?? 'Dosen Pengampu Mata Kuliah',
            'category' => $a->category?->name ?? 'Akademik',
            'category_label' => $a->category?->name ?? 'Aktivitas Perkuliahan Akademik',
            'status' => $a->is_upcoming ? 'Mendatang' : 'Selesai',
            'is_upcoming' => (bool) $a->is_upcoming,
            'desc' => $a->description ?? '',
            'description' => $a->description ?? '',
            'source' => $a->source_name ?? 'Kalender Akademik UNESA & SINDIG',
        ];
    }

    public function getAgenda(array $onlyColumns = []): array
    {
        $data = Cache::remember(CacheKeys::AGENDA_ALL, $this->ttlDynamic, function () {
            return Agenda::query()
                ->with('category:id,name')
                ->orderBy('event_date')
                ->get()
                ->map(fn ($a) => $this->mapAgenda($a))
                ->all();
        });

        return $this->project($data, $onlyColumns);
    }

    public function getAgendaPaginated(int $perPage = 5, bool $upcomingOnly = false): LengthAwarePaginator
    {
        $query = Agenda::query()->with('category:id,name')->orderBy('event_date');

        if ($upcomingOnly) {
            $query->where('is_upcoming', true);
        }

        $paginator = $query->paginate($perPage)->withQueryString();
        $paginator->getCollection()->transform(fn ($a) => $this->mapAgenda($a));

        return $paginator;
    }

    // ------------------------------------------------------------------
    // Dosen
    // ------------------------------------------------------------------

    private function mapLecturer(Lecturer $d): array
    {
        return [
            'id' => $d->id,
            'name' => $d->name,
            'gelar' => $d->gelar ?? $d->name,
            'role' => $d->role ?? 'Dosen Pengajar',
            'category' => $d->category,
            'category_label' => $d->category_label ?? $d->category,
            'bidang' => $d->bidang ?? '',
            'matkul' => $d->matkul ?? [],
            'image' => $d->image ?? '/images/default-img.png',
            'email' => $d->email,
            'sertifikasi' => $d->sertifikasi ?? [],
            'status_label' => $d->role ?? 'Dosen Pengajar',
            'source' => $d->source_name ?? 'SINDIG UNESA & Pangkalan Data Dosen UNESA',
        ];
    }

    public function getDosen(array $onlyColumns = []): array
    {
        $data = Cache::remember(CacheKeys::DOSEN_ALL, $this->ttlStatic, function () {
            return Lecturer::query()
                ->where('status', 'active')
                ->orderBy('sort_order')
                ->get()
                ->map(fn ($d) => $this->mapLecturer($d))
                ->all();
        });

        return $this->project($data, $onlyColumns);
    }

    public function getDosenPaginated(int $perPage = 8, ?string $category = null): LengthAwarePaginator
    {
        $query = Lecturer::query()->where('status', 'active')->orderBy('sort_order');

        if ($category) {
            $query->where('category', $category);
        }

        $paginator = $query->paginate($perPage)->withQueryString();
        $paginator->getCollection()->transform(fn ($d) => $this->mapLecturer($d));

        return $paginator;
    }

    // ------------------------------------------------------------------
    // Mitra, testimoni, karier
    // ------------------------------------------------------------------

    public function getMitra(): array
    {
        return Cache::remember(CacheKeys::MITRA, $this->ttlStatic, function () {
            $rows = Partnership::query()->where('status', 'active')->orderBy('id')->get();

            if ($rows->isEmpty()) {
                return PpakData::getMitra();
            }

            return [
                'status' => 'published',
                'message' => 'Jejaring kemitraan resmi program studi.',
                'items' => $rows->map(fn ($p) => [
                    'name' => $p->partner_name,
                    'category' => $p->partner_category,
                    'type' => $p->collaboration_type,
                    'description' => $p->collaboration_type ?? '',
                    'logo' => $p->logo,
                    'source' => $p->source_name,
                ])->all(),
            ];
        });
    }

    public function getTestimoni(): array
    {
        return Cache::remember(CacheKeys::TESTIMONI, $this->ttlStatic, function () {
            $rows = Testimonial::query()->where('status', 'published')->orderBy('sort_order')->get();

            if ($rows->isEmpty()) {
                return PpakData::getTestimoni();
            }

            return [
                'status' => 'published',
                'message' => 'Testimoni alumni terverifikasi.',
                'items' => $rows->map(fn ($t) => [
                    'name' => $t->name,
                    'role' => $t->role,
                    'company' => $t->company,
                    'year' => $t->year,
                    'avatar' => $t->avatar,
                    'quote' => $t->quote,
                ])->all(),
            ];
        });
    }

    public function getKarierSectors(): array
    {
        return Cache::remember(CacheKeys::KARIER_SECTORS, $this->ttlStatic, fn () => PpakData::getKarierSectors());
    }

    // ------------------------------------------------------------------
    // Kurikulum
    // ------------------------------------------------------------------

    public function getKurikulum(): array
    {
        return Cache::remember(CacheKeys::KURIKULUM, $this->ttlStatic, function () {
            $rows = AcademicCurriculum::query()->orderBy('semester')->orderBy('sort_order')->get();

            if ($rows->isEmpty()) {
                return PpakData::getKurikulum();
            }

            $map = fn ($r) => [
                'kode' => $r->course_code,
                'nama' => $r->name_id,
                'sks' => (int) $r->credits,
                'jenis' => $r->course_type,
                'deskripsi' => $r->description ?? '',
                'cpl' => $r->cpl_mapping ?? [],
                'pengajar' => $r->instructors ?? [],
            ];

            $s1 = $rows->where('semester', 1)->values()->map($map)->all();
            $s2 = $rows->where('semester', 2)->values()->map($map)->all();
            $magang = $rows->whereNotIn('semester', [1, 2])->values()->map(fn ($r) => [
                'nama' => $r->name_id,
                'sks' => (int) $r->credits,
                'deskripsi' => $r->description ?? '',
            ])->all();

            if (empty($s1)) {
                $s1 = PpakData::getKurikulum()['semester_1'];
            }
            if (empty($s2)) {
                $s2 = PpakData::getKurikulum()['semester_2'];
            }
            if (empty($magang)) {
                $magang = PpakData::getKurikulum()['paket_magang'];
            }

            return [
                'semester_1' => $s1,
                'semester_2' => $s2,
                'paket_magang' => $magang,
                'source' => 'SINDIG UNESA - Program Studi Pendidikan Profesi Akuntan (Kode 62902)',
                'source_url' => 'https://sindig.unesa.ac.id',
            ];
        });
    }

    // ------------------------------------------------------------------
    // Kalender akademik
    // ------------------------------------------------------------------

    public function getKalender(): array
    {
        return Cache::remember(CacheKeys::KALENDER, $this->ttlStatic, function () {
            $rows = AcademicCalendar::query()->orderBy('sort_order')->get();

            if ($rows->isEmpty()) {
                return PpakData::getKalender();
            }

            $tahun = $rows->sortByDesc('academic_year')->first()->academic_year;
            $rowsTahun = $rows->where('academic_year', $tahun);

            $build = function ($semester) use ($rowsTahun) {
                $items = $rowsTahun->where('semester', $semester)->values();
                if ($items->isEmpty()) {
                    return null;
                }

                $min = $items->map(fn ($r) => Carbon::parse($r->start_date))->min();
                $max = $items->map(fn ($r) => $r->end_date ? Carbon::parse($r->end_date) : Carbon::parse($r->start_date))->max();

                // Label periode resmi jika diisi admin/seeder, fallback ke rentang tanggal.
                $periode = $items->firstWhere('period_label', '!=', null)?->period_label
                    ?? ($this->tglIndo($min).' – '.$this->tglIndo($max));

                return [
                    'periode' => $periode,
                    'agenda' => $items->map(function ($r) {
                        return [
                            'tanggal' => $this->formatRentang(
                                Carbon::parse($r->start_date),
                                $r->end_date ? Carbon::parse($r->end_date) : null
                            ),
                            'kegiatan' => $r->activity,
                            'kategori' => $r->category,
                        ];
                    })->all(),
                ];
            };

            $gasal = $build('Gasal');
            $genap = $build('Genap');

            if (! $gasal || ! $genap) {
                return PpakData::getKalender();
            }

            $first = $rowsTahun->first();

            return [
                'tahun_akademik' => $tahun,
                'sk_info' => $first->decree_info ?? 'Kalender Akademik Resmi UNESA',
                'instansi' => $first->source_name ?? 'Direktorat Pendidikan dan Transformasi Pembelajaran Universitas Negeri Surabaya',
                'source_url' => $first->source_url ?? 'https://unesa.ac.id',
                'gasal' => $gasal,
                'genap' => $genap,
            ];
        });
    }

    // ------------------------------------------------------------------
    // Admisi
    // ------------------------------------------------------------------

    public function getAdmisiInfo(): array
    {
        return Cache::remember(CacheKeys::ADMISI, $this->ttlStatic, function () {
            $fallback = PpakData::getAdmisiInfo();

            $ukt = TuitionFee::query()->where('fee_type', 'UKT')->orderByDesc('id')->first();
            $waves = AdmissionSchedule::query()->orderBy('sort_order')->get();

            $jadwal = $waves->isNotEmpty()
                ? $waves->map(fn ($w) => [
                    'gelombang' => $w->wave_name,
                    'pendaftaran' => $w->period_label ?? ($this->tglIndo($w->start_date).' – '.$this->tglIndo($w->end_date)),
                    'seleksi' => $w->exam_date ? $this->tglIndo($w->exam_date) : 'Menyesuaikan pengumuman resmi',
                    'pengumuman' => $w->announcement_date ? $this->tglIndo($w->announcement_date) : 'Menyesuaikan pengumuman resmi',
                    'registrasi' => $w->registration_deadline ? $this->tglIndo($w->registration_deadline) : 'Menyesuaikan pengumuman resmi',
                    'status' => $w->status === 'active' ? 'Dibuka' : ($w->status === 'upcoming' ? 'Segera Dibuka' : 'Selesai (Arsip)'),
                ])->all()
                : $fallback['jadwal_2026'];

            $hasActive = $waves->contains(fn ($w) => $w->status === 'active');

            return [
                'ukt' => (int) ($ukt?->amount ?? $fallback['ukt']),
                'ukt_label' => $ukt
                    ? 'Rp'.number_format((int) $ukt->amount, 0, ',', '.').' / semester'
                    : $fallback['ukt_label'],
                'ukt_note' => $ukt?->description ?? $fallback['ukt_note'],
                'registration_fee_note' => $fallback['registration_fee_note'],
                'portal_url' => $fallback['portal_url'],
                'admisi_url' => $fallback['admisi_url'],
                'status' => $hasActive ? 'dibuka' : 'arsip',
                'status_label' => $hasActive ? 'Pendaftaran Dibuka' : 'Arsip Seleksi '.($waves->first()?->academic_year ?? '2026/2027'),
                'jadwal_2026' => $jadwal,
                'persyaratan_umum' => $fallback['persyaratan_umum'],
                'tahapan_pendaftaran' => $fallback['tahapan_pendaftaran'],
            ];
        });
    }

    public function getFaq(): array
    {
        return Cache::remember(CacheKeys::FAQ, $this->ttlStatic, function () {
            $rows = FAQ::query()->orderBy('sort_order')->get();

            if ($rows->isEmpty()) {
                return PpakData::getFaq();
            }

            return $rows->map(fn ($f) => [
                'kategori' => $f->category,
                'tanya' => $f->question,
                'jawab' => $f->answer,
                'q' => $f->question,
                'a' => $f->answer,
            ])->all();
        });
    }

    // ------------------------------------------------------------------
    // Riset, pengabdian, galeri, unduhan
    // ------------------------------------------------------------------

    public function getRiset(): array
    {
        return Cache::remember(CacheKeys::RISET, $this->ttlDynamic, function () {
            $rows = Publication::query()->orderByDesc('publish_date')->get();

            if ($rows->isEmpty()) {
                return PpakData::getRiset();
            }

            return $rows->map(fn ($p, $i) => [
                'id' => $p->id,
                'judul' => $p->title,
                'penulis' => $p->authors,
                'tahun' => $p->year ?? ($p->publish_date ? Carbon::parse($p->publish_date)->format('Y') : '-'),
                'tanggal' => $p->publish_date ? $this->tglIndo($p->publish_date) : '-',
                'kategori' => $p->publication_type ?? 'Publikasi Dosen PPAk/FEB',
                'jurnal' => $p->journal_or_publisher ?? '-',
                'doi' => $p->doi_or_url,
                'sinta_url' => $p->doi_or_url ?? 'https://sinta.kemdikbud.go.id',
                'sitasi' => 'Terindeks SINTA Kemendikbudristek',
                'deskripsi' => $p->journal_or_publisher ?? '',
                'source' => $p->source_name ?? 'SINTA & Database Publikasi Dosen UNESA',
            ])->all();
        });
    }

    public function getPengabdian(): array
    {
        return Cache::remember(CacheKeys::PENGABDIAN, $this->ttlStatic, function () {
            $rows = CommunityService::query()->where('status', 'published')->orderByDesc('year')->get();

            if ($rows->isEmpty()) {
                return PpakData::getPengabdian();
            }

            return [
                'status' => 'published',
                'message' => 'Kegiatan pengabdian kepada masyarakat terverifikasi.',
                'items' => $rows->map(fn ($p) => [
                    'title' => $p->title,
                    'leader' => $p->leader_name,
                    'location' => $p->location,
                    'year' => $p->year,
                    'tahun' => $p->year,
                    'description' => $p->description,
                ])->all(),
            ];
        });
    }

    public function getGaleri(): array
    {
        return Cache::remember(CacheKeys::GALERI, $this->ttlDynamic, function () {
            $rows = Gallery::query()
                ->with('category:id,name')
                ->where('status', 'published')
                ->orderByDesc('event_date')
                ->get();

            if ($rows->isEmpty()) {
                return PpakData::getGaleri();
            }

            return $rows->map(fn ($g) => [
                'id' => $g->id,
                'title' => $g->title,
                'category' => $g->category?->name ?? 'Dokumentasi',
                'date' => $g->event_date ? Carbon::parse($g->event_date)->format('Y') : '-',
                'image' => $g->image,
                'description' => $g->title,
                'source' => $g->source_name ?? 'Dokumentasi Resmi FEB UNESA',
            ])->all();
        });
    }

    public function getUnduhan(): array
    {
        return Cache::remember(CacheKeys::UNDUHAN, $this->ttlDynamic, function () {
            $rows = Document::query()
                ->with('category:id,name')
                ->where('status', 'published')
                ->orderByDesc('year')
                ->get();

            if ($rows->isEmpty()) {
                return PpakData::getUnduhan();
            }

            return $rows->map(fn ($d) => [
                'id' => $d->id,
                'judul' => $d->title,
                'title' => $d->title,
                'slug' => $d->slug,
                'filename' => $d->filename,
                'kategori' => $d->category?->name ?? 'Dokumen',
                'nomor_sk' => $d->source_name ?? '-',
                'tanggal' => (string) ($d->year ?? '-'),
                'tahun' => (string) ($d->year ?? '-'),
                'ukuran' => $this->humanSize((int) $d->size),
                'size' => $this->humanSize((int) $d->size),
                'format' => $d->format,
                'instansi' => $d->source_name ?? 'PPAk FEB UNESA',
                'url' => $d->source_url ?? '#',
                'source' => $d->source_name ?? 'PPAk FEB UNESA',
            ])->all();
        });
    }

    public function getUnduhanPaginated(int $perPage = 10, ?string $category = null): LengthAwarePaginator
    {
        $query = Document::query()
            ->with('category:id,name')
            ->where('status', 'published')
            ->orderByDesc('year');

        if ($category) {
            $query->whereHas('category', fn ($q) => $q->where('name', $category));
        }

        $paginator = $query->paginate($perPage)->withQueryString();
        $paginator->getCollection()->transform(fn ($d) => [
            'id' => $d->id,
            'judul' => $d->title,
            'title' => $d->title,
            'slug' => $d->slug,
            'filename' => $d->filename,
            'kategori' => $d->category?->name ?? 'Dokumen',
            'nomor_sk' => $d->source_name ?? '-',
            'tanggal' => (string) ($d->year ?? '-'),
            'tahun' => (string) ($d->year ?? '-'),
            'ukuran' => $this->humanSize((int) $d->size),
            'size' => $this->humanSize((int) $d->size),
            'format' => $d->format,
            'instansi' => $d->source_name ?? 'PPAk FEB UNESA',
            'url' => $d->source_url ?? '#',
            'source' => $d->source_name ?? 'PPAk FEB UNESA',
        ]);

        return $paginator;
    }

    public function search(string $keyword, int $perPage = 6): array
    {
        if (mb_strlen(trim($keyword)) < 2) {
            return ['berita' => [], 'agenda' => [], 'dosen' => []];
        }

        $berita = News::query()
            ->where('status', 'published')
            ->where(fn ($q) => $q->where('title', 'like', "%{$keyword}%")->orWhere('excerpt', 'like', "%{$keyword}%"))
            ->orderByDesc('published_at')
            ->limit($perPage)
            ->with(['category:id,name,slug', 'author:id,name'])
            ->get()
            ->map(fn ($n) => $this->mapNews($n))
            ->all();

        $agenda = Agenda::query()
            ->where(fn ($q) => $q->where('title', 'like', "%{$keyword}%")->orWhere('description', 'like', "%{$keyword}%"))
            ->orderBy('event_date')
            ->limit($perPage)
            ->with('category:id,name')
            ->get()
            ->map(fn ($a) => $this->mapAgenda($a))
            ->all();

        $dosen = Lecturer::query()
            ->where('status', 'active')
            ->where(fn ($q) => $q->where('name', 'like', "%{$keyword}%")->orWhere('bidang', 'like', "%{$keyword}%"))
            ->orderBy('sort_order')
            ->limit($perPage)
            ->get()
            ->map(fn ($d) => $this->mapLecturer($d))
            ->all();

        return ['berita' => $berita, 'agenda' => $agenda, 'dosen' => $dosen];
    }
}
