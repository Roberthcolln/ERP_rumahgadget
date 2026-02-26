@extends('layouts.web')

@section('isi')
    <div class="hero_area" style="min-height: auto; background: #111; padding: 80px 0 40px 0;">
        <div class="container text-center text-white">
            <h1 class="font-weight-bold">Simulasi <span style="color: #ffbe33;">Kredit Gadget</span></h1>
        </div>
    </div>

    <div class="section py-5" style="background: #f8f9fa;">
        <div class="container">
            <div class="row">
                {{-- SIDEBAR FILTER --}}
                <div class="col-lg-3 mb-4">
                    <div class="sidebar-card shadow-sm border-0 sticky-top"
                        style="top: 100px; background: #fff; border-radius: 20px; overflow: hidden;">
                        <div class="sidebar-header p-3 bg-light border-bottom">
                            <h6 class="mb-0 font-weight-bold"><i class="fa fa-filter mr-2 text-warning"></i> Pilih Brand
                            </h6>
                        </div>
                        <div id="sidebar-container" class="p-3">
                            {{-- Memanggil partial sidebar yang sudah Anda miliki --}}
                            @include('partials._sidebar_jenis')
                        </div>
                    </div>
                </div>

                {{-- TABLE CONTENT --}}
                <div class="col-lg-9">
                    <div class="table-responsive shadow-sm rounded-20 bg-white" id="table-container">
                        @include('partials._kredit_table')
                    </div>
                    <div class="text-right mt-3">
                        <small class="text-muted" id="last-update">Update Terakhir: {{ now()->format('d/m/Y H:i') }}
                            WITA</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT AJAX --}}
    <script src="{{ asset('web/js/jquery-3.4.1.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let filter = {
                kategori: "{{ request('kategori') }}",
                jenis: "{{ request('jenis') }}",
                search: "{{ request('search') }}",
            };

            function updateKreditContent() {
                $('#table-container').css('opacity', '0.5');
                $.ajax({
                    url: "{{ route('kredits') }}",
                    method: "GET",
                    data: filter,
                    success: function(res) {
                        $('#table-container').html(res.table).css('opacity', '1');
                        $('#sidebar-container').html(res.sidebar);

                        // Update URL browser tanpa reload
                        let newUrl = window.location.pathname + '?' + $.param(filter);
                        window.history.pushState({
                            path: newUrl
                        }, '', newUrl);
                    }
                });
            }

            // Event saat klik Brand di Sidebar
            $(document).on('click', '.btn-filter-jenis', function(e) {
                e.preventDefault();
                filter.jenis = $(this).data('id');
                updateKreditContent();
            });
        });
    </script>
@endsection
