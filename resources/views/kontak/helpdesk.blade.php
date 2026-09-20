@extends('layouts.app')

@section('title', 'Kontak Sekretariat & Helpdesk | PPAk FEB UNESA')
@section('meta_description', 'Layanan bantuan helpdesk pendaftaran, informasi akademik, konsultasi perkuliahan, dan kontak resmi PPAk FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => $pg['header_title']['heading'] ?? 'Sekretariat & Helpdesk Layanan Mahasiswa',
    'badge' => $pg['header_badge']['heading'] ?? 'Pusat Bantuan & Komunikasi',
    'lead' => $pg['header_lead']['body'] ?? 'Silakan hubungi staf sekretariat untuk konsultasi pendaftaran, persyaratan matrikulasi, dan administrasi akademik profesi.',
    'breadcrumbs' => [
        ['label' => 'Kontak', 'url' => route('kontak.lokasi')],
        ['label' => 'Helpdesk', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        {{-- Contact Cards Row --}}
        <div class="row g-4 mb-5">
            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100 text-center">
                    <div class="feature-icon-wrapper mx-auto mb-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
                        <i class="fa-brands fa-whatsapp text-success"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-1">Helpdesk WhatsApp</h3>
                    <p class="small text-secondary mb-3">Layanan pesan cepat untuk konsultasi syarat pendaftaran dan seleksi masuk.</p>
                    <a href="https://wa.me/{{ preg_replace('/\D/', '', $info['whatsapp'] ?? '6281234567890') }}" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary btn-ppak-sm w-100">
                        <span>Chat WhatsApp ({{ $info['whatsapp'] ?? '0812-3456-7890' }})</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100 text-center">
                    <div class="feature-icon-wrapper mx-auto mb-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
                        <i class="fa-regular fa-envelope text-primary"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-1">Email Resmi</h3>
                    <p class="small text-secondary mb-3">Kirimkan surat permohonan, legalisir ijazah, atau kerja sama kelembagaan.</p>
                    <a href="mailto:{{ $info['email'] ?? 'ppak.feb@unesa.ac.id' }}" class="btn-ppak-secondary btn-ppak-sm w-100">
                        <span>{{ $info['email'] ?? 'ppak.feb@unesa.ac.id' }}</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-ppak-flat h-100 text-center">
                    <div class="feature-icon-wrapper mx-auto mb-3" style="width: 48px; height: 48px; font-size: 1.25rem;">
                        <i class="fa-solid fa-phone text-navy"></i>
                    </div>
                    <h3 class="fs-6 fw-bold text-navy mb-1">Telepon Kantor</h3>
                    <p class="small text-secondary mb-3">Layanan suara langsung pada jam kerja operasional kantor.</p>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $info['phone'] ?? '+62 31 828 0009') }}" class="btn-ppak-secondary btn-ppak-sm w-100">
                        <span>{{ $info['phone'] ?? '+62 31 828 0009' }} Ext. 312</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Interactive Inquiry Form & Mini FAQ --}}
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="p-4 p-md-5 rounded-4 border bg-subtle">
                    <span class="badge-ppak badge-ppak-blue mb-2">Formulir Pesan</span>
                    <h3 class="h4 text-navy mb-3">Kirim Pesan atau Pertanyaan</h3>
                    <p class="small text-secondary mb-4">
                        Isi formulir di bawah ini untuk menyampaikan pertanyaan Anda. Tim administrasi kami akan merespons melalui email dalam kurun waktu 1x24 jam kerja.
                    </p>

                    <div id="helpdeskSuccessAlert" class="alert alert-success d-none mb-4" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i>
                        Terima kasih! Pesan Anda telah berhasil dikirimkan. Tim sekretariat PPAk akan segera menghubungi Anda melalui email yang didaftarkan.
                    </div>

                    <form id="helpdeskInquiryForm">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="senderName" class="form-label small fw-semibold text-navy">Nama Lengkap *</label>
                                <input type="text" class="form-control rounded-2" id="senderName" placeholder="Contoh: Budi Santoso" required>
                            </div>
                            <div class="col-md-6">
                                <label for="senderEmail" class="form-label small fw-semibold text-navy">Alamat Email *</label>
                                <input type="email" class="form-control rounded-2" id="senderEmail" placeholder="nama@email.com" required>
                            </div>
                            <div class="col-md-6">
                                <label for="senderPhone" class="form-label small fw-semibold text-navy">Nomor WhatsApp / HP *</label>
                                <input type="tel" class="form-control rounded-2" id="senderPhone" placeholder="08123456789" required>
                            </div>
                            <div class="col-md-6">
                                <label for="senderCategory" class="form-label small fw-semibold text-navy">Topik Pertanyaan *</label>
                                <select class="form-select rounded-2" id="senderCategory" required>
                                    <option value="" selected disabled>Pilih Topik Pertanyaan</option>
                                    <option value="admisi">Informasi Pendaftaran & Syarat Masuk</option>
                                    <option value="biaya">Biaya Pendidikan & Pembayaran</option>
                                    <option value="kurikulum">Kurikulum & Penyetaraan (Waiver) CA</option>
                                    <option value="legalisir">Legalisir Ijazah & Transkrip Profesi</option>
                                    <option value="lainnya">Lain-lain / Kerja Sama</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="senderMessage" class="form-label small fw-semibold text-navy">Isi Pesan / Pertanyaan *</label>
                                <textarea class="form-control rounded-2" id="senderMessage" rows="4" placeholder="Tuliskan pertanyaan Anda secara jelas..." required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-ppak-primary btn-ppak-sm">
                                    <i class="fa-regular fa-paper-plane me-1"></i>
                                    <span>Kirimkan Pertanyaan</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Mini FAQ --}}
            <div class="col-lg-5">
                <div class="p-4 rounded-4 border bg-white h-100">
                    <span class="badge-ppak badge-ppak-navy mb-2">Jawaban Singkat</span>
                    <h3 class="h5 text-navy fw-bold mb-3">Tanya Jawab Terpopuler</h3>

                    <div class="accordion accordion-ppak" id="helpdeskMiniFaq">
                        @foreach($faqs as $idx => $f)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="miniFaqH{{ $idx }}">
                                    <button class="accordion-button {{ $idx === 0 ? '' : 'collapsed' }} py-2 px-3 small" type="button" data-bs-toggle="collapse" data-bs-target="#miniFaqC{{ $idx }}" aria-expanded="{{ $idx === 0 ? 'true' : 'false' }}">
                                        {{ $f['tanya'] ?? $f['q'] ?? '' }}
                                    </button>
                                </h2>
                                <div id="miniFaqC{{ $idx }}" class="accordion-collapse collapse {{ $idx === 0 ? 'show' : '' }}" data-bs-parent="#helpdeskMiniFaq">
                                    <div class="accordion-body small py-2 px-3 text-secondary">
                                        {{ $f['jawab'] ?? $f['a'] ?? '' }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-4 pt-3 border-top text-center">
                        <a href="{{ route('admisi.faq') }}" class="small fw-bold text-primary text-decoration-none">
                            Lihat Halaman FAQ Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Official Social Media Channels Section --}}
        <div class="row mt-5 pt-4 border-top">
            <div class="col-12 text-center mb-4">
                <span class="badge-ppak badge-ppak-gold mb-2">Koneksi & Media</span>
                <h3 class="h4 text-navy fw-bold">Kanal Media Sosial & Informasi Resmi</h3>
                <p class="text-secondary small mx-auto" style="max-width: 600px;">
                    Ikuti perkembangan berita, agenda wisuda, pendaftaran profesi akuntansi, dan informasi akademik terbaru melalui kanal resmi UNESA dan FEB.
                </p>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <a href="{{ $info['socials']['instagram'] ?? 'https://www.instagram.com/official_unesa' }}" target="_blank" rel="noopener noreferrer" class="card-ppak-flat p-3 text-decoration-none d-flex align-items-center gap-3 h-100">
                    <div class="feature-icon-wrapper flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.15rem; background: rgba(225, 48, 108, 0.1); color: #E1306C;">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-navy small mb-0">Instagram UNESA</div>
                        <div class="text-secondary" style="font-size: 0.78rem;">@official_unesa</div>
                    </div>
                    <i class="fa-solid fa-arrow-up-right-from-square ms-auto text-muted small"></i>
                </a>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <a href="{{ $info['socials']['instagram_feb'] ?? 'https://www.instagram.com/feb.unesa' }}" target="_blank" rel="noopener noreferrer" class="card-ppak-flat p-3 text-decoration-none d-flex align-items-center gap-3 h-100">
                    <div class="feature-icon-wrapper flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.15rem; background: rgba(13, 110, 253, 0.1); color: #0d6efd;">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-navy small mb-0">Instagram FEB UNESA</div>
                        <div class="text-secondary" style="font-size: 0.78rem;">@feb.unesa</div>
                    </div>
                    <i class="fa-solid fa-arrow-up-right-from-square ms-auto text-muted small"></i>
                </a>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <a href="{{ $info['socials']['youtube'] ?? 'https://www.youtube.com/@officialunesa' }}" target="_blank" rel="noopener noreferrer" class="card-ppak-flat p-3 text-decoration-none d-flex align-items-center gap-3 h-100">
                    <div class="feature-icon-wrapper flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.15rem; background: rgba(255, 0, 0, 0.1); color: #FF0000;">
                        <i class="fa-brands fa-youtube"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-navy small mb-0">YouTube Official</div>
                        <div class="text-secondary" style="font-size: 0.78rem;">@officialunesa</div>
                    </div>
                    <i class="fa-solid fa-arrow-up-right-from-square ms-auto text-muted small"></i>
                </a>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <a href="{{ $info['socials']['tiktok'] ?? 'https://www.tiktok.com/@unesaid' }}" target="_blank" rel="noopener noreferrer" class="card-ppak-flat p-3 text-decoration-none d-flex align-items-center gap-3 h-100">
                    <div class="feature-icon-wrapper flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.15rem; background: rgba(0, 0, 0, 0.08); color: #000000;">
                        <i class="fa-brands fa-tiktok"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-navy small mb-0">TikTok UNESA</div>
                        <div class="text-secondary" style="font-size: 0.78rem;">@unesaid</div>
                    </div>
                    <i class="fa-solid fa-arrow-up-right-from-square ms-auto text-muted small"></i>
                </a>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <a href="{{ $info['socials']['facebook'] ?? 'https://www.facebook.com/officialunesa' }}" target="_blank" rel="noopener noreferrer" class="card-ppak-flat p-3 text-decoration-none d-flex align-items-center gap-3 h-100">
                    <div class="feature-icon-wrapper flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.15rem; background: rgba(24, 119, 242, 0.1); color: #1877F2;">
                        <i class="fa-brands fa-facebook-f"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-navy small mb-0">Facebook UNESA</div>
                        <div class="text-secondary" style="font-size: 0.78rem;">officialunesa</div>
                    </div>
                    <i class="fa-solid fa-arrow-up-right-from-square ms-auto text-muted small"></i>
                </a>
            </div>

            <div class="col-md-4 col-sm-6 mb-3">
                <a href="{{ $info['socials']['linkedin'] ?? 'https://www.linkedin.com/school/universitas-negeri-surabaya' }}" target="_blank" rel="noopener noreferrer" class="card-ppak-flat p-3 text-decoration-none d-flex align-items-center gap-3 h-100">
                    <div class="feature-icon-wrapper flex-shrink-0" style="width: 44px; height: 44px; font-size: 1.15rem; background: rgba(10, 102, 194, 0.1); color: #0A66C2;">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-navy small mb-0">LinkedIn UNESA</div>
                        <div class="text-secondary" style="font-size: 0.78rem;">Universitas Negeri Surabaya</div>
                    </div>
                    <i class="fa-solid fa-arrow-up-right-from-square ms-auto text-muted small"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

