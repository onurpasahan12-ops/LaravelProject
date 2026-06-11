<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticaret Mağazası</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card { transition: transform 0.2s; border: none; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .hero-section { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="/">🛒 E-STORE</a>
        <div class="d-flex align-items-center gap-3">
            @auth
                <span class="text-light me-2">👋 Hoş geldin, <strong>{{ Auth::user()->name }}</strong></span>
                @if(Auth::user()->role === 'admin')
                    <a href="/admin/dashboard" class="btn btn-danger btn-sm fw-bold shadow-sm">🛡️ Yönetim Paneli</a>
                @endif
                <form action="/logout" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Çıkış Yap</button>
                </form>
            @else
                <a href="/login" class="btn btn-outline-light btn-sm">Giriş Yap</a>
                <a href="/register" class="btn btn-light btn-sm fw-bold text-primary">Kayıt Ol</a>
            @endauth
        </div>
    </div>
</nav>

<div class="hero-section py-5 mb-5 shadow-sm">
    <div class="container text-center py-4">
        <h1 class="display-4 fw-bold mb-3">Muhteşem Mağazamıza Hoş Geldiniz</h1>
        <p class="lead opacity-75">En kaliteli ürünler, en uygun fiyatlarla tek bir tık uzağınızda.</p>
    </div>
</div>

<div class="container mb-5">
    <h2 class="fw-bold mb-4 d-flex align-items-center gap-2">🛍️ Öne Çıkan Ürünlerimiz</h2>

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 product-card shadow-sm">
                    <div class="card-body d-flex flex-column p-4">
                        <span class="badge bg-secondary mb-2 align-self-start">Kategori</span>
                        <h5 class="card-title fw-bold text-dark mb-2">{{ $product->name }}</h5>
                        <p class="text-muted small flex-grow-1">{{ Str::limit($product->description, 100, '...') }}</p>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="fs-4 fw-bold text-primary">{{ number_format($product->price, 2) }} TL</span>
                            @if($product->stock > 0)
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2">Stokta Var ({{ $product->stock }})</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-2">Tükendi</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 p-4 pt-0">
                        <button class="btn btn-primary w-100 fw-bold py-2 shadow-sm" {{ $product->stock == 0 ? 'disabled' : '' }}>
                            {{ $product->stock == 0 ? 'Stok Yok' : 'Sepete Ekle' }}
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="card p-5 shadow-sm border-0 bg-white">
                    <h4 class="text-muted mb-0">✨ Mağazamız henüz çok yeni! Yakında harika ürünlerle karşınızda olacağız.</h4>
                </div>
            </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
