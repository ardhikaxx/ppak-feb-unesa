<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Dynamic Title --}}
    <title>@yield('title', 'Pendidikan Profesi Akuntansi FEB UNESA | Universitas Negeri Surabaya')</title>

    {{-- SEO & Metadata --}}
    <meta name="description" content="@yield('meta_description', 'Pendidikan Profesi Akuntansi (PPAk) Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya mempersiapkan akuntan profesional beregister dengan standar global, etika kokoh, dan kurikulum selaras IAI.')">
    <meta name="keywords" content="PPAk, Pendidikan Profesi Akuntansi, FEB UNESA, Akuntan, Chartered Accountant, CA Indonesia, CPA, Akuntansi UNESA, Surabaya">
    <meta name="author" content="PPAk FEB UNESA">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph / Social Sharing --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Pendidikan Profesi Akuntansi FEB UNESA')">
    <meta property="og:description" content="@yield('meta_description', 'Program Pendidikan Profesi Akuntansi Fakultas Ekonomika dan Bisnis Universitas Negeri Surabaya.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-ppak-unesa.jpg'))">

    {{-- Bootstrap 5.3.3 via CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- Font Awesome 6.6.0 via CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Custom Design System CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ file_exists(public_path('css/app.css')) ? filemtime(public_path('css/app.css')) : time() }}">

    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Skip link for accessibility --}}
    <a href="#main-content" class="visually-hidden-focusable p-3 bg-white text-primary position-absolute top-0 start-0 z-3">Lewati ke konten utama</a>

    {{-- Top Information Bar --}}
    @include('partials.topbar')

    {{-- Sticky Primary Navbar --}}
    @include('partials.navbar')

    {{-- Main Content Area --}}
    <main id="main-content" class="flex-grow-1">
        @yield('content')
    </main>

    {{-- Call To Action Pre-Footer (Rendered on pages unless explicitly hidden) --}}
    @unless(View::hasSection('hide_cta'))
        @include('partials.cta-banner')
    @endunless

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Bootstrap 5.3.3 Bundle via CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- Application Custom JS --}}
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
</body>
</html>
