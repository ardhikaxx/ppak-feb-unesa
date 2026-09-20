@extends('admin.layouts.app')

@section('title', 'FAQ')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">FAQ</h1>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah FAQ</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari pertanyaan / jawaban...">
                </div>
                <div class="col-md-4">
                    <select name="kategori" class="form-select form-select-sm">
                        <option value="">Semua kategori</option>
                        @foreach($categories as $c)
                            <option value="{{ $c }}" @selected(request('kategori') === $c)>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button class="btn btn-secondary btn-sm">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Kategori</th><th>Pertanyaan</th><th>Urutan</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                        <tr>
                            <td><span class="badge text-bg-light border">{{ $faq->category }}</span></td>
                            <td>
                                <div class="fw-semibold">{{ $faq->question }}</div>
                                <div class="small text-muted">{{ \Illuminate\Support\Str::limit($faq->answer, 130) }}</div>
                            </td>
                            <td class="small">{{ $faq->sort_order }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.faqs.destroy', $faq) }}"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada FAQ.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($faqs->hasPages())
            <div class="card-footer">{{ $faqs->links() }}</div>
        @endif
    </div>
@endsection
