<?php
use Illuminate\Support\Facades\DB;
$konf = DB::table('setting')->first();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
    <link rel="shortcut icon" href="{{ asset('favicon/' . $konf->favicon_setting) }}" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('web/fonts/icomoon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/fonts/flaticon/font/flaticon.css') }}" />

    <link rel="stylesheet" href="{{ asset('web/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}" />

    <title>{{ $konf->instansi_setting }}</title>

    <style>

    </style>
</head>

<body>
    <div class="mobile-header-logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="Logo">
        </a>
    </div>

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav">
        <div class="container">
            <div class="menu-bg-wrap">
                <div class="site-navigation">
                    <a href="{{ url('/') }}" class="logo m-0 float-start">
                        <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt="Logo" style="height: 40px;">
                    </a>

                    <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('harga') }}">Harga</a></li>
                        <li><a href="{{ url('servis') }}">Servis</a></li>
                        <li><a href="{{ url('aksesoris') }}">Aksesoris</a></li>
                        <li><a href="{{ url('jual') }}">Jual</a></li>
                        <li><a href="{{ url('kredit') }}">Kredit</a></li>
                        <li><a href="{{ url('sewa') }}">Sewa iPhone</a></li>
                        <li><a href="{{ url('rate-card') }}">Rate Card</a></li>
                        <li><a href="{{ url('about') }}">About</a></li>
                        <li><a href="{{ url('contact') }}">Contact Us</a></li>
                    </ul>

                    <a href="#"
                        class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
                        data-toggle="collapse" data-target="#main-navbar">
                        <span></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="mobile-bottom-nav">
        <a href="{{ url('/') }}" class="nav-item-mobile">
            <span class="icon-home"></span>
            <span>Home</span>
        </a>
        <a href="{{ url('harga') }}" class="nav-item-mobile">
            <span class="icon-search"></span>
            <span>Harga</span>
        </a>
        <a href="{{ url('jual') }}" class="nav-item-mobile">
            <span class="icon-shopping-bag"></span>
            <span>Jual</span>
        </a>

        <div class="nav-item-mobile" id="btnLainnya" style="cursor: pointer;">
            <span class="icon-menu"></span>
            <span>Lainnya</span>
            <div class="dropup-menu" id="menuLainnya">
                <a href="{{ url('servis') }}">Servis</a>
                <a href="{{ url('aksesoris') }}">Aksesoris</a>
                <a href="{{ url('kredit') }}">Kredit</a>
                <a href="{{ url('sewa') }}">Sewa iPhone</a>
                <a href="{{ url('rate-card') }}">Rate Card</a>
                <a href="{{ url('about') }}">About Us</a>
                <a href="{{ url('contact') }}">Contact</a>
            </div>
        </div>
    </div>

    @yield('isi')

    <div class="site-footer">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <p>Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script>. All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('web/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('web/js/aos.js') }}"></script>
    <script src="{{ asset('web/js/navbar.js') }}"></script>
    <script src="{{ asset('web/js/counter.js') }}"></script>
    <script src="{{ asset('web/js/custom.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Logika Active Menu (Desktop & Mobile)
            const currentUrl = window.location.href;
            const navLinks = document.querySelectorAll('.nav-item-mobile, .site-menu li a, .dropup-menu a');

            navLinks.forEach(link => {
                // Cek jika href link sama dengan URL saat ini
                if (link.href === currentUrl || (currentUrl.endsWith('/') && link.href.endsWith('/'))) {
                    link.classList.add('active');

                    // Jika yang aktif ada di dalam dropup, beri warna juga pada tombol "Lainnya"
                    if (link.closest('.dropup-menu')) {
                        document.getElementById('btnLainnya').classList.add('active');
                    }

                    // Untuk navigasi desktop (parent li)
                    if (link.parentElement.tagName === 'LI') {
                        link.parentElement.classList.add('active');
                    }
                }
            });

            // 2. Logika Dropup Mobile
            const btnLainnya = document.getElementById('btnLainnya');
            const menuLainnya = document.getElementById('menuLainnya');

            btnLainnya.addEventListener('click', function(e) {
                e.stopPropagation();
                menuLainnya.classList.toggle('show-dropup');
            });

            document.addEventListener('click', function(e) {
                if (!btnLainnya.contains(e.target)) {
                    menuLainnya.classList.remove('show-dropup');
                }
            });
        });
    </script>
</body>

</html>
