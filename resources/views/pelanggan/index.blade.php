@extends('layouts.index')

@section('content')
    <div class="container-xxl"><br>

        <h4 class="mb-4">{{ $title }}</h4>

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('pelanggan.index') }}" method="GET" class="row g-3 align-items-end">

                    <div class="col-md-3">
                        <label class="form-label fw-bold">Cari Pelanggan</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Nama atau No. HP..."
                                value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold">Dari Tanggal</label>
                        <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold">Sampai Tanggal</label>
                        <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                    </div>

                    <div class="col-md-5 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-filter-alt me-1"></i> Filter
                        </button>

                        <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">
                            <i class="bx bx-refresh me-1"></i> Reset
                        </a>

                        <button type="button" class="btn btn-info ms-auto" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Data pelanggan otomatis tercatat setiap kali ada transaksi di kasir (POS)">
                            <i class="bx bx-info-circle me-1"></i> Info POS
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="bx bx-list-ul me-2"></i>Daftar Pelanggan</h6>
                <span class="badge bg-primary rounded-pill">
                    Total: {{ $pelanggan->count() }} Pelanggan
                </span>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover table-striped align-middle mb-0" id="tablePelanggan">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th width="15%">Nama Pelanggan</th>
                                <th width="15%">Kontak & Status</th>
                                <th width="15%">Alamat & Wilayah</th>
                                <th width="25%">Detail Pembelian Terakhir</th>
                                <th class="text-center" width="10%">Aktivitas</th>
                                <th width="10%">Total Pembayaran</th>
                                <th width="10%">Loyalitas (Poin)</th>
                                <th class="text-center" width="5%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pelanggan as $p)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xs me-2">
                                                {{-- Warna avatar berubah berdasarkan jenis kelamin --}}
                                                <span
                                                    class="avatar-initial rounded-circle {{ $p->jenis_kelamin == 'P' ? 'bg-label-danger' : 'bg-label-primary' }} text-uppercase">
                                                    {{ substr($p->nama_pelanggan, 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <span class="fw-semibold text-dark d-block">{{ $p->nama_pelanggan }}</span>
                                                <small class="text-muted" style="font-size: 0.7rem;">Lahir:
                                                    {{ $p->tanggal_lahir ? \Carbon\Carbon::parse($p->tanggal_lahir)->format('d/m/Y') : '-' }}</small>
                                            </div>
                                        </div>
                                        <small class="text-muted d-block mt-1">Gabung:
                                            {{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y') }}</small>
                                    </td>
                                    <td>
                                        <small class="d-block"><i
                                                class="bx bx-phone me-1 text-primary"></i>{{ $p->no_hp ?? '-' }}</small>
                                        <small class="d-block"><i
                                                class="bx bx-envelope me-1 text-danger"></i>{{ $p->email ?? '-' }}</small>
                                        {{-- Badge Status --}}
                                        <span
                                            class="badge {{ $p->status == 'Active' ? 'bg-label-success' : 'bg-label-warning' }} btn-sm mt-1"
                                            style="font-size: 0.7rem;">
                                            {{ $p->status ?? 'Pending' }}
                                        </span>
                                    </td>

                                    {{-- Kolom Baru: Alamat & Wilayah --}}
                                    <td>
                                        <small class="text-wrap d-block fw-bold"
                                            style="max-width: 150px;">{{ $p->alamat ?? '-' }}</small>
                                        <div style="font-size: 0.75rem;" class="text-muted mt-1">
                                            {{ $p->kelurahan->nama_kelurahan ?? '' }}<br>
                                            {{ $p->kecamatan->nama_kecamatan ?? '' }}, {{ $p->kota->nama_kota ?? '' }}
                                        </div>
                                    </td>

                                    <td>
                                        @if ($p->penjualan->where('status', 'selesai')->count() > 0)
                                            <div class="p-2 border rounded bg-light"
                                                style="max-height: 250px; overflow-y: auto;">
                                                <ul class="list-unstyled mb-0" style="font-size: 0.8rem;">
                                                    @foreach ($p->penjualan->where('status', 'selesai')->sortByDesc('tanggal_penjualan') as $jual)
                                                        <li class="mb-3 p-2 border-bottom bg-white rounded shadow-sm">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-1">
                                                                <small class="fw-bold text-primary">
                                                                    {{ \Carbon\Carbon::parse($jual->tanggal_penjualan)->format('d/m/Y') }}
                                                                    - {{ $jual->kode_invoice }}
                                                                </small>
                                                            </div>

                                                            @foreach ($jual->detail as $dtl)
                                                                <div class="ms-2 mb-1 border-bottom-dashed">
                                                                    <i class="bx bx-check-circle text-success"
                                                                        style="font-size: 0.7rem;"></i>
                                                                    <strong>{{ $dtl->qty }}x</strong>
                                                                    {{ $dtl->produk->nama_produk ?? 'Produk Dihapus' }}
                                                                    <div class="text-muted ms-3"
                                                                        style="font-size: 0.75rem;">
                                                                        @ Rp {{ number_format($dtl->harga, 0, ',', '.') }}
                                                                        <span>(Sub: Rp
                                                                            {{ number_format($dtl->subtotal, 0, ',', '.') }})</span>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                            <div class="mt-2 pt-1 border-top text-end">
                                                                <small class="text-dark fw-bold">Total Transaksi:
                                                                    <span class="text-danger">Rp
                                                                        {{ number_format($jual->total, 0, ',', '.') }}</span>
                                                                </small>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @else
                                            <span class="text-muted small italic">Belum ada riwayat pembelian</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-label-primary px-3">
                                            <i class="bx bx-cart-alt me-1"></i> {{ $p->penjualan_count }} Trx
                                        </span>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-dark">
                                                Rp
                                                {{ number_format($p->penjualan->where('status', 'selesai')->sum('total'), 0, ',', '.') }}
                                            </span>
                                            <small class="text-muted" style="font-size: 0.7rem;">Akumulasi Belanja</small>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="badge {{ $p->level_color }} mb-1">
                                                <i class="bx bxs-medal me-1"></i> {{ $p->level }}
                                            </span>
                                            <small class="fw-bold text-dark">
                                                <i class="bx bx-カスタマー me-1"></i>
                                                {{ number_format($p->point, 0, ',', '.') }} Poin
                                            </small>
                                            @php
                                                // Hitung nilai cashback (Contoh: 1 poin = Rp 10)
                                                $cashback = $p->point * 10;
                                            @endphp
                                            <small class="text-success" style="font-size: 0.7rem;">
                                                Tukar: Rp {{ number_format($cashback, 0, ',', '.') }}
                                            </small>
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}" method="POST"
                                            class="d-inline-block shadow-none"
                                            onsubmit="return confirm('Hapus data pelanggan ini? Riwayat transaksi lama akan tetap tersimpan tetapi profil pelanggan akan dihapus.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-sm btn-outline-danger"
                                                title="Hapus">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">Data pelanggan tidak ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            if ($('#tablePelanggan tbody tr').length > 10) {
                $('#tablePelanggan').DataTable({
                    "paging": true,
                    "ordering": true,
                    "info": true,
                    "searching": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                    }
                });
            }
        });
    </script>
@endpush
