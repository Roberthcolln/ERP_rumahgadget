@extends('layouts.web')

@section('isi')
    <style>
        /* Overlay untuk mengunci form sebelum setuju */
        #lock-overlay-jual {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.85);
            z-index: 10;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
        }

        .card-custom {
            border-radius: 20px;
            height: 100%;
            /* Agar tinggi kartu sama */
            border: none;
            transition: all 0.3s ease;
        }

        .list-syarat li {
            margin-bottom: 12px;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
        }

        .list-syarat li span {
            margin-right: 10px;
            color: #ffbe33;
        }
    </style>

    <section class="jual_hp_section layout_padding" style="background: #f8f9fa; padding: 60px 0;">
        <div class="container">
            <div class="heading_container heading_center mb-5">
                <h2 style="font-weight: 800; color: #000;">Jual HP Lama Kamu</h2>
                <p style="color: #666;">Dapatkan harga penawaran terbaik di Rumah Gadget</p>
            </div>

            <div class="row">
                {{-- KOLOM KIRI: FORM CEK HARGA --}}
                <div class="col-lg-5 mb-4">
                    <div class="card card-custom shadow-sm p-4 position-relative" id="cardJual">
                        {{-- Overlay --}}
                        <div id="lock-overlay-jual">
                            <button class="btn btn-dark btn-md shadow" data-toggle="modal" data-target="#modalSyarat"
                                style="border-radius: 12px; font-weight: 600;">
                                <i class="fa fa-lock mr-2"></i> Baca Syarat untuk Membuka
                            </button>
                        </div>

                        <h5 class="font-weight-bold mb-4">Pilih Perangkat</h5>

                        <div class="form-group">
                            <label class="small font-weight-bold text-muted">Merk & Tipe HP</label>
                            <select class="form-control form-control-lg" id="pilihHp" disabled
                                style="border-radius: 12px; border: 1px solid #ddd; font-size: 16px;">
                                <option selected disabled>Cari tipe HP kamu...</option>
                                @foreach ($produk as $pro)
                                    <option value="{{ $pro->id_produk }}">{{ $pro->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button id="btnCekHarga" class="btn btn-warning btn-block py-3 mt-2" disabled
                            style="border-radius: 12px; font-weight: 700; color: #000;">
                            CEK ESTIMASI HARGA
                        </button>

                        {{-- HASIL HARGA --}}
                        <div id="resultHarga" class="mt-4 text-center p-3"
                            style="display: none; background: #fff9e6; border-radius: 15px; border: 1px dashed #ffbe33;">
                            <p class="mb-1 text-muted small">Estimasi Harga Terima:</p>
                            <h2 class="text-success font-weight-bold mb-1" id="displayHarga">Rp 0</h2>
                            <small class="text-muted">Update: <span id="displayWaktu">-</span></small>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: INFORMASI SYARAT --}}
                <div class="col-lg-7 mb-4">
                    <div class="card card-custom bg-dark text-white p-4 p-md-5 shadow-lg">
                        <h4 class="mb-4" style="font-weight: 700; border-left: 4px solid #ffbe33; padding-left: 15px;">
                            Syarat & Ketentuan
                        </h4>
                        <ul class="list-syarat" style="list-style: none; padding-left: 0;">
                            <li><span><i class="fa fa-check-circle"></i></span> Lolos pengecekan fungsi oleh tim General
                                Check Up Rumah Gadget.</li>
                            <li><span><i class="fa fa-check-circle"></i></span> Fisik mulus (tidak ada lecet parah, retak,
                                atau dent).</li>
                            <li><span><i class="fa fa-check-circle"></i></span> Fungsi hardware (Kamera, FaceID/Fingerprint,
                                Layar) normal.</li>
                            <li><span><i class="fa fa-check-circle"></i></span> <strong>Penting:</strong> IMEI terdaftar
                                resmi di Kemenperin/Beacukai.</li>
                            <li><span><i class="fa fa-check-circle"></i></span> Battery Health minimal 85% & tidak kembung.
                            </li>
                            <li><span><i class="fa fa-check-circle"></i></span> Belum pernah bongkar/service (Sparepart
                                Original).</li>
                            <li><span><i class="fa fa-check-circle"></i></span> iCloud / Google Account sudah dalam keadaan
                                Sign Out.</li>
                            <li><span><i class="fa fa-check-circle"></i></span> <strong>Wajib membawa KTP/SIM asli
                                    pemilik.</strong></li>
                        </ul>
                        <div class="mt-4 p-3 style='background: rgba(255,255,255,0.1); border-radius: 10px;'">
                            <small class="text-warning font-italic">* Harga dapat berubah sewaktu-waktu mengikuti fluktuasi
                                pasar gadget second.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MODAL SYARAT --}}
    <div class="modal fade" id="modalSyarat" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-body p-5 text-center">
                    <div class="mb-4">
                        <i class="fa fa-file-text-o fa-4x text-warning"></i>
                    </div>
                    <h4 class="font-weight-bold">Persetujuan Layanan</h4>
                    <p class="text-muted">Dengan melanjutkan, Anda menyetujui bahwa harga yang ditampilkan adalah estimasi
                        untuk kondisi unit sempurna.</p>
                    <button type="button" id="btnSetuju" class="btn btn-success btn-block py-3 mt-4"
                        style="border-radius: 12px; font-weight: 600;">
                        SAYA MENGERTI & SETUJU
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function unlockForm() {
                $('#lock-overlay-jual').fadeOut();
                $('#pilihHp, #btnCekHarga').prop('disabled', false);
            }

            // Selalu tampilkan modal saat load
            $('#modalSyarat').modal('show');

            $('#btnSetuju').on('click', function() {
                unlockForm();
                $('#modalSyarat').modal('hide');
            });

            $('#btnCekHarga').on('click', function() {
                let idProduk = $('#pilihHp').val();
                if (!idProduk) {
                    alert('Silakan pilih tipe HP kamu!');
                    return;
                }

                let btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menghitung...');

                $.ajax({
                    url: "{{ url('/cek-harga') }}/" + idProduk,
                    type: "GET",
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            $('#displayHarga').text(response.harga);
                            $('#displayWaktu').text(response.waktu);
                            $('#resultHarga').slideDown();

                            // Scroll otomatis ke hasil di mobile
                            if ($(window).width() < 768) {
                                $('html, body').animate({
                                    scrollTop: $("#resultHarga").offset().top - 100
                                }, 500);
                            }
                        }
                    },
                    error: function() {
                        alert('Gagal mengambil data. Coba lagi nanti.');
                    },
                    complete: function() {
                        btn.prop('disabled', false).text('CEK ESTIMASI HARGA');
                    }
                });
            });
        });
    </script>
@endsection
