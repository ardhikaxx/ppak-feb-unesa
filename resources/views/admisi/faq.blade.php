@extends('layouts.app')

@section('title', 'Tanya Jawab (FAQ) Admisi & Pendaftaran | Pendidikan Profesi Akuntan FEB UNESA')
@section('meta_description', 'Pertanyaan yang sering diajukan seputar prosedur pendaftaran akun PMB, verifikasi berkas, biaya UKT, dan jadwal perkuliahan Pendidikan Profesi Akuntan FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => $pg['header_title']['heading'] ?? 'Pertanyaan yang Sering Diajukan (FAQ)',
    'badge' => $pg['header_badge']['heading'] ?? 'Pusat Bantuan & Tanya Jawab',
    'lead' => $pg['header_lead']['body'] ?? 'Jawaban atas pertanyaan umum seputar pendaftaran akun PMB, verifikasi dokumen, pembayaran UKT, dan layanan akademik.',
    'breadcrumbs' => [
        ['label' => 'Admisi', 'url' => route('admisi.jalur-syarat')],
        ['label' => 'FAQ', 'url' => '']
    ]
])

<section class="section-py bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="accordion accordion-ppak" id="faqAccordion">
                    @foreach($faqs as $index => $faq)
                        @php
                            $question = $faq['tanya'] ?? $faq['q'] ?? '';
                            $answer = $faq['jawab'] ?? $faq['a'] ?? '';
                            $category = $faq['kategori'] ?? 'Umum';
                        @endphp
                        <div class="accordion-item mb-3 border rounded-3 overflow-hidden shadow-sm">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }} fw-semibold text-navy bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge-ppak badge-ppak-navy" style="font-size: 0.65rem;">{{ $category }}</span>
                                        <span>{{ $question }}</span>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-secondary small bg-subtle" style="line-height: 1.7;">
                                    {{ $answer }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Contact Box if question not found --}}
                <div class="p-4 p-md-5 rounded-4 border bg-subtle mt-5 text-center">
                    <span class="badge-ppak badge-ppak-gold mb-2">BANTUAN INFORMASI</span>
                    <h3 class="fs-6 fw-bold text-navy mb-2">Pertanyaan Anda Belum Terjawab?</h3>
                    <p class="small text-secondary mb-4">
                        Untuk pertanyaan yang belum tercantum atau membutuhkan konfirmasi khusus, silakan menghubungi layanan resmi Admisi PMB UNESA atau Sekretariat Program Studi FEB UNESA.
                    </p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="https://admisi.unesa.ac.id" target="_blank" rel="noopener noreferrer" class="btn-ppak-primary btn-ppak-sm">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>
                            <span>Portal Admisi UNESA</span>
                        </a>
                        <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-secondary btn-ppak-sm">
                            <i class="fa-solid fa-envelope me-1"></i>
                            <span>Hubungi Sekretariat PPAk</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

