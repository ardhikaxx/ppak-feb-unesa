<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Area internal: jangan diindeks search engine --}}
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('title', 'CMS Admin') | PPAk FEB UNESA</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-single.png') }}">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --navy: #102a43;
            --navy-dark: #0b1e33;
            --gold: #c9a227;
            --bg: #f1f4f8;
        }
        body { background: var(--bg); font-size: .925rem; }
        .sidebar { width: 264px; background: var(--navy); min-height: 100vh; position: fixed; top: 0; bottom: 0; left: 0; z-index: 1040; display: flex; flex-direction: column; transition: transform .25s ease; }
        .sidebar-brand { padding: 1.1rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,.12); color: #fff; }
        .sidebar-brand img { height: 38px; }
        .sidebar-nav { flex: 1; overflow-y: auto; padding: .75rem .75rem 1.5rem; }
        .sidebar-group { color: #8fa3bd; font-size: .68rem; letter-spacing: .08em; text-transform: uppercase; padding: 1rem .6rem .35rem; font-weight: 700; }
        .sidebar-link { display: flex; align-items: center; gap: .65rem; color: #cdd9e8; text-decoration: none; padding: .5rem .6rem; border-radius: .5rem; font-weight: 500; }
        .sidebar-link i { width: 20px; text-align: center; color: #8fa3bd; }
        .sidebar-link:hover { background: rgba(255,255,255,.08); color: #fff; }
        .sidebar-link.active { background: #fff; color: var(--navy); font-weight: 700; }
        .sidebar-link.active i { color: var(--gold); }
        .sidebar-footer { border-top: 1px solid rgba(255,255,255,.12); padding: .9rem 1.25rem; color: #cdd9e8; font-size: .8rem; }
        .main { margin-left: 264px; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { background: #fff; border-bottom: 1px solid #dee2e6; position: sticky; top: 0; z-index: 1030; }
        .content { padding: 1.5rem; flex: 1; }
        .card { border: 1px solid #dee2e6; box-shadow: 0 1px 2px rgba(16,42,67,.06); }
        .card-header { background: #fff; font-weight: 700; color: var(--navy); }
        .stat-tile { border-left: 4px solid var(--navy); }
        .stat-tile.gold { border-left-color: var(--gold); }
        .stat-tile.green { border-left-color: #198754; }
        .stat-tile.red { border-left-color: #dc3545; }
        .table th { background: #f8fafc; color: var(--navy); font-size: .78rem; text-transform: uppercase; letter-spacing: .04em; }
        .required::after { content: " *"; color: #dc3545; }
        .sidebar-backdrop { display: none; }
        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); width: 280px; max-width: 85vw; }
            body.sidebar-open .sidebar { transform: translateX(0); }
            body.sidebar-open .sidebar-backdrop { display: block; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 1035; }
            .main { margin-left: 0; }
            .topbar .breadcrumb { max-width: calc(100vw - 180px); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
            .topbar .breadcrumb-item { max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
            .content { padding: 1rem; }
            .card-header { font-size: 0.85rem; padding: 0.65rem 0.85rem; }
            .card-body { padding: 0.85rem; }
            .table th { font-size: 0.7rem; padding: 0.6rem 0.5rem; }
            .table td { font-size: 0.8rem; padding: 0.6rem 0.5rem; }
            .btn-group-sm .btn { padding: 0.25rem 0.4rem; font-size: 0.75rem; }
            .stat-tile .card-body { gap: 0.5rem !important; }
            .stat-tile .fs-3 { font-size: 1.2rem !important; }
            .stat-tile .fs-4 { font-size: 1.1rem !important; }
            .form-control, .form-select { font-size: 16px; min-height: 44px; }
            .form-label { font-size: 0.85rem; }
            .breadcrumb { font-size: 0.75rem; }
            footer.px-4 { padding-left: 1rem !important; padding-right: 1rem !important; font-size: 0.75rem; }
        }
        @media (max-width: 575.98px) {
            .topbar .d-flex.align-items-center.gap-2 { flex-wrap: wrap; gap: 0.35rem !important; }
            .topbar .btn { font-size: 0.75rem; padding: 0.25rem 0.5rem; }
            .topbar .dropdown-toggle { font-size: 0.75rem; padding: 0.25rem 0.5rem; max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
            .content { padding: 0.75rem; }
            .d-flex.align-items-center.justify-content-between { flex-direction: column; align-items: stretch !important; gap: 0.6rem; }
            .d-flex.align-items-center.justify-content-between .btn { width: 100%; justify-content: center; }
            .row.g-3 > [class*="col-"] { padding-left: 0.375rem; padding-right: 0.375rem; }
            .stat-tile .card-body { flex-direction: row !important; text-align: left !important; gap: 0.6rem !important; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
    <aside class="sidebar" id="adminSidebar" aria-label="Navigasi CMS">
        <div class="sidebar-brand d-flex align-items-center gap-2">
            <img src="{{ asset('images/logo-single.png') }}" alt="Logo PPAk FEB UNESA" width="38" height="38">
            <div>
                <div class="fw-bold" style="font-size:.95rem;">CMS PPAk</div>
                <div class="small" style="color:#8fa3bd;">FEB UNESA</div>
            </div>
        </div>
        @php($cmsAdmin = auth('admin')->user())
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>

            <div class="sidebar-group">Profil PPAk</div>
            @if($cmsAdmin?->isSuperAdmin())
                <a href="{{ route('admin.program-profile.edit') }}" class="sidebar-link {{ request()->routeIs('admin.program-profile.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-building-columns"></i> Profil Program
                </a>
                <a href="{{ route('admin.accreditations.index') }}" class="sidebar-link {{ request()->routeIs('admin.accreditations.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-award"></i> Akreditasi
                </a>
            @endif
            <a href="{{ route('admin.lecturers.index') }}" class="sidebar-link {{ request()->routeIs('admin.lecturers.*') ? 'active' : '' }}">
                <i class="fa-solid fa-chalkboard-user"></i> Dosen / Pengajar
            </a>

            <div class="sidebar-group">Akademik</div>
            <a href="{{ route('admin.curricula.index') }}" class="sidebar-link {{ request()->routeIs('admin.curricula.*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-open"></i> Kurikulum
            </a>
            @if($cmsAdmin?->isSuperAdmin())
                <a href="{{ route('admin.learning-outcomes.index') }}" class="sidebar-link {{ request()->routeIs('admin.learning-outcomes.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-bullseye"></i> CPL
                </a>
                <a href="{{ route('admin.academic-calendars.index') }}" class="sidebar-link {{ request()->routeIs('admin.academic-calendars.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar-days"></i> Kalender Akademik
                </a>
            @endif

            <div class="sidebar-group">Admisi</div>
            <a href="{{ route('admin.admission-schedules.index') }}" class="sidebar-link {{ request()->routeIs('admin.admission-schedules.*') ? 'active' : '' }}">
                <i class="fa-solid fa-door-open"></i> Gelombang Pendaftaran
            </a>
            <a href="{{ route('admin.tuition-fees.index') }}" class="sidebar-link {{ request()->routeIs('admin.tuition-fees.*') ? 'active' : '' }}">
                <i class="fa-solid fa-money-bill-wave"></i> Biaya Pendidikan
            </a>
            <a href="{{ route('admin.faqs.index') }}" class="sidebar-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                <i class="fa-solid fa-circle-question"></i> FAQ
            </a>

            <div class="sidebar-group">Riset & Pengabdian</div>
            <a href="{{ route('admin.publications.index') }}" class="sidebar-link {{ request()->routeIs('admin.publications.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-lines"></i> Publikasi
            </a>
            @if($cmsAdmin?->isSuperAdmin())
                <a href="{{ route('admin.researches.index') }}" class="sidebar-link {{ request()->routeIs('admin.researches.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-flask"></i> Riset
                </a>
                <a href="{{ route('admin.community-services.index') }}" class="sidebar-link {{ request()->routeIs('admin.community-services.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-hand-holding-heart"></i> Pengabdian (PKM)
                </a>
                <a href="{{ route('admin.partnerships.index') }}" class="sidebar-link {{ request()->routeIs('admin.partnerships.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-handshake"></i> Kerja Sama
                </a>
            @endif

            @if($cmsAdmin?->isSuperAdmin())
                <div class="sidebar-group">Kemahasiswaan & Alumni</div>
                <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-quote-left"></i> Testimoni
                </a>
                <a href="{{ route('admin.alumni.index') }}" class="sidebar-link {{ request()->routeIs('admin.alumni.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-graduate"></i> Alumni
                </a>
            @endif

            <div class="sidebar-group">Informasi & Publikasi</div>
            <a href="{{ route('admin.news.index') }}" class="sidebar-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                <i class="fa-solid fa-newspaper"></i> Berita
            </a>
            <a href="{{ route('admin.agendas.index') }}" class="sidebar-link {{ request()->routeIs('admin.agendas.*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-check"></i> Agenda / Event
            </a>
            <a href="{{ route('admin.galleries.index') }}" class="sidebar-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
                <i class="fa-solid fa-images"></i> Galeri
            </a>

            <div class="sidebar-group">Dokumen & Media</div>
            <a href="{{ route('admin.documents.index') }}" class="sidebar-link {{ request()->routeIs('admin.documents.*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-pdf"></i> Dokumen
            </a>
            @if($cmsAdmin?->isSuperAdmin())
                <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-tags"></i> Kategori
                </a>
                <a href="{{ route('admin.media.index') }}" class="sidebar-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-folder-open"></i> Media Manager
                </a>
            @endif

            @if($cmsAdmin?->isSuperAdmin())
                <div class="sidebar-group">Website</div>
                <a href="{{ route('admin.seo-health.index') }}" class="sidebar-link {{ request()->routeIs('admin.seo-health.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i> Kesehatan SEO
                </a>
                <a href="{{ route('admin.site-settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear"></i> Pengaturan Website
                </a>
                <a href="{{ route('admin.helpdesk.index') }}" class="sidebar-link {{ request()->routeIs('admin.helpdesk.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-headset"></i> Helpdesk
                    @if(($helpdeskOpenCount ?? 0) > 0)
                        <span class="badge text-bg-danger ms-auto">{{ $helpdeskOpenCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.audit-logs.index') }}" class="sidebar-link {{ request()->routeIs('admin.audit-logs.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-clock-rotate-left"></i> Audit Log
                </a>
            @endif

            <div class="sidebar-group">Bantuan</div>
            <a href="{{ route('admin.guide') }}" class="sidebar-link {{ request()->routeIs('admin.guide') ? 'active' : '' }}">
                <i class="fa-solid fa-book-open-reader"></i> Panduan CMS
            </a>

            <div class="sidebar-group">Akun</div>
            @if($cmsAdmin?->isSuperAdmin())
                <a href="{{ route('admin.admins.index') }}" class="sidebar-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users-gear"></i> Kelola Admin
                </a>
            @endif
            <a href="{{ route('admin.profile.edit') }}" class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i> Profil Saya
            </a>
        </nav>
        <div class="sidebar-footer">
            <div class="fw-semibold text-white">{{ $cmsAdmin?->name }}</div>
            <div class="text-truncate">{{ $cmsAdmin?->email }}</div>
            @if($cmsAdmin)
                <div class="mt-1"><span class="badge {{ $cmsAdmin->isSuperAdmin() ? 'text-bg-warning' : 'text-bg-secondary' }}">{{ $cmsAdmin->isSuperAdmin() ? 'Super Admin' : 'Operator' }}</span></div>
            @endif
        </div>
    </aside>

    <div class="main">
        <header class="topbar">
            <div class="d-flex align-items-center gap-2 px-3 py-2">
                <button class="btn btn-outline-secondary btn-sm d-lg-none" id="sidebarToggle" aria-label="Buka navigasi">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <nav aria-label="breadcrumb" class="ms-1">
                    <ol class="breadcrumb mb-0 small">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">CMS</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
                <div class="ms-auto d-flex align-items-center gap-2">
                    <a href="{{ route('home') }}" target="_blank" rel="noopener" class="btn btn-outline-primary btn-sm">
                        <i class="fa-solid fa-globe me-1"></i><span class="d-none d-md-inline">Lihat Website</span>
                    </a>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle border" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-circle-user me-1"></i>{{ auth('admin')->user()?->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i class="fa-solid fa-user me-2"></i>Profil Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}" data-swal-confirm
                                     data-confirm-title="Konfirmasi Logout"
                                     data-confirm-text="Apakah Anda yakin ingin keluar dari akun?"
                                     data-confirm-confirm-text="Ya, Logout">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <main class="content">
            {{-- Flash success/error/info/warning dirender sebagai SweetAlert2 toast
                via partial components.swal (agar tidak tampil dua kali). --}}
            @if($errors->any() && !isset($hideErrorBag))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fa-solid fa-triangle-exclamation me-1"></i>Periksa kembali isian form:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="px-4 py-3 small text-muted border-top bg-white">
            CMS Admin PPAk FEB UNESA
        </footer>
    </div>

    {{-- Form DELETE generik untuk konfirmasi hapus SweetAlert2 (tanpa modal Bootstrap).
        Diisi action dari tombol .btn-delete[data-url], lalu di-submit setelah user konfirmasi. --}}
    <form method="POST" id="confirmDeleteForm" class="d-none">
        @csrf
        @method('DELETE')
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Sidebar mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', () => document.body.classList.toggle('sidebar-open'));
        document.getElementById('sidebarBackdrop')?.addEventListener('click', () => document.body.classList.remove('sidebar-open'));

        // Konfirmasi hapus (.btn-delete) ditangani SweetAlert2 via partial components.swal.

        // Slug otomatis dari judul pada form yang punya [data-slug-from]
        document.querySelectorAll('[data-slug-from]').forEach(function (slugInput) {
            const src = document.querySelector(slugInput.dataset.slugFrom);
            if (!src) return;
            let touched = slugInput.value.length > 0;
            slugInput.addEventListener('input', () => touched = true);
            src.addEventListener('input', () => {
                if (touched) return;
                slugInput.value = src.value.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
            });
        });

        // Lindungi form panjang CMS dari perubahan yang belum tersimpan.
        let cmsFormDirty = false;
        let cmsFormSubmitting = false;
        document.querySelectorAll('form').forEach(function (form) {
            if (form.dataset.noUnsavedWarning === 'true') return;

            form.addEventListener('input', () => { cmsFormDirty = true; });
            form.addEventListener('change', () => { cmsFormDirty = true; });
            form.addEventListener('submit', () => {
                cmsFormSubmitting = true;
                cmsFormDirty = false;
            });
        });

        window.addEventListener('beforeunload', function (event) {
            if (!cmsFormDirty || cmsFormSubmitting) return;
            event.preventDefault();
            event.returnValue = '';
        });
    </script>
    @include('components.swal')
    @stack('scripts')
</body>
</html>
