@extends('layouts.app')

@section('title', 'Tanya Jawab (FAQ) Admisi & Perkuliahan | PPAk FEB UNESA')
@section('meta_description', 'Pertanyaan umum seputar pendaftaran, biaya, sistem perkuliahan, dan sertifikasi Chartered Accountant di PPAk FEB UNESA.')

@section('content')

@include('partials.page-header', [
    'title' => 'Pertanyaan yang Sering Diajukan (FAQ)',
    'badge' => 'Pusat Bantuan Calon Mahasiswa',
    'lead' => 'Temukan jawaban cepat atas pertanyaan seputar persyaratan, jadwal, biaya, serta fasilitas akademik profesi.',
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
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                    <i class="fa-regular fa-circle-question text-primary me-3"></i>
                                    <span>{{ $faq['q'] }}</span>
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ $faq['a'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Contact Box if question not found --}}
                <div class="p-4 p-md-5 rounded-4 border bg-subtle mt-5 text-center">
                    <h3 class="fs-6 fw-bold text-navy mb-2">Masih Memiliki Pertanyaan Lain?</h3>
                    <p class="small text-secondary mb-4">Tim sekretariat akademik PPAk FEB UNESA siap membantu memberikan informasi lebih mendalam seputar perkuliahan.</p>
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="{{ route('kontak.helpdesk') }}" class="btn-ppak-primary btn-ppak-sm">
                            <i class="fa-solid fa-headset me-1"></i>
                            <span>Hubungi Helpdesk Kami</span>
                        </a>
                        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="btn-ppak-secondary btn-ppak-sm">
                            <i class="fa-brands fa-whatsapp text-success me-1"></i>
                            <span>Konsultasi WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
