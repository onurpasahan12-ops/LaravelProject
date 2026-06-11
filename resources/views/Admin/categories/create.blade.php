<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kategori Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width: 500px;">
    <div class="card p-4 shadow-sm border-0 bg-white">
        <h4 class="fw-bold mb-3">➕ Yeni Kategori Ekle</h4>
        <form action="/admin/categories" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kategori Adı</label>
                <input type="text" name="name" class="form-control" required placeholder="Örn: Telefonlar, Laptoplar">
            </div>
            <div class="d-flex justify-content-between">
                <a href="/admin/categories" class="btn btn-light">İptal</a>
                <button type="submit" class="btn btn-success px-4">Kaydet</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
