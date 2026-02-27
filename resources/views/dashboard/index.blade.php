@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Welcome Card --}}
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card border-0 shadow-none bg-label-primary">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h4 class="card-title text-primary mb-2">
                                    <span id="greeting">Selamat Datang</span>, {{ Auth::user()->name }}! 🚀
                                </h4>
                                <p class="mb-4 text-dark">
                                    Anda masuk ke panel <span
                                        class="fw-bold text-primary">{{ $konf->instansi_setting }}</span>.
                                    Pantau performa bisnis Anda hari ini.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('admin/assets/img/illustrations/man-with-laptop-light.png') }}"
                                    height="140" alt="Illustration" style="transform: scaleX(-1);" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik Cards --}}
        <div class="row mb-4">
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-primary p-2"><i class="bx bx-cart fs-3"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Order Hari Ini</span>
                        <h3 class="card-title mb-2">{{ $totalOrderHariIni }}</h3>
                        <small class="text-muted">Pesanan Masuk</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-success p-2"><i class="bx bx-wallet fs-3"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Omzet</span>
                        <h3 class="card-title mb-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                        <small class="text-muted">Dari Seluruh Pesanan Sukses</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Orders Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header fw-bold"><i class="bx bx-receipt me-2"></i>Pesanan Terbaru</h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Pelanggan</th>
                                    <th>Produk</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($recentOrders as $order)
                                    <tr>
                                        <td><strong>{{ $order->number }}</strong></td>
                                        <td>{{ $order->nama_pelanggan }}</td>
                                        <td>
                                            <small>{{ $order->details->count() }} item</small>
                                        </td>
                                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            @php
                                                $statusClass =
                                                    [
                                                        'pending' => 'bg-label-warning',
                                                        'success' => 'bg-label-success',
                                                        'failed' => 'bg-label-danger',
                                                    ][$order->status_pembayaran] ?? 'bg-label-secondary';
                                            @endphp
                                            <span
                                                class="badge {{ $statusClass }}">{{ ucfirst($order->status_pembayaran) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">Belum ada pesanan terbaru.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
