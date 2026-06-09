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
<div class="p-5 mb-4 bg-light rounded-3 text-center shadow-sm">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold text-dark">🚀 Muhteşem Mağazamıza Hoş Geldiniz</h1>
        <p class="col-md-8 fs-4 mx-auto text-muted">En kaliteli ürünler, en uygun fiyatlarla tek bir tık uzağınızda. Güvenli alışverişin tadını çıkarın!</p>
    </div>
</div>

<div class="container my-5">
    <h2 class="text-center mb-4 fw-bold text-secondary">🛍️ Öne Çıkan Ürünlerimiz</h2>
    <hr class="mb-5" style="width: 100px; margin: 0 auto; border-top: 3px solid #dc3545;">

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 transition-all">
                    <div class="bg-dark text-white text-center py-5 rounded-top" style="opacity: 0.85;">
                        <span class="fs-1">📦</span>
                        <h5 class="mt-2 text-warning fw-bold">{{ $product->name }}</h5>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit($product->description, 100, '...') ?: 'Bu ürün için bir açıklama girilmemiş.' }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fs-4 fw-bold text-danger">{{ number_format($product->price, 2) }} TL</span>

                            @if($product->stock > 0)
                                <span class="badge bg-success-subtle text-success border border-success px-2 py-1">Stokta Var ({{ $product->stock }})</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger px-2 py-1">Tükendi</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 pb-3">
                        <button class="btn btn-outline-danger w-100 fw-bold shadow-sm" {{ $product->stock == 0 ? 'disabled' : '' }}>
                            {{ $product->stock > 0 ? '🛒 Sepete Ekle' : 'Tükendi' }}
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-warning border-0 shadow-sm d-inline-block px-5">
                    ✨ Mağazamız henüz çok yeni! Yakında harika ürünlerle karşınızda olacağız.
                </div>
            </div>
        @endforelse
    </div>
</div>
</body>
</html>
