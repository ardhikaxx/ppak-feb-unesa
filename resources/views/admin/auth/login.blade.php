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
                    <h2 class="h5 fw-bold mb-1">Login Administrator</h2>
                    <p class="text-muted small mb-4">Area khusus pengelola konten website. Bukan untuk publik.</p>

                    @if(session('error'))
                        <div class="alert alert-danger" role="alert"><i class="fa-solid fa-circle-exclamation me-1"></i>{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success" role="alert"><i class="fa-solid fa-circle-check me-1"></i>{{ session('success') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login.store') }}" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@unesa.ac.id">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                       required autocomplete="current-password" placeholder="••••••••">
                            </div>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-semibold">
                            <i class="fa-solid fa-right-to-bracket me-1"></i>Masuk ke Dashboard
                        </button>
                    </form>
                </div>
            </div>
            <p class="text-center small mt-3 mb-0" style="color:#8fa3bd;">
                <a href="{{ route('home') }}" class="text-decoration-none" style="color:#cdd9e8;"><i class="fa-solid fa-arrow-left me-1"></i>Kembali ke website publik</a>
            </p>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
