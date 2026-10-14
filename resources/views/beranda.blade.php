<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda | Pengelolaan Data Peserta Sertifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="welcome-page">
    <div class="welcome-card card">
        <div class="card-body p-4 p-md-5 text-center">
            <h1 class="welcome-title mb-2">Selamat Datang</h1>
            <h2 class="h5 fw-semibold mb-3">Aplikasi Pengelolaan Data Peserta Sertifikasi</h2>
            <p class="text-muted mb-4">Kelola data peserta dan skema sertifikasi dalam satu aplikasi dengan mudah dan efisien.</p>

            @auth
                <div class="d-grid gap-2 col-md-8 mx-auto">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-speedometer2"></i> Ke Dashboard
                    </a>
                </div>
            @else
                <div class="d-flex flex-column flex-sm-row justify-content-center gap-2">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-4">
                        <i class="bi bi-person-plus"></i> Daftar Akun
                    </a>
                </div>
            @endauth
        </div>
    </div>
</body>
</html>