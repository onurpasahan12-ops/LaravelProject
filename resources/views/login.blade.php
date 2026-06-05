<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticaret Projesi - Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/viewport/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 mt-5">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h4 class="mb-0">Kullanıcı Girişi</h4>
                </div>
                <div class="card-body p-4">

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="/login" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">E-posta Adresi</label>
                            <img src="" alt="">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Örn: admin@mysite.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="•••••" required>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-dark">Giriş Yap</button>
                        </div>
                    </form>

                </div>
                <div class="card-footer text-center py-3 bg-white border-0">
                    <a href="/" class="text-muted small">← Ana Sayfaya Dön</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
