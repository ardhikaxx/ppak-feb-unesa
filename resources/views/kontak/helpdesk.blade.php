@extends('layouts.app')

@section('title', 'Kontak Sekretariat & Helpdesk | PPAk FEB UNESA')
@section('meta_description', 'Layanan bantuan helpdesk pendaftaran, informasi akademik, konsultasi perkuliahan, dan kontak resmi PPAk FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Sekretariat & Helpdesk Layanan Mahasiswa',
    'badge' => 'Pusat Bantuan & Komunikasi',
    'lead' => 'Silakan hubungi staf sekretariat untuk konsultasi pendaftaran, persyaratan matrikulasi, dan administrasi akademik profesi.',
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
                    <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary btn-ppak-sm w-100">
                        <span>Chat WhatsApp (0812-3456-7890)</span>
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
                    <a href="mailto:ppak.feb@unesa.ac.id" class="btn-ppak-secondary btn-ppak-sm w-100">
                        <span>ppak.feb@unesa.ac.id</span>
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
                    <a href="tel:+62318280009" class="btn-ppak-secondary btn-ppak-sm w-100">
                        <span>+62 31 828 0009 Ext. 312</span>
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
                                        {{ $f['q'] }}
                                    </button>
                                </h2>
                                <div id="miniFaqC{{ $idx }}" class="accordion-collapse collapse {{ $idx === 0 ? 'show' : '' }}" data-bs-parent="#helpdeskMiniFaq">
                                    <div class="accordion-body small py-2 px-3 text-secondary">
                                        {{ $f['a'] }}
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
    </div>
</section>

@endsection
