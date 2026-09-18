@extends('layouts.app')

@section('title', 'Sejarah Singkat | PPAk FEB UNESA')
@section('meta_description', 'Sejarah berdirinya Program Pendidikan Profesi Akuntansi (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya dan perjalanannya mencetak akuntan profesional.')

@section('content')

@include('partials.page-header', [
    'title' => 'Sejarah Singkat Program',
    'badge' => 'Profil Program Studi',
    'lead' => 'Perjalanan dedikasi Pendidikan Profesi Akuntansi FEB UNESA dalam membangun tradisi keunggulan akademik dan integritas keprofesian akuntan Indonesia.',
    'breadcrumbs' => [
        ['label' => 'Profil', 'url' => route('profil.sejarah')],
        ['label' => 'Sejarah Singkat', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        <div class="row g-5">
            {{-- Left column: History narrative --}}
            <div class="col-lg-8">
                <article class="pe-lg-4">
                    <h2 class="h3 text-navy mb-4">Tonggak Pendirian & Dedikasi Berkelanjutan</h2>
                    <p class="lead">
                        Pendidikan Profesi Akuntansi (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya didirikan sebagai respons strategis terhadap dinamika kebutuhan nasional akan tenaga akuntan profesional beregister yang berintegritas tinggi.
                    </p>
                    <p>
                        Sejak berlakunya Undang-Undang Nomor 34 Tahun 1954 dan regulasi pembaruan dari Kementerian Keuangan Republik Indonesia, sebutan Akuntan (Ak.) diatur melalui penyelenggaraan pendidikan profesi terstruktur di bawah perguruan tinggi yang telah memperoleh rekomendasi dari organisasi profesi Ikatan Akuntan Indonesia (IAI) serta izin operasional dari kementerian yang berwenang.
                    </p>
                    <p>
                        FEB UNESA, yang memiliki rekam jejak panjang dalam pembinaan ilmu ekonomi dan akuntansi, mengambil prakarsa membentuk PPAk guna memfasilitasi para sarjana akuntansi melanjutkan pendidikan ke jenjang keprofesian. Kurikulum dirancang sejak awal agar adaptif dengan standar pelaporan internasional (IFRS) serta standar audit berbasis ISA.
                    </p>

                    <div class="p-4 rounded-3 border bg-subtle my-4">
                        <h4 class="fs-6 fw-bold text-navy mb-2"><i class="fa-solid fa-quote-left text-primary me-2"></i>Komitmen Pengabdian Profesi</h4>
                        <p class="small text-secondary mb-0">
                            "Keberadaan PPAk FEB UNESA bukan sekadar meluluskan peserta didik dengan gelar profesi, melainkan menanamkan nilai luhur independensi, etika kerja pantang kompromi, dan tanggung jawab sosial akuntan di hadapan publik dan negara."
                        </p>
                    </div>

                    <h3 class="h4 text-navy mt-5 mb-3">Fase Perkembangan Mutu & Akreditasi</h3>
                    <p>
                        Dalam perkembangannya, PPAk FEB UNESA terus meningkatkan kapasitas penjaminan mutu internal (SPMI). Kemitraan dengan Kantor Akuntan Publik (KAP) bertaraf nasional dan internasional dibuka seluas-luasnya, memungkinkan mahasiswa memperoleh pengalaman riil dalam simulasi audit dan studi kasus transaksi korporasi berskala besar.
                    </p>
                    <p>
                        Saat ini, program studi telah terakreditasi <strong>Baik Sekali</strong> oleh Lembaga Akreditasi Mandiri Ekonomi Manajemen Bisnis dan Akuntansi (LAMEMBA), menegaskan posisi PPAk FEB UNESA sebagai salah satu pusat pendidikan profesi akuntansi terpercaya di kawasan Indonesia Timur.
                    </p>
                </article>
            </div>

            {{-- Right column: Milestone timeline & Fast facts --}}
            <div class="col-lg-4">
                <div class="p-4 rounded-3 border bg-subtle sticky-top" style="top: 100px;">
                    <h3 class="fs-6 fw-bold text-navy text-uppercase tracking-wider mb-3">
                        <i class="fa-solid fa-timeline text-primary me-2"></i>Milestone Perkembangan
                    </h3>
                    
                    <div class="stepper-container">
                        <div class="stepper-item">
                            <div class="stepper-circle" style="width: 36px; height: 36px; font-size: 0.8rem;">1</div>
                            <div class="stepper-content py-2 px-3">
                                <span class="badge-ppak badge-ppak-navy mb-1" style="font-size: 0.675rem;">Inisiasi Awal</span>
                                <h5 class="fs-6 fw-bold mb-1">Kajian Pendirian</h5>
                                <p class="small text-secondary mb-0">Penyusunan naskah akademik dan rekomendasi komisi IAI Pusat.</p>
                            </div>
                            <div class="stepper-line" style="left: 17px; top: 36px;"></div>
                        </div>

                        <div class="stepper-item">
                            <div class="stepper-circle" style="width: 36px; height: 36px; font-size: 0.8rem;">2</div>
                            <div class="stepper-content py-2 px-3">
                                <span class="badge-ppak badge-ppak-navy mb-1" style="font-size: 0.675rem;">Izin Operasional</span>
                                <h5 class="fs-6 fw-bold mb-1">Penyelenggaraan Perdana</h5>
                                <p class="small text-secondary mb-0">Penerimaan angkatan pertama mahasiswa profesi akuntan.</p>
                            </div>
                            <div class="stepper-line" style="left: 17px; top: 36px;"></div>
                        </div>

                        <div class="stepper-item">
                            <div class="stepper-circle" style="width: 36px; height: 36px; font-size: 0.8rem;">3</div>
                            <div class="stepper-content py-2 px-3">
                                <span class="badge-ppak badge-ppak-blue mb-1" style="font-size: 0.675rem;">Integrasi Profesi</span>
                                <h5 class="fs-6 fw-bold mb-1">Skema Waiver CA & MoU KAP</h5>
                                <p class="small text-secondary mb-0">Kerja sama pembebasan ujian sertifikasi bersama IAI Jawa Timur.</p>
                            </div>
                            <div class="stepper-line" style="left: 17px; top: 36px;"></div>
                        </div>

                        <div class="stepper-item">
                            <div class="stepper-circle" style="width: 36px; height: 36px; font-size: 0.8rem;">4</div>
                            <div class="stepper-content py-2 px-3">
                                <span class="badge-ppak badge-ppak-green mb-1" style="font-size: 0.675rem;">Kini & Masa Depan</span>
                                <h5 class="fs-6 fw-bold mb-1">Akreditasi Baik Sekali LAMEMBA</h5>
                                <p class="small text-secondary mb-0">Implementasi analitika data audit dan kurikulum pelaporan ESG.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('profil.visi-misi') }}" class="btn-ppak-secondary w-100 btn-ppak-sm">
                            <span>Lihat Visi & Misi Program</span>
                            <i class="fa-solid fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
