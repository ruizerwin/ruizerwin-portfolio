<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $portfolio['seo']['title'] }}</title>
    <meta name="description" content="{{ $portfolio['seo']['description'] }}">
    <meta name="author" content="{{ $portfolio['name'] }}">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#0f1c24">

    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $portfolio['seo']['title'] }}">
    <meta property="og:description" content="{{ $portfolio['seo']['description'] }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/profile-erwin.jpg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/portfolio.css') }}?v=7" rel="stylesheet">
</head>
<body>
    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <button type="button" class="scroll-top" id="scrollTopBtn" aria-label="Scroll to top">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/portfolio.js') }}?v=2" defer></script>
    @stack('scripts')
</body>
</html>
