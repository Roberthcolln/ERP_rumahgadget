@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Laporan /</span> {{ $title }}
            </h4>
            <div class="text-muted small">
                <i class="bx bx-calendar me-1"></i> {{ date('d M Y') }}
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="badge bg-label-primary p-2 rounded-3 me-3">
                                <i class="bx bx-cart-alt fs-3"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted small">Total Transaksi</p>
                                <h5 class="mb-0 fw-bold">{{ $laporanAll->count() }} Transaksi</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="badge bg-label-success p-2 rounded-3 me-3">
                                <i class="bx bx-wallet fs-3"></i>
                            </div>
                            @php
                                $totalIncome = $laporanAll->sum('total');
                            @endphp
                            <div>
                                <p class="mb-0 text-muted small">Akumulasi Penghasilan</p>
                                <h5 class="mb-0 fw-bold text-success">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4 border-0 shadow-sm rounded-4">
            <div class="card-body">
                <form action="{{ route('laporan.filter') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Dari Tanggal</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Sampai Tanggal</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Region</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-map"></i></span>
                            <select name="id_region" class="form-select">
                                <option value="">-- Semua Region --</option>
                                @foreach ($regions as $reg)
                                    <option value="{{ $reg->id_region }}"
                                        {{ request('id_region') == $reg->id_region ? 'selected' : '' }}>
                                        {{ $reg->nama_region }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary shadow-sm w-100">
                            <i class="bx bx-filter-alt me-1"></i> Filter
                        </button>
                    </div>

                    <div class="col-12 d-flex gap-2 mt-3">
                        <a href="{{ route('laporan.pdf', [
                            'from' => request('from'),
                            'to' => request('to'),
                            'id_region' => request('id_region'),
                        ]) }}"
                            class="btn btn-outline-danger px-4 shadow-sm">
                            <i class="bx bxs-file-pdf me-1"></i> Export PDF
                        </a>

                        <a href="{{ route('laporan.index') }}" class="btn btn-label-secondary px-4">
                            <i class="bx bx-refresh me-1"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark"><i class="bx bx-list-ul me-2"></i>Riwayat Penjualan</h5>
                @if (request('from'))
                    <span class="text-muted small">Menampilkan: <b>{{ request('from') }}</b> s/d
                        <b>{{ request('to') }}</b></span>
                @endif
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center py-3" width="70">No</th>
                            <th>Tanggal</th>
                            <th>Kode Invoice</th>
                            <th>Nominal Pembayaran</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporanAll as $p)
                            <tr>
                                <td class="text-center text-muted fw-medium">{{ $loop->iteration }}</td>
                                <td>
                                    <span
                                        class="d-block fw-bold text-dark">{{ \Carbon\Carbon::parse($p->created_at)->format('d M Y') }}</span>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($p->created_at)->format('H:i') }}
                                        WIB</small>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="fw-bold d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#detailModal{{ $p->id_penjualan }}">
                                        <i class="bx bx-receipt me-2 text-primary"></i> {{ $p->kode_invoice }}
                                    </a>
                                </td>
                                <td class="fw-bold text-dark">
                                    Rp {{ number_format($p->total, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    @if ($p->status == 'selesai')
                                        <span class="badge bg-label-success px-3">Selesai</span>
                                    @elseif($p->status == 'batal')
                                        <span class="badge bg-label-danger px-3">Batal</span>
                                    @else
                                        <span class="badge bg-label-secondary px-3">{{ ucfirst($p->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <img src="https://illustrations.popsy.co/gray/no-data-found.svg" alt="no-data"
                                        width="150" class="mb-3">
                                    <p class="text-muted mb-0">Tidak ada data laporan ditemukan untuk periode ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @foreach ($laporanAll as $p)
            <div class="modal fade" id="detailModal{{ $p->id_penjualan }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header bg-dark p-4">
                            <div class="modal-title text-white">
                                <h5 class="mb-0 text-white fw-bold">Rincian Invoice</h5>
                                <small class="opacity-75">No: {{ $p->kode_invoice }}</small>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row mb-4">
                                <div class="col-6">
                                    <p class="text-muted mb-1 small text-uppercase fw-bold">Waktu Transaksi</p>
                                    <p class="mb-0 fw-bold">
                                        {{ \Carbon\Carbon::parse($p->created_at)->format('d F Y, H:i') }}</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="text-muted mb-1 small text-uppercase fw-bold">Status Pembayaran</p>
                                    <h6 class="mb-0 text-success fw-bold">{{ strtoupper($p->status) }}</h6>
                                </div>
                            </div>

                            <div class="table-responsive rounded-3 border">
                                <table class="table table-borderless align-middle mb-0">
                                    <thead class="bg-light border-bottom">
                                        <tr>
                                            <th class="py-3">Produk / Jasa</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-end">Harga</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($p->detail as $d)
                                            <tr class="border-bottom">
                                                <td class="py-3 fw-semibold text-dark">
                                                    {{ $d->produk->nama_produk ?? '-' }}</td>
                                                <td class="text-center"><span
                                                        class="badge bg-secondary rounded-pill">{{ $d->qty }}</span>
                                                </td>
                                                <td class="text-end">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                                                <td class="text-end fw-bold">Rp
                                                    {{ number_format($d->subtotal, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-light fw-bold">
                                        <tr>
                                            <td colspan="3" class="text-end py-3">Total Akhir</td>
                                            <td class="text-end text-primary fs-5 py-3">Rp
                                                {{ number_format($p->total, 0, ',', '.') }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer border-0 p-4">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                            <a href="{{ route('laporan.pdf', ['id' => $p->id_penjualan]) }}" class="btn btn-primary"><i
                                    class="bx bx-printer me-1"></i> Cetak Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
