@extends('layouts.web')

@section('isi')
    {{-- HERO SECTION --}}
    <div class="hero_area" style="min-height: auto;">

        <div class="container" style="padding: 100px 0 60px 0; position: relative; z-index: 2;">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-8">
                    <span class="text-warning font-weight-bold text-uppercase mb-2 d-block"
                        style="letter-spacing: 3px; font-size: 13px;">Pusat Perbaikan Gadget</span>
                    <h1 class="text-white fw-bold mb-4" style="font-size: 3rem;">Service <span style="color: #ffbe33;">Price
                            List</span></h1>

                    <div class="search-wrapper mx-auto shadow-lg" style="max-width: 600px;">
                        <div class="input-group">
                            <input type="text" id="search-service" class="form-control border-0 px-4 py-4"
                                placeholder="Ketik tipe gadget Anda (Contoh: iPhone 13 Pro)..."
                                style="height: 55px; border-radius: 50px 0 0 50px;">
                            <div class="input-group-append p-1 bg-white" style="border-radius: 0 50px 50px 0;">
                                <button type="button" id="btn-search-service"
                                    class="btn btn-warning rounded-pill px-4 font-weight-bold shadow-sm">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section bg-light" style="padding: 60px 0;">
        <div class="container-fluid px-md-5">
            {{-- KATEGORI SELECTOR --}}
            <div class="row mb-4 justify-content-center">
                <div class="col-lg-10">
                    <div class="d-flex justify-content-center flex-wrap" style="gap: 10px;">
                        @foreach ($kategori_service as $kat)
                            <button class="btn-service-cat {{ $loop->first ? 'active' : '' }}"
                                data-id="{{ $kat->id_kategori_service }}">
                                <i class="fa fa-tools mr-2 small opacity-50"></i>
                                {{ $kat->nama_kategori_service }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- TABLE CARD --}}
            <div class="card border-0 shadow-sm rounded-20 overflow-hidden">
                <div class="bg-white p-3 border-bottom d-flex justify-content-between align-items-center px-4">
                    <h6 class="mb-0 fw-bold text-dark"><i class="fa fa-list-alt text-warning me-2"></i> Estimasi Harga
                        Sparepart</h6>
                    <span class="badge bg-soft-dark text-dark border px-3">Update: {{ date('F Y') }}</span>
                </div>
                <div id="service-table-container" class="position-relative">
                    @include('partials._service_table')
                </div>
            </div>

            <div class="mt-4 text-center">
                <p class="text-muted small italic">
                    <i class="fa fa-info-circle me-1"></i> Geser tabel ke samping untuk melihat detail harga per komponen.
                </p>
            </div>
        </div>
    </div>

    <style>
        .rounded-20 {
            border-radius: 20px !important;
        }

        .bg-soft-dark {
            background-color: rgba(0, 0, 0, 0.03);
        }

        /* Modern Category Button */
        .btn-service-cat {
            padding: 12px 25px;
            border-radius: 12px;
            border: 2px solid transparent;
            background: #fff;
            color: #666;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .btn-service-cat:hover {
            background: #fdfdfd;
            border-color: #ffbe33;
            color: #ffbe33;
        }

        .btn-service-cat.active {
            background: #222831;
            color: #ffbe33;
            border-color: #222831;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        /* Search Wrapper */
        .search-wrapper {
            background: #fff;
            border-radius: 50px;
            overflow: hidden;
        }

        /* Table Customizations */
        .table-responsive-custom {
            overflow-x: auto;
            scrollbar-width: thin;
        }

        .table-service-custom thead th {
            background: #f8f9fa !important;
            font-size: 11px !important;
            letter-spacing: 0.5px;
            border: 1px solid #eee !important;
            color: #888 !important;
        }

        .sticky-col {
            position: sticky;
            left: 0;
            background-color: #fff !important;
            z-index: 5;
            box-shadow: 5px 0 10px rgba(0, 0, 0, 0.03);
            font-weight: bold;
            color: #222;
            min-width: 180px;
        }
    </style>

    <script>
        // Gunakan fungsi pengecekan agar tidak error jika jQuery belum siap
        function initServiceFilter() {
            if (typeof jQuery === 'undefined') {
                setTimeout(initServiceFilter, 50);
                return;
            }

            $(document).ready(function() {
                // State Filter
                let filter = {
                    // Gunakan id_kategori_service agar sesuai dengan variabel di Controller
                    id_kategori_service: $('.btn-service-cat.active').data('id') || "",
                    search: "",
                    page: 1
                };

                function updateServiceContent() {
                    $('#service-table-container').css('opacity', '0.5');

                    $.ajax({
                        url: "{{ route('web.service') }}",
                        method: "GET",
                        data: filter,
                        dataType: "json", // Pastikan mengharap JSON
                        success: function(res) {
                            // Pastikan Controller mengirimkan key 'table'
                            $('#service-table-container').html(res.table).css('opacity', '1');
                        },
                        error: function(err) {
                            console.error("Gagal:", err);
                            $('#service-table-container').css('opacity', '1');
                        }
                    });
                }

                // Gunakan delegated event agar tombol yang di-render ulang tetap berfungsi
                $(document).on('click', '.btn-service-cat', function(e) {
                    e.preventDefault();
                    $('.btn-service-cat').removeClass('active');
                    $(this).addClass('active');

                    filter.id_kategori_service = $(this).data('id');
                    filter.page = 1;
                    filter.search = $('#search-service').val(); // Ambil search yang sedang ada

                    updateServiceContent();
                });

                $('#btn-search-service').on('click', function() {
                    filter.search = $('#search-service').val();
                    filter.page = 1;
                    updateServiceContent();
                });

                // Trigger Search saat tekan Enter
                $('#search-service').on('keypress', function(e) {
                    if (e.which == 13) {
                        $('#btn-search-service').click();
                    }
                });

                // Pagination Link Fix (Agar klik nomor halaman tidak reload page)
                $(document).on('click', '.pagination a', function(e) {
                    e.preventDefault();
                    let url = $(this).attr('href');
                    let page = url.split('page=')[1];
                    filter.page = page;
                    updateServiceContent();

                    // Scroll halus ke atas tabel
                    $('html, body').animate({
                        scrollTop: $("#service-table-container").offset().top - 150
                    }, 500);
                });
            });
        }

        initServiceFilter();
    </script>
@endsection
