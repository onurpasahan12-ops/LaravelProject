<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürünü Düzenle - Admin Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/viewport/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/admin/dashboard">🛡️ Yönetim Paneli (Admin)</a>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="mb-0">✏️ Ürünü Düzenle: {{ $product->name }}</h5>
                </div>
                <div class="card-body p-4 bg-white">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/admin/products/{{ $product->id }}" method="POST">
                        @csrf
                        @method('PUT') <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Ürün Adı</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Ürün Fiyatı (TL)</label>
                            <input type="number" name="price" id="price" step="0.01" class="form-control" value="{{ old('price', $product->price) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok Adedi</label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Ürün Açıklaması</label>
                            <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $product->description) }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="/admin/dashboard" class="btn btn-secondary">İptal Et</a>
                            <button type="submit" class="btn btn-warning px-4 fw-bold">Değişiklikleri Kaydet</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
