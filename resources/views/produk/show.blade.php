@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Produk /</span> Detail #{{ $produk->id_produk }}
            </h4>
            <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="product-img-wrapper text-center mb-3">
                            <img src="{{ $produk->gambar_produk ? asset('file/produk/' . $produk->gambar_produk) : 'https://placehold.co/400x400?text=No+Image' }}"
                                alt="{{ $produk->nama_produk }}" class="img-fluid rounded border shadow-sm"
                                style="max-height: 350px; object-fit: contain;">
                        </div>
                        <h4 class="text-center fw-bold mb-1">{{ $produk->nama_produk }}</h4>
                        <p class="text-center text-muted mb-3">{{ $produk->tipe->nama_tipe ?? '-' }}</p>

                        <div class="d-flex justify-content-around border-top pt-3">
                            <div class="text-center">
                                <small class="text-muted d-block">Total Stok</small>
                                <span class="badge bg-label-primary fs-6">{{ $produk->total_stok }} Unit</span>
                            </div>
                            <div class="text-center">
                                <small class="text-muted d-block">Kategori</small>
                                <span
                                    class="badge bg-label-secondary fs-6">{{ $produk->kategori->nama_kategori ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($produk->promo)
                    <div class="card mb-4 border-2 border-success shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bx bxs-offer text-success fs-3 me-2"></i>
                                <h5 class="mb-0 text-success fw-bold">Promo Aktif</h5>
                            </div>
                            <div class="alert alert-success mb-0 py-2">
                                <p class="mb-1 fw-bold">{{ $produk->promo->nama_promo }}</p>
                                <p class="mb-0 small">{{ $produk->promo->label_diskon }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-xl-8 col-lg-7 col-md-7">
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-spesifikasi">Spesifikasi</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-stok">Lokasi Stok</button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-deskripsi">Deskripsi</button>
                        </li>
                    </ul>

                    <div class="tab-content border-0 shadow-sm p-0 bg-transparent">
                        <div class="tab-pane fade show active" id="navs-spesifikasi" role="tabpanel">
                            <div class="card shadow-none border">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-4">Informasi Produk & Harga</h5>
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <small class="text-muted d-block">Jenis Produk</small>
                                            <p class="fw-medium text-dark">{{ $produk->jenis->nama_jenis ?? '-' }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <small class="text-muted d-block">Varian (RAM/Internal)</small>
                                            <p class="fw-medium text-dark">{{ $produk->varian->nama_varian ?? '-' }}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <small class="text-muted d-block">Warna</small>
                                            <p class="fw-medium text-dark"><i
                                                    class="bx bx-palette me-1"></i>{{ $produk->warna->nama_warna ?? '-' }}
                                            </p>
                                        </div>
                                        <div class="col-sm-6">
                                            <small class="text-muted d-block">Supplier</small>
                                            <p class="fw-medium text-dark">{{ $produk->supplier->nama_supplier ?? '-' }}
                                            </p>
                                        </div>

                                        <div class="col-12 mt-2">
                                            <hr class="my-2">
                                        </div>

                                        <div class="col-sm-4">
                                            <small class="text-muted d-block">Harga Modal (HPP)</small>
                                            <p class="fw-bold text-danger">Rp
                                                {{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="col-sm-4">
                                            <small class="text-muted d-block">Harga Jual Normal</small>
                                            <p class="fw-bold text-primary fs-5">Rp
                                                {{ number_format($produk->harga_jual_produk, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="col-sm-4">
                                            <small class="text-muted d-block">Harga Promo (Manual)</small>
                                            <p class="fw-bold text-warning">Rp
                                                {{ number_format($produk->harga_promo_produk, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="navs-stok" role="tabpanel">
                            <div class="card shadow-none border">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nama Gudang</th>
                                                <th>Lokasi</th>
                                                <th>Stok Tersedia</th>
                                                <th>Terakhir Update</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($produk->gudang as $g)
                                                <tr>
                                                    <td><span class="fw-bold">{{ $g->nama_gudang }}</span></td>
                                                    <td><small>{{ $g->alamat_gudang ?? 'Gudang Utama' }}</small></td>
                                                    <td><span class="badge bg-label-success">{{ $g->pivot->qty }}
                                                            Unit</span></td>
                                                    <td><small
                                                            class="text-muted">{{ $g->pivot->updated_at ? $g->pivot->updated_at->format('d M Y H:i') : '-' }}</small>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-3">Belum ada data stok di
                                                        gudang manapun.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="navs-deskripsi" role="tabpanel">
                            <div class="card shadow-none border">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-3">Deskripsi Produk</h5>
                                    <div class="text-dark" style="line-height: 1.6;">
                                        {!! $produk->deskripsi_produk ?? '<span class="text-muted italic">Tidak ada deskripsi produk.</span>' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-none border bg-light">
                    <div class="card-body d-flex gap-2">
                        <a href="{{ route('produk.edit', $produk->id_produk) }}" class="btn btn-warning">
                            <i class="bx bx-edit-alt me-1"></i> Edit Data
                        </a>
                        <button type="button" class="btn btn-outline-primary" onclick="window.print()">
                            <i class="bx bx-printer me-1"></i> Cetak Label
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
