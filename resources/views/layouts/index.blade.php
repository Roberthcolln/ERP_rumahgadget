<?php

use Illuminate\Support\Facades\DB;

$konf = DB::table('setting')->first();

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('../admin/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard Admin - {{ $konf->instansi_setting }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon/' . $konf->favicon_setting) }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('../admin/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('../admin/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('../admin/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('../admin/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('../admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('../admin/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('../admin/assets/js/config.js') }}"></script>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{ url('/') }}" class="app-brand-link d-flex justify-content-center w-100">
                        <span class="app-brand-logo demo">
                            <i class="bx bx-store-alt fs-2 text-primary"></i>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1 text-uppercase fs-5">
                            {{ $konf->instansi_setting }}
                        </span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    {{-- DASHBOARD - Semua User --}}
                    <li class="menu-item {{ Route::is('dashboard.*') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    {{-- ROLE: ADMIN --}}
                    @if (auth()->user()->jabatan == 'Admin')
                        <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen
                                Utama</span></li>

                        {{-- Berita --}}
                        <li class="menu-item {{ Route::is('berita.*') ? 'active' : '' }}">
                            <a href="{{ route('berita.index') }}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-news"></i>
                                <div>Berita & Informasi</div>
                                <div class="badge bg-label-secondary ms-auto">{{ \App\Models\Berita::count() }}</div>
                            </a>
                        </li>

                        {{-- Katalog Gadget --}}
                        <li
                            class="menu-item {{ Route::is('kategori.*') || Route::is('jenis.*') || Route::is('warna.*') || Route::is('varian.*') || Route::is('tipe.*') || Route::is('produk.*') || Route::is('supplier.*') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-box"></i>
                                <div>Katalog Gadget</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item {{ Route::is('kategori.*') ? 'active' : '' }}"><a
                                        href="{{ route('kategori.index') }}" class="menu-link">
                                        <div>Kategori</div>
                                    </a></li>
                                <li class="menu-item {{ Route::is('jenis.*') ? 'active' : '' }}"><a
                                        href="{{ route('jenis.index') }}" class="menu-link">
                                        <div>Jenis</div>
                                    </a></li>
                                <li class="menu-item {{ Route::is('tipe.*') ? 'active' : '' }}"><a
                                        href="{{ route('tipe.index') }}" class="menu-link">
                                        <div>Tipe Model</div>
                                    </a></li>
                                <li class="menu-item {{ Route::is('varian.*') ? 'active' : '' }}"><a
                                        href="{{ route('varian.index') }}" class="menu-link">
                                        <div>Varian</div>
                                    </a></li>
                                <li class="menu-item {{ Route::is('warna.*') ? 'active' : '' }}"><a
                                        href="{{ route('warna.index') }}" class="menu-link">
                                        <div>Warna</div>
                                    </a></li>
                                <li class="menu-item {{ Route::is('produk.*') ? 'active' : '' }}"><a
                                        href="{{ route('produk.index') }}" class="menu-link">
                                        <div>Daftar Produk</div>
                                    </a></li>
                                <li class="menu-item {{ Route::is('supplier.*') ? 'active' : '' }}"><a
                                        href="{{ route('supplier.index') }}" class="menu-link">
                                        <div>Supplier</div>
                                    </a></li>
                            </ul>
                        </li>

                        <li
                            class="menu-item {{ Route::is('kategori_service.*') || Route::is('service.*') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-wrench"></i>
                                <div>Service Gadget</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item {{ Route::is('kategori_service.*') ? 'active' : '' }}"><a
                                        href="{{ route('kategori_service.index') }}" class="menu-link">
                                        <div>Kategori Service</div>
                                    </a></li>
                                <li class="menu-item {{ Route::is('service.*') ? 'active' : '' }}"><a
                                        href="{{ route('service.index') }}" class="menu-link">
                                        <div>Service</div>
                                    </a></li>

                            </ul>
                        </li>

                        <li
                            class="menu-item {{ Route::is('kategori_aksesoris.*') || Route::is('aksesoris.*') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-plug"></i>
                                <div>Aksesoris Gadget</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item {{ Route::is('kategori_aksesoris.*') ? 'active' : '' }}"><a
                                        href="{{ route('kategori_aksesoris.index') }}" class="menu-link">
                                        <div>Kategori Aksesoris</div>
                                    </a></li>
                                <li class="menu-item {{ Route::is('aksesoris.*') ? 'active' : '' }}"><a
                                        href="{{ route('aksesoris.index') }}" class="menu-link">
                                        <div> Aksesoris</div>
                                    </a></li>


                            </ul>
                        </li>

                        <li class="menu-item {{ Route::is('kredit.*') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-wallet"></i>
                                <div>Kredit Gadget</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item {{ Route::is('kredit.*') ? 'active' : '' }}"><a
                                        href="{{ route('kredit.index') }}" class="menu-link">
                                        <div>Kredit</div>
                                    </a></li>



                            </ul>
                        </li>



                        {{-- ROLE: KASIR --}}
                    @endif
                </ul>
            </aside>
            <!-- / Menu -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center text-muted">

                                <i class="bx bx-time fs-4 lh-0 me-2"></i>

                                <!-- Mobile (ringkas) -->
                                <span class="fw-semibold d-inline d-md-none">
                                    {{ \Carbon\Carbon::now()->isoFormat('D MMM') }}
                                    <span id="clockmobile"></span>
                                </span>

                                <!-- Tablet & Desktop (lengkap) -->
                                <span class="fw-semibold d-none d-md-inline">
                                    {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y') }}
                                    <span id="clock"></span>
                                </span>

                            </div>
                        </div>

                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">

                            <li class="nav-item me-3">
                                <a class="nav-link cursor-pointer" id="theme-toggle" title="Toggle Dark Mode">
                                    <i class="bx bx-moon fs-4" id="theme-icon"></i>
                                </a>
                            </li>

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('logo/' . $konf->logo_setting) }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ auth()->user()->foto
                                                            ? asset('file/foto/' . auth()->user()->foto)
                                                            : asset('../admin/assets/img/avatars/1.png') }}"
                                                            alt="Foto User" class="rounded-circle"
                                                            style="width: 40px; height: 40px; object-fit: cover;" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">
                                                        {{ auth()->user()->name }}
                                                    </span>
                                                    <small class="text-muted">
                                                        {{ auth()->user()->jabatan }}
                                                    </small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        @if (auth()->user()->id > 1)
                                            <a class="dropdown-item" href="{{ route('anggota.index') }}">
                                                <i class="bx bx-user me-2"></i>
                                                <span class="align-middle">My Profile</span>
                                            </a>
                                        @else
                                            <a class="dropdown-item" href="">
                                                <i class="bx bx-user me-2"></i>
                                                <span class="align-middle">My Profile</span>
                                            </a>
                                        @endif
                                    </li>
                                    <li>
                                        @if (auth()->user()->jabatan == 'Admin')
                                            <a class="dropdown-item" href="{{ route('setting.index') }}">
                                                <i class="bx bx-cog me-2"></i>
                                                <span class="align-middle">Settings</span>
                                            </a>
                                        @endif
                                    </li>

                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger py-2">
                                                <i class="bx bx-power-off me-2 fs-5 align-middle"></i>
                                                <span class="align-middle fw-semibold">Keluar Aplikasi</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                @yield('content')

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            System by
                            <a href="#" target="_blank"
                                class="footer-link fw-bolder">{{ $konf->instansi_setting }}</a>
                        </div>
                        <div>
                            Version 0.0.1

                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>

            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->


    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('../admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('../admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('../admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('../admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('../admin/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('../admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('../admin/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('../admin/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js') }}"></script>

    <script>
        $(document).ready(function() {

            /* =============================
               KATEGORI -> JENIS
            ============================= */

            $('#kategori-dd').on('change', function() {

                let idKategori = $(this).val();

                $('#jenis-dd').html('<option value="">Loading...</option>');
                $('#tipe-dd').html('<option value="">Pilih Tipe</option>');

                $.ajax({

                    url: "{{ url('fetch-jenis') }}",
                    type: "GET",

                    data: {
                        id_kategori: idKategori
                    },

                    dataType: 'json',

                    success: function(res) {

                        $('#jenis-dd').html('<option value="">Pilih Jenis</option>');

                        $.each(res.jenis, function(key, value) {

                            $('#jenis-dd').append(
                                '<option value="' + value.id_jenis + '">' + value
                                .nama_jenis + '</option>'
                            );

                        });

                    }

                });

            });


            /* =============================
               JENIS -> TIPE
            ============================= */

            $('#jenis-dd').on('change', function() {

                let idJenis = $(this).val();

                $('#tipe-dd').html('<option value="">Loading...</option>');

                $.ajax({

                    url: "{{ url('fetch-tipe') }}",
                    type: "GET",

                    data: {
                        id_jenis: idJenis
                    },

                    dataType: 'json',

                    success: function(res) {

                        $('#tipe-dd').html('<option value="">Pilih Tipe</option>');

                        $.each(res.tipe, function(key, value) {

                            $('#tipe-dd').append(
                                '<option value="' + value.id_tipe + '">' + value
                                .nama_tipe + '</option>'
                            );

                        });

                    }

                });

            });

        });
    </script>




    @stack('scripts')

</body>

</html>
