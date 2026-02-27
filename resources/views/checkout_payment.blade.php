@extends('layouts.web') @section('isi')
    <div class="container mt-5 mb-5 text-center">
        <div class="card shadow-sm p-4">
            <h4>Satu Langkah Lagi!</h4>
            <p>Pesanan <strong>{{ $order->number }}</strong> telah dicatat.</p>
            <h2 class="text-primary">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</h2>

            <button id="pay-button" class="btn btn-primary btn-lg mt-3">Bayar Sekarang</button>
        </div>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran Berhasil!");
                    window.location.href = "{{ url('/') }}";
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran Anda.");
                },
                onError: function(result) {
                    alert("Pembayaran gagal.");
                }
            });
        });
    </script>
@endsection
