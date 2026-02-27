@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaksi /</span> {{ $title }}</h4>

        {{-- Filter Section --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('order.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Cari Transaksi</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Invoice atau Nama..."
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Dari</label>
                        <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-bold">Sampai</label>
                        <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="bx bx-filter-alt me-1"></i>
                            Filter</button>
                        <a href="{{ route('order.index') }}" class="btn btn-outline-secondary px-3"><i
                                class="bx bx-refresh"></i></a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h6 class="mb-0 fw-bold"><i class="bx bx-list-ul me-2"></i>Riwayat Pembelian</h6>
                <span class="badge bg-label-primary rounded-pill">Total: {{ $orders->total() }} Transaksi</span>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" width="5%">No</th>
                            <th>Invoice & Tanggal</th>
                            <th>Pelanggan</th>
                            <th>Detail Produk</th>
                            <th>Total Bayar</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $o)
                            @php
                                // Logic warna status dipindah ke atas agar rapi
                                $statusMap = [
                                    'pending' => ['class' => 'bg-label-warning', 'label' => 'Menunggu'],
                                    'success' => ['class' => 'bg-label-success', 'label' => 'Selesai'],
                                    'failed' => ['class' => 'bg-label-danger', 'label' => 'Gagal'],
                                ];
                                $currentStatus = $statusMap[$o->status_pembayaran] ?? [
                                    'class' => 'bg-label-secondary',
                                    'label' => $o->status_pembayaran,
                                ];
                            @endphp
                            <tr>
                                <td class="text-center text-muted">
                                    {{ ($orders->currentPage() - 1) * $orders->perPage() + $loop->iteration }}
                                </td>
                                <td>
                                    <span class="fw-bold d-block text-dark">{{ $o->number }}</span>
                                    <small class="text-muted"><i class="bx bx-calendar-alt small"></i>
                                        {{ $o->created_at->format('d/m/Y H:i') }}</small>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $o->nama_pelanggan }}</div>
                                    <small class="text-muted"><i class="bx bx-map small"></i>
                                        {{ $o->alamat }}</small><br>
                                    <small class="text-muted"><i class="bx bx-phone small"></i> {{ $o->whatsapp }}</small>
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0 small">
                                        @foreach ($o->details->take(2) as $dtl)
                                            <li class="d-flex align-items-center mb-1">
                                                {{-- Logic Gambar: Cek foto di detail dulu, kalau null cek ke relasi produk --}}
                                                <img src="{{ $dtl->product?->gambar_produk ? asset('file/produk/' . $dtl->product->gambar_produk) : asset('assets/img/illustrations/default-device.png') }}"
                                                    onerror="this.onerror=null; this.src='{{ asset('assets/img/illustrations/default-device.png') }}';"
                                                    alt="product" class="rounded me-2 shadow-sm" width="28"
                                                    height="28" style="object-fit: cover;">
                                                <span class="text-truncate" style="max-width: 150px;">{{ $dtl->qty }}x
                                                    {{ $dtl->nama_produk }}</span>
                                            </li>
                                        @endforeach

                                        @if ($o->details->count() > 2)
                                            <li class="text-muted ps-4 small font-italic">...
                                                (+{{ $o->details->count() - 2 }} item lainnya)
                                            </li>
                                        @endif

                                        {{-- Sesuai preferensi Anda: Tampilkan info Trade-in jika ada --}}
                                        @if ($o->hp_lama)
                                            <li class="mt-1">
                                                <span class="badge bg-label-info" style="font-size: 0.65rem;">
                                                    <i class="bx bx-repost"></i> Tukar Tambah: {{ $o->hp_lama }}
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </td>
                                <td>
                                    <span class="fw-bold text-primary">Rp
                                        {{ number_format($o->total_harga, 0, ',', '.') }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $currentStatus['class'] }}">{{ $currentStatus['label'] }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded fs-5"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                data-bs-target="#modalDetail{{ $o->id }}">
                                                <i class="bx bx-show me-2"></i> Detail Order
                                            </a>
                                            <a class="dropdown-item text-success"
                                                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $o->whatsapp) }}"
                                                target="_blank">
                                                <i class="bx bxl-whatsapp me-2"></i> Hubungi WA
                                            </a>
                                            <div class="dropdown-divider"></div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <img src="{{ $dtl->product?->gambar_produk ? asset('file/produk/' . $dtl->product->gambar_produk) : asset('assets/img/illustrations/default-device.png') }}"
                                        onerror="this.onerror=null; this.src='{{ asset('assets/img/illustrations/default-device.png') }}';"
                                        alt="product" class="rounded me-2 shadow-sm" width="28" height="28"
                                        style="object-fit: cover;">
                                    <p class="text-muted">Tidak ada data transaksi yang ditemukan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-top">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    {{-- Modal Details --}}
    @foreach ($orders as $o)
        <div class="modal fade" id="modalDetail{{ $o->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title text-white fw-bold"><i class="bx bx-receipt me-2"></i>Invoice
                            #{{ $o->number }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="text-muted d-block small fw-bold">WAKTU TRANSAKSI</label>
                                <span class="fw-semibold">{{ $o->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="col-6 text-end">
                                <label class="text-muted d-block small fw-bold">STATUS PEMBAYARAN</label>
                                <span
                                    class="badge {{ $statusMap[$o->status_pembayaran]['class'] ?? 'bg-label-secondary' }}">
                                    {{ $statusMap[$o->status_pembayaran]['label'] ?? $o->status_pembayaran }}
                                </span>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded-3 mb-4">
                            <h6 class="fw-bold mb-3 small text-uppercase text-primary">Informasi Pelanggan</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Nama</span>
                                <span class="fw-semibold">{{ $o->nama_pelanggan }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Alamat</span>
                                <span class="fw-semibold">{{ $o->alamat }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">WhatsApp</span>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $o->whatsapp) }}" target="_blank"
                                    class="fw-semibold">{{ $o->whatsapp }}</a>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-2 small text-uppercase text-primary">Item Pesanan</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless align-middle">
                                <thead>
                                    <tr class="border-bottom text-muted" style="font-size: 0.75rem;">
                                        <th>PRODUK</th>
                                        <th class="text-center">QTY</th>
                                        <th class="text-end">SUBTOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders->find($o->id)->details as $dtl)
                                        <tr class="border-bottom">
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $dtl->product?->gambar_produk ? asset('file/produk/' . $dtl->product->gambar_produk) : asset('assets/img/illustrations/default-device.png') }}"
                                                        onerror="this.onerror=null; this.src='{{ asset('assets/img/illustrations/default-device.png') }}';"
                                                        alt="product" class="rounded me-2 shadow-sm" width="28"
                                                        height="28" style="object-fit: cover;">
                                                    <div>
                                                        <div class="fw-bold small text-wrap" style="max-width: 150px;">
                                                            {{ $dtl->nama_produk }}</div>
                                                        <small class="text-muted">Rp
                                                            {{ number_format($dtl->harga, 0, ',', '.') }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ $dtl->qty }}</td>
                                            <td class="text-end fw-semibold">Rp
                                                {{ number_format($dtl->harga * $dtl->qty, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    @if ($o->hp_lama)
                                        <tr class="table-warning border-top">
                                            <td colspan="2" class="py-2 small">
                                                <strong>Tukar Tambah (HP Lama):</strong><br>{{ $o->hp_lama }}
                                            </td>
                                            <td class="text-end text-danger fw-bold">- Potongan</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th colspan="2" class="pt-4 h6 mb-0">TOTAL BAYAR</th>
                                        <th class="text-end pt-4 h5 text-primary fw-bold">Rp
                                            {{ number_format($o->total_harga, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer border-top bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $o->whatsapp) }}" target="_blank"
                            class="btn btn-success">
                            <i class="bx bxl-whatsapp me-1"></i> Chat Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
