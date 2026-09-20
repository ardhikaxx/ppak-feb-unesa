@extends('admin.layouts.app')

@section('title', 'Media Manager')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Media Manager</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-1">Media / File Manager</h1>
    <p class="text-muted small mb-3">File yang diupload melalui CMS (storage). File yang masih dipakai konten tidak dapat dihapus.</p>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-md-10">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control form-control-sm" placeholder="Cari nama file...">
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
                    <tr><th style="width:80px;">Pratinjau</th><th>File</th><th>Tipe / Ukuran</th><th>Penggunaan</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($files as $file)
                        <tr>
                            <td>
                                @if($file['is_image'])
                                    <img src="{{ $file['url'] }}" alt="" class="rounded" style="width:64px;height:48px;object-fit:cover;">
                                @else
                                    <div class="text-center text-danger fs-4"><i class="fa-solid fa-file-pdf"></i></div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold small">{{ $file['name'] }}</div>
                                <div class="small text-muted">{{ $file['dir'] }} &bull; {{ date('d M Y H:i', $file['modified']) }}</div>
                            </td>
                            <td class="small">{{ $file['mime'] }}<br><span class="text-muted">{{ $file['size_human'] }}</span></td>
                            <td class="small">
                                @if(empty($file['usage']))
                                    <span class="badge text-bg-success">Tidak dipakai</span>
                                @else
                                    @foreach($file['usage'] as $u)
                                        <span class="badge text-bg-warning mb-1">{{ $u }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a href="{{ $file['url'] }}" target="_blank" rel="noopener" class="btn btn-outline-secondary btn-sm" title="Buka"><i class="fa-solid fa-eye"></i></a>
                                @if(empty($file['usage']))
                                    <button class="btn btn-outline-danger btn-sm btn-delete" data-url="{{ route('admin.media.destroy') }}?path={{ urlencode($file['path']) }}"
                                            data-message="Hapus file {{ $file['name'] }} secara permanen?">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada file di storage. Upload melalui modul Berita, Dosen, Galeri, atau Dokumen.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
