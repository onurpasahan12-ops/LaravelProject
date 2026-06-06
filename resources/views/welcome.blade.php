<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticaret Projesi - Ana Sayfa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/viewport/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">🛒 E-Ticaret Mağazası</a>
        <div class="navbar-nav ms-auto">

            @auth
                <span class="nav-link text-white me-3 align-self-center">
                    👋 Hoş geldin, {{ Auth::user()->name }}
                </span>

                @if(Auth::user()->hasRole('admin'))
                    <a class="btn btn-danger btn-sm text-white px-3 me-2 align-self-center" href="/admin/dashboard">
                        🛡️ Yönetim Paneli
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="POST" class="d-inline align-self-center">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-light px-3">Çıkış Yap</button>
                </form>
            @endauth

            @guest
                <a class="nav-link btn btn-outline-light text-white px-3 me-2" href="/login">Giriş Yap</a>
                <a class="nav-link btn btn-warning text-dark px-3" href="/register">Kayıt Ol</a>
            @endguest

        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center bg-white p-5 rounded shadow-sm">
            <h1 class="display-4 mb-4">Mağazamıza Hoş Geldiniz!</h1>
            <p class="lead text-muted">Bu proje Laravel framework'ü kullanılarak Gelişmiş Web Programlama dersi için hazırlanmıştır.</p>
            <hr class="my-4">
            <p>Güvenli alışveriş ve yönetim paneline erişmek için lütfen giriş yapın.</p>
        </div>
    </div>
</div>

</body>
</html>
