@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0">
                <span class="text-muted fw-light">Laporan /</span> {{ $title }}
            </h4>
            <div class="d-flex gap-2">
                <a href="{{ route('stok.history') }}" class="btn btn-outline-primary">
                    <i class="bx bx-history me-1"></i> Riwayat Transaksi
                </a>
                <a href="{{ route('stok.masuk') }}" class="btn btn-success">
                    <i class="bx bx-plus-circle me-1"></i> Barang Masuk
                </a>
                <a href="{{ route('stok.keluar') }}" class="btn btn-danger">
                    <i class="bx bx-minus-circle me-1"></i> Barang Keluar
                </a>
            </div>
        </div>

        @if (session('Sukses'))
            <div class="alert alert-success alert-dismissible shadow-sm border-0 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bx bx-check-circle me-2 fs-4"></i>
                    <span>{{ session('Sukses') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('Gagal'))
            <div class="alert alert-danger alert-dismissible shadow-sm border-0 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bx bx-error-circle me-2 fs-4"></i>
                    <span>{{ session('Gagal') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-header border-bottom bg-transparent py-3">
                <h6 class="mb-0 text-primary fw-bold"><i class="bx bx-filter-alt me-2"></i>Filter Pencarian</h6>
            </div>
            <div class="card-body pt-4">
                <form method="GET" action="{{ route('stok.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">NAMA PRODUK</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" name="nama_produk" value="{{ request('nama_produk') }}"
                                class="form-control" placeholder="Cari nama produk...">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">KATEGORI</label>
                        <select name="id_kategori" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id_kategori }}"
                                    {{ request('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">GUDANG</label>
                        <select name="id_gudang" class="form-select">
                            <option value="">Semua Gudang</option>
                            @foreach ($gudang as $g)
                                <option value="{{ $g->id_gudang }}"
                                    {{ request('id_gudang') == $g->id_gudang ? 'selected' : '' }}>
                                    {{ $g->nama_gudang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">RENTANG QTY</label>
                        <div class="input-group">
                            <input type="number" name="qty_min" value="{{ request('qty_min') }}" class="form-control"
                                placeholder="Min">
                            <input type="number" name="qty_max" value="{{ request('qty_max') }}" class="form-control"
                                placeholder="Max">
                        </div>
                    </div>

                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bx bx-check me-1"></i> Terapkan
                        </button>
                        <a href="{{ route('stok.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="bx bx-refresh me-1"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-uppercase">
                        <tr>
                            <th class="text-center" width="70">No</th>
                            <th>Detail Produk</th>
                            <th>Kategori</th>
                            <th>Lokasi Gudang</th>
                            <th class="text-center">Persediaan (Qty)</th>
                            <th class="text-center">Status Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stok as $s)
                            <tr>
                                <td class="text-center fw-medium">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark">{{ $s->produk->nama_produk ?? '-' }}</span>
                                        <small class="text-muted">SKU:
                                            {{ $s->produk->sku ?? 'PROD-' . $s->id_produk }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="badge bg-label-info">{{ $s->produk->kategori->nama_kategori ?? '-' }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-map-pin me-2 text-secondary"></i>
                                        {{ $s->gudang->nama_gudang ?? '-' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="fs-6 fw-bold {{ $s->qty <= 5 ? 'text-danger' : ($s->qty <= 20 ? 'text-warning' : 'text-success') }}">
                                        {{ number_format($s->qty, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($s->qty <= 5)
                                        <span class="badge bg-danger shadow-sm w-px-100">Kritis</span>
                                    @elseif ($s->qty <= 10)
                                        <span class="badge bg-warning shadow-sm w-px-100">Menipis</span>
                                    @else
                                        <span class="badge bg-success shadow-sm w-px-100">Aman</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bx bx-box fs-1 d-block mb-2"></i>
                                        Data persediaan stok tidak ditemukan.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<style>
    .w-px-100 {
        width: 100px;
    }

    .table thead th {
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        font-weight: 700;
    }

    .badge {
        text-transform: uppercase;
        font-weight: 600;
    }
</style>
