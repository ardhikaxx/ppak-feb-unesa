@extends('admin.layouts.app')

@section('title', 'Kelola Admin')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Kelola Admin</li>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h1 class="h4 fw-bold mb-0">Akun Administrator</h1>
        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-plus me-1"></i>Tambah Admin</a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Login Terakhir</th><th style="width:130px;">Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($admins as $account)
                        <tr>
                            <td class="fw-semibold">{{ $account->name }} @if($account->id === auth('admin')->id()) <span class="badge text-bg-info">Anda</span> @endif</td>
                            <td class="small">{{ $account->email }}</td>
                            <td><span class="badge {{ $account->isSuperAdmin() ? 'text-bg-warning' : 'text-bg-secondary' }}">{{ $account->isSuperAdmin() ? 'Super Admin' : 'Operator' }}</span></td>
                            <td><span class="badge {{ $account->is_active ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $account->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                            <td class="small">{{ \App\Support\Tanggal::datetime($account->last_login_at) ?? '—' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.admins.edit', $account) }}" class="btn btn-outline-primary"><i class="fa-solid fa-pen"></i></a>
                                    <button class="btn btn-outline-danger btn-delete" data-url="{{ route('admin.admins.destroy', $account) }}" data-message="Hapus akun {{ $account->email }}?"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada akun admin.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($admins->hasPages())
            <div class="card-footer">{{ $admins->links() }}</div>
        @endif
    </div>
@endsection
