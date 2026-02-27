<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout & Pembayaran | {{ $konf->instansi_setting }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .checkout-container {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background-color: #222831;
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ddd;
            height: auto;
        }

        .form-control:focus {
            border-color: #ffbe33;
            box-shadow: none;
        }

        .btn-pay {
            background: linear-gradient(45deg, #1d6ed3, #28a745);
            color: white;
            font-weight: 600;
            padding: 15px;
            border-radius: 10px;
            border: none;
            transition: 0.3s;
        }

        .btn-pay:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            color: white;
        }

        .product-img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            background: #f1f1f1;
            border-radius: 8px;
        }

        .total-section {
            background: #fef9ef;
            border-top: 2px dashed #ddd;
        }

        .badge-trade-in {
            background-color: #ffbe33;
            color: #000;
            font-size: 11px;
        }
    </style>
</head>

<body>

    <div class="container checkout-container">
        <div class="row">
            <div class="col-lg-7 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="fa fa-shield mr-2"></i> Pembayaran Aman</h4>
                    </div>
                    <div class="card-body p-4">
                        <form id="payment-form">
                            @csrf
                            <h5 class="font-weight-bold mb-3">Informasi Pengiriman</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        placeholder="Nama sesuai identitas" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Nomor WhatsApp</label>
                                    <input type="text" name="wa" id="wa" class="form-control"
                                        placeholder="0812xxxxxx" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Metode Pengiriman</label>
                                <select name="metode_kirim" id="metode_kirim" class="form-control" required>
                                    <option value="Ambil di Counter">Ambil di Counter (Free)</option>
                                    <option value="Gojek">Gojek / Grab (Khusus Bali)</option>
                                    <option value="Ekspedisi">Ekspedisi (JNE/J&T - Luar Bali)</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Alamat Lengkap</label>
                                <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="Jl. Raya, No, Kec, Kab..."></textarea>
                            </div>

                            @php $isTradeIn = false; @endphp
                            @foreach ($cart as $item)
                                @if (in_array($item['nama_jenis'] ?? '', ['iPhone Ex IBox', 'iPhone Second', 'Android Second']))
                                    @php
                                        $isTradeIn = true;
                                        break;
                                    @endphp
                                @endif
                            @endforeach

                            @if ($isTradeIn)
                                <div class="alert alert-warning border-0 mt-4" style="border-radius: 10px;">
                                    <h6 class="font-weight-bold"><i class="fa fa-refresh"></i> Program Tukar Tambah</h6>
                                    <p class="small mb-2">Anda membeli unit second. Ingin tukar tambah? Masukkan detail
                                        HP lama Anda di bawah:</p>
                                    <input type="text" name="hp_lama" id="hp_lama"
                                        class="form-control form-control-sm"
                                        placeholder="Contoh: iPhone XR 128GB Blue Mulus">
                                </div>
                            @endif

                            <button type="submit" class="btn btn-pay btn-block mt-4" id="submit-button">
                                <i class="fa fa-credit-card mr-2"></i> Bayar Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="p-4">
                            <h5 class="font-weight-bold mb-4">Ringkasan Pesanan</h5>
                            @php $total = 0; @endphp
                            @foreach ($cart as $id => $details)
                                @php $total += $details['harga'] * $details['quantity'] @endphp
                                <div class="d-flex mb-3 align-items-center cart-item" data-id="{{ $id }}">
                                    <img src="{{ asset('file/produk/' . ($details['gambar'] ?? 'no-image.png')) }}"
                                        class="product-img mr-3">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between">
                                            <h6 class="mb-0 font-weight-bold" style="font-size: 14px;">
                                                {{ $details['nama'] }}</h6>
                                            <a href="javascript:void(0)" class="text-danger remove-item"
                                                data-id="{{ $id }}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <div class="input-group input-group-sm" style="width: 100px;">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-secondary update-qty"
                                                        data-id="{{ $id }}" data-action="minus">-</button>
                                                </div>
                                                <input type="text" class="form-control text-center bg-white"
                                                    value="{{ $details['quantity'] }}" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary update-qty"
                                                        data-id="{{ $id }}" data-action="plus">+</button>
                                                </div>
                                            </div>

                                            <div class="font-weight-bold text-right">
                                                Rp
                                                {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="p-4 total-section" style="border-radius: 0 0 15px 15px;">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <h5 class="font-weight-bold">Total Bayar</h5>
                                <h5 class="font-weight-bold text-success">Rp {{ number_format($total, 0, ',', '.') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $('#payment-form').submit(function(e) {
            e.preventDefault();
            const btn = $('#submit-button');
            btn.html('<i class="fa fa-spinner fa-spin"></i> Memproses...').attr('disabled', true);

            $.post("{{ url('proses-checkout') }}", $(this).serialize(), function(res) {
                if (res.snap_token) {
                    window.snap.pay(res.snap_token, {
                        onSuccess: function(result) {
                            window.location.href = "/finish?order_id=" + result.order_id;
                        },
                        onPending: function(result) {
                            alert("Selesaikan pembayaran Anda");
                            location.reload();
                        },
                        onError: function(result) {
                            alert("Pembayaran Gagal");
                            location.reload();
                        },
                        onClose: function() {
                            alert('Anda menutup jendela pembayaran sebelum selesai.');
                            btn.html('<i class="fa fa-credit-card mr-2"></i> Bayar Sekarang')
                                .attr('disabled', false);
                        }
                    });
                }
            }).fail(function() {
                alert("Terjadi kesalahan server.");
                btn.html('<i class="fa fa-credit-card mr-2"></i> Bayar Sekarang').attr('disabled', false);
            });
        });
    </script>
    <script>
        // Fungsi Update Qty
        $('.update-qty').click(function() {
            const id = $(this).data('id');
            const action = $(this).data('action');

            $.post("{{ url('cart/update-qty') }}", {
                _token: "{{ csrf_token() }}",
                id: id,
                action: action
            }, function(res) {
                if (res.success) {
                    location.reload(); // Reload untuk update total harga dan ringkasan
                }
            });
        });

        // Fungsi Hapus Item
        $('.remove-item').click(function() {
            if (confirm('Hapus produk ini dari keranjang?')) {
                const id = $(this).data('id');

                $.post("{{ url('cart/remove') }}", {
                    _token: "{{ csrf_token() }}",
                    id: id
                }, function(res) {
                    if (res.success) {
                        location.reload();
                    }
                });
            }
        });
    </script>
</body>

</html>
