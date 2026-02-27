@extends('layouts.web')

@section('isi')
    {{-- 1. HERO SECTION --}}
    {{-- Menggunakan background gelap agar teks putih dan aksen kuning terlihat premium --}}
    <div class="hero_area"
        style="min-height: 450px; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1556656793-062ff987b50d?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position: center; position: relative; overflow: hidden; display: flex; align-items: center;">
        <div class="container py-5">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-9">
                    {{-- Logo --}}
                    <div class="mb-4">
                        <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="Logo"
                            style="width: 100px; border-radius: 50%; border: 3px solid #ffbe33; padding: 5px; background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
                    </div>

                    {{-- Text Content --}}
                    <span class="text-warning font-weight-bold text-uppercase mb-2 d-block"
                        style="letter-spacing: 3px; font-size: 14px;">
                        Price List Unit Terbaru
                    </span>

                    <h1 class="text-white font-weight-bold mb-4"
                        style="font-size: 3.5rem; text-shadow: 2px 4px 10px rgba(0,0,0,0.5);">
                        Price List <span style="color: #ffbe33;">Sewa iPhone</span>
                    </h1>

                    <p class="text-white-50 lead mx-auto shadow-sm" style="max-width: 600px; font-size: 1.2rem;">
                        Solusi sewa iPhone gadget harian dan mingguan dengan proses mudah, cepat, dan terpercaya.
                    </p>
                </div>
            </div>
        </div>

        {{-- Dekorasi iPhone Melayang --}}
        <img src="https://www.apple.com/v/iphone/home/bu/images/overview/select/iphone_15_pro__dq7iyay9844y_xlarge.png"
            style="position: absolute; right: -30px; bottom: -20px; width: 280px; transform: rotate(-15deg); opacity: 0.6;"
            class="d-none d-lg-block">
    </div>

    {{-- 2. TABLE SECTION --}}
    <div class="section" style="padding: 60px 0; background: #fdfdfd;">
        <div class="container">
            <div class="text-center mb-5">
                <h3 class="font-weight-bold">Pilih Unit Favorit Anda</h3>
                <div style="width: 80px; height: 4px; background: #ffbe33; margin: 10px auto;"></div>
            </div>

            <div class="table-responsive shadow-lg rounded-20 border-0">
                <table class="table table-hover mb-0 text-center">
                    <thead style="background: #222; color: #ffbe33;">
                        <tr>
                            <th class="py-4 text-left px-4">TIPE IPHONE</th>
                            <th class="py-4">24 Jam</th>
                            <th class="py-4">2 Hari</th>
                            <th class="py-4">3 Hari</th>
                            <th class="py-4">7 Hari</th>
                            <th class="py-4">14 Hari</th>
                            <th class="py-4">1 Bulan</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 1rem; font-weight: 600; color: #444;">
                        @foreach ($sewa as $s)
                            <tr>
                                <td class="text-left px-4 py-4 bg-light font-weight-bold">{{ $s->produk->nama_produk }}</td>
                                <td class="py-4">{{ number_format($s->harga_24_jam / 1000, 0) }}K</td>
                                <td class="py-4">{{ number_format($s->harga_2_hari / 1000, 0) }}K</td>
                                <td class="py-4">{{ number_format($s->harga_3_hari / 1000, 0) }}K</td>
                                <td class="py-4">{{ number_format($s->harga_7_hari / 1000, 0) }}K</td>
                                <td class="py-4">{{ number_format($s->harga_14_hari / 1000, 0) }}K</td>
                                <td class="py-4 text-dark font-weight-bold" style="background: rgba(255, 190, 51, 0.1);">
                                    {{ number_format($s->harga_1_bulan / 1000, 0) }}K
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- 3. INFORMATION SECTION --}}
    <div class="section pb-5" style="background: #fff;">
        <div class="container">
            <div class="row bg-white shadow-sm rounded-20 p-4 border">
                {{-- Cara Rental --}}
                <div class="col-md-4 mb-4 border-right">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-info-circle text-warning mr-2" style="font-size: 1.5rem;"></i>
                        <h5 class="font-weight-bold text-uppercase mb-0">Cara Sewa iPhone:</h5>
                    </div>
                    <ol class="pl-3 text-muted" style="line-height: 1.8;">
                        <li>Chat admin untuk cek ketersediaan stok.</li>
                        <li>Mengisi formulir data diri.</li>
                        <li>Verifikasi data oleh tim Rumah Gadget.</li>
                        <li>Lakukan pembayaran setelah lolos verifikasi.</li>
                        <li>Ambil unit di store sesuai tanggal.</li>
                    </ol>
                </div>

                {{-- Syarat --}}
                <div class="col-md-4 mb-4 border-right">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-file-text text-warning mr-2" style="font-size: 1.5rem;"></i>
                        <h5 class="font-weight-bold text-uppercase mb-0">Syarat Utama:</h5>
                    </div>
                    <ol class="pl-3 text-muted" style="line-height: 1.8;">
                        <li>Wajib lolos verifikasi data internal.</li>
                        <li>Identitas (KTP/SIM) ditahan selama masa sewa.</li>
                        <li>Pelajar < 17 th wajib KTP Orang Tua & Kartu Pelajar.</li>
                        <li>Menyertakan Foto Kartu Keluarga.</li>
                        <li>Follow Instagram <span class="font-weight-bold text-dark">@sewaiphonerumahgadget</span>.</li>
                        <li>Tanda tangan surat perjanjian sewa.</li>
                    </ol>
                </div>

                {{-- Ketentuan --}}
                <div class="col-md-4 mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-gavel text-warning mr-2" style="font-size: 1.5rem;"></i>
                        <h5 class="font-weight-bold text-uppercase mb-0">Ketentuan:</h5>
                    </div>
                    <ol class="pl-3 text-muted" style="line-height: 1.8;">
                        <li>Booking minimal H-1 sebelum pengambilan.</li>
                        <li>Unit hanya tersedia di Cabang Gunung Agung.</li>
                        <li>**Wajib Transfer** lunas sebelum ke store.</li>
                        <li>Tanpa Transfer = No Booking.</li>
                        <li>Hanya pilih tipe (Warna & Kapasitas acak).</li>
                    </ol>

                    {{-- Checkbox Persetujuan --}}
                    <div class="custom-control custom-checkbox mt-4 p-3 rounded shadow-sm"
                        style="background: #fff9e6; border: 1px solid #ffbe33;">
                        <input type="checkbox" class="custom-control-input" id="setujuKetentuan">
                        <label class="custom-control-label font-weight-bold text-dark" for="setujuKetentuan"
                            style="cursor: pointer; font-size: 0.9rem;">
                            Saya setuju dengan Syarat & Ketentuan Sewa diatas.
                        </label>
                    </div>
                </div>
            </div>

            {{-- Tombol WhatsApp --}}
            <div class="text-center mt-5">
                <a href="https://wa.me/{{ $konf->no_hp_setting }}" id="btnWA"
                    class="btn btn-success btn-lg px-5 py-3 rounded-pill font-weight-bold shadow disabled"
                    style="pointer-events: none; opacity: 0.5; transition: 0.3s;">
                    <i class="fa fa-whatsapp mr-2"></i> HUBUNGI ADMIN VIA WHATSAPP
                </a>
                <small class="d-block mt-3 text-danger font-italic" id="warningText">
                    <i class="fa fa-lock mr-1"></i> Centang kotak persetujuan untuk mengaktifkan tombol chat.
                </small>
            </div>
        </div>
    </div>

    <style>
        .rounded-20 {
            border-radius: 20px !important;
        }

        .table thead th {
            border: none;
            letter-spacing: 1px;
            font-size: 0.85rem;
        }

        .table tbody td {
            vertical-align: middle;
            border-top: 1px solid #eee;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 190, 51, 0.05);
        }

        ol li {
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        .border-right {
            border-right: 1px solid #eee;
        }

        @media (max-width: 768px) {
            .border-right {
                border-right: none;
                border-bottom: 1px solid #eee;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('setujuKetentuan');
            const btnWA = document.getElementById('btnWA');
            const warningText = document.getElementById('warningText');

            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    btnWA.classList.remove('disabled');
                    btnWA.style.pointerEvents = 'auto';
                    btnWA.style.opacity = '1';
                    btnWA.style.transform = 'scale(1.05)';
                    warningText.innerHTML =
                        '<i class="fa fa-check-circle text-success mr-1"></i> Anda sekarang dapat menghubungi admin.';
                    warningText.classList.replace('text-danger', 'text-success');
                } else {
                    btnWA.classList.add('disabled');
                    btnWA.style.pointerEvents = 'none';
                    btnWA.style.opacity = '0.5';
                    btnWA.style.transform = 'scale(1)';
                    warningText.innerHTML =
                        '<i class="fa fa-lock mr-1"></i> Centang kotak persetujuan untuk mengaktifkan tombol chat.';
                    warningText.classList.replace('text-success', 'text-danger');
                }
            });
        });
    </script>
@endsection
