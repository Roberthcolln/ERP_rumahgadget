@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">SDM /</span> {{ $title }}
        </h4>

        <div class="card">
            <h5 class="card-header">Buat Penawaran Kerja (Offering Letter)</h5>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Terjadi Kesalahan!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('offering-letter.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        {{-- Data Personal & Posisi --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Kandidat *</label>
                            <input type="text" name="nama_kandidat" class="form-control"
                                placeholder="Nama lengkap sesuai KTP" value="{{ old('nama_kandidat') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Posisi *</label>
                            <input type="text" name="posisi" class="form-control" placeholder="Contoh: Web Developer"
                                value="{{ old('posisi') }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status Kerja *</label>
                            <select name="status_kerja" class="form-select" required>
                                <option value="PKWT/PKWTT" {{ old('status_kerja') == 'PKWT/PKWTT' ? 'selected' : '' }}>
                                    PKWT/PKWTT</option>
                                <option value="PKWT" {{ old('status_kerja') == 'PKWT' ? 'selected' : '' }}>PKWT (Kontrak)
                                </option>
                                <option value="PKWTT" {{ old('status_kerja') == 'PKWTT' ? 'selected' : '' }}>PKWTT (Tetap)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tanggal Mulai Kerja *</label>
                            <input type="date" name="tanggal_mulai" class="form-control"
                                value="{{ old('tanggal_mulai') }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Penempatan Kerja *</label>
                            <input type="text" name="penempatan" class="form-control"
                                placeholder="Contoh: Rumah Gadget Gunung Agung"
                                value="{{ old('penempatan', 'Rumah Gadget Gunung Agung') }}" required>
                        </div>

                        <hr class="my-4">
                        <h6 class="mb-3 fw-bold text-primary">Informasi Masa Training</h6>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Masa Training Normal (Bulan)</label>
                            <input type="number" name="masa_training" class="form-control"
                                value="{{ old('masa_training', 2) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Maksimal Training (Bulan)</label>
                            <input type="number" name="maks_training" class="form-control"
                                value="{{ old('maks_training', 3) }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Minimal Training (Bulan)</label>
                            <input type="number" name="min_training" class="form-control"
                                value="{{ old('min_training', 1) }}">
                        </div>

                        <hr class="my-4">
                        <h6 class="mb-3 fw-bold text-primary">Kompensasi & Gaji</h6>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gaji Pokok Masa Training (Rp) *</label>
                            <input type="number" name="gaji_training" class="form-control"
                                value="{{ old('gaji_training', 2000000) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gaji Pokok Lulus Training (Rp) *</label>
                            <input type="number" name="gaji_lulus" class="form-control"
                                value="{{ old('gaji_lulus', 2900000) }}" required>
                        </div>

                        <hr class="my-4">

                        {{-- Ruang Lingkup --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Ruang Lingkup Pekerjaan</label>
                            <textarea name="ruang_lingkup" id="editor_ruang_lingkup" class="form-control">
                                <ul>
                                    <li>Mengembangkan dan memelihara website perusahaan.</li>
                                    <li>Melakukan perbaikan bug serta peningkatan performa sistem.</li>
                                    <li>Berkolaborasi dengan tim desain/front-end dan tim operasional dalam pengembangan fitur.</li>
                                    <li>Memastikan keamanan, stabilitas, serta optimalisasi website perusahaan.</li>
                                </ul>
                            </textarea>
                        </div>

                        {{-- NDA --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Klausul Kerahasiaan (NDA)</label>
                            <textarea name="nda_klausul" id="editor_nda" class="form-control">
                                <ul>
                                    <li>Data pelanggan dan supplier</li>
                                    <li>Data penjualan dan strategi bisnis</li>
                                    <li>Informasi sistem, source code, database, dan akses server</li>
                                    <li>Informasi keuangan, kebijakan internal, dan dokumen perusahaan lainnya</li>
                                </ul>
                            </textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-2">
                        <a href="{{ route('offering-letter.index') }}" class="btn btn-secondary me-2">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Simpan & Generate OL
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- CKEDITOR --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        // Editor untuk Ruang Lingkup
        ClassicEditor.create(document.querySelector('#editor_ruang_lingkup'))
            .catch(error => console.error(error));

        // Editor untuk NDA
        ClassicEditor.create(document.querySelector('#editor_nda'))
            .catch(error => console.error(error));
    </script>
@endsection
