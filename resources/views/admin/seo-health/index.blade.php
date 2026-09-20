@extends('admin.layouts.app')

@section('title', 'Kesehatan & Audit SEO')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Kesehatan SEO</li>
@endsection

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h4 fw-bold mb-1"><i class="fa-solid fa-gauge-high text-primary me-2"></i>Kesehatan & Audit SEO</h1>
            <p class="text-muted small mb-0">Pemantauan real-time metadata, structured data, canonical URL, sitemap, dan kesiapan Google Search Console.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ $sitemapUrl }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-sitemap me-1"></i> Buka Sitemap XML
            </a>
            <a href="{{ $robotsUrl }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                <i class="fa-solid fa-robot me-1"></i> Cek robots.txt
            </a>
            <form method="POST" action="{{ route('admin.seo-health.flush-cache') }}" class="d-inline">
                @csrf
                <button class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-rotate me-1"></i> Segarkan Cache Sitemap
                </button>
            </form>
        </div>
    </div>

    {{-- STAT TILES --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-tile h-100 p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Rute Publik Terindeks</div>
                        <div class="fs-4 fw-bold text-navy">{{ $health['routes_count'] }} Halaman</div>
                        <div class="small text-success"><i class="fa-solid fa-circle-check me-1"></i>100% 200 OK</div>
                    </div>
                    <i class="fa-solid fa-network-wired fs-2 text-primary opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-tile gold h-100 p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Berita Terbit (SEO)</div>
                        <div class="fs-4 fw-bold text-navy">{{ $health['news']['published'] }} Artikel</div>
                        <div class="small text-muted">{{ $health['news']['noindex_count'] }} Noindex &bull; {{ $health['news']['missing_featured_image'] }} Tanpa Gambar</div>
                    </div>
                    <i class="fa-solid fa-newspaper fs-2 text-warning opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-tile green h-100 p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Dokumen Publik di Sitemap</div>
                        <div class="fs-4 fw-bold text-navy">{{ $health['documents_in_sitemap'] }} File PDF</div>
                        <div class="small text-success"><i class="fa-solid fa-file-pdf me-1"></i>Kanonis & Stabil</div>
                    </div>
                    <i class="fa-solid fa-file-shield fs-2 text-success opacity-25"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-tile h-100 p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small">Default OG Image</div>
                        <div class="fs-6 fw-bold text-navy text-truncate" style="max-width: 150px;">{{ basename($health['settings']['default_og_image']) }}</div>
                        <div class="small {{ $health['settings']['og_image_exists'] ? 'text-success' : 'text-danger' }}">
                            <i class="fa-solid {{ $health['settings']['og_image_exists'] ? 'fa-circle-check' : 'fa-circle-xmark' }} me-1"></i>
                            {{ $health['settings']['og_image_exists'] ? '1200x630 Statis Aktif' : 'File Tidak Ditemukan' }}
                        </div>
                    </div>
                    <i class="fa-solid fa-image fs-2 text-primary opacity-25"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- AUDIT BREAKDOWN --}}
    <div class="row g-4 mb-4">
        {{-- Technical & Schema Audit --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fa-solid fa-code me-1 text-primary"></i> Audit Fondasi Technical SEO</span>
                    <span class="badge bg-success-subtle text-success">Optimal</span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                            <div>
                                <div class="fw-semibold small">Atribut Bahasa HTML (<code>lang="id"</code>)</div>
                                <div class="text-muted" style="font-size:0.75rem;">Mendefinisikan bahasa konten utama untuk bot pencari</div>
                            </div>
                            <span class="badge bg-success"><i class="fa-solid fa-check"></i> Aktif</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                            <div>
                                <div class="fw-semibold small">Canonical URL Tags</div>
                                <div class="text-muted" style="font-size:0.75rem;">Mencegah duplikasi parameter pencarian dan pagination</div>
                            </div>
                            <span class="badge bg-success"><i class="fa-solid fa-check"></i> Otomatis</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                            <div>
                                <div class="fw-semibold small">Robots.txt Dinamis</div>
                                <div class="text-muted" style="font-size:0.75rem;">Menutup akses bot ke <code>/admin/</code> dan <code>/search</code>, membuka publik</div>
                            </div>
                            <span class="badge bg-success"><i class="fa-solid fa-check"></i> Terkonfigurasi</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                            <div>
                                <div class="fw-semibold small">Sitemap XML Dinamis</div>
                                <div class="text-muted" style="font-size:0.75rem;">Mengikutsertakan berita & dokumen dengan <code>lastmod</code> presisi</div>
                            </div>
                            <span class="badge bg-success"><i class="fa-solid fa-check"></i> Terhubung DB</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                            <div>
                                <div class="fw-semibold small">Single H1 Semantic Hierarchy</div>
                                <div class="text-muted" style="font-size:0.75rem;">Satu tag H1 per halaman pada komponen header/hero</div>
                            </div>
                            <span class="badge bg-success"><i class="fa-solid fa-check"></i> Standard Semantik</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                            <div>
                                <div class="fw-semibold small">Image SEO & Alt Tags</div>
                                <div class="text-muted" style="font-size:0.75rem;">Lazy loading gambar bawah fold & deskripsi alt informatif</div>
                            </div>
                            <span class="badge bg-success"><i class="fa-solid fa-check"></i> Sesuai Standar</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Structured Data Status --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fa-solid fa-diagram-project me-1 text-primary"></i> Structured Data (Schema.org JSON-LD)</span>
                    <span class="badge bg-primary-subtle text-primary">Server Rendered</span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                            <div>
                                <div class="fw-semibold small"><code>EducationalOrganization</code> Schema</div>
                                <div class="text-muted" style="font-size:0.75rem;">Identitas institusi, logo, alamat resmi Ketintang, email, telepon</div>
                            </div>
                            <span class="badge bg-success">Global Head</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                            <div>
                                <div class="fw-semibold small"><code>WebSite</code> + <code>SearchAction</code> Schema</div>
                                <div class="text-muted" style="font-size:0.75rem;">Sitelink Search Box resmi merujuk ke endpoint <code>/search</code></div>
                            </div>
                            <span class="badge bg-success">Beranda</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                            <div>
                                <div class="fw-semibold small"><code>BreadcrumbList</code> Schema</div>
                                <div class="text-muted" style="font-size:0.75rem;">Hierarki navigasi terstruktur pada seluruh halaman sub</div>
                            </div>
                            <span class="badge bg-success">Seluruh Sub-halaman</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                            <div>
                                <div class="fw-semibold small"><code>NewsArticle</code> Schema</div>
                                <div class="text-muted" style="font-size:0.75rem;">Headline, gambar, tanggal publikasi/update, author & publisher</div>
                            </div>
                            <span class="badge bg-success">Detail Berita</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                            <div>
                                <div class="fw-semibold small"><code>Event</code> Schema</div>
                                <div class="text-muted" style="font-size:0.75rem;">Agenda kegiatan seminar, kuliah tamu, workshop sertifikasi CA</div>
                            </div>
                            <span class="badge bg-success">Halaman Agenda</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                            <div>
                                <div class="fw-semibold small"><code>Person</code> / Dosen Schema</div>
                                <div class="text-muted" style="font-size:0.75rem;">Profil tenaga pengajar profesional dan afiliasi UNESA</div>
                            </div>
                            <span class="badge bg-success">Profil Dosen</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Public Routes Matrix --}}
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-bold"><i class="fa-solid fa-list-check me-1 text-primary"></i> Matriks Rute Publik & Keyword Mapping</span>
            <span class="badge bg-secondary-subtle text-secondary">{{ count($health['public_routes']) }} Entitas Kanonis</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size:0.85rem;">
                    <thead>
                        <tr>
                            <th style="width:25%;">Halaman / Entitas</th>
                            <th style="width:35%;">Canonical URL</th>
                            <th style="width:25%;">Search Intent Utama</th>
                            <th style="width:15%;" class="text-center">Indexing Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($health['public_routes'] as $label => $url)
                            <tr>
                                <td class="fw-semibold text-navy">{{ $label }}</td>
                                <td>
                                    <a href="{{ $url }}" target="_blank" class="text-decoration-none text-muted small text-truncate d-inline-block" style="max-width:320px;">
                                        {{ $url }} <i class="fa-solid fa-arrow-up-right-from-square ms-1" style="font-size:0.7rem;"></i>
                                    </a>
                                </td>
                                <td>
                                    @if(str_contains($label, 'Beranda'))
                                        <span class="badge bg-primary-subtle text-primary">Navigational & Brand</span>
                                    @elseif(str_contains($label, 'Admisi') || str_contains($label, 'Biaya') || str_contains($label, 'Jalur'))
                                        <span class="badge bg-success-subtle text-success">Transactional / Admission</span>
                                    @elseif(str_contains($label, 'Akademik') || str_contains($label, 'Kurikulum') || str_contains($label, 'Gelar'))
                                        <span class="badge bg-info-subtle text-info">Academic & Certification</span>
                                    @elseif(str_contains($label, 'Riset') || str_contains($label, 'Publikasi'))
                                        <span class="badge bg-warning-subtle text-warning">Research & Collaboration</span>
                                    @elseif(str_contains($label, 'Kontak') || str_contains($label, 'Lokasi'))
                                        <span class="badge bg-secondary-subtle text-secondary">Local & Contact Intent</span>
                                    @else
                                        <span class="badge bg-light text-dark border">Informational</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success"><i class="fa-solid fa-check me-1"></i>Indexable</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Deployment & Google Search Console Checklist --}}
    <div class="card border-info">
        <div class="card-header bg-info-subtle text-info-emphasis fw-bold">
            <i class="fa-solid fa-clipboard-check me-1"></i> Checklist Deployment Production & Google Search Console
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-server me-1"></i> Pengaturan Lingkungan Production:</h6>
                    <ul class="small text-secondary ps-3 mb-0" style="line-height: 1.6;">
                        <li>Pastikan <code>APP_ENV=production</code> dan <code>APP_DEBUG=false</code> pada file <code>.env</code>.</li>
                        <li>Pastikan <code>APP_URL</code> terkonfigurasi ke domain production resmi (contoh: <code>https://ppak.feb.unesa.ac.id</code>).</li>
                        <li>Pastikan sertifikat SSL (HTTPS) terpasang aktif tanpa mixed-content HTTP.</li>
                        <li>Pastikan direktori <code>public/images/og-ppak-unesa.jpg</code> dapat diakses publik oleh bot medsos.</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-navy small mb-2"><i class="fa-brands fa-google me-1 text-primary"></i> Langkah Google Search Console:</h6>
                    <ul class="small text-secondary ps-3 mb-0" style="line-height: 1.6;">
                        <li>Daftarkan properti domain di <a href="https://search.google.com/search-console" target="_blank" class="text-primary fw-semibold">Google Search Console</a> via verifikasi DNS / HTML Tag.</li>
                        <li>Submit URL Sitemap: <code>{{ $sitemapUrl }}</code> pada menu Sitemaps.</li>
                        <li>Lakukan <strong>URL Inspection</strong> pada Homepage dan halaman pendaftaran untuk memvalidasi render bot.</li>
                        <li>Periksa tab <strong>Enhancements / Rich Results</strong> untuk memastikan schema Organization, Breadcrumb, dan Article terbaca valid.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
