<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/admin/dashboard">🛡️ CONTROL PANEL (ADMIN)</a>
        <a href="/" class="btn btn-outline-light btn-sm fw-bold">🛒 Mağazaya Dön</a>
    </div>
</nav>

<div class="container mt-5 mb-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            🎉 <strong>Başarılı!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 position-sticky" style="top: 20px;">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0 fw-bold">➕ Yeni Ürün Ekle</h5>
                </div>
                <div class="card-body p-4 bg-white">
                    <form action="/admin/products" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Ürün Adı</label>
                            <input type="text" name="name" class="form-control py-2 shadow-sm" required placeholder="Örn: Kablosuz Kulaklık">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Fiyat (TL)</label>
                            <input type="number" step="0.01" name="price" class="form-control py-2 shadow-sm" required placeholder="0.00">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Stok Adedi</label>
                            <input type="number" name="stock" class="form-control py-2 shadow-sm" required placeholder="10">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Ürün Açıklaması</label>
                            <textarea name="description" rows="3" class="form-control shadow-sm" placeholder="Ürün detaylarını yazınız..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100 fw-bold py-2 shadow-sm mt-3">💾 Ürünü Veritabanına Kaydet</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0 fw-bold">📦 Veritabanındaki Ürünler</h5>
                </div>
                <div class="card-body p-0 bg-white table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-light">
                        <tr>
                            <th class="py-3">ID</th>
                            <th class="py-3 text-start">Ürün Adı</th>
                            <th class="py-3">Fiyat</th>
                            <th class="py-3">Stok</th>
                            <th class="py-3">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="fw-bold text-secondary">#{{ $product->id }}</td>
                                <td class="text-start fw-semibold text-dark">{{ $product->name }}</td>
                                <td class="text-primary fw-bold">{{ number_format($product->price, 2) }} TL</td>
                                <td>
                                    @if($product->stock > 0)
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">{{ $product->stock }} Adet</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">Tükendi</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-warning btn-sm fw-bold px-3">Düzenle</a>
                                        <form action="/admin/products/{{ $product->id }}" method="POST" onsubmit="return confirm('Bu ürünü silmek istediğinize emin misiniz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm px-3">Sil</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-5 text-muted">Henüz hiç ürün eklenmemiş. Soldaki formdan ilk ürünü ekleyebilirsiniz!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
