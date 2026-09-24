@extends('admin.layouts.app')

@section('title', 'Panduan CMS')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Panduan CMS</li>
@endsection

@section('content')
    @php($cmsAdmin = auth('admin')->user())
    @php($isSuperAdmin = $cmsAdmin?->isSuperAdmin())

    {{-- Header halaman panduan --}}
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h4 fw-bold mb-1">Panduan Penggunaan CMS</h1>
            <p class="text-muted mb-0 small">
                Panduan lengkap sesuai role Anda
                (<span class="badge {{ $cmsAdmin?->isSuperAdmin() ? 'text-bg-warning' : 'text-bg-secondary' }}">{{ $cmsAdmin?->isSuperAdmin() ? 'Super Admin' : 'Operator' }}</span>).
                Klik judul pada <strong>Daftar Isi</strong> untuk berpindah bagian panduan.
            </p>
        </div>
        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="window.print()">
            <i class="fa-solid fa-print me-1"></i>Cetak Panduan
        </button>
    </div>

    <div class="row g-3">
        {{-- Daftar isi (sticky) — klik = berpindah section --}}
        <div class="col-lg-3">
            <div class="card guide-toc">
                <div class="card-header"><i class="fa-solid fa-list-ul me-1"></i>Daftar Isi</div>
                <div class="card-body p-2" style="max-height:75vh; overflow-y:auto;">
                    <ul class="nav flex-column guide-toc-list small" id="guideToc">
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#umum">Penggunaan Umum</a></li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#login">Login &amp; Keamanan Akun</a></li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#dashboard">Dashboard</a></li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#alur-crud">Alur Tambah / Ubah / Hapus Konten</a></li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#role">Memahami Role &amp; Hak Akses</a></li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#profil-saya">Profil Saya</a></li>

                        <li class="guide-toc-divider" data-roles="operator super_admin">Informasi &amp; Publikasi</li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#berita">Berita</a></li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#agenda">Agenda / Event</a></li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#galeri">Galeri</a></li>

                        <li class="guide-toc-divider" data-roles="operator super_admin">Profil PPAk</li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#dosen">Dosen / Pengajar</a></li>
                        @if($isSuperAdmin)
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#profil-program">Profil Program</a></li>
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#akreditasi">Akreditasi</a></li>
                        @endif

                        <li class="guide-toc-divider" data-roles="operator super_admin">Akademik</li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#kurikulum">Kurikulum</a></li>
                        @if($isSuperAdmin)
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#cpl">CPL (Capaian Pembelajaran)</a></li>
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#kalender">Kalender Akademik</a></li>
                        @endif

                        <li class="guide-toc-divider" data-roles="operator super_admin">Admisi</li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#gelombang">Gelombang Pendaftaran</a></li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#biaya">Biaya Pendidikan</a></li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#faq">FAQ</a></li>

                        <li class="guide-toc-divider" data-roles="operator super_admin">Riset &amp; Pengabdian</li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#publikasi">Publikasi</a></li>
                        @if($isSuperAdmin)
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#riset">Riset</a></li>
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#pengabdian">Pengabdian (PKM)</a></li>
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#kerja-sama">Kerja Sama</a></li>
                        @endif

                        @if($isSuperAdmin)
                            <li class="guide-toc-divider" data-roles="super_admin">Kemahasiswaan &amp; Alumni</li>
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#testimoni">Testimoni</a></li>
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#alumni">Alumni</a></li>
                        @endif

                        <li class="guide-toc-divider" data-roles="operator super_admin">Dokumen &amp; Media</li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#dokumen">Dokumen</a></li>
                        @if($isSuperAdmin)
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#kategori">Kategori</a></li>
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#media">Media Manager</a></li>
                        @endif

                        @if($isSuperAdmin)
                            <li class="guide-toc-divider" data-roles="super_admin">Website &amp; Sistem</li>
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#seo">Kesehatan SEO</a></li>
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#pengaturan">Pengaturan Website</a></li>
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#helpdesk">Helpdesk</a></li>
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#audit-log">Audit Log</a></li>

                            <li class="guide-toc-divider" data-roles="super_admin">Akun</li>
                            <li class="guide-toc-item" data-roles="super_admin"><a class="guide-toc-link" href="#kelola-admin">Kelola Admin</a></li>
                        @endif

                        <li class="guide-toc-divider" data-roles="operator super_admin">Lampiran</li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#aturan">Aturan &amp; Tips Penting</a></li>
                        <li class="guide-toc-item" data-roles="operator super_admin"><a class="guide-toc-link" href="#tanya">Tanya Jawab Singkat</a></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Isi panduan: hanya SATU section tampil, berpindah via Daftar Isi --}}
        <div class="col-lg-9">
            @include('admin.guide.partials.umum')
            @include('admin.guide.partials.konten')
            @if($isSuperAdmin)
                @include('admin.guide.partials.superadmin')
            @endif
            @include('admin.guide.partials.lampiran')

            <div id="guideSectionNav" class="d-flex justify-content-between align-items-center gap-2 mb-4"></div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .guide-toc-link { display:block; padding:.3rem .6rem; border-radius:.4rem; color:#102a43; text-decoration:none; font-weight:500; }
    .guide-toc-link:hover { background:#eef2f7; color:#102a43; }
    .guide-toc-link.active { background:#102a43; color:#fff; font-weight:700; }
    .guide-toc-divider { color:#8fa3bd; font-size:.68rem; letter-spacing:.08em; text-transform:uppercase; font-weight:700; padding:.85rem .6rem .3rem; }
    .guide-section { scroll-margin-top: 5rem; }
    .guide-section.role-hidden, .guide-section.section-hidden,
    .guide-toc-item.role-hidden, .guide-toc-divider.role-hidden { display: none !important; }
    .guide-badge-both { background:#198754; color:#fff; }
    .guide-badge-sa { background:#c9a227; color:#102a43; }
    .guide-step { counter-reset: step; list-style:none; padding-left:0; }
    .guide-step > li { position:relative; padding-left:2.2rem; margin-bottom:.55rem; counter-increment: step; }
    .guide-step > li::before { content: counter(step); position:absolute; left:0; top:0; width:1.5rem; height:1.5rem; border-radius:50%; background:#102a43; color:#fff; font-size:.75rem; font-weight:700; display:flex; align-items:center; justify-content:center; }
    .guide-table th { background:#f8fafc; color:#102a43; font-size:.75rem; text-transform:uppercase; letter-spacing:.04em; white-space:nowrap; }
    .guide-table td { font-size:.85rem; vertical-align:top; }
    .guide-table code { font-size:.8rem; }
    .guide-tip { border-left:4px solid #c9a227; background:#fff9e8; }
    .guide-warn { border-left:4px solid #dc3545; background:#fdf1f1; }
    .guide-info { border-left:4px solid #0d6efd; background:#eef5ff; }
    .guide-ok { border-left:4px solid #198754; background:#edf7f1; }
    .guide-field-name { font-weight:600; color:#102a43; white-space:nowrap; }
    .guide-req { color:#dc3545; font-weight:700; }
    .guide-opt { color:#6c757d; font-weight:500; }
    .guide-a { color:#0d6efd; text-decoration:none; font-weight:600; }
    .guide-a:hover { text-decoration:underline; }
    .guide-menu-path { font-size:.8rem; color:#52677d; }
    .guide-menu-path i { color:#c9a227; margin:0 .15rem; font-size:.65rem; }
    @media print {
        .sidebar, .topbar, footer, .btn-outline-secondary, #guideSectionNav { display:none !important; }
        .main { margin-left:0 !important; }
        .guide-section.section-hidden { display:block !important; }
        .guide-section.role-hidden, .guide-toc-item.role-hidden, .guide-toc-divider.role-hidden { display:none !important; }
        .card { box-shadow:none !important; border:1px solid #ddd !important; break-inside: avoid; }
        .guide-toc { display:none; }
    }
</style>
@endpush

@push('scripts')
<script>
(function () {
    const MY_ROLE = @json($currentRole);
    const sections = Array.from(document.querySelectorAll('.guide-section'));
    const tocItems = Array.from(document.querySelectorAll('.guide-toc-item'));
    const tocDividers = Array.from(document.querySelectorAll('.guide-toc-divider'));
    const links = Array.from(document.querySelectorAll('.guide-toc-link'));
    const navBox = document.getElementById('guideSectionNav');

    function inRole(el) {
        return (el.dataset.roles || '').trim().split(/\s+/).includes(MY_ROLE);
    }

    // 1) Sembunyikan panduan yang bukan milik role login (tampil selamanya, ikut cetak).
    sections.forEach(s => { if (!inRole(s)) s.classList.add('role-hidden'); });
    tocItems.forEach(t => { if (!inRole(t)) t.classList.add('role-hidden'); });

    // Divider TOC tanpa anak terlihat ikut disembunyikan.
    tocDividers.forEach(d => {
        if (!inRole(d)) { d.classList.add('role-hidden'); return; }
        let visible = false;
        let n = d.nextElementSibling;
        while (n && !n.classList.contains('guide-toc-divider')) {
            if (n.classList.contains('guide-toc-item') && !n.classList.contains('role-hidden')) { visible = true; break; }
            n = n.nextElementSibling;
        }
        d.classList.toggle('role-hidden', !visible);
    });

    // Urutan section sesuai Daftar Isi (yang tampil untuk role ini).
    const order = tocItems
        .filter(t => !t.classList.contains('role-hidden'))
        .map(t => t.querySelector('.guide-toc-link')?.getAttribute('href')?.slice(1))
        .filter(id => id && document.getElementById(id));

    function labelOf(id) {
        const a = links.find(l => l.getAttribute('href') === '#' + id);
        return a ? a.textContent.trim() : id;
    }

    function renderNav(currentId) {
        if (!navBox) return;
        const i = order.indexOf(currentId);
        const prev = i > 0 ? order[i - 1] : null;
        const next = i >= 0 && i < order.length - 1 ? order[i + 1] : null;
        navBox.innerHTML =
            (prev
                ? '<button type="button" class="btn btn-outline-secondary btn-sm guide-nav-btn" data-target="' + prev + '"><i class="fa-solid fa-angle-left me-1"></i>' + labelOf(prev) + '</button>'
                : '<span></span>') +
            '<span class="small text-muted">' + (i + 1) + ' / ' + order.length + ' bagian</span>' +
            (next
                ? '<button type="button" class="btn btn-primary btn-sm guide-nav-btn text-end" data-target="' + next + '">' + labelOf(next) + '<i class="fa-solid fa-angle-right ms-1"></i></button>'
                : '<span></span>');
    }

    function showSection(id, scroll) {
        const target = document.getElementById(id);
        if (!target || target.classList.contains('role-hidden')) return;

        sections.forEach(s => s.classList.toggle('section-hidden', s !== target));
        links.forEach(a => a.classList.toggle('active', a.getAttribute('href') === '#' + id));
        renderNav(id);

        if (scroll) {
            const main = document.querySelector('main.content');
            const top = main.getBoundingClientRect().top + window.scrollY - 70;
            window.scrollTo({ top: Math.max(top, 0), behavior: 'smooth' });
        }
    }

    // 2) Klik Daftar Isi = berpindah section (bukan scroll panjang).
    links.forEach(a => a.addEventListener('click', function (e) {
        e.preventDefault();
        showSection(this.getAttribute('href').slice(1), true);
    }));

    // Navigasi Sebelumnya / Berikutnya.
    navBox?.addEventListener('click', function (e) {
        const btn = e.target.closest('.guide-nav-btn');
        if (btn) showSection(btn.dataset.target, true);
    });

    // Section awal: dari #hash bila valid, selain itu bagian pertama.
    const fromHash = location.hash.slice(1);
    const initial = fromHash && order.includes(fromHash) ? fromHash : order[0];
    if (initial) showSection(initial, false);
})();
</script>
@endpush
