<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol - E-Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .register-card { border: none; border-radius: 15px; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card register-card shadow-lg p-4 bg-white">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark">📝 Kayıt Ol</h2>
                        <p class="text-muted small">Hemen ücretsiz bir hesap oluşturun</p>
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

                    <form method="POST" action="/register">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Adınız Soyadınız</label>
                            <input type="text" name="name" class="form-control py-2 shadow-sm" value="{{ old('name') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">E-Posta Adresi</label>
                            <input type="email" name="email" class="form-control py-2 shadow-sm" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Şifre</label>
                            <input type="password" name="password" class="form-control py-2 shadow-sm" required autocomplete="new-password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">Şifre Tekrar</label>
                            <input type="password" name="password_confirmation" class="form-control py-2 shadow-sm" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm mb-3 text-white" style="background: linear-gradient(to right, #667eea, #764ba2); border: none;">
                            Kayıt İşlemini Tamamla
                        </button>

                        <div class="text-center">
                            <a href="/login" class="text-decoration-none small fw-semibold text-primary">Zaten hesabınız var mı? Giriş Yapın</a>
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
