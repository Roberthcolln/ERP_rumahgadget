@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0">
                <span class="text-muted fw-light">Stok /</span> Riwayat Transaksi
            </h4>
            <a href="{{ route('stok.index') }}" class="btn btn-secondary shadow-sm">
                <i class="bx bx-arrow-back me-1"></i> Kembali ke Persediaan
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header border-bottom bg-transparent py-3">
                <h6 class="mb-0 fw-bold"><i class="bx bx-list-ul me-2 text-primary"></i>Log Aktivitas Barang Masuk & Keluar
                </h6>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th width="15%">Waktu</th>
                            <th width="15%">No. Bukti</th>
                            <th class="text-center" width="10%">Jenis</th>
                            <th width="15%">Gudang</th>
                            <th width="15%">Pihak Penerima/Asal</th>
                            <th width="15%">Petugas</th>
                            <th class="text-center" width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($history as $h)
                            <tr>
                                <td class="text-center fw-medium">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold text-dark">{{ $h->created_at->format('d/m/Y') }}</span>
                                        <small class="text-muted">{{ $h->created_at->format('H:i') }} WIB</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-label-primary fs-tiny text-uppercase fw-bold">
                                        {{ $h->no_bukti }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($h->jenis == 'masuk')
                                        <span class="badge bg-success shadow-none text-uppercase"
                                            style="font-size: 0.7rem;">
                                            <i class="bx bx-down-arrow-alt me-1"></i> Masuk
                                        </span>
                                    @else
                                        <span class="badge bg-danger shadow-none text-uppercase" style="font-size: 0.7rem;">
                                            <i class="bx bx-up-arrow-alt me-1"></i> Keluar
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $h->gudang->nama_gudang ?? '-' }}</td>
                                <td><span class="text-truncate d-inline-block"
                                        style="max-width: 150px;">{{ $h->pihak_eksternal ?? '-' }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center small">
                                        <i class="bx bx-user-circle me-1 text-secondary"></i>
                                        {{ $h->user->name ?? 'System' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-info"
                                        data-bs-toggle="modal" data-bs-target="#modalDetail{{ $h->id_transaksi }}"
                                        title="Lihat Detail">
                                        <i class="bx bx-show"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bx bx-history fs-1 d-block mb-2"></i>
                                        Belum ada riwayat transaksi stok.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($history as $h)
        <div class="modal fade" id="modalDetail{{ $h->id_transaksi }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                    <div class="modal-header bg-light border-bottom">
                        <div class="modal-title">
                            <h5 class="mb-0 fw-bold">Detail Transaksi</h5>
                            <small class="text-muted">{{ $h->no_bukti }}</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                        <div class="mb-4">
                            <label class="small text-uppercase fw-bold text-muted mb-1 d-block">Catatan Transaksi</label>
                            <p class="p-3 bg-light rounded small mb-0 italic">
                                {{ $h->catatan ?? 'Tidak ada catatan tambahan untuk transaksi ini.' }}
                            </p>
                        </div>

                        <label class="small text-uppercase fw-bold text-muted mb-2 d-block">Daftar Item</label>
                        <div class="table-responsive border rounded">
                            <table class="table table-sm mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3 py-2">Nama Produk</th>
                                        <th class="text-center py-2" width="100">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($h->details as $detail)
                                        <tr>
                                            <td class="ps-3 py-2 fw-medium text-dark">
                                                {{ $detail->produk->nama_produk ?? 'Produk Dihapus' }}</td>
                                            <td class="text-center py-2">
                                                <span class="badge bg-label-dark">{{ $detail->qty }} Item</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer border-top bg-light pt-2 pb-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm"
                            data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        .table thead th {
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        .fs-tiny {
            font-size: 0.7rem !important;
        }

        .bg-label-primary {
            background-color: #e7e7ff !important;
            color: #696cff !important;
        }
    </style>
@endsection
