@extends('layouts.web')

@section('isi')
    <style>
        .card-trade {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .select2-container--bootstrap4 .select2-selection {
            border-radius: 15px !important;
        }

        .divider-custom {
            border-top: 2px dashed #dee2e6;
            margin: 20px 0;
        }

        /* Overlay untuk mengunci konten sebelum setuju */
        #lock-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            z-index: 10;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <section class="jual_hp_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center mb-5">
                <h2 style="font-weight: 800; color: #000;">Cek Harga HP Kamu</h2>
                <p style="color: #666;">Bandingkan harga dan dapatkan penawaran tukar tambah terbaik</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-trade p-4 mb-4 position-relative" id="mainFormArea">
                        <div id="lock-overlay">
                            <button class="btn btn-dark btn-lg" data-toggle="modal" data-target="#modalToC"
                                style="border-radius: 12px;">
                                Baca & Setujui Syarat Terlebih Dahulu
                            </button>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="small font-weight-bold">HP Kamu Saat Ini</label>
                                <select class="form-control form-control-lg select2" id="hpClient" disabled>
                                    <option value="" selected disabled>Pilih Gadget Kamu</option>
                                    @foreach ($hpClient as $item)
                                        <option value="{{ $item->id_produk }}">{{ $item->nama_produk }}
                                            ({{ $item->varian->nama_varian ?? '-' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label class="small font-weight-bold">HP Impian (Tukar Ke)</label>
                                <select class="form-control form-control-lg select2" id="hpTarget" disabled>
                                    <option value="" selected disabled>Pilih Gadget Impian</option>
                                    @foreach ($hpTarget as $item)
                                        <option value="{{ $item->id_produk }}">{{ $item->nama_produk }}
                                            ({{ $item->varian->nama_varian ?? '-' }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button id="btnHitung" class="btn btn-primary btn-lg btn-block" disabled
                                    style="border-radius: 15px; background-color: #007bff;">
                                    Cek Harga
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="hasilKalkulasi" style="display: none;">
                        <div class="card card-trade p-4 text-center mb-4">
                            <h5 class="text-muted mb-1">Cukup Menambah</h5>
                            <h1 class="display-4 font-weight-bold text-dark" id="totalBayar">Rp 0</h1>
                            <p class="small text-muted">Kalkulasi per <span id="waktuUpdate"></span> WITA</p>
                            <div class="divider-custom"></div>
                            <h4 class="font-weight-bold mb-4">Rincian Perhitungan</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless text-left">
                                    <thead>
                                        <tr class="text-muted" style="font-size: 0.9rem;">
                                            <th>Gadget Kamu Saat ini</th>
                                            <th>Varian</th>
                                            <th class="text-right">Estimasi Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="font-weight-bold">
                                            <td id="namaClient">-</td>
                                            <td id="varianClient">-</td>
                                            <td class="text-right text-success">(+) <span id="hargaClient">Rp 0</span></td>
                                        </tr>
                                        <tr class="text-muted" style="font-size: 0.9rem;">
                                            <th>Gadget Pilihan Kamu</th>
                                            <th>Varian</th>
                                            <th class="text-right">Estimasi Harga</th>
                                        </tr>
                                        <tr class="font-weight-bold border-bottom">
                                            <td id="namaTarget">-</td>
                                            <td id="varianTarget">-</td>
                                            <td class="text-right text-danger">(-) <span id="hargaTarget">Rp 0</span></td>
                                        </tr>
                                        <tr class="font-weight-bold" style="font-size: 1.2rem;">
                                            <td colspan="2" class="pt-3">Tambah Sebesar</td>
                                            <td class="text-right pt-3" id="totalBayarRow">Rp 0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modalToC" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="border-radius: 30px; border: none;">
                <div class="modal-body bg-dark text-white p-5" style="border-radius: 30px;">
                    <h4 class="text-center mb-4" style="font-weight: 700;">Syarat & Ketentuan Tukar Tambah</h4>
                    <ul style="list-style: none; padding-left: 0; line-height: 2.2; opacity: 0.9;">
                        <li>• Lolos pengecekan fungsi secara langsung oleh tim general check up Rumah Gadget</li>
                        <li>• Fisik mulus tidak ada lecet, retak dan sebagainya</li>
                        <li>• Fungsi Hp secara keseluruhan normal</li>
                        <li>• IMEI tidak terblokir dan terdaftar di database Beacukai</li>
                        <li>• Baterai tidak drop dengan kesehatan minimal 85%</li>
                        <li>• Spare parts hp original, tidak pernah dibongkar/service sebelumnya</li>
                        <li>• Terbebas dari iCloud/Google/Samsung Activation Lock</li>
                        <li>• Tidak tersangkut kasus hukum</li>
                        <li>• Tidak dalam masa cicilan</li>
                        <li>• <strong>Wajib membawa identitas diri seperti KTP/SIM/Kartu Pelajar</strong></li>
                    </ul>
                    <div class="text-center mt-5">
                        <button type="button" class="btn btn-light px-5 py-2" id="btnSetuju"
                            style="border-radius: 12px; font-weight: 700;">
                            SAYA MENGERTI & SETUJU
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // 1. Munculkan Modal secara otomatis saat halaman dibuka
            $('#modalToC').modal('show');

            // 2. Logika ketika tombol Setuju diklik
            $('#btnSetuju').on('click', function() {
                $('#lock-overlay').fadeOut(); // Hilangkan overlay
                $('#hpClient, #hpTarget, #btnHitung').prop('disabled', false); // Aktifkan input
                $('#modalToC').modal('hide'); // Tutup modal
            });

            // 3. Logika Hitung (Sama seperti sebelumnya)
            $('#btnHitung').on('click', function() {
                let idClient = $('#hpClient').val();
                let idTarget = $('#hpTarget').val();

                if (!idClient || !idTarget) {
                    alert('Silakan pilih kedua HP untuk dibandingkan!');
                    return;
                }

                $(this).prop('disabled', true).text('Menghitung...');

                Promise.all([
                    fetch("{{ url('/get-produk-detail') }}/" + idClient).then(res => res.json()),
                    fetch("{{ url('/get-produk-detail') }}/" + idTarget).then(res => res.json())
                ]).then(data => {
                    const resClient = data[0];
                    const resTarget = data[1];

                    if (resClient.success && resTarget.success) {
                        $('#namaClient').text(resClient.nama);
                        $('#varianClient').text(resClient.varian);
                        $('#hargaClient').text(resClient.harga_fmt);
                        $('#namaTarget').text(resTarget.nama);
                        $('#varianTarget').text(resTarget.varian);
                        $('#hargaTarget').text(resTarget.harga_fmt);

                        let selisih = resTarget.harga_raw - resClient.harga_raw;
                        if (selisih < 0) selisih = 0;

                        let formattedSelisih = new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0
                        }).format(selisih);

                        $('#totalBayar').text(formattedSelisih);
                        $('#totalBayarRow').text(formattedSelisih);
                        $('#waktuUpdate').text(resTarget.waktu);
                        $('#hasilKalkulasi').slideDown();
                    }
                }).catch(err => {
                    alert('Terjadi kesalahan saat mengambil data.');
                }).finally(() => {
                    $(this).prop('disabled', false).text('Cek Harga');
                });
            });
        });
    </script>
@endsection
