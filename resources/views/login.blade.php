<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap - E-Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card { border: none; border-radius: 15px; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card login-card shadow-lg p-4 bg-white">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark">🔑 Giriş Yap</h2>
                        <p class="text-muted small">Hesabınıza erişmek için bilgilerinizi girin</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 small">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="/login">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">E-Posta Adresi</label>
                            <input type="email" name="email" class="form-control py-2 shadow-sm" value="{{ old('email') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Şifre</label>
                            <input type="password" name="password" class="form-control py-2 shadow-sm" required autocomplete="current-password">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember_me">
                            <label class="form-check-label text-muted small" for="remember_me">Beni Hatırla</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm mb-3 text-white" style="background: linear-gradient(to right, #667eea, #764ba2); border: none;">
                            Oturum Aç
                        </button>

                        <div class="text-center">
                            <a href="/register" class="text-decoration-none small fw-semibold text-primary">Henüz hesabınız yok mu? Kayıt Olun</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="/" class="text-white-50 text-decoration-none small">← Mağazaya Geri Dön</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
