@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Promo /</span> Edit Promo</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('promo.update', $promo->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Promo</label>
                            <input type="text" name="nama_promo" class="form-control" value="{{ $promo->nama_promo }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kode Promo</label>
                            <input type="text" name="kode_promo" class="form-control" value="{{ $promo->kode_promo }}"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Tipe Promo</label>
                            <select name="tipe_promo" class="form-select">
                                <option value="nominal" {{ $promo->tipe_promo == 'nominal' ? 'selected' : '' }}>Nominal (Rp)
                                </option>
                                <option value="persentase" {{ $promo->tipe_promo == 'persentase' ? 'selected' : '' }}>
                                    Persentase (%)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nilai Promo</label>
                            <input type="number" name="nilai_promo" class="form-control"
                                value="{{ (int) $promo->nilai_promo }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ $promo->status ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ !$promo->status ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tanggal Selesai</label>
                            <input type="date" name="tgl_selesai" class="form-control"
                                value="{{ $promo->tgl_selesai->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('promo.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
