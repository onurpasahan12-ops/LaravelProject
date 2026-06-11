<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünü Düzenle - Admin Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .edit-card {
            border: none;
            border-radius: 12px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/admin/dashboard">🛡️ CONTROL PANEL (ADMIN)</a>
        <a href="/admin/dashboard" class="btn btn-outline-light btn-sm fw-bold">← Panele Geri Dön</a>
    </div>
</nav>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card edit-card shadow p-4 bg-white">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <h3 class="fw-bold text-dark mb-0">📝 Ürünü Güncelle</h3>
                    </div>
                    <p class="text-muted small mb-4"><strong>#{{ $product->id }}</strong> ID'li ürüne ait bilgileri aşağıdan güncelleyebilirsiniz.</p>

                    <form action="/admin/products/{{ $product->id }}" method="POST">
                        @csrf
                        @method('PUT') <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Ürün Adı</label>
                            <input type="text" name="name" class="form-control py-2 shadow-sm" value="{{ $product->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Fiyat (TL)</label>
                            <input type="number" step="0.01" name="price" class="form-control py-2 shadow-sm" value="{{ $product->price }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Stok Adedi</label>
                            <input type="number" name="stock" class="form-control py-2 shadow-sm" value="{{ $product->stock }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary">Ürün Açıklaması</label>
                            <textarea name="description" rows="4" class="form-control shadow-sm">{{ $product->description }}</textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="/admin/dashboard" class="btn btn-light w-50 fw-bold py-2 border">İptal Et</a>
                            <button type="submit" class="btn btn-warning w-50 fw-bold py-2 shadow-sm text-dark">🔄 Değişiklikleri Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
