<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ $konf->instansi_setting ?? 'Toko Gadget' }}</title>
    <link rel="shortcut icon" href="{{ asset('favicon/' . $konf->favicon_setting) }}" type="">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('web/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('web/css/responsive.css') }}" rel="stylesheet" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #0c0c0c;
            background-color: #ffffff;
        }

        .hero_area {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            /* Menambahkan gradient gelap dari atas ke bawah */
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), url('{{ asset('web/images/hero-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Opsional: memberikan efek parallax saat scroll */
        }

        .header_section {
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 24px;
            color: #ffffff !important;
        }

        .nav-item .nav-link {
            color: #ffffff !important;
            margin: 0 10px;
            text-transform: uppercase;
            font-size: 15px;
        }

        .nav-item.active .nav-link {
            color: #ffbe33 !important;
        }

        /* Filter Menu Styling */
        .filters_menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            list-style-type: none;
            padding: 0;
            margin-bottom: 45px;
        }

        .filters_menu li {
            padding: 7px 25px;
            cursor: pointer;
            border-radius: 25px;
            transition: all 0.3s;
            margin: 5px;
            background-color: #f1f1f1;
        }

        .filters_menu li.active {
            background-color: #222831;
            color: #ffffff;
        }

        /* Footer */
        .footer_section {
            background-color: #222831;
            color: #ffffff;
            padding: 60px 0 30px 0;
        }

        .footer_section h4 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer-logo {
            font-size: 28px;
            font-weight: bold;
            color: #ffbe33;
        }

        .social_box a {
            color: #ffffff;
            margin-right: 15px;
            font-size: 20px;
        }

        /* Membuat Header Sticky */
        .header_section {
            padding: 15px 0;
            position: fixed;
            /* Gunakan fixed agar menempel saat scroll */
            top: 0;
            width: 100%;
            z-index: 999;
            transition: background-color 0.3s ease;
            /* Transisi halus saat berubah warna */
        }

        /* Memberikan background gelap saat di-scroll (Opsional namun disarankan) */
        .header_section.sticky-nav {
            background-color: rgba(34, 40, 49, 0.95);
            /* Warna #222831 dengan transparansi */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            padding: 10px 0;
            /* Navigasi mengecil sedikit saat scroll */
        }

        /* Pastikan hero area memiliki padding top agar konten awal tidak tertutup navbar */
        .hero_area {
            padding-top: 70px;
            /* Sesuaikan dengan tinggi navbar Anda */
        }

        @media (max-width: 991px) {
            .header_section {
                display: none;
                /* Tetap sembunyikan di mobile sesuai logika awal Anda */
            }

            .hero_area {
                padding-top: 0;
                /* Reset padding di mobile karena pakai mobile-header */
            }
        }


        /* Efek Hover untuk Box Produk */
        .box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .box:hover img {
            transform: scale(1.1);
        }

        .btn-outline-dark:hover {
            background-color: #ffbe33;
            border-color: #ffbe33;
            color: #000;
        }

        /* Memastikan tinggi box sama meski nama produk panjangnya beda */
        .grid {
            display: flex;
            flex-wrap: wrap;
        }

        /* Pastikan modal muncul di atas segalanya */
        #modalDetailProduk {
            z-index: 10000 !important;
        }

        /* Memperbaiki tampilan modal di HP */
        @media (max-width: 576px) {
            .modal-dialog-centered {
                display: flex;
                align-items: center;
                min-height: calc(100% - 1rem);
            }

            .modal-content {
                max-height: 90vh;
                /* Agar modal tidak terlalu mentok layar atas-bawah */
            }

            .modal-footer .btn {
                margin-left: 0 !important;
                width: 100%;
            }

            /* Mencegah tabrakan dengan mobile-nav jika ada */
            #modalDetailProduk {
                padding-bottom: 60px;
            }
        }

        /* Styling isi deskripsi agar rapi */
        #detailDeskripsi p {
            margin-bottom: 8px;
        }

        @media (max-width: 991px) {

            /* Mencegah konten tertutup karena header menjadi sticky/fixed */
            .hero_area {
                padding-top: 0 !important;
            }

            /* Memastikan transisi smooth jika ada perubahan warna atau posisi */
            .mobile-header {
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            }
        }

        /* Pastikan Modal Detail Produk tetap berada di atas mobile-header */
        .modal {
            z-index: 2000 !important;
        }

        .modal-backdrop {
            z-index: 1999 !important;
        }

        /* Badge untuk jumlah keranjang */
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: #ffbe33;
            color: #222831;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 50%;
            border: 1px solid #ffffff;
        }
    </style>
