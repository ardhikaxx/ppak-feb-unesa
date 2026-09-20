@extends('admin.layouts.app')

@section('title', ($item->exists ? 'Ubah' : 'Tambah') . ' Section')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.page-contents.index', ['page' => $item->page]) }}">Konten Halaman</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $item->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $item->exists ? 'Ubah Section' : 'Tambah Section' }}</h1>

    <form method="POST" action="{{ $item->exists ? route('admin.page-contents.update', $item) : route('admin.page-contents.store') }}">
        @csrf
        @if($item->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="page">Halaman</label>
                        <select name="page" id="page" class="form-select" required>
                            @foreach(\App\Models\PageContent::PAGES as $key => $label)
                                <option value="{{ $key }}" @selected(old('page', $item->page) === $key)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold required" for="section_key">Kunci section</label>
                        <input type="text" name="section_key" id="section_key" class="form-control" value="{{ old('section_key', $item->section_key) }}" required maxlength="100"
                               @if($item->exists) readonly @endif placeholder="narasi_body">
                        <div class="form-text">Identitas unik per halaman. Terkunci setelah dibuat agar tidak merusak tampilan.</div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-semibold" for="sort_order">Urutan</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control" min="0" value="{{ old('sort_order', $item->sort_order ?? 0) }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label fw-semibold required" for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="published" @selected(old('status', $item->status ?? 'published') === 'published')>Terbit</option>
                            <option value="draft" @selected(old('status', $item->status) === 'draft')>Draft</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="heading">Heading / judul section</label>
                    <input type="text" name="heading" id="heading" class="form-control" value="{{ old('heading', $item->heading) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="subtitle">Sub-judul (khusus bagan organisasi)</label>
                    <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ old('subtitle', $item->subtitle) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" for="body">Isi (boleh HTML dasar: p, strong, em, ul, li, a, h2–h4)</label>
                    <textarea name="body" id="body" rows="8" class="form-control">{{ old('body', $item->body) }}</textarea>
                    <div class="form-text">Script dan event handler otomatis dibuang demi keamanan. Kelas CSS bawaan template dipertahankan bila tidak diubah.</div>
                </div>
                <div class="mb-0">
                    <label class="form-label fw-semibold" for="link_url">Tautan (khusus tombol sertifikasi)</label>
                    <input type="url" name="link_url" id="link_url" class="form-control" value="{{ old('link_url', $item->link_url) }}" placeholder="https://...">
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.page-contents.index', ['page' => $item->page]) }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
