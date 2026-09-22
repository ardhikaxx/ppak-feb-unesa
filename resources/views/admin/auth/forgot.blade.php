<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <title>Lupa Password Admin | PPAk FEB UNESA</title>
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
        .auth-step { display: flex; gap: .85rem; align-items: flex-start; }
        .auth-step .step-badge {
            width: 42px; height: 42px; flex: 0 0 42px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            background: rgba(201, 162, 39, .16); border: 1px solid rgba(201, 162, 39, .45); color: var(--gold);
            font-weight: 700;
        }
        .auth-step.active .step-badge { background: var(--gold); color: var(--navy-dark); border-color: var(--gold); }
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
                        <img src="{{ asset('images/logo-unesa.png') }}" alt="Logo UNESA" width="170" height="53">
                    </div>
                    <div>
                        <div class="gold-line mb-3"></div>
                        <h1 class="fw-bold mb-2" style="font-size:2rem;">Lupa Password?</h1>
                        <p class="mb-4" style="color:#b8c7dd;">Tenang, akun Anda aman. Ikuti 3 langkah mudah berikut.</p>
                        <div class="d-flex flex-column gap-3">
                            <div class="auth-step active">
                                <span class="step-badge">1</span>
                                <div>
                                    <div class="fw-semibold">Minta tautan reset</div>
                                    <small style="color:#9db1c9;">Masukkan email akun admin Anda pada form di samping.</small>
                                </div>
                            </div>
                            <div class="auth-step">
                                <span class="step-badge">2</span>
                                <div>
                                    <div class="fw-semibold">Buka tautan di email</div>
                                    <small style="color:#9db1c9;">Klik tautan "Atur Ulang Password" yang dikirim ke email Anda.</small>
                                </div>
                            </div>
                            <div class="auth-step">
                                <span class="step-badge">3</span>
                                <div>
                                    <div class="fw-semibold">Buat password baru</div>
                                    <small style="color:#9db1c9;">Minimal 8 karakter, kombinasi huruf besar, kecil, dan angka.</small>
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
                        <img src="{{ asset('images/logo-single.png') }}" alt="Logo PPAk FEB UNESA" width="52" height="52" class="mb-2">
                        <div class="fw-bold" style="color:var(--navy);">CMS Admin PPAk FEB UNESA</div>
                    </div>
                    <div class="gold-line mb-3"></div>
                    <h2 class="h4 fw-bold mb-1" style="color:var(--navy);">Lupa password?</h2>
                    <p class="text-muted small mb-4">Jika email terdaftar, tautan untuk membuat password baru akan dikirim ke email Anda.</p>

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.password.email') }}" id="forgotForm" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="nama@unesa.ac.id">
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-navy w-100 fw-semibold py-2" id="forgotBtn">
                            <i class="fa-solid fa-envelope-circle-check me-1"></i><span>Kirim Tautan Reset</span>
                        </button>
                    </form>

                    <p class="text-center small mt-4 mb-0">
                        <a href="{{ route('admin.login') }}" class="text-decoration-none"><i class="fa-solid fa-arrow-left me-1"></i>Kembali ke halaman login</a>
                    </p>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.getElementById('forgotForm')?.addEventListener('submit', function () {
            var btn = document.getElementById('forgotBtn');
            if (!btn) return;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span><span>Mengirim...</span>';
        });
    </script>
    @include('components.swal')
</body>
</html>
