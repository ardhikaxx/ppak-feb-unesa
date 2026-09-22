<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Login Admin CMS | PPAk FEB UNESA</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-single.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root { --navy: #102a43; --navy-dark: #0b1e33; --gold: #c9a227; }
        body { background: #eef2f7; min-height: 100vh; }
        .auth-brand {
            background-image: linear-gradient(160deg, rgba(11, 30, 51, .94) 0%, rgba(16, 42, 67, .88) 45%, rgba(16, 42, 67, .72) 100%), url('{{ asset('images/background-hero.jpg') }}');
            background-size: cover; background-position: center;
            color: #fff; min-height: 100vh;
        }
        .auth-brand .gold-line { width: 64px; height: 4px; background: var(--gold); border-radius: 2px; }
        .auth-feature { display: flex; gap: .85rem; align-items: flex-start; }
        .auth-feature .icon-badge {
            width: 42px; height: 42px; flex: 0 0 42px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(201, 162, 39, .16); border: 1px solid rgba(201, 162, 39, .45); color: var(--gold);
        }
        .auth-form-col { background: #fff; min-height: 100vh; }
        .auth-form-wrap { max-width: 400px; width: 100%; }
        .auth-form-wrap .gold-line { width: 56px; height: 4px; background: var(--gold); border-radius: 2px; }
        .btn-navy { background: var(--navy); border-color: var(--navy); color: #fff; transition: transform .15s ease, box-shadow .15s ease, background .15s ease; }
        .btn-navy:hover, .btn-navy:focus { background: var(--navy-dark); border-color: var(--navy-dark); color: #fff; transform: translateY(-1px); box-shadow: 0 8px 20px rgba(16, 42, 67, .25); }
        .btn-navy:focus-visible { outline: 3px solid rgba(201, 162, 39, .55); outline-offset: 2px; }
        .form-control:focus { border-color: var(--gold); box-shadow: 0 0 0 .2rem rgba(201, 162, 39, .22); }
        a { color: var(--navy); }
        a:hover { color: var(--navy-dark); }
    </style>
</head>
<body>
    <main class="container-fluid p-0">
        <div class="row g-0">
            {{-- Panel branding kampus (desktop) --}}
            <div class="col-lg-6 d-none d-lg-flex auth-brand">
                <div class="d-flex flex-column justify-content-between w-100 p-5">
                    <div class="d-flex align-items-center gap-3">
                        <a href="{{ route('home') }}" aria-label="Kembali ke beranda website">
                            <img src="{{ asset('images/logo-unesa.png') }}" alt="Logo UNESA" width="170" height="53">
                        </a>
                    </div>
                    <div>
                        <div class="gold-line mb-3"></div>
                        <h1 class="fw-bold mb-2" style="font-size:2rem;">CMS Admin PPAk</h1>
                        <p class="mb-4" style="color:#b8c7dd;">Pendidikan Profesi Akuntan &bull; Fakultas Ekonomika dan Bisnis &bull; Universitas Negeri Surabaya</p>
                        <div class="d-flex flex-column gap-3">
                            <div class="auth-feature">
                                <span class="icon-badge"><i class="fa-solid fa-pen-to-square"></i></span>
                                <div>
                                    <div class="fw-semibold">Kelola seluruh konten website</div>
                                    <small style="color:#9db1c9;">Berita, agenda, dosen, kurikulum, admisi, dokumen — tanpa menyentuh kode.</small>
                                </div>
                            </div>
                            <div class="auth-feature">
                                <span class="icon-badge"><i class="fa-solid fa-shield-halved"></i></span>
                                <div>
                                    <div class="fw-semibold">Keamanan berlapis</div>
                                    <small style="color:#9db1c9;">Role super admin &amp; operator, anti brute force, audit log aktivitas.</small>
                                </div>
                            </div>
                            <div class="auth-feature">
                                <span class="icon-badge"><i class="fa-solid fa-users-gear"></i></span>
                                <div>
                                    <div class="fw-semibold">Akses sesuai peran</div>
                                    <small style="color:#9db1c9;">Operator mengelola modul konten, pengaturan dijaga super admin.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small style="color:#8fa3bd;"><i class="fa-solid fa-lock me-1"></i>Area khusus pengelola &bull; Aktivitas tercatat di audit log</small>
                </div>
            </div>

            {{-- Panel form --}}
            <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center auth-form-col py-5 px-3">
                <div class="auth-form-wrap">
                    <div class="text-center d-lg-none mb-4">
                        <a href="{{ route('home') }}" aria-label="Kembali ke beranda website">
                            <img src="{{ asset('images/logo-single.png') }}" alt="Logo PPAk FEB UNESA" width="52" height="52" class="mb-2">
                        </a>
                        <div class="fw-bold" style="color:var(--navy);">CMS Admin PPAk FEB UNESA</div>
                    </div>
                    <div class="gold-line mb-3"></div>
                    <h2 class="h4 fw-bold mb-1" style="color:var(--navy);">Selamat datang kembali</h2>
                    <p class="text-muted small mb-4">Masuk untuk mengelola konten website PPAk FEB UNESA.</p>

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.store') }}" id="loginForm" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@unesa.ac.id">
                            </div>
                        </div>
                        <div class="mb-2">
                            <x-password-field name="password" label="Password" icon="fa-lock"
                                              autocomplete="current-password" :required="true" />
                            <div class="form-text text-warning d-none" id="capsHint"><i class="fa-solid fa-triangle-exclamation me-1"></i>Caps Lock aktif.</div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Ingat saya</label>
                            </div>
                            <a href="{{ route('admin.password.request') }}" class="small text-decoration-none">Lupa password?</a>
                        </div>
                        <button type="submit" class="btn btn-navy w-100 fw-semibold py-2" id="loginBtn">
                            <i class="fa-solid fa-right-to-bracket me-1"></i><span>Masuk ke Dashboard</span>
                        </button>
                    </form>

                    <p class="text-center small mt-4 mb-0">
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted"><i class="fa-solid fa-arrow-left me-1"></i>Kembali ke website publik</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Status loading pada tombol + peringatan Caps Lock (murni UX, tanpa ubah auth).
        document.getElementById('loginForm')?.addEventListener('submit', function () {
            var btn = document.getElementById('loginBtn');
            if (!btn) return;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span><span>Memeriksa...</span>';
        });
        document.querySelectorAll('[data-password-input]').forEach(function (input) {
            input.addEventListener('keyup', function (e) {
                var hint = document.getElementById('capsHint');
                if (!hint || !e.getModifierState) return;
                hint.classList.toggle('d-none', !e.getModifierState('CapsLock'));
            });
        });
    </script>
    @include('components.swal')
    @if(session('password_reset_success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof window.Swal === 'undefined') return;
                window.Swal.fire({
                    icon: 'success',
                    title: 'Password Berhasil Diubah',
                    text: 'Password sudah berhasil diubah. Silakan login dengan password baru Anda.',
                    confirmButtonText: 'Oke',
                    confirmButtonColor: '#0b409c',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                });
            });
        </script>
    @endif
</body>
</html>
