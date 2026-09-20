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
                        <label class="form-label fw-semibold {{ $account->exists ? '' : 'required' }}" for="password">
                            Password {{ $account->exists ? '(kosongkan jika tidak diubah)' : '(min 8 karakter)' }}
                        </label>
                        <input type="password" name="password" id="password" class="form-control" autocomplete="new-password" @if(!$account->exists) required @endif>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold" for="password_confirmation">Konfirmasi password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
                    </div>
                </div>
                <div class="form-check mb-0">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $account->is_active ?? true))>
                    <label class="form-check-label" for="is_active">Akun aktif (dapat login CMS)</label>
                </div>
            </div>
            <div class="card-footer d-flex gap-2">
                <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan</button>
                <a href="{{ route('admin.admins.index') }}" class="btn btn-light border">Batal</a>
            </div>
        </div>
    </form>
@endsection
