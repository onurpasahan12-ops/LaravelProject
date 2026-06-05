<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticaret Projesi - Admin Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/viewport/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow">
    <div class="container">
        <a class="navbar-brand font-weight-bold" href="/admin/dashboard">🛡️ Yönetim Paneli (Admin)</a>
        <div class="navbar-nav ms-auto">
            <span class="nav-link text-white me-3">Hoş geldiniz, {{ Auth::user()->name }}</span>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light">Güvenli Çıkış</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="list-group shadow-sm">
                <a href="#" class="list-group-item list-group-item-action active bg-danger border-danger">Anasayfa</a>
                <a href="#" class="list-group-item list-group-item-action">Ürün Yönetimi</a>
                <a href="#" class="list-group-item list-group-item-action">Kategoriler</a>
                <a href="#" class="list-group-item list-group-item-action">Siparişler</a>
                <a href="#" class="list-group-item list-group-item-action">Kullanıcılar</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card shadow-sm border-0 p-4 bg-white rounded">
                <h2 class="mb-3">Sistem Özeti</h2>
                <p class="text-muted">E-ticaret sisteminizin genel durumu ve istatistikleri burada listelenir.</p>
                <hr>

                <div class="row text-center mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="p-3 bg-light rounded border">
                            <h3 class="text-danger">Açık</h3>
                            <p class="mb-0 text-muted">Sistem Durumu</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-3 bg-light rounded border">
                            <h3 class="text-dark">2</h3>
                            <p class="mb-0 text-muted">Tanımlı Rol Sayısı</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-3 bg-light rounded border">
                            <h3 class="text-dark">Admin & User</h3>
                            <p class="mb-0 text-muted">Aktif Yetkiler</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
