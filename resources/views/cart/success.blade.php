<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Başarılı!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
@php $order = session()->get('completed_order'); @endphp
<div class="container text-center">
    <div class="card p-5 shadow border-0 bg-white mx-auto" style="max-width: 600px;">
        <div class="display-1 text-success mb-3">🎉</div>
        <h2 class="fw-bold text-success mb-2">Siparişiniz Başarıyla Alındı!</h2>
        <p class="text-muted fs-5">Sayın <strong>{{ $order['customer'] ?? 'Müşterimiz' }}</strong>, bizi tercih ettiğiniz için teşekkür ederiz.</p>

        <div class="alert alert-secondary my-4">
            <p class="mb-1 text-dark">Sipariş Numarası: <strong>{{ $order['order_number'] ?? 'ORD-000000' }}</strong></p>
            <small class="text-muted">Sipariş detayları ve kargo takip bilgileri sisteme işlenmiştir.</small>
        </div>

        <a href="/" class="btn btn-primary fw-bold px-4 py-2 shadow-sm">🛒 Alışverişe Devam Et</a>
    </div>
</div>
</body>
</html>
