<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil | {{ $konf->instansi_setting }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .success-card {
            max-width: 500px;
            margin: 80px auto;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .check-icon {
            font-size: 80px;
            color: #28a745;
        }

        .btn-wa {
            background-color: #25d366;
            color: white;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-wa:hover {
            background-color: #128c7e;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container text-center">
        <div class="card success-card p-5">
            <div class="mb-4">
                <i class="fa fa-check-circle check-icon"></i>
            </div>
            <h3 class="font-weight-bold">Pembayaran Diterima!</h3>
            <p class="text-muted">Terima kasih <strong>{{ $order->nama_pelanggan }}</strong>, pesanan Anda sedang kami
                proses.</p>

            <div class="bg-light p-3 rounded mb-4 text-left">
                <div class="d-flex justify-content-between small">
                    <span>No. Invoice:</span>
                    <span class="font-weight-bold">{{ $order->number }}</span>
                </div>
                <div class="d-flex justify-content-between small">
                    <span>Total Bayar:</span>
                    <span class="font-weight-bold text-success">Rp
                        {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>

            <p class="small text-muted mb-4">Kami juga telah mengirimkan detail pesanan ke sistem kami. Silakan
                konfirmasi via WhatsApp untuk mempercepat pengiriman.</p>

            <a href="https://wa.me/{{ $konf->no_hp_setting }}?text=Halo%20Admin%2C%20saya%20sudah%20bayar%20pesanan%20{{ $order->number }}"
                class="btn btn-wa btn-block p-3">
                <i class="fa fa-whatsapp mr-2"></i> Konfirmasi ke Admin
            </a>

            <a href="{{ url('/') }}" class="btn btn-link mt-3 text-muted">Kembali ke Beranda</a>
        </div>
    </div>

</body>

</html>
