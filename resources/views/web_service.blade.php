@extends('layouts.web')

@section('isi')
    {{-- HERO SECTION --}}
    <div class="hero_area" style="min-height: auto; background: linear-gradient(45deg, #1a1c20, #222831);">
        <div class="container" style="padding: 60px 15px 40px 15px; position: relative; z-index: 2;">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-8">
                    <span class="text-warning font-weight-bold text-uppercase mb-2 d-block"
                        style="letter-spacing: 2px; font-size: 11px;">Pusat Perbaikan Gadget</span>
                    <h1 class="text-white fw-bold mb-4 responsive-h1">Service <span style="color: #ffbe33;">Price List</span>
                    </h1>

                    <div class="search-wrapper mx-auto shadow-lg">
                        <div class="input-group">
                            <input type="text" id="search-service" class="form-control border-0 px-3 px-md-4"
                                placeholder="Cari tipe gadget..."
                                style="height: 50px; border-radius: 50px 0 0 50px; font-size: 14px;">
                            <div class="input-group-append p-1 bg-white" style="border-radius: 0 50px 50px 0;">
                                <button type="button" id="btn-search-service"
                                    class="btn btn-warning rounded-pill px-3 px-md-4 font-weight-bold shadow-sm">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section bg-light" style="padding: 30px 0 60px 0;">
        <div class="container-fluid px-md-5">

            {{-- KATEGORI SELECTOR (Horizontal Scroll di Mobile) --}}
            <div class="row mb-4">
                <div class="col-12">
                    <div class="category-scroll-container">
                        @foreach ($kategori_service as $kat)
                            <button class="btn-service-cat {{ $loop->first ? 'active' : '' }}"
                                data-id="{{ $kat->id_kategori_service }}">
                                <i class="fa fa-tools mr-1 small opacity-50"></i>
                                {{ $kat->nama_kategori_service }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- TABLE CARD --}}
            <div class="card border-0 shadow-sm rounded-20 overflow-hidden">
                <div
                    class="bg-white p-3 border-bottom d-flex flex-column flex-md-row justify-content-between align-items-center px-4">
                    <h6 class="mb-2 mb-md-0 fw-bold text-dark text-center text-md-left">
                        <i class="fa fa-list-alt text-warning me-2"></i> Estimasi Harga Sparepart
                    </h6>
                    <span class="badge bg-soft-dark text-dark border px-3 py-2" style="font-size: 11px;">
                        Update: {{ date('F Y') }}
                    </span>
                </div>

                {{-- Container Tabel dengan Hint Scroll --}}
                <div id="service-table-container" class="position-relative table-responsive-wrapper">
                    @include('partials._service_table')
                </div>
            </div>

            <div class="mt-3 text-center d-md-none">
                <div class="badge badge-pill badge-light text-muted border py-2 px-3">
                    <i class="fa fa-arrows-h mr-1 text-warning"></i> Geser tabel ke samping
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Typography Responsive */
        .responsive-h1 {
            font-size: 2rem;
        }

        @media (min-width: 768px) {
            .responsive-h1 {
                font-size: 3rem;
            }
        }

        .rounded-20 {
            border-radius: 15px !important;
        }

        @media (min-width: 768px) {
            .rounded-20 {
                border-radius: 20px !important;
            }
        }

        /* Kategori Scroll (Penting untuk Mobile) */
        .category-scroll-container {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            padding: 5px 15px 15px 15px;
            gap: 10px;
            scrollbar-width: none;
            /* Firefox */
            -webkit-overflow-scrolling: touch;
        }

        .category-scroll-container::-webkit-scrollbar {
            display: none;
        }

        .btn-service-cat {
            flex: 0 0 auto;
            padding: 10px 20px;
            border-radius: 10px;
            border: 1px solid #eee;
            background: #fff;
            color: #666;
            font-weight: 600;
            font-size: 13px;
            transition: 0.3s;
        }

        .btn-service-cat.active {
            background: #222831;
            color: #ffbe33;
            border-color: #222831;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Search Wrapper */
        .search-wrapper {
            background: #fff;
            border-radius: 50px;
            width: 100%;
            max-width: 500px;
        }

        /* Optimasi Tabel di Mobile */
        .table-responsive-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Memberikan efek bayangan pada kolom sticky jika di-scroll */
        .sticky-col {
            position: sticky;
            left: 0;
            background-color: #fff !important;
            z-index: 2;
            min-width: 140px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
        }

        /* Loading Overlay */
        #service-table-container.loading::after {
            content: "Memuat...";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            z-index: 10;
        }
    </style>

    <script>
        function initServiceFilter() {
            if (typeof jQuery === 'undefined') {
                setTimeout(initServiceFilter, 50);
                return;
            }

            $(document).ready(function() {
                let filter = {
                    id_kategori_service: $('.btn-service-cat.active').data('id') || "",
                    search: "",
                    page: 1
                };

                function updateServiceContent() {
                    $('#service-table-container').addClass('loading');

                    $.ajax({
                        url: "{{ route('web.service') }}",
                        method: "GET",
                        data: filter,
                        dataType: "json",
                        success: function(res) {
                            $('#service-table-container').html(res.table).removeClass('loading');
                        },
                        error: function() {
                            $('#service-table-container').removeClass('loading');
                        }
                    });
                }

                $(document).on('click', '.btn-service-cat', function(e) {
                    e.preventDefault();
                    $('.btn-service-cat').removeClass('active');
                    $(this).addClass('active');

                    filter.id_kategori_service = $(this).data('id');
                    filter.page = 1;
                    updateServiceContent();
                });

                $('#btn-search-service').on('click', function() {
                    filter.search = $('#search-service').val();
                    filter.page = 1;
                    updateServiceContent();
                });

                $('#search-service').on('keypress', function(e) {
                    if (e.which == 13) $('#btn-search-service').click();
                });
            });
        }
        initServiceFilter();
    </script>
@endsection
