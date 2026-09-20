@extends('admin.layouts.app')

@section('title', 'Profil Saya')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
@endsection

@section('content')
    <h1 class="h4 fw-bold mb-3">Profil Saya</h1>

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">Data akun</div>
                <form method="POST" action="{{ route('admin.profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold required" for="name">Nama</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-semibold required" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-sm"><i class="fa-solid fa-floppy-disk me-1"></i>Simpan Profil</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">Ubah password</div>
                <form method="POST" action="{{ route('admin.profile.password') }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold required" for="current_password">Password saat ini</label>
                            <input type="password" name="current_password" id="current_password" class="form-control" required autocomplete="current-password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold required" for="password">Password baru (min 8, huruf besar-kecil + angka)</label>
                            <input type="password" name="password" id="password" class="form-control" required autocomplete="new-password">
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-semibold required" for="password_confirmation">Konfirmasi password baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-warning btn-sm"><i class="fa-solid fa-key me-1"></i>Ubah Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
