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

        {{-- Filter Section --}}
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('dashboard.index') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Dari Tanggal</label>
                        <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Sampai Tanggal</label>
                        <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="bx bx-filter-alt me-1"></i>
                            Filter</button>
                        <a href="{{ route('dashboard.index') }}" class="btn btn-outline-secondary"><i
                                class="bx bx-refresh"></i></a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Statistik Cards --}}
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="avatar flex-shrink-0 mb-3">
                            <span class="badge bg-label-primary p-2"><i class="bx bx-cart fs-3"></i></span>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Order</span>
                        <h3 class="card-title mb-2">{{ $totalOrder }}</h3>
                        <small class="text-muted">{{ $labelStats }}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <div class="avatar flex-shrink-0 mb-3">
                            <span class="badge bg-label-success p-2"><i class="bx bx-wallet fs-3"></i></span>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Pendapatan</span>
                        <h3 class="card-title mb-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                        <small class="text-muted">{{ $labelStats }}</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Orders Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <h5 class="card-header fw-bold"><i class="bx bx-receipt me-2"></i>Daftar Pesanan {{ $labelStats }}
                    </h5>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Invoice</th>
                                    <th>Pelanggan</th>
                                    <th>Item</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentOrders as $order)
                                    <tr>
                                        <td><strong>{{ $order->number }}</strong></td>
                                        <td>{{ $order->nama_pelanggan }}</td>
                                        <td><span class="badge bg-label-info">{{ $order->details->count() }} item</span>
                                        </td>
                                        <td class="fw-bold">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
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
