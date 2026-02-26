@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kredit /</span> {{ $title }}
        </h4>

        <div class="card">
            <h5 class="card-header">Tambah Skema Kredit Baru</h5>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Perhatian!</strong> Ada beberapa data yang belum sesuai.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('kredit.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        {{-- Kategori --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kategori *</label>
                            <select name="id_kategori" id="kategori-dd" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Jenis (Dependen ke Kategori) --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jenis *</label>
                            <select name="id_jenis" id="jenis-dd" class="form-select" required disabled>
                                <option value="">-- Pilih Jenis --</option>
                            </select>
                        </div>

                        {{-- Tipe (Dependen ke Jenis) --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tipe *</label>
                            <select name="id_tipe" id="tipe-dd" class="form-select" required disabled>
                                <option value="">-- Pilih Tipe --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Varian *</label>
                            <select name="id_varian" class="form-select" required>
                                <option value="">-- Pilih Varian --</option>
                                @foreach ($varian as $v)
                                    <option value="{{ $v->id_varian }}">{{ $v->nama_varian }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Warna *</label>
                            <select name="id_warna" class="form-select" required>
                                <option value="">-- Pilih Warna --</option>
                                @foreach ($warna as $w)
                                    <option value="{{ $w->id_warna }}">{{ $w->nama_warna }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Harga Kredit *</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_kredit" id="harga_kredit" class="form-control"
                                    placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">DP (Uang Muka) *</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="dp" id="dp" class="form-control" placeholder="0"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Tenor Cicilan *</label>
                            <select name="cicilan" id="tenor" class="form-select" required>
                                <option value="">-- Pilih Tenor --</option>
                                @foreach ($opsi_cicilan as $oc)
                                    <option value="{{ $oc }}">{{ $oc }}x Cicilan</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-primary fw-bold">Harga Cicilan / Bulan *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">Rp</span>
                                <input type="number" name="harga_cicilan" id="harga_cicilan"
                                    class="form-control border-primary" placeholder="0" required>
                            </div>
                            <small class="text-muted">Dapat diisi manual atau otomatis</small>
                        </div>
                    </div>



                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('kredit.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Skema Kredit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- AJAX Script untuk Dropdown Bercabang --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Saat Kategori Berubah
            $('#kategori-dd').on('change', function() {
                var idKategori = this.value;
                $("#jenis-dd").html('<option value="">-- Loading... --</option>');
                $("#tipe-dd").html('<option value="">-- Pilih Tipe --</option>').attr('disabled', true);

                if (idKategori) {
                    $.ajax({
                        url: "{{ url('api/fetch-jenis') }}", // Sesuaikan URL API Anda
                        type: "POST",
                        data: {
                            id_kategori: idKategori,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            $('#jenis-dd').html('<option value="">-- Pilih Jenis --</option>')
                                .removeAttr('disabled');
                            $.each(result.jenis, function(key, value) {
                                $("#jenis-dd").append('<option value="' + value
                                    .id_jenis + '">' + value.nama_jenis +
                                    '</option>');
                            });
                        }
                    });
                } else {
                    $("#jenis-dd").html('<option value="">-- Pilih Jenis --</option>').attr('disabled',
                        true);
                }
            });

            // Saat Jenis Berubah
            $('#jenis-dd').on('change', function() {
                var idJenis = this.value;
                $("#tipe-dd").html('<option value="">-- Loading... --</option>');

                if (idJenis) {
                    $.ajax({
                        url: "{{ url('api/fetch-tipe') }}", // Sesuaikan URL API Anda
                        type: "POST",
                        data: {
                            id_jenis: idJenis,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function(result) {
                            $('#tipe-dd').html('<option value="">-- Pilih Tipe --</option>')
                                .removeAttr('disabled');
                            $.each(result.tipe, function(key, value) {
                                $("#tipe-dd").append('<option value="' + value.id_tipe +
                                    '">' + value.nama_tipe + '</option>');
                            });
                        }
                    });
                } else {
                    $("#tipe-dd").html('<option value="">-- Pilih Tipe --</option>').attr('disabled', true);
                }
            });
        });
    </script>
    {{-- Tambahkan Script Kalkulasi Otomatis (Opsional untuk Membantu Input) --}}
    <script>
        $(document).ready(function() {
            function hitungOtomatis() {
                let harga = parseFloat($('#harga_kredit').val()) || 0;
                let dp = parseFloat($('#dp').val()) || 0;
                let tenor = parseFloat($('#tenor').val()) || 0;

                if (harga > 0 && tenor > 0) {
                    let hasil = (harga - dp) / tenor;
                    $('#harga_cicilan').val(Math.round(hasil)); // Pembulatan otomatis ke angka terdekat
                }
            }

            // Jalankan saat input harga, dp, atau tenor berubah
            $('#harga_kredit, #dp, #tenor').on('input change', function() {
                hitungOtomatis();
            });
        });
    </script>
@endsection
