<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alışveriş Sepetim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="/">🛒 E-STORE</a>
        <a href="/" class="btn btn-outline-light btn-sm">Mağazaya Geri Dön</a>
    </div>
</nav>

<div class="container mt-5 mb-5">
    <h2 class="fw-bold mb-4">🛒 Alışveriş Sepetiniz</h2>

    @if(session('success'))
        <div class="alert alert-success shadow-sm mb-4">{{ session('success') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 bg-white">
                <div class="card-body p-0">
                    <table class="table align-middle mb-0 text-center">
                        <thead class="table-light">
                        <tr>
                            <th class="py-3 text-start ps-4">Ürün</th>
                            <th class="py-3">Fiyat</th>
                            <th class="py-3">Adet</th>
                            <th class="py-3">Toplam</th>
                            <th class="py-3">İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $total = 0; @endphp
                        @forelse($cart as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp
                            <tr>
                                <td class="text-start ps-4 fw-semibold">{{ $details['name'] }}</td>
                                <td>{{ number_format($details['price'], 2) }} TL</td>
                                <td><span class="badge bg-secondary px-3 py-2">{{ $details['quantity'] }}</span></td>
                                <td class="fw-bold text-primary">{{ number_format($details['price'] * $details['quantity'], 2) }} TL</td>
                                <td>
                                    <form action="/cart/remove/{{ $id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm px-3">Kaldır</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-5 text-muted">Sepetiniz şu anda boş. Detaylı bir alışveriş için ana sayfaya dönebilirsiniz!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 bg-white p-4">
                <h5 class="fw-bold mb-3">Sipariş Özeti</h5>
                <hr>
                <div class="d-flex justify-content-between mb-3 fs-5">
                    <span>Genel Toplam:</span>
                    <strong class="text-success">{{ number_format($total, 2) }} TL</strong>
                </div>
                <a href="/checkout" class="btn btn-success w-100 fw-bold py-2 shadow-sm {{ empty($cart) ? 'disabled' : '' }}">
                    💳 Alışverişi Tamamla (Ödeme Yap)
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
