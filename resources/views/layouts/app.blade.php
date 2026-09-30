<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Pengelolaan Data Peserta Sertifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">Pengelolaan Data Peserta Sertifikasi</div>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('peserta.*') ? 'active' : '' }}" href="{{ route('peserta.index') }}">
                <i class="bi bi-people"></i> Data Peserta
            </a>
            <a class="nav-link {{ request()->routeIs('skema.*') ? 'active' : '' }}" href="{{ route('skema.index') }}">
                <i class="bi bi-award"></i> Data Skema
            </a>
        </nav>
    </aside>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="main">
        <header class="topbar">
            <button class="btn btn-outline-secondary d-lg-none" id="sidebarToggle" type="button" aria-label="Buka menu">
                <i class="bi bi-list"></i>
            </button>
            <h1 class="topbar-title">@yield('title')</h1>
            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="text-muted d-none d-sm-inline">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="bi bi-box-arrow-right"></i> Keluar</button>
                </form>
            </div>
        </header>

        <main class="content">
            @include('partials.alerts')
            @yield('content')
        </main>

        <footer class="footer">Aplikasi Pengelolaan Data Peserta Sertifikasi</footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
