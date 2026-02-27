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
                <form action="{{ route('sewa.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        {{-- Pilih Produk --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Pilih iPhone (Kategori Apple)</label>
                            <select name="id_produk" class="form-select @error('id_produk') is-invalid @enderror" required>
                                <option value="">-- Pilih Produk --</option>
                                @foreach ($produk as $p)
                                    <option value="{{ $p->id_produk }}"
                                        {{ old('id_produk') == $p->id_produk ? 'selected' : '' }}>
                                        {{ $p->nama_produk }} ({{ $p->varian->nama_varian ?? '-' }} /
                                        {{ $p->warna->nama_warna ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Baris Harga --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga 24 Jam</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_24_jam" class="form-control" placeholder="0"
                                    value="{{ old('harga_24_jam') }}" required>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga 2 Hari</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_2_hari" class="form-control" placeholder="0"
                                    value="{{ old('harga_2_hari') }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga 3 Hari</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_3_hari" class="form-control" placeholder="0"
                                    value="{{ old('harga_3_hari') }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga 7 Hari (1 Minggu)</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_7_hari" class="form-control" placeholder="0"
                                    value="{{ old('harga_7_hari') }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga 14 Hari</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_14_hari" class="form-control" placeholder="0"
                                    value="{{ old('harga_14_hari') }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Harga 1 Bulan</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_1_bulan" class="form-control" placeholder="0"
                                    value="{{ old('harga_1_bulan') }}">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold text-danger">Denda / Harga per Jam</label>
                            <div class="input-group input-group-merge border-danger">
                                <span class="input-group-text text-danger">Rp</span>
                                <input type="number" name="harga_per_jam" class="form-control" placeholder="0"
                                    value="{{ old('harga_per_jam') }}" required>
                            </div>
                            <small class="text-muted">Biaya keterlambatan per jam</small>
                        </div>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary px-4">Simpan Data Sewa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
