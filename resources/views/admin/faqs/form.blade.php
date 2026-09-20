@extends('admin.layouts.app')

@section('title', ($faq->exists ? 'Ubah' : 'Tambah') . ' FAQ')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.faqs.index') }}">FAQ</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $faq->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $faq->exists ? 'Ubah FAQ' : 'Tambah FAQ' }}</h1>

    <form method="POST" action="{{ $faq->exists ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}">
        @csrf
        @if($faq->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="category">Kategori</label>
                        <input type="text" name="category" id="category" list="faqCategories" class="form-control" value="{{ old('category', $faq->category ?? 'Pendaftaran') }}" required maxlength="50">
                        <datalist id="faqCategories">
                            <option value="Pendaftaran"></option>
                            <option value="Biaya"></option>
                            <option value="Akun PMB"></option>
                            <option value="Pembayaran"></option>
                            <option value="Dokumen"></option>
                            <option value="Akademik"></option>
                            <option value="Kontak"></option>
                        </datalist>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="sort_order">Urutan tampil</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control" min="0" value="{{ old('sort_order', $faq->sort_order ?? 0) }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold required" for="question">Pertanyaan</label>
                    <textarea name="question" id="question" rows="2" class="form-control" required>{{ old('question', $faq->question) }}</textarea>
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold required" for="answer">Jawaban (berbasis sumber resmi)</label>
                    <textarea name="answer" id="answer" rows="5" class="form-control" required>{{ old('answer', $faq->answer) }}</textarea>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.faqs.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
