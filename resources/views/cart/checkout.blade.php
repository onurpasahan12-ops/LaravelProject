<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş ve Ödeme</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="fw-bold mb-4">💳 Teslimat ve Ödeme Bilgileri</h2>
    <div class="row g-4">
        <div class="col-md-7">
            <div class="card p-4 shadow-sm border-0 bg-white">
                <h5 class="fw-bold mb-3">Kargo ve Fatura Adresi</h5>
                <form action="/order/place" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Adınız Soyadınız</label>
                        <input type="text" name="name" class="form-line form-control" required placeholder="Onur Paşahan">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefon Numaranız</label>
                        <input type="text" name="phone" class="form-control" required placeholder="0555 XXXXXXX">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Açık Adres</label>
                        <textarea name="address" class="form-control" rows="3" required placeholder="Fatih / İstanbul..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100 fw-bold py-2 mt-3">🔒 Siparişi Güvenle Tamamla</button>
                </form>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card p-4 shadow-sm border-0 bg-white">
                <h5 class="fw-bold mb-3">Sipariş Edilen Ürünler</h5>
                <ul class="list-group list-group-flush">
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $details)
                        @php $total += $details['price'] * $details['quantity']; @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <h6 class="my-0 fw-semibold">{{ $details['name'] }}</h6>
                                <small class="text-muted">Adet: {{ $details['quantity'] }}</small>
                            </div>
                            <span class="text-muted">{{ number_format($details['price'] * $details['quantity'], 2) }} TL</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between px-0 fs-5 fw-bold text-success">
                        <span>Toplam Tutar:</span>
                        <span>{{ number_format($total, 2) }} TL</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>
