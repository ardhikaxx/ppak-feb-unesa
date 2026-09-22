<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Ubah Password Baru Admin | PPAk FEB UNESA</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-single.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body { background: #102a43; min-height: 100vh; display: flex; align-items: center; }
        .login-card { max-width: 440px; width: 100%; }
        .login-brand img { height: 56px; }
        .gold-line { width: 56px; height: 4px; background: #c9a227; border-radius: 2px; }
    </style>
</head>
<body>
    <main class="container py-5">
        <div class="login-card mx-auto">
            <div class="text-center text-white mb-4 login-brand">
                <img src="{{ asset('images/logo-unesa.png') }}" alt="Logo UNESA" class="mb-3" width="180" height="56">
                <h1 class="h4 fw-bold mb-1">CMS Admin PPAk FEB UNESA</h1>
                <p class="small mb-0" style="color:#b8c7dd;">Pendidikan Profesi Akuntan &bull; Universitas Negeri Surabaya</p>
            </div>
            <div class="card shadow">
                <div class="card-body p-4">
                    <div class="gold-line mb-3"></div>
                    <h2 class="h5 fw-bold mb-1">Buat Password Baru</h2>
                    <p class="text-muted small mb-4">Akun <strong>{{ $email }}</strong> terverifikasi. Silakan masukkan password baru Anda.</p>

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.update') }}" novalidate>
                        @csrf
                        <div class="mb-3">
                            <x-password-field name="password" label="Password Baru" icon="fa-lock"
                                              autocomplete="new-password" :required="true" />
                        </div>
                        <div class="mb-3">
                            <x-password-field name="password_confirmation" label="Konfirmasi Password Baru" icon="fa-lock"
                                              autocomplete="new-password" :required="true" />
                        </div>
                        <p class="text-muted small mb-3"><i class="fa-solid fa-circle-info me-1"></i>Minimal 8 karakter, kombinasi huruf besar, huruf kecil, dan angka.</p>
                        <button type="submit" class="btn btn-primary w-100 fw-semibold">
                            <i class="fa-solid fa-key me-1"></i>Simpan Password Baru
                        </button>
                    </form>

                    <p class="text-center small mt-3 mb-0">
                        <a href="{{ route('admin.password.request') }}" class="text-decoration-none"><i class="fa-solid fa-arrow-left me-1"></i>Gunakan email lain</a>
                    </p>
                </div>
            </div>
            <p class="text-center small mt-3 mb-0" style="color:#8fa3bd;">
                <a href="{{ route('home') }}" class="text-decoration-none" style="color:#cdd9e8;"><i class="fa-solid fa-globe me-1"></i>Kembali ke website publik</a>
            </p>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @include('components.swal')
</body>
</html>
