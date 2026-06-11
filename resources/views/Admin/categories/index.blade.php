<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kategori Yönetimi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">📁 Kategori Yönetimi</h2>
        <div>
            <a href="/admin/dashboard" class="btn btn-secondary btn-sm me-2">Dashboard'a Dön</a>
            <a href="/admin/categories/create" class="btn btn-primary btn-sm">+ Yeni Kategori Ekle</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 bg-white">
        <table class="table table-hover align-middle mb-0 text-center">
            <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Kategori Adı</th>
                <th>Slug</th>
                <th>İşlem</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td class="text-muted">{{ $category->slug }}</td>
                    <td>
                        <form action="/admin/categories/{{ $category->id }}" method="POST" onsubmit="return confirm('Bu kategoriyi silmek istediğinize emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-4 text-muted">Henüz hiç kategori eklenmemiş.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
