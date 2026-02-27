@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master / Sewa /</span> {{ $title }}
            </h4>
            <a href="{{ route('sewa.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('sewa.update', $sewa->id_sewa) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        {{-- Pilih Produk (Disabled di Edit biasanya lebih aman) --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">iPhone</label>
                            <select name="id_produk" class="form-select bg-light" required>
                                @foreach ($produk as $p)
                                    <option value="{{ $p->id_produk }}"
                                        {{ $sewa->id_produk == $p->id_produk ? 'selected' : '' }}>
                                        {{ $p->nama_produk }} ({{ $p->varian->nama_varian ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga 24 Jam</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_24_jam" class="form-control"
                                    value="{{ $sewa->harga_24_jam }}" required>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga 2 Hari</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_2_hari" class="form-control"
                                    value="{{ $sewa->harga_2_hari }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga 3 Hari</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_3_hari" class="form-control"
                                    value="{{ $sewa->harga_3_hari }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga 7 Hari</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_7_hari" class="form-control"
                                    value="{{ $sewa->harga_7_hari }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga 14 Hari</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_14_hari" class="form-control"
                                    value="{{ $sewa->harga_14_hari }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga 1 Bulan</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_1_bulan" class="form-control"
                                    value="{{ $sewa->harga_1_bulan }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga Per Jam</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_per_jam" class="form-control"
                                    value="{{ $sewa->harga_per_jam }}" required>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Update Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
