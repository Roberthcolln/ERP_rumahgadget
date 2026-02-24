@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Breadcrumb & Title --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> {{ $title }}
            </h4>
            <a href="{{ route('slip-gaji.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom py-3">
                <div class="d-flex align-items-center">
                    <i class="bx bx-file-blank fs-4 text-primary me-2"></i>
                    <h5 class="card-title mb-0">Formulir Pembuatan {{ $title }}</h5>
                </div>
            </div>

            <div class="card-body pt-4">
                <form action="{{ route('slip-gaji.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        {{-- SEKSI NAMA KARYAWAN --}}
                        <div class="col-12 mb-4">
                            <div class="p-3 border rounded bg-light bg-opacity-10">
                                <div
                                    class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-3 gap-2">
                                    <div>
                                        <label class="form-label fw-bold mb-0">Pilih Karyawan</label>
                                        <p class="text-muted small mb-0">Checklist satu atau lebih karyawan yang akan
                                            dibuatkan slip gaji.</p>
                                    </div>
                                    <div class="btn-group shadow-sm">
                                        <button type="button" class="btn btn-xs btn-primary" onclick="selectAll()">Pilih
                                            Semua</button>
                                        <button type="button" class="btn btn-xs btn-outline-primary"
                                            onclick="unselectAll()">Batal</button>
                                    </div>
                                </div>

                                <div class="row g-2 overflow-auto custom-scrollbar" style="max-height: 300px;">
                                    @foreach ($users as $user)
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                            <div class="user-item">
                                                <input type="checkbox" class="form-check-input user-checkbox"
                                                    id="user_{{ $user->id }}" name="user_id[]"
                                                    value="{{ $user->id }}"
                                                    {{ is_array(old('user_id')) && in_array($user->id, old('user_id')) ? 'checked' : '' }}>
                                                <label class="form-check-label w-100" for="user_{{ $user->id }}">
                                                    {{ $user->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- SEKSI DETAIL GAJI --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Periode</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                <input type="month" name="periode" class="form-control" value="{{ old('periode') }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Gaji Pokok</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control hitung"
                                    value="{{ old('gaji_pokok', 0) }}" required>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Tunjangan</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="tunjangan" id="tunjangan" class="form-control hitung"
                                    value="{{ old('tunjangan', 0) }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Biaya Layanan</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="biaya_layanan" id="biaya_layanan" class="form-control hitung"
                                    value="{{ old('biaya_layanan', 0) }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold text-danger">Potongan</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text text-danger border-danger"><i class="bx bx-minus"></i></span>
                                <input type="number" name="potongan" id="potongan"
                                    class="form-control hitung border-danger text-danger" value="{{ old('potongan', 0) }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Total Gaji Diterima</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text bg-success text-white border-success">Rp</span>
                                <input type="text" id="total_gaji" class="form-control fw-bold border-success bg-white"
                                    readonly>
                            </div>
                        </div>
                    </div>

                    <div class="hr-dashed my-4"></div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-5">
                            <i class="bx bx-save me-1"></i> Simpan Data Slip
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Styling User Box / Checkbox Items */
        .user-item {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #ffffff;
        }

        .user-item:hover {
            border-color: #696cff;
            background-color: #f4f5ff;
        }

        .user-item input:checked+label {
            font-weight: 600;
            color: #696cff;
        }

        .user-item input:checked {
            background-color: #696cff;
            border-color: #696cff;
        }

        /* Utilitas Tambahan */
        .btn-xs {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .hr-dashed {
            border-top: 1px dashed #d9dee3;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d9dee3;
            border-radius: 10px;
        }

        .input-group-text {
            background-color: #f8f9fa;
        }
    </style>

    <script>
        // Logika perhitungan (Tetap sama, hanya ditambahkan pembulatan/format)
        function hitungTotal() {
            let gaji = parseFloat(document.getElementById('gaji_pokok').value) || 0;
            let tunj = parseFloat(document.getElementById('tunjangan').value) || 0;
            let biaya = parseFloat(document.getElementById('biaya_layanan').value) || 0;
            let pot = parseFloat(document.getElementById('potongan').value) || 0;
            let total = gaji + tunj + biaya - pot;

            document.getElementById('total_gaji').value = total.toLocaleString('id-ID');
        }

        document.querySelectorAll('.hitung').forEach(el => el.addEventListener('input', hitungTotal));

        function selectAll() {
            document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = true);
        }

        function unselectAll() {
            document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = false);
        }

        // Inisialisasi awal
        window.onload = hitungTotal;
    </script>
@endsection
