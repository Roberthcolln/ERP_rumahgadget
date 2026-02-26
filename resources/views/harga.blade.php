@extends('layouts.web')

@section('isi')
    {{-- 1. HERO SECTION DENGAN EFEK GRADIENT & BLUR --}}
    <div class="hero_area" style="min-height: auto;">
        {{-- <div class="bg-box" style="opacity: 0.6;">
            <img src="{{ asset('web/images/hero-bg1.jpg') }}" alt="" style="filter: brightness(0.5) contrast(1.1);">
        </div> --}}
        <div class="container" style="padding: 120px 0 80px 0; position: relative; z-index: 2;">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-10">
                    <span class="text-warning font-weight-bold text-uppercase mb-2 d-block"
                        style="letter-spacing: 3px; font-size: 14px;">Gadget Store Terbaik</span>
                    <h1 class="text-white font-weight-bold mb-4"
                        style="font-size: 3.5rem; text-shadow: 2px 4px 10px rgba(0,0,0,0.3);">
                        Temukan Gadget <span style="color: #ffbe33;">Impian Anda</span>
                    </h1>

                    {{-- Pencarian yang Lebih Modern --}}
                    <div class="search-wrapper mx-auto shadow-lg">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-0 pl-4">
                                    <i class="fa fa-search text-muted"></i>
                                </span>
                            </div>
                            <input type="text" id="search-input" class="form-control border-0 py-4"
                                placeholder="Cari merk, tipe, atau spesifikasi..." value="{{ request('search') }}"
                                style="font-size: 16px; height: 60px;">
                            <div class="input-group-append p-2 bg-white">
                                <button type="button" id="btn-search"
                                    class="btn btn-warning rounded-pill px-4 font-weight-bold shadow-sm">
                                    CARI SEKARANG
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. CONTENT SECTION --}}
    <div class="section" style="padding: 60px 0; background: #f8f9fa;">
        <div class="container">

            {{-- FILTER KATEGORI (GLASSMORPHISM STYLE) --}}
            <div class="row mb-5">
                <div class="col-12">
                    <div class="d-flex justify-content-center flex-wrap" style="gap: 15px;">
                        <button class="btn-category {{ !request('kategori') ? 'active' : '' }}" data-id="">
                            <i class="fa fa-th-large mr-2"></i> Semua Produk
                        </button>
                        @foreach ($kategori as $kat)
                            <button class="btn-category {{ request('kategori') == $kat->id_kategori ? 'active' : '' }}"
                                data-id="{{ $kat->id_kategori }}">
                                {{-- Ikon dinamis sederhana berdasarkan kata kunci kategori --}}
                                <i
                                    class="fa {{ Str::contains(strtolower($kat->nama_kategori), 'phone') ? 'fa-mobile' : 'fa-laptop' }} mr-2"></i>
                                {{ $kat->nama_kategori }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- SIDEBAR BRAND --}}
                <div class="col-lg-3 mb-4">
                    <div class="sidebar-card shadow-sm border-0 sticky-top" style="top: 100px;">
                        <div class="sidebar-header">
                            <h6 class="mb-0 font-weight-bold text-dark"><i class="fa fa-filter mr-2 text-warning"></i> Pilih
                                Brand</h6>
                        </div>
                        <div id="sidebar-container" class="sidebar-body">
                            @include('partials._sidebar_jenis')
                        </div>
                    </div>
                </div>

                {{-- PRODUK LIST --}}
                <div class="col-lg-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="font-weight-bold mb-0">Daftar Produk</h5>
                        <small class="text-muted">Menampilkan hasil pencarian terbaik</small>
                    </div>
                    <div id="table-container" class="product-container">
                        @include('partials._harga_table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. MODAL DETAIL DENGAN DESIGN BERSIH --}}
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-2xl rounded-20">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close-circle" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0" id="detail-isi">
                    {{-- Ajax Loading --}}
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPTS (Tetap sama dengan logika Anda namun sedikit dioptimasi) --}}
    <script src="{{ asset('web/js/jquery-3.4.1.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let filter = {
                kategori: "{{ request('kategori') }}",
                jenis: "{{ request('jenis') }}",
                search: "{{ request('search') }}",
                page: 1
            };

            function updateContent() {
                $('#table-container').addClass('loading-opacity');
                $.ajax({
                    url: "{{ route('harga') }}",
                    method: "GET",
                    data: filter,
                    success: function(res) {
                        $('#table-container').html(res.table).removeClass('loading-opacity');
                        $('#sidebar-container').html(res.sidebar);
                        let newUrl = window.location.pathname + '?' + $.param(filter);
                        window.history.pushState({
                            path: newUrl
                        }, '', newUrl);
                    }
                });
            }

            $(document).on('click', '.btn-category', function() {
                $('.btn-category').removeClass('active');
                $(this).addClass('active');
                filter.kategori = $(this).data('id');
                filter.jenis = '';
                filter.page = 1;
                updateContent();
            });

            $(document).on('click', '.btn-filter-jenis', function(e) {
                e.preventDefault();
                filter.jenis = $(this).data('id');
                filter.page = 1;
                updateContent();
            });

            $('#btn-search').on('click', function() {
                filter.search = $('#search-input').val();
                filter.page = 1;
                updateContent();
            });

            $(document).on('click', '.btn-detail', function() {
                let id = $(this).data('id');
                $('#modalDetail').modal('show');
                $('#detail-isi').html(
                    '<div class="text-center py-5"><div class="spinner-grow text-warning"></div><p class="mt-3">Menyiapkan Detail Produk...</p></div>'
                );
                $.get("{{ url('harga/detail') }}/" + id, function(res) {
                    $('#detail-isi').html(res);
                });
            });
        });
    </script>

    <style>
        /* CSS PREMIUM CUSTOMIZATION */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        /* Search Wrapper Modern */
        .search-wrapper {
            background: #fff;
            border-radius: 50px;
            padding: 5px;
            max-width: 700px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Tombol Kategori Modern */
        .btn-category {
            padding: 12px 28px;
            border-radius: 15px;
            border: none;
            background: #fff;
            color: #555;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .btn-category:hover,
        .btn-category.active {
            background: #ffbe33;
            color: #fff;
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 190, 51, 0.3);
        }

        /* Sidebar Card */
        .sidebar-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
        }

        .sidebar-header {
            padding: 20px;
            background: #fafafa;
            border-bottom: 1px solid #eee;
        }

        .sidebar-body {
            padding: 15px;
        }

        /* Modal Customization */
        .rounded-20 {
            border-radius: 20px !important;
        }

        .close-circle {
            position: absolute;
            right: -15px;
            top: -15px;
            width: 40px;
            height: 40px;
            background: #ffbe33;
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 20px;
            z-index: 999;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Animation */
        .loading-opacity {
            opacity: 0.4;
            transition: 0.3s;
        }

        .product-container {
            min-height: 400px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero_area h1 {
                font-size: 2.2rem !important;
            }

            .btn-category {
                width: 100%;
                text-align: left;
            }
        }
    </style>
@endsection
