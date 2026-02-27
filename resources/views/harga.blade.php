@extends('layouts.web')

@section('isi')
    {{-- 1. HERO SECTION --}}
    <div class="hero_area" style="min-height: auto; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6));">
        <div class="container" style="padding: 80px 15px 60px 15px; position: relative; z-index: 2;">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-10">
                    <span class="text-warning font-weight-bold text-uppercase mb-2 d-block"
                        style="letter-spacing: 2px; font-size: 12px;">Gadget Store Terbaik</span>
                    <h1 class="text-white font-weight-bold mb-4 responsive-title">
                        Temukan Gadget <span style="color: #ffbe33;">Impian Anda</span>
                    </h1>

                    {{-- Search Wrapper - Dibuat lebih lebar di Mobile --}}
                    <div class="search-wrapper mx-auto shadow-lg">
                        <div class="input-group">
                            <input type="text" id="search-input" class="form-control border-0"
                                placeholder="Cari merk atau tipe..." value="{{ request('search') }}">
                            <div class="input-group-append p-1 p-md-2 bg-white">
                                <button type="button" id="btn-search"
                                    class="btn btn-warning rounded-pill px-3 px-md-4 font-weight-bold shadow-sm">
                                    <i class="fa fa-search d-md-none"></i>
                                    <span class="d-none d-md-inline">CARI SEKARANG</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. CONTENT SECTION --}}
    <div class="section" style="padding: 40px 0; background: #f8f9fa;">
        <div class="container">

            {{-- FILTER KATEGORI (Scroll Horizontal di Mobile) --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="category-scroll-wrapper">
                        <button class="btn-category {{ !request('kategori') ? 'active' : '' }}" data-id="">
                            <i class="fa fa-th-large mr-1"></i> Semua
                        </button>
                        @foreach ($kategori as $kat)
                            <button class="btn-category {{ request('kategori') == $kat->id_kategori ? 'active' : '' }}"
                                data-id="{{ $kat->id_kategori }}">
                                <i
                                    class="fa {{ Str::contains(strtolower($kat->nama_kategori), 'phone') ? 'fa-mobile' : 'fa-laptop' }} mr-1"></i>
                                {{ $kat->nama_kategori }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                {{-- SIDEBAR BRAND - Menggunakan Collapse di Mobile --}}
                <div class="col-lg-3 mb-4 order-2 order-lg-1">
                    <div class="sidebar-card shadow-sm border-0 sticky-top" style="top: 20px;">
                        <div class="sidebar-header d-flex justify-content-between align-items-center" data-toggle="collapse"
                            data-target="#brandCollapse" aria-expanded="true" style="cursor: pointer;">
                            <h6 class="mb-0 font-weight-bold text-dark">
                                <i class="fa fa-filter mr-2 text-warning"></i> Pilih Brand
                            </h6>
                            <i class="fa fa-chevron-down d-lg-none"></i>
                        </div>
                        <div id="brandCollapse" class="collapse show d-lg-block">
                            <div id="sidebar-container" class="sidebar-body">
                                @include('partials._sidebar_jenis')
                            </div>
                        </div>
                    </div>
                </div>

                {{-- PRODUK LIST --}}
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                        <h5 class="font-weight-bold mb-0" style="font-size: 1.1rem;">Daftar Produk</h5>
                        <small class="text-muted d-none d-sm-block">Hasil pencarian terbaik</small>
                    </div>
                    <div id="table-container" class="product-container">
                        @include('partials._harga_table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. MODAL DETAIL --}}
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg rounded-20">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        style="position: absolute; right: 15px; top: 15px; z-index: 10; background: #ffbe33; width: 30px; height: 30px; border-radius: 50%; opacity: 1; color: white; padding: 0; line-height: 30px; border: none;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0" id="detail-isi"></div>
            </div>
        </div>
    </div>

    {{-- SCRIPTS (Logika Tetap Sama) --}}
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
                // Scroll ke atas list di mobile setelah pilih brand
                if ($(window).width() < 992) {
                    $('html, body').animate({
                        scrollTop: $("#table-container").offset().top - 100
                    }, 500);
                }
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
                    '<div class="text-center py-5"><div class="spinner-grow text-warning"></div></div>');
                $.get("{{ url('harga/detail') }}/" + id, function(res) {
                    $('#detail-isi').html(res);
                });
            });
        });
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Responsive Font */
        .responsive-title {
            font-size: 2.2rem;
            text-shadow: 2px 4px 10px rgba(0, 0, 0, 0.3);
        }

        @media (min-width: 992px) {
            .responsive-title {
                font-size: 3.5rem;
            }
        }

        /* Horizontal Scroll Kategori */
        .category-scroll-wrapper {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            padding: 5px 2px 15px 2px;
            gap: 10px;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .category-scroll-wrapper::-webkit-scrollbar {
            display: none;
        }

        .btn-category {
            flex: 0 0 auto;
            padding: 10px 20px;
            border-radius: 12px;
            border: none;
            background: #fff;
            font-weight: 600;
            font-size: 13px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .btn-category.active {
            background: #ffbe33;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 190, 51, 0.3);
        }

        /* Search Wrapper */
        .search-wrapper {
            background: #fff;
            border-radius: 50px;
            padding: 5px;
            width: 100%;
            max-width: 600px;
        }

        .search-wrapper input {
            height: 50px;
            font-size: 14px;
            border-radius: 50px 0 0 50px !important;
        }

        /* Sidebar & Layout */
        .sidebar-card {
            border-radius: 15px;
            overflow: hidden;
        }

        .loading-opacity {
            opacity: 0.4;
            transition: 0.3s;
        }

        .rounded-20 {
            border-radius: 15px !important;
        }

        /* Responsive adjustments */
        @media (max-width: 991px) {
            .sidebar-header {
                padding: 15px;
                background: #eee !important;
            }

            .order-1 {
                order: 1;
            }

            .order-2 {
                order: 2;
            }
        }
    </style>
@endsection
