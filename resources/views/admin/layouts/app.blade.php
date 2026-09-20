<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CMS Admin') | PPAk FEB UNESA</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
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
            .sidebar { transform: translateX(-100%); }
            body.sidebar-open .sidebar { transform: translateX(0); }
            body.sidebar-open .sidebar-backdrop { display: block; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 1035; }
            .main { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
    <aside class="sidebar" id="adminSidebar" aria-label="Navigasi CMS">
        <div class="sidebar-brand d-flex align-items-center gap-2">
            <img src="{{ asset('images/logo-unesa.png') }}" alt="Logo UNESA">
            <div>
                <div class="fw-bold" style="font-size:.95rem;">CMS PPAk</div>
                <div class="small" style="color:#8fa3bd;">FEB UNESA</div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>

            <div class="sidebar-group">Profil PPAk</div>
            <a href="{{ route('admin.program-profile.edit') }}" class="sidebar-link {{ request()->routeIs('admin.program-profile.*') ? 'active' : '' }}">
                <i class="fa-solid fa-building-columns"></i> Profil Program
            </a>
            <a href="{{ route('admin.accreditations.index') }}" class="sidebar-link {{ request()->routeIs('admin.accreditations.*') ? 'active' : '' }}">
                <i class="fa-solid fa-award"></i> Akreditasi
            </a>
            <a href="{{ route('admin.lecturers.index') }}" class="sidebar-link {{ request()->routeIs('admin.lecturers.*') ? 'active' : '' }}">
                <i class="fa-solid fa-chalkboard-user"></i> Dosen / Pengajar
            </a>

            <div class="sidebar-group">Akademik</div>
            <a href="{{ route('admin.curricula.index') }}" class="sidebar-link {{ request()->routeIs('admin.curricula.*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-open"></i> Kurikulum
            </a>
            <a href="{{ route('admin.learning-outcomes.index') }}" class="sidebar-link {{ request()->routeIs('admin.learning-outcomes.*') ? 'active' : '' }}">
                <i class="fa-solid fa-bullseye"></i> CPL
            </a>
            <a href="{{ route('admin.academic-calendars.index') }}" class="sidebar-link {{ request()->routeIs('admin.academic-calendars.*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-days"></i> Kalender Akademik
            </a>

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
            <a href="{{ route('admin.researches.index') }}" class="sidebar-link {{ request()->routeIs('admin.researches.*') ? 'active' : '' }}">
                <i class="fa-solid fa-flask"></i> Riset
            </a>
            <a href="{{ route('admin.community-services.index') }}" class="sidebar-link {{ request()->routeIs('admin.community-services.*') ? 'active' : '' }}">
                <i class="fa-solid fa-hand-holding-heart"></i> Pengabdian (PKM)
            </a>
            <a href="{{ route('admin.partnerships.index') }}" class="sidebar-link {{ request()->routeIs('admin.partnerships.*') ? 'active' : '' }}">
                <i class="fa-solid fa-handshake"></i> Kerja Sama
            </a>

            <div class="sidebar-group">Kemahasiswaan & Alumni</div>
            <a href="{{ route('admin.testimonials.index') }}" class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <i class="fa-solid fa-quote-left"></i> Testimoni
            </a>
            <a href="{{ route('admin.alumni.index') }}" class="sidebar-link {{ request()->routeIs('admin.alumni.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-graduate"></i> Alumni
            </a>

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
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fa-solid fa-tags"></i> Kategori
            </a>
            <a href="{{ route('admin.media.index') }}" class="sidebar-link {{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
                <i class="fa-solid fa-folder-open"></i> Media Manager
            </a>

            <div class="sidebar-group">Website</div>
            <a href="{{ route('admin.content-blocks.index') }}" class="sidebar-link {{ request()->routeIs('admin.content-blocks.*') ? 'active' : '' }}">
                <i class="fa-solid fa-cubes"></i> Blok Konten
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

            <div class="sidebar-group">Akun</div>
            <a href="{{ route('admin.admins.index') }}" class="sidebar-link {{ request()->routeIs('admin.admins.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users-gear"></i> Kelola Admin
            </a>
            <a href="{{ route('admin.profile.edit') }}" class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i> Profil Saya
            </a>
        </nav>
        <div class="sidebar-footer">
            <div class="fw-semibold text-white">{{ auth('admin')->user()?->name }}</div>
            <div class="text-truncate">{{ auth('admin')->user()?->email }}</div>
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
                                <form method="POST" action="{{ route('admin.logout') }}">
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
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check me-1"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-1"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif
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
            CMS Admin PPAk FEB UNESA &bull; Seluruh perubahan konten tercatat pada audit log.
        </footer>
    </div>

    {{-- Modal konfirmasi hapus generik --}}
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa-solid fa-triangle-exclamation text-danger me-2"></i>Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0" id="confirmDeleteMessage">Data yang dihapus masuk ke arsip (soft delete) dan dapat dipulihkan. Lanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form method="POST" id="confirmDeleteForm">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash me-1"></i>Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Sidebar mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', () => document.body.classList.toggle('sidebar-open'));
        document.getElementById('sidebarBackdrop')?.addEventListener('click', () => document.body.classList.remove('sidebar-open'));

        // Delete confirm modal: pakai tombol .btn-delete[data-url][data-message]
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-delete');
            if (!btn) return;
            e.preventDefault();
            document.getElementById('confirmDeleteForm').setAttribute('action', btn.dataset.url);
            document.getElementById('confirmDeleteMessage').textContent = btn.dataset.message || 'Data yang dihapus masuk ke arsip (soft delete) dan dapat dipulihkan. Lanjutkan?';
            new bootstrap.Modal(document.getElementById('confirmDeleteModal')).show();
        });

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
    </script>
    @stack('scripts')
</body>
</html>
