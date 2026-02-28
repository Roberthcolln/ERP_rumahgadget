@extends('layouts.web')

@section('isi')
    <style>
        /* Desain Latar Belakang & Kartu */
        .jual_hp_section {
            background: rgba(255, 255, 255, 0.9);
            background-attachment: fixed;
            min-height: 100vh;
            padding: 60px 0;
        }

        .card-trade {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        /* Styling Input & Tombol */
        .form-label-custom {
            font-weight: 700;
            color: #444;
            margin-bottom: 8px;
            display: block;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .custom-select-lg {
            border-radius: 15px !important;
            border: 2px solid #eee;
            height: calc(2.8rem + 2px) !important;
            font-weight: 500;
        }

        .btn-calc {
            background: #000;
            color: #fff;
            border-radius: 15px;
            font-weight: 700;
            letter-spacing: 1px;
            padding: 12px 30px;
            transition: all 0.3s;
        }

        .btn-calc:hover {
            background: #333;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Rincian Hasil */
        .result-box {
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            border: 2px solid #ffbe33;
        }

        .result-header {
            background: #ffbe33;
            padding: 20px;
            color: #000;
        }

        .price-tag {
            font-size: 3rem;
            font-weight: 800;
            color: #000;
            text-shadow: 1px 1px 0px #fff;
        }

        /* Overlay Lock */
        #lock-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(8px);
            z-index: 10;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .badge-step {
            width: 30px;
            height: 30px;
            background: #ffbe33;
            color: #000;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 10px;
            font-weight: bold;
        }
    </style>

    <section class="jual_hp_section">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-4 font-weight-bold" style="color: #000;">Smart Trade-In</h1>
                <p class="lead" style="color: #444;">Tukar tambah HP lama kamu dengan yang baru hanya dalam hitungan detik.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="card card-trade p-4 p-md-5 position-relative">
                        <div id="lock-overlay">
                            <button class="btn btn-dark btn-lg shadow-lg" data-toggle="modal" data-target="#modalToC"
                                style="border-radius: 50px; padding: 15px 40px; font-weight: 700;">
                                <i class="fa fa-unlock-alt mr-2"></i> Buka Kalkulator Tukar Tambah
                            </button>
                        </div>

                        <div class="row align-items-end">
                            <div class="col-md-5 mb-3 mb-md-0">
                                <label class="form-label-custom">
                                    <span class="badge-step">1</span> Gadget Kamu Saat Ini
                                </label>
                                <select class="form-control custom-select-lg shadow-sm" id="hpClient" disabled>
                                    <option value="" selected disabled>Pilih Merk & Tipe HP...</option>
                                    @foreach ($hpClient as $item)
                                        <option value="{{ $item->id_produk }}">
                                            {{ $item->nama_produk }} ({{ $item->varian->nama_varian ?? '-' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 text-center d-none d-md-block mb-3">
                                <div class="bg-dark text-white rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px;">
                                    <i class="fa fa-exchange fa-lg"></i>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label-custom">
                                    <span class="badge-step">2</span> Gadget Impian
                                </label>
                                <select class="form-control custom-select-lg shadow-sm" id="hpTarget" disabled>
                                    <option value="" selected disabled>Pilih HP yang Diinginkan...</option>
                                    @foreach ($hpTarget as $item)
                                        <option value="{{ $item->id_produk }}">
                                            {{ $item->nama_produk }} ({{ $item->varian->nama_varian ?? '-' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 mt-4">
                                <button id="btnHitung" class="btn btn-calc btn-block shadow-sm" disabled>
                                    <i class="fa fa-calculator mr-2"></i> HITUNG SELISIH HARGA
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="hasilKalkulasi" class="mt-5" style="display: none;">
                        <div class="result-box shadow-lg">
                            <div class="result-header text-center">
                                <h5 class="text-uppercase font-weight-bold mb-0">Estimasi Sisa Pembayaran</h5>
                            </div>
                            <div class="p-4 p-md-5">
                                <div class="text-center mb-5">
                                    <p id="labelHasil" class="text-muted mb-1">Anda Cukup Menambah:</p>
                                    <h1 class="price-tag" id="totalBayar">Rp 0</h1>
                                    <span class="badge badge-warning px-3 py-2 mt-2">Update: <span
                                            id="waktuUpdate"></span></span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4 mb-md-0">
                                        <div class="p-3 rounded-20 border" style="background: #f8f9fa;">
                                            <h6 class="font-weight-bold text-muted">HP LAMA ANDA</h6>
                                            <h5 id="namaClient" class="font-weight-bold text-dark">-</h5>
                                            <p id="varianClient" class="small mb-2">-</p>
                                            <h4 class="text-success font-weight-bold">Value: <span id="hargaClient">Rp
                                                    0</span></h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="p-3 rounded-20 border" style="background: #f8f9fa;">
                                            <h6 class="font-weight-bold text-muted">HP BARU ANDA</h6>
                                            <h5 id="namaTarget" class="font-weight-bold text-dark">-</h5>
                                            <p id="varianTarget" class="small mb-2">-</p>
                                            <h4 class="text-danger font-weight-bold">Price: <span id="hargaTarget">Rp
                                                    0</span></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 text-center">
                                    <p class="text-muted small">*Harga di atas adalah estimasi. Kondisi fisik unit sangat
                                        menentukan harga akhir.</p>
                                    <a href="https://wa.me/{{ $konf->whatsapp ?? '' }}" target="_blank"
                                        class="btn btn-success btn-lg rounded-pill px-5 shadow">
                                        <i class="fa fa-whatsapp mr-2"></i> HUBUNGI ADMIN UNTUK TUKAR SEKARANG
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalToC" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0" style="border-radius: 30px; overflow: hidden;">
                <div class="modal-body p-0">
                    <div class="row no-gutters">
                        <div class="col-md-5 bg-warning d-flex align-items-center justify-content-center p-5">
                            <div class="text-center">
                                <i class="fa fa-file-text-o fa-5x mb-3 text-dark"></i>
                                <h3 class="font-weight-bold text-dark">Ketentuan Unit</h3>
                            </div>
                        </div>
                        <div class="col-md-7 bg-dark text-white p-5">
                            <ul class="list-unstyled" style="line-height: 2;">
                                <li><i class="fa fa-check text-warning mr-2"></i> Lolos General Check Up</li>
                                <li><i class="fa fa-check text-warning mr-2"></i> Fisik mulus (No Dent/Lecet)</li>
                                <li><i class="fa fa-check text-warning mr-2"></i> Fungsi Normal 100%</li>
                                <li><i class="fa fa-check text-warning mr-2"></i> IMEI Terdaftar Beacukai/Kemenperin</li>
                                <li><i class="fa fa-check text-warning mr-2"></i> Battery Health > 85%</li>
                                <li><i class="fa fa-check text-warning mr-2"></i> iCloud / Google Log Out</li>
                                <li><i class="fa fa-id-card text-warning mr-2"></i> <strong>Wajib Membawa KTP Asli</strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-warning btn-block mt-4 py-3 font-weight-bold"
                                id="btnSetuju" style="border-radius: 15px;">
                                MENGERTI & LANJUTKAN
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#modalToC').modal('show');

            $('#btnSetuju').on('click', function() {
                $('#lock-overlay').fadeOut(600);
                $('#hpClient, #hpTarget, #btnHitung').prop('disabled', false);
                $('#modalToC').modal('hide');
            });

            $('#btnHitung').on('click', function() {
                let idClient = $('#hpClient').val();
                let idTarget = $('#hpTarget').val();

                if (!idClient || !idTarget) {
                    alert('Harap pilih kedua gadget!');
                    return;
                }

                let btn = $(this);
                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');

                Promise.all([
                    fetch("{{ url('/get-produk-detail') }}/" + idClient).then(res => res.json()),
                    fetch("{{ url('/get-produk-detail') }}/" + idTarget).then(res => res.json())
                ]).then(data => {
                    const resClient = data[0];
                    const resTarget = data[1];

                    if (resClient.success && resTarget.success) {
                        // Isi data detail ke UI
                        $('#namaClient').text(resClient.nama);
                        $('#varianClient').text(resClient.varian);
                        $('#hargaClient').text(resClient.harga_fmt);

                        $('#namaTarget').text(resTarget.nama);
                        $('#varianTarget').text(resTarget.varian);
                        $('#hargaTarget').text(resTarget.harga_fmt);

                        // LOGIKA BARU: Hitung Selisih
                        let selisih = resTarget.harga_raw - resClient.harga_raw;
                        let labelHasil = "";
                        let absSelisih = Math.abs(selisih);

                        // Format mata uang
                        let formattedSelisih = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0
                        }).format(absSelisih);

                        if (selisih > 0) {
                            // Jika HP Baru lebih mahal
                            labelHasil = "Anda Cukup Menambah:";
                            $('#totalBayar').text(formattedSelisih).css('color', '#000');
                        } else if (selisih < 0) {
                            // Jika HP Lama lebih mahal (Pelanggan dapat uang/kembalian)
                            labelHasil = "Anda Mendapatkan Bayaran Senilai:";
                            $('#totalBayar').text(formattedSelisih).css('color',
                                '#28a745'); // Warna hijau sukses
                        } else {
                            // Jika harga sama
                            labelHasil = "Tukar Langsung (Sama Harga):";
                            $('#totalBayar').text("Rp 0").css('color', '#000');
                        }

                        // Update Label dan Harga
                        $('.text-muted.mb-1').text(labelHasil);
                        $('#waktuUpdate').text(resTarget.waktu);
                        $('#hasilKalkulasi').slideDown(800);

                        // Auto scroll
                        $('html, body').animate({
                            scrollTop: $("#hasilKalkulasi").offset().top - 50
                        }, 1000);
                    }
                }).finally(() => {
                    btn.prop('disabled', false).html(
                        '<i class="fa fa-calculator mr-2"></i> HITUNG SELISIH HARGA');
                });
            });
        });
    </script>
@endsection
