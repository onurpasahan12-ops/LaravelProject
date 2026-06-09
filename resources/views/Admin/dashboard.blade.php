<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/viewport/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/admin/dashboard">🛡️ E-Ticaret Yönetim Paneli</a>
        <div class="navbar-nav ms-auto d-flex align-items-center">
                <span class="nav-link text-white me-3">
                    👤 Admin: {{ Auth::user()->name }}
                </span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light">Çıkış Yap</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white fw-bold">
                    ⚙️ Hızlı Menü
                </div>
                <div class="list-group list-group-flush">
                    <a href="/admin/dashboard" class="list-group-item list-group-item-action active bg-danger border-danger">
                        📊 Genel Durum
                    </a>
                    <a href="/admin/products/create" class="list-group-item list-group-item-action">
                        📦 Yeni Ürün Ekle
                    </a>
                    <a href="/" class="list-group-item list-group-item-action text-primary">
                        🏠 Site Ön Sayfasına Git
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 fw-bold">📦 Mevcut Ürünler (Veritabanı)</h5>
                    <a href="/admin/products/create" class="btn btn-sm btn-danger fw-bold">+ Yeni Ürün Ekle</a>
                </div>
                <div class="card-body p-4 bg-white">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            🎉 {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Ürün Adı</th>
                                <th>Fiyat (TL)</th>
                                <th>Stok</th>
                                <th>Açıklama</th>
                                <th>İşlemler</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td><strong>{{ $product->name }}</strong></td>
                                    <td class="text-success fw-bold">{{ number_format($product->price, 2) }} TL</td>
                                    <td>
                                        @if($product->stock > 0)
                                            <span class="badge bg-success">{{ $product->stock }} Adet</span>
                                        @else
                                            <span class="badge bg-danger">Stokta Yok</span>
                                        @endif
                                    </td>
                                    <td><small class="text-muted">{{ Str::limit($product->description, 35) }}</small></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning me-1">Düzenle</button>
                                        <form action="/admin/products/{{ $product->id }}" method="POST" class="d-inline" onsubmit="return confirm('Bu ürünü silmek istediğinize emin misiniz?')">
                                            @csrf
                                            @method('DELETE') <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        📭 Henüz hiç ürün eklenmemiş. Yukarıdaki butondan ilk ürünü ekleyebilirsiniz!
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
