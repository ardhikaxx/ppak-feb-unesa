@extends('admin.layouts.app')

@section('title', ($account->exists ? 'Ubah' : 'Tambah') . ' Admin')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">Kelola Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $account->exists ? 'Ubah' : 'Tambah' }}</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">{{ $account->exists ? 'Ubah Akun Admin' : 'Tambah Akun Admin' }}</h1>

    <form method="POST" action="{{ $account->exists ? route('admin.admins.update', $account) : route('admin.admins.store') }}">
        @csrf
        @if($account->exists) @method('PUT') @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="name">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $account->name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $account->email) }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <x-password-field name="password"
                                          :label="'Password ' . ($account->exists ? '(kosongkan jika tidak diubah)' : '(min 8 karakter, huruf besar/kecil + angka)')"
                                          :labelClass="$account->exists ? '' : 'required'"
                                          :required="!$account->exists" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <x-password-field name="password_confirmation" label="Konfirmasi password" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold required" for="role">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="operator" @selected(old('role', $account->role ?? 'operator') === 'operator')>Operator — konten (berita, agenda, galeri, dokumen, FAQ, publikasi, kurikulum, dosen, admisi)</option>
                            <option value="super_admin" @selected(old('role', $account->role) === 'super_admin')>Super Admin — akses penuh CMS</option>
                        </select>
                        <div class="form-text">Hanya super admin yang dapat mengatur role. Role akun sendiri tidak dapat diubah.</div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $account->is_active ?? true))>
                            <label class="form-check-label" for="is_active">Akun aktif (dapat login CMS)</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.admins.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
