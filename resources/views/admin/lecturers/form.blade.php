@extends('admin.layouts.app')

@section('title', ($lecturer->exists ? 'Ubah' : 'Tambah') . ' Dosen')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.lecturers.index') }}">Dosen</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $lecturer->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $lecturer->exists ? 'Ubah Data Dosen' : 'Tambah Dosen' }}</h1>

    <form method="POST" action="{{ $lecturer->exists ? route('admin.lecturers.update', $lecturer) : route('admin.lecturers.store') }}" enctype="multipart/form-data">
        @csrf
        @if($lecturer->exists) @method('PUT') @endif

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-header">Identitas</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-semibold required">Nama lengkap (tanpa gelar)</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name', $lecturer->name) }}" required maxlength="255">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gelar" class="form-label fw-semibold">Nama bergelar</label>
                                <input type="text" name="gelar" id="gelar" class="form-control" maxlength="255"
                                       value="{{ old('gelar', $lecturer->gelar) }}" placeholder="Nama, S.E., M.S.A.">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label fw-semibold required">Slug (unik)</label>
                            <input type="text" name="slug" id="slug" data-slug-from="#name" class="form-control @error('slug') is-invalid @enderror"
                                   value="{{ old('slug', $lecturer->slug) }}" required pattern="[a-z0-9\-]+">
                            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label fw-semibold">Jabatan / peran</label>
                            <input type="text" name="role" id="role" class="form-control" maxlength="255"
                                   value="{{ old('role', $lecturer->role) }}" placeholder="Koordinator Program Studi & Dosen Aktif">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label fw-semibold required">Kategori bidang</label>
                                <select name="category" id="category" class="form-select" required>
                                    @foreach(['auditing' => 'Auditing', 'keuangan' => 'Keuangan', 'perpajakan' => 'Perpajakan', 'manajemen' => 'Manajemen'] as $val => $label)
                                        <option value="{{ $val }}" @selected(old('category', $lecturer->category ?? 'manajemen') === $val)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category_label" class="form-label fw-semibold">Label kategori</label>
                                <input type="text" name="category_label" id="category_label" class="form-control" maxlength="255"
                                       value="{{ old('category_label', $lecturer->category_label) }}" placeholder="Akuntansi Keuangan & Perpajakan">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="bidang" class="form-label fw-semibold">Bidang keahlian</label>
                            <input type="text" name="bidang" id="bidang" class="form-control" maxlength="500" value="{{ old('bidang', $lecturer->bidang) }}">
                        </div>
                        <div class="mb-3">
                            <label for="matkul" class="form-label fw-semibold">Mata kuliah diampu (pisahkan koma)</label>
                            <textarea name="matkul" id="matkul" rows="2" class="form-control">{{ old('matkul', is_array($lecturer->matkul) ? implode(', ', $lecturer->matkul) : $lecturer->matkul) }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" id="email" class="form-control" maxlength="255" value="{{ old('email', $lecturer->email) }}">
                            </div>
                            <div class="col-md-6 mb-0">
                                <label for="sertifikasi" class="form-label fw-semibold">Sertifikasi (pisahkan koma)</label>
                                <input type="text" name="sertifikasi" id="sertifikasi" class="form-control"
                                       value="{{ old('sertifikasi', is_array($lecturer->sertifikasi) ? implode(', ', $lecturer->sertifikasi) : $lecturer->sertifikasi) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">Foto & Tampil</div>
                    <div class="card-body">
                        @if($lecturer->image)
                            <img src="{{ $lecturer->image }}" alt="" class="img-fluid rounded mb-2">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="remove_image">
                                <label class="form-check-label small" for="remove_image">Hapus foto saat ini</label>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Foto baru</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
                            <div class="form-text">JPG/PNG/WebP, maks 5 MB.</div>
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold required">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="active" @selected(old('status', $lecturer->status ?? 'active') === 'active')>Aktif (tampil di publik)</option>
                                <option value="inactive" @selected(old('status', $lecturer->status) === 'inactive')>Nonaktif</option>
                            </select>
                        </div>
                        <div class="mb-0">
                            <label for="sort_order" class="form-label fw-semibold">Urutan tampil</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control" min="0" max="9999" value="{{ old('sort_order', $lecturer->sort_order ?? 0) }}">
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                    <a href="{{ route('admin.lecturers.index') }}" class="btn btn-light border">Batal</a>
                </div>
            </div>
        </div>
    </form>
@endsection
