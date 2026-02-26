<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ $konf->instansi_setting ?? 'Toko Gadget' }}</title>

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
    </style>
</head>

<body>
    <div class="mobile-header d-lg-none d-flex align-items-center justify-content-between px-3 py-2"
        style="background-color: #222831; border-bottom: 2px solid #ffffff;">
        <a class="navbar-brand m-0" href="{{ url('/') }}" style="display: flex; align-items: center;">
            <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="Logo {{ $konf->instansi_setting }}"
                style="height: 30px; width: auto; margin-right: 10px; object-fit: contain;">

            <span style="font-size: 18px; color: #ffffff; font-weight: bold; line-height: 1;">
                {{ $konf->instansi_setting }}
            </span>
        </a>

        <a href="https://wa.me/{{ $konf->no_hp_setting }}" class="btn btn-success btn-sm rounded-pill px-3">
            <i class="fa fa-whatsapp"></i>
        </a>
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
                            <li class="nav-item {{ Request::is('aksesoriss*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('aksesoriss') }}">Aksesoris</a>
                            </li>

                            <li
                                class="nav-item dropdown {{ Request::is('jual*', 'kredits*', 'sewa-iphone*', 'kartu-tarif*', 'berita*') ? 'active' : '' }}">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Layanan & Info
                                </a>
                                <div class="dropdown-menu shadow border-0" aria-labelledby="navbarDropdown"
                                    style="border-radius: 10px;">

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item {{ Request::is('jual*') ? 'active' : '' }}"
                                        href="{{ url('jual') }}">Jual Gadget (Trade-in)</a>
                                    <a class="dropdown-item {{ Request::is('kredits*') ? 'active' : '' }}"
                                        href="{{ url('kredits') }}">Info Kredit</a>
                                    <a class="dropdown-item {{ Request::is('sewa-iphone*') ? 'active' : '' }}"
                                        href="{{ url('sewa-iphone') }}">Sewa iPhone</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item {{ Request::is('kartu-tarif*') ? 'active' : '' }}"
                                        href="{{ url('kartu-tarif') }}">Rate Card</a>
                                    <a class="dropdown-item {{ Request::is('berita*') ? 'active' : '' }}"
                                        href="{{ url('berita') }}">Berita Gadget</a>
                                </div>
                            </li>


                        </ul>

                        <div class="user_option">
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
            // Tentukan Judul dan Deskripsi berdasarkan route saat ini
            $sliderTitle = 'Gadget Berkualitas';
            $sliderDesc = 'Temukan smartphone impianmu dengan kondisi terbaik dan garansi terpercaya.';

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
                $sliderTitle = 'Jual & Tukar Tambah';
                $sliderDesc = 'Kami hargai gadget lamamu dengan harga tinggi untuk tukar tambah ke unit baru.';
            } elseif (Request::is('sewa*')) {
                $sliderTitle = 'Sewa iPhone & Gadget';
                $sliderDesc = 'Sewa harian atau mingguan untuk kebutuhan konten atau gaya hidupmu.';
            } elseif (Request::is('rate_card*')) {
                $sliderTitle = 'Rate Card & Tarif';
                $sliderDesc = 'Informasi tarif layanan jasa dan kartu tarif iklan kami secara transparan.';
            } elseif (Request::is('berita*')) {
                $sliderTitle = 'Berita Gadget Terbaru';
                $sliderDesc = 'Update seputar teknologi, tips gadget, dan perkembangan dunia smartphone.';
            } elseif (Request::is('kredits*')) {
                $sliderTitle = 'Kredit Gadget Mudah';
                $sliderDesc = 'Cicilan ringan tanpa ribet. Miliki gadget impianmu sekarang, bayar nanti.';
            }
        @endphp

        @if (Request::is('/') ||
                Request::is('web_service*') ||
                Request::is('harga*') ||
                Request::is('aksesoriss*') ||
                Request::is('jual*') ||
                Request::is('sewa*') ||
                Request::is('rate_card*') ||
                Request::is('berita*') ||
                Request::is('kredits*'))
            <section class="slider_section flex-grow-1 d-flex align-items-center text-white text-center">
                <div class="container">
                    <h1 class="font-weight-bold slider-text-shadow">{{ $sliderTitle }}</h1>
                    <p class="slider-text-shadow">{{ $sliderDesc }}</p>
                </div>
            </section>
        @endif
    </div>

    <main>
        @yield('isi')
    </main>

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
        <a href="{{ url('harga') }}" class="mobile-nav-item {{ Request::is('harga*') ? 'active' : '' }}">
            <i class="fa fa-tag"></i>
            <span>Harga</span>
        </a>
        <a href="{{ url('servis') }}" class="mobile-nav-item {{ Request::is('servis*') ? 'active' : '' }}">
            <i class="fa fa-wrench"></i>
            <span>Servis</span>
        </a>
        <a href="{{ url('aksesoris') }}" class="mobile-nav-item {{ Request::is('aksesoris*') ? 'active' : '' }}">
            <i class="fa fa-headphones"></i>
            <span>Aksesoris</span>
        </a>
        <a href="{{ url('jual') }}" class="mobile-nav-item {{ Request::is('jual*') ? 'active' : '' }}">
            <i class="fa fa-money"></i>
            <span>Jual</span>
        </a>
        <a href="{{ url('kredits') }}" class="mobile-nav-item {{ Request::is('kredits*') ? 'active' : '' }}">
            <i class="fa fa-credit-card"></i>
            <span>Kredit</span>
        </a>
        <a href="{{ url('sewa-iphone') }}"
            class="mobile-nav-item {{ Request::is('sewa-iphone*') ? 'active' : '' }}">
            <i class="fa fa-mobile"></i>
            <span>Sewa iPhone</span>
        </a>
        <a href="{{ url('kartu-tarif') }}"
            class="mobile-nav-item {{ Request::is('kartu-tarif*') ? 'active' : '' }}">
            <i class="fa fa-address-card"></i>
            <span>Rate Card</span>
        </a>
        <a href="{{ url('berita') }}" class="mobile-nav-item {{ Request::is('berita*') ? 'active' : '' }}">
            <i class="fa fa-newspaper-o"></i>
            <span>Berita Gadget</span>
        </a>
    </div>
</body>

</html>
