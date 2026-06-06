<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Ticaret Projesi - Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/viewport/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h4 class="mb-0">Yeni Üyelik Oluştur</h4>
                </div>
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/register" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Adınız Soyadınız</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Örn: Ahmet Yılmaz" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-posta Adresi</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Örn: ahmet@example.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Şifre</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="En az 5 karakter" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Şifre Tekrarı</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="•••••" required>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-dark">Kayıt Ol</button>
                        </div>
                    </form>

                </div>
                <div class="card-footer text-center py-3 bg-white border-0">
                    <a href="/login" class="text-muted small">Zaten hesabınız var mı? Giriş Yapın</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
