@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Promo /</span> Tambah Baru</h4>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('promo.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Promo</label>
                            <input type="text" name="nama_promo" class="form-control"
                                placeholder="Contoh: Promo Akhir Tahun" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kode Promo (Kupon)</label>
                            <input type="text" name="kode_promo" class="form-control" placeholder="Contoh: GADGETBARU"
                                required style="text-transform:uppercase">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Tipe Promo</label>
                            <select name="tipe_promo" class="form-select" required>
                                <option value="nominal">Nominal (Rp)</option>
                                <option value="persentase">Persentase (%)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nilai Promo</label>
                            <input type="number" name="nilai_promo" class="form-control" placeholder="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Minimal Belanja (Optional)</label>
                            <input type="number" name="minimal_pembelian" class="form-control" value="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Tanggal Mulai</label>
                            <input type="date" name="tgl_mulai" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Tanggal Selesai</label>
                            <input type="date" name="tgl_selesai" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Kuota Total</label>
                            <input type="number" name="kuota_total" class="form-control"
                                placeholder="Berapa kali promo bisa dipakai" required>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Promo</button>
                        <a href="{{ route('promo.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