</head>

<body>
    <div class="mobile-header d-lg-none d-flex align-items-center justify-content-between px-3 py-2 sticky-top"
        style="background-color: #222831; border-bottom: 2px solid #ffffff; z-index: 1050; top: 0;">

        <a class="navbar-brand m-0" href="{{ url('/') }}" style="display: flex; align-items: center;">
            <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="Logo"
                style="height: 30px; width: auto; margin-right: 10px; object-fit: contain;">
            <span style="font-size: 18px; color: #ffffff; font-weight: bold; line-height: 1;">
                {{ $konf->instansi_setting }}
            </span>
        </a>

        <div class="d-flex align-items-center">
            <a href="{{ url('checkout') }}" class="text-white mr-3 position-relative" style="font-size: 20px;">
                <i class="fa fa-shopping-cart"></i>
                @if (session('cart'))
                    <span class="cart-badge">{{ count(session('cart')) }}</span>
                @endif
            </a>
            <a href="https://wa.me/{{ $konf->no_hp_setting }}" class="btn btn-success btn-sm rounded-pill px-3">
                <i class="fa fa-whatsapp"></i>
            </a>
        </div>
    </div>
    <div class="hero_area">
        <header class="header_section d-none d-lg-block">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container">
                    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                        <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="Logo {{ $konf->instansi_setting }}"
                            style="height: 40px; width: auto; margin-right: 12px; object-fit: contain;">

                        <span>{{ $konf->instansi_setting }}</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent">
                        <span class="fa fa-bars text-white"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item {{ Request::is('harga*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('harga') }}">Harga</a>
                            </li>
                            <li class="nav-item {{ Request::is('web_service*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('web_service') }}">Servis</a>
                            </li>
                            <li class="nav-item {{ Request::is('artikel*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('artikel') }}">Artikel</a>
                            </li>


                            <li
                                class="nav-item dropdown {{ Request::is('jual*', 'kredits*', 'rental*', 'tukar-tambah*', 'rate-card*', 'aksesoriss*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Layanan & Info
                                </a>
                                <div class="dropdown-menu shadow border-0" aria-labelledby="navbarDropdown"
                                    style="border-radius: 10px;">

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item {{ Request::is('jual*') ? 'active' : '' }}"
                                        href="{{ url('jual') }}">Jual Gadget </a>
                                    <a class="dropdown-item {{ Request::is('aksesoriss*') ? 'active' : '' }}"
                                        href="{{ url('aksesoriss') }}">Aksesoris</a>
                                    <a class="dropdown-item {{ Request::is('tukar-tambah*') ? 'active' : '' }}"
                                        href="{{ url('tukar-tambah') }}">Tukar Tambah</a>
                                    <a class="dropdown-item {{ Request::is('kredits*') ? 'active' : '' }}"
                                        href="{{ url('kredits') }}">Info Kredit</a>
                                    <a class="dropdown-item {{ Request::is('rental*') ? 'active' : '' }}"
                                        href="{{ url('rental') }}">Sewa iPhone</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item {{ Request::is('rate-card*') ? 'active' : '' }}"
                                        href="{{ url('rate-card') }}">Rate Card</a>

                                </div>
                            </li>


                        </ul>

                        <div class="user_option d-flex align-items-center">
                            <a href="{{ url('checkout') }}" class="mr-3 text-white position-relative"
                                style="font-size: 20px;">
                                <i class="fa fa-shopping-cart"></i>
                                @if (session('cart'))
                                    <span class="cart-badge">{{ count(session('cart')) }}</span>
                                @endif
                            </a>

                            <a href="https://wa.me/{{ $konf->no_hp_setting }}"
                                class="btn btn-success rounded-pill px-3 py-2" style="font-weight: 400;">
                                <i class="fa fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        @php
            // 1. Tentukan Judul dan Deskripsi default (untuk halaman Home / '/')
            $sliderTitle = 'Rumah Gadget';
            $sliderDesc = 'Every Gadget Has a Story';

            // 2. Logika Penentuan Konten Slider berdasarkan URL
            if (Request::is('web_service*')) {
                $sliderTitle = 'Layanan Servis Profesional';
                $sliderDesc = 'Solusi perbaikan gadget cepat, bergaransi, dan ditangani teknisi ahli.';
            } elseif (Request::is('harga*')) {
                $sliderTitle = 'Katalog & Harga Terbaru';
                $sliderDesc = 'Daftar harga gadget terlengkap, mulai dari unit baru hingga second berkualitas.';
            } elseif (Request::is('aksesoriss*')) {
                $sliderTitle = 'Aksesoris Terlengkap';
                $sliderDesc = 'Lengkapi gadgetmu dengan pelindung, charger, dan audio original.';
            } elseif (Request::is('jual*')) {
                $sliderTitle = 'Jual HP Harga Tinggi';
                $sliderDesc = 'Kami hargai gadget lamamu dengan penawaran terbaik untuk tukar tambah.';
            } elseif (Request::is('rental*') || Request::is('sewa*')) {
                $sliderTitle = 'Sewa iPhone & Gadget';
                $sliderDesc = 'Solusi sewa iPhone harian atau mingguan untuk kebutuhan konten dan gaya hidupmu.';
            }
            // Bagian Rate Card (Mendukung rate-card atau rate_card)
            elseif (Request::is('rate*card*')) {
                $sliderTitle = 'Social Media Rate Card';
                $sliderDesc = 'Pilihan paket konten kreatif untuk meningkatkan engagement dan promosi bisnis Anda.';
            } elseif (Request::is('artikel*')) {
                $sliderTitle = 'Artikel Gadget Terbaru';
                $sliderDesc = 'Update seputar teknologi, tips gadget, dan perkembangan dunia smartphone.';
            } elseif (Request::is('kredits*')) {
                $sliderTitle = 'Kredit Gadget Mudah';
                $sliderDesc = 'Cicilan ringan tanpa ribet. Miliki gadget impianmu sekarang, bayar nanti.';
            } elseif (Request::is('tukar-tambah*')) {
                $sliderTitle = 'Tukar Tambah Gadget';
                $sliderDesc = 'Upgrade gadget lama kamu ke unit impian dengan proses instan dan transparan.';
            }
        @endphp

        {{-- 3. Render Section Slider --}}
        @if (Request::is('/') ||
                Request::is('web_service*') ||
                Request::is('harga*') ||
                Request::is('aksesoriss*') ||
                Request::is('jual*') ||
                Request::is('rental*') ||
                Request::is('sewa*') ||
                Request::is('rate*card*') ||
                Request::is('artikel*') ||
                Request::is('tukar-tambah*') ||
                Request::is('kredits*'))
            <section class="slider_section flex-grow-1 d-flex align-items-center text-white text-center">
                <div class="container">
                    <h1 class="font-weight-bold slider-text-shadow animate__animated animate__fadeInDown">
                        {{ $sliderTitle }}
                    </h1>
                    <p class="slider-text-shadow lead animate__animated animate__fadeInUp">
                        {{ $sliderDesc }}
                    </p>
                </div>
            </section>
        @endif
    </div>

    <main>
        @yield('isi')
    </main>

    <div class="modal fade" id="modalDetailProduk" tabindex="-1" role="dialog" aria-hidden="true"
        style="z-index: 9999;">
        <div class="modal-dialog modal-lg modal-dialog-centered mx-2 mx-md-auto" role="document">
            <div class="modal-content" style="border-radius: 15px; border: none; overflow: hidden;">
                <div
                    class="modal-header bg-dark text-white d-flex align-items-center justify-content-between py-2 px-3">
                    <h5 class="modal-title font-weight-bold mb-0" id="detailNamaProduk"
                        style="font-size: 16px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 80%;">
                        Detail Produk</h5>
                    <button type="button" class="close text-white m-0 p-0" data-dismiss="modal" aria-label="Close"
                        style="opacity: 1; outline: none;">
                        <span aria-hidden="true" style="font-size: 28px;">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-3" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row">
                        <div class="col-md-5 text-center mb-3">
                            <div class="img-container p-2 bg-light rounded">
                                <img id="detailGambar" src="" class="img-fluid rounded shadow-sm"
                                    alt="Gambar Produk" style="max-height: 250px; object-fit: contain;">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h4 class="text-dark font-weight-bold mb-1" id="detailNamaProdukText"
                                style="font-size: 1.2rem;"></h4>
                            <h5 class="text-warning font-weight-bold mb-3" id="detailHarga"></h5>

                            <div class="table-responsive">
                                <table class="table table-sm table-borderless text-dark mb-0"
                                    style="font-size: 13px;">
                                    <tr>
                                        <td width="35%">Kategori</td>
                                        <td id="detailKategori">: -</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis</td>
                                        <td id="detailJenis">: -</td>
                                    </tr>
                                    <tr>
                                        <td>Tipe</td>
                                        <td id="detailTipe">: -</td>
                                    </tr>
                                    <tr>
                                        <td>Varian</td>
                                        <td id="detailVarian">: -</td>
                                    </tr>
                                    <tr>
                                        <td>Warna</td>
                                        <td id="detailWarna">: -</td>
                                    </tr>
                                </table>
                            </div>

                            <hr class="my-2">
                            <div class="description-section">
                                <h6 class="font-weight-bold mb-1" style="font-size: 14px;">Deskripsi:</h6>
                                <div id="detailDeskripsi" class="text-muted"
                                    style="font-size: 13px; line-height: 1.5;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex flex-column flex-md-row p-2">
                    <a href="#" id="btnHubungiAdmin"
                        class="btn btn-success btn-block rounded-pill mb-2 mb-md-0 px-4">
                        <i class="fa fa-whatsapp mr-1"></i> Tanya Stok Via WhatsApp
                    </a>
                    <button type="button" class="btn btn-light btn-block btn-md-auto rounded-pill px-4"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer_section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-col mb-4 mb-md-0">
                    <div class="footer_detail">
                        <a href="{{ url('/') }}" class="footer-logo d-flex align-items-center mb-3">
                            <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="Logo"
                                style="height: 45px; margin-right: 15px;">
                            <span class="text-white">{{ $konf->instansi_setting }}</span>
                        </a>
                        <div style="color: #bec5d1; line-height: 1.6; font-size: 14px;">
                            {!! $konf->tentang_setting !!}
                        </div>
                        <div class="footer_social mt-4">
                            <a href="{{ $konf->instagram_setting }}" target="_blank" class="mr-3"><i
                                    class="fa fa-instagram"></i></a>
                            <a href="{{ $konf->youtube_setting }}" target="_blank" class="mr-3"><i
                                    class="fa fa-youtube-play"></i></a>
                            <a href="mailto:{{ $konf->email_setting }}"><i class="fa fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 footer-col mb-4 mb-md-0">
                    <h4 class="footer-heading">Lokasi Kami</h4>
                    <div class="row">
                        <div class="col-sm-6 mb-3">

                            <div class="map-container mb-2"
                                style="border-radius: 8px; overflow: hidden; height: 120px; border: 1px solid rgba(255,255,255,0.1);">
                                <iframe src="{{ $konf->maps_setting }}" width="100%" height="100%"
                                    style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <ul class="list-unstyled contact-list small">
                                <li><i class="fa fa-map-marker"></i> {{ $konf->alamat_setting }}</li>
                                <li><i class="fa fa-whatsapp"></i> {{ $konf->no_hp_setting }}</li>
                            </ul>
                        </div>

                        <div class="col-sm-6 mb-3">

                            <div class="map-container mb-2"
                                style="border-radius: 8px; overflow: hidden; height: 120px; border: 1px solid rgba(255,255,255,0.1);">
                                <iframe src="{{ $konf->maps_setting_2 }}" width="100%" height="100%"
                                    style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <ul class="list-unstyled contact-list small">
                                <li><i class="fa fa-map-marker"></i> {{ $konf->alamat_setting_2 }}</li>
                                <li><i class="fa fa-whatsapp"></i> {{ $konf->no_hp_setting_2 }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 footer-col">
                    <h4 class="footer-heading">Jam Operasional</h4>
                    <div class="op-hours py-2 px-3" style="background: rgba(255,255,255,0.05); border-radius: 10px;">
                        <p class="mb-1 text-white-50 small">Setiap Hari:</p>
                        <p class="h5 text-white mb-0">09.00 - 22.00 <small>WITA</small></p>
                    </div>
                    <p class="mt-3 small" style="color: #888; font-size: 11px;">*Hari libur nasional tetap buka
                        kecuali diinfokan kembali melalui media sosial.</p>
                </div>
            </div>

            <div class="footer-info text-center mt-5 pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
                <p class="mb-0 small">&copy; {{ date('Y') }} <strong>{{ $konf->instansi_setting }}</strong>. All
                    Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>

    <script>
        // Isotope filtering logic
        $(window).on('load', function() {
            $('.grid').isotope({
                itemSelector: '.all',
                percentPosition: true,
                masonry: {
                    columnWidth: '.all'
                }
            });

            $('.filters_menu li').click(function() {
                $('.filters_menu li').removeClass('active');
                $(this).addClass('active');

                var data = $(this).attr('data-filter');
                $('.grid').isotope({
                    filter: data
                });
            });
        });
    </script>


    <div class="mobile-nav d-lg-none">
        <a href="{{ url('/') }}" class="mobile-nav-item {{ Request::is('/') ? 'active' : '' }}">
            <i class="fa fa-home"></i>
            <span>Home</span>
        </a>
        <a href="{{ url('checkout') }}" class="mobile-nav-item {{ Request::is('checkout*') ? 'active' : '' }}">
            <i class="fa fa-shopping-cart"></i>
            <span>Keranjang</span>
        </a>
        <a href="{{ url('harga') }}" class="mobile-nav-item {{ Request::is('harga*') ? 'active' : '' }}">
            <i class="fa fa-tag"></i>
            <span>Harga</span>
        </a>
        <a href="{{ url('web_service') }}"
            class="mobile-nav-item {{ Request::is('web_service*') ? 'active' : '' }}">
            <i class="fa fa-wrench"></i>
            <span>Servis</span>
        </a>
        <a href="{{ url('artikel') }}" class="mobile-nav-item {{ Request::is('artikel*') ? 'active' : '' }}">
            <i class="fa fa-newspaper-o"></i>
            <span>Artikel Gadget</span>
        </a>
        <a href="{{ url('aksesoriss') }}" class="mobile-nav-item {{ Request::is('aksesoriss*') ? 'active' : '' }}">
            <i class="fa fa-headphones"></i>
            <span>Aksesoris</span>
        </a>
        <a href="{{ url('tukar-tambah') }}"
            class="mobile-nav-item {{ Request::is('tukar-tambah*') ? 'active' : '' }}">
            <i class="fa fa-headphones"></i>
            <span>Tukar Tambah</span>
        </a>
        <a href="{{ url('jual') }}" class="mobile-nav-item {{ Request::is('jual*') ? 'active' : '' }}">
            <i class="fa fa-money"></i>
            <span>Jual</span>
        </a>
        <a href="{{ url('kredits') }}" class="mobile-nav-item {{ Request::is('kredits*') ? 'active' : '' }}">
            <i class="fa fa-credit-card"></i>
            <span>Kredit</span>
        </a>
        <a href="{{ url('rental') }}" class="mobile-nav-item {{ Request::is('rental*') ? 'active' : '' }}">
            <i class="fa fa-mobile"></i>
            <span>Sewa iPhone</span>
        </a>
        <a href="{{ url('rate-card') }}" class="mobile-nav-item {{ Request::is('rate-card*') ? 'active' : '' }}">
            <i class="fa fa-address-card"></i>
            <span>Rate Card</span>
        </a>

    </div>

    <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('.header_section').addClass('sticky-nav');
            } else {
                $('.header_section').removeClass('sticky-nav');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-detail').on('click', function() {
                var id = $(this).data('id');

                // Tampilkan loading sederhana (opsional)
                $('#detailNamaProdukText').text('Memuat...');

                $.ajax({
                    url: "{{ url('/produk/detail') }}/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        // Isi data teks dasar
                        $('#detailNamaProduk').text(data.nama_produk);
                        $('#detailNamaProdukText').text(data.nama_produk);

                        // LOGIKA HARGA DISKON DI MODAL
                        var htmlHarga = '';
                        if (data.harga_promo_produk > 0) {
                            // Jika ada promo, tampilkan harga promo dan harga jual dicoret
                            htmlHarga = '<div class="d-flex flex-column">' +
                                '<span class="text-warning" style="font-size: 1.3rem;">Rp ' +
                                new Intl.NumberFormat('id-ID').format(data.harga_promo_produk) +
                                '</span>' +
                                '<span class="text-danger" style="text-decoration: line-through; font-size: 0.9rem; font-weight: normal;">Rp ' +
                                new Intl.NumberFormat('id-ID').format(data.harga_jual_produk) +
                                '</span>' +
                                '</div>';
                        } else {
                            // Jika tidak ada promo, hanya tampilkan harga jual biasa
                            htmlHarga = 'Rp ' + new Intl.NumberFormat('id-ID').format(data
                                .harga_jual_produk);
                        }

                        // Masukkan ke elemen detailHarga menggunakan .html() karena membawa tag span
                        $('#detailHarga').html(htmlHarga);

                        // Deskripsi (Gunakan .html() agar tag HTML dari database diproses)
                        $('#detailDeskripsi').html(data.deskripsi_produk ||
                            '<p class="text-muted italic">Tidak ada deskripsi produk.</p>');

                        // Isi data relasi lainnya (Kategori, Jenis, dll)
                        $('#detailKategori').text(': ' + (data.kategori ? data.kategori
                            .nama_kategori : '-'));
                        $('#detailJenis').text(': ' + (data.jenis ? data.jenis.nama_jenis :
                            '-'));
                        $('#detailTipe').text(': ' + (data.tipe ? data.tipe.nama_tipe : '-'));
                        $('#detailVarian').text(': ' + (data.varian ? data.varian.nama_varian :
                            '-'));
                        $('#detailWarna').text(': ' + (data.warna ? data.warna.nama_warna :
                            '-'));

                        // Gambar & Link WA
                        var pathGambar = "{{ asset('file/produk') }}/" + data.gambar_produk;
                        $('#detailGambar').attr('src', data.gambar_produk ? pathGambar :
                            "{{ asset('web/images/no-image.png') }}");

                        var waLink =
                            "https://wa.me/{{ $konf->no_hp_setting }}?text=Halo Admin, saya ingin bertanya tentang produk: " +
                            data.nama_produk;
                        $('#btnHubungiAdmin').attr('href', waLink);

                        // Tampilkan Modal
                        $('#modalDetailProduk').modal('show');
                    },
                    error: function() {
                        alert("Gagal mengambil data produk.");
                    }
                });
            });
        });
    </script>

    <script>
        $('.add-to-cart').click(function() {
            let id = $(this).data('id');
            $.post("{{ url('add-to-cart') }}", {
                _token: '{{ csrf_token() }}',
                id_produk: id
            }, function(data) {
                alert(data.message);
                // Refresh halaman agar badge update (Cara simpel)
                location.reload();

                // ATAU update angka badge manual jika tidak ingin reload:
                // $('.cart-badge').text(data.cart_count); 
            });
        });
    </script>
</body>

</html>
