@extends('layouts.index')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            @if (auth()->user()->jabatan == 'Admin')

                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body py-3">
                                <form method="GET" action="{{ route('dashboard.index') }}" id="filterForm">
                                    <div class="d-flex flex-wrap align-items-center gap-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm flex-shrink-0">
                                                <span class="avatar-initial rounded bg-label-primary">
                                                    <i class="bx bx-filter-alt"></i>
                                                </span>
                                            </div>
                                            <label for="region_id" class="fw-bold text-dark mb-0">Filter Data
                                            </label>
                                        </div>

                                        <div class="d-none d-md-block border-start h-px-30 mx-2"></div>

                                        <div class="flex-grow-1 flex-md-grow-0" style="min-width: 250px;">
                                            <select name="region_id" id="region_id" class="form-select border-primary-focus"
                                                onchange="this.form.submit()">
                                                <option value="">📍 Semua Lokasi/ Region</option>
                                                @foreach ($regions as $region)
                                                    <option value="{{ $region->id_region }}"
                                                        {{ $selectedRegionId == $region->id_region ? 'selected' : '' }}>
                                                        📍 {{ $region->nama_region }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        @if ($selectedRegionId)
                                            <a href="{{ route('dashboard.index') }}" class="btn btn-icon btn-outline-danger"
                                                data-bs-toggle="tooltip" title="Reset Filter">
                                                <i class="bx bx-refresh"></i>
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Welcome Card -->
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
                                            Pantau performa bisnis dan kelola data Anda dengan mudah hari ini.
                                        </p>

                                        {{-- <div class="d-flex gap-3 align-items-center mb-2">
                                            <div class="badge bg-white text-primary p-2 rounded shadow-sm">
                                                <i class="bx bx-calendar me-1"></i> {{ date('d M Y') }}
                                            </div>
                                            <div class="badge bg-white text-primary p-2 rounded shadow-sm">
                                                <i class="bx bx-time me-1"></i> <span id="realtime-clock">00:00:00</span>
                                            </div>
                                        </div>

                                        <a href="#" class="btn btn-sm btn-primary mt-2">Lihat
                                            Profil</a> --}}
                                    </div>
                                </div>
                                <div class="col-sm-5 text-center text-sm-left">
                                    <div class="card-body pb-0 px-0 px-md-4">
                                        <img src="{{ asset('admin/assets/img/illustrations/man-with-laptop-light.png') }}"
                                            height="170" alt="Dashboard Welcome Illustration"
                                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                            data-app-light-img="illustrations/man-with-laptop-light.png"
                                            style="transform: scaleX(-1);" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- HEADER RINGKASAN KEUANGAN - Premium Style -->
                <div class="row g-4 mb-6">
                    <div class="col-xl-4 col-md-6">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all hover-lift">
                            <div class="card-body bg-gradient-primary text-white p-4 position-relative">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <small class="text-white-75 fw-medium d-block mb-1">Penghasilan Hari Ini <br>
                                            {{ now()->format('d M Y') }}</small>
                                        <h3 class="mb-0 fw-bold text-white">Rp
                                            {{ number_format($income['today'] ?? 0, 0, ',', '.') }}</h3>
                                    </div>
                                    <div
                                        class="avatar avatar-xl bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bx-money bx-lg text-black"
                                            style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.995);"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all hover-lift">
                            <div class="card-body bg-gradient-info text-white p-4 position-relative">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        @php
                                            // Hitung tanggal minggu ini (Senin - Minggu)
                                            $startOfWeek = \Carbon\Carbon::now()->startOfWeek()->format('d M Y');
                                            $endOfWeek = \Carbon\Carbon::now()->endOfWeek()->format('d M Y');
                                        @endphp
                                        <small class="text-white-75 fw-medium d-block mb-1">
                                            Penghasilan Minggu Ini <br>
                                            {{ $startOfWeek }} - {{ $endOfWeek }}
                                        </small>
                                        <h3 class="mb-0 fw-bold text-white">Rp
                                            {{ number_format($income['this_week'] ?? 0, 0, ',', '.') }}
                                        </h3>
                                    </div>
                                    <div
                                        class="avatar avatar-xl bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bx-money bx-lg text-black"
                                            style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.995);"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-12">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all hover-lift">
                            <div class="card-body bg-gradient-warning text-dark p-4 position-relative">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <small class="text-dark-75 fw-medium d-block mb-1">Penghasilan Bulan ini
                                            <br>{{ now()->format('M Y') }}</small>
                                        <h3 class="mb-0 fw-bold text-white">Rp
                                            {{ number_format($income['this_month'] ?? 0, 0, ',', '.') }}
                                        </h3>
                                    </div>
                                    <div
                                        class="avatar avatar-xl bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bx-money bx-lg text-black"
                                            style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.995);"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <br>

                <!-- CHART SECTION - Modern Layout -->
                <div class="row g-4 mb-6">
                    <div class="col-xl-8 col-lg-7">
                        <div class="card border-0 shadow-lg rounded-4 h-100">
                            <div
                                class="card-header bg-white border-0 d-flex align-items-center justify-content-between px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-line-chart bx-md text-primary me-2"></i>
                                    <div>
                                        <h5 class="mb-0 fw-semibold text-dark">Tren Pendapatan</h5>
                                        <small class="text-muted">7 Hari Terakhir</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3">
                                        <i class="bx bx-refresh me-1"></i>{{ now()->format('H:i') }}
                                    </span>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <div id="revenueChart" style="min-height: 450px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-5">
                        <div class="d-flex flex-column gap-4 h-100">

                            <div class="card border-0 shadow-lg rounded-4 flex-fill">
                                <div class="card-header bg-white border-0 px-4 py-3 pb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-bar-chart-alt-2 bx-sm text-success me-2"></i>
                                        <h6 class="mb-0 fw-semibold text-dark">Unit Terjual (7 Hari)</h6>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div id="soldChart" style="height: 180px;"></div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-lg rounded-4 flex-fill">
                                <div class="card-header bg-white border-0 px-4 py-3 pb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-donate-heart bx-sm text-danger me-2"></i>
                                        <h6 class="mb-0 fw-semibold text-dark">Top Produk Bulan Ini</h6>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div id="topProductsChart" style="height: 180px; overflow: hidden;"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <br>

                <!-- STOK & UNIT TERJUAL - Berdampingan & Elegan -->
                <div class="row g-4 mb-6">
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-lg rounded-4 h-100">
                            <div
                                class="card-header bg-white border-0 d-flex align-items-center justify-content-between px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-package bx-md text-primary me-2"></i>
                                    <h5 class="mb-0 fw-semibold text-dark">Stok Tersedia Saat Ini</h5>
                                </div>
                                <small class="text-muted">Total: {{ number_format($totalStock ?? 0) }} unit</small>
                            </div>

                            <div class="card-body p-0" style="max-height: 400px; overflow-y: auto;">
                                @if ($produkStok->isEmpty())
                                    <div class="text-center py-5 text-muted">
                                        <i class="bx bx-package bx-lg mb-3 opacity-50"></i><br>
                                        Belum ada produk terdaftar
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="bg-light sticky-top" style="z-index: 1;">
                                                <tr>
                                                    <th class="ps-4 py-3">Produk</th>
                                                    <th class="text-center py-3">Stok</th>
                                                    <th class="ps-4 py-3">Gudang</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($produkStok as $produk)
                                                    @php
                                                        $stokQty = $produk->stok_total ?? 0;
                                                        if ($produk->stok && $produk->stok->isNotEmpty()) {
                                                            $stokGudang = $produk->stok
                                                                ->map(function ($s) {
                                                                    return $s->gudang?->nama_gudang ??
                                                                        '(Gudang tidak ditemukan)';
                                                                })
                                                                ->implode(', ');
                                                        } else {
                                                            $stokGudang = '-';
                                                        }
                                                    @endphp
                                                    <tr class="hover-bg-light transition-all">
                                                        <td class="ps-4 py-3">
                                                            <span
                                                                class="fw-medium text-dark">{{ $produk->nama_produk }}</span>
                                                        </td>
                                                        <td class="text-center py-3">
                                                            @if ($stokQty <= 5)
                                                                <span
                                                                    class="badge bg-danger-subtle text-danger px-3 py-2 fs-6 fw-bold">{{ $stokQty }}</span>
                                                            @elseif ($stokQty <= 20)
                                                                <span
                                                                    class="badge bg-warning-subtle text-warning px-3 py-2 fs-6 fw-bold">{{ $stokQty }}</span>
                                                            @else
                                                                <span
                                                                    class="badge bg-success-subtle text-success px-3 py-2 fs-6 fw-bold">{{ $stokQty }}</span>
                                                            @endif
                                                            <small class="ms-1 text-muted">unit</small>
                                                        </td>
                                                        <td class="ps-4 py-3">
                                                            <small class="text-muted">{{ $stokGudang }}</small>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer bg-white border-0 py-2"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card border-0 shadow-lg rounded-4 h-100">
                            <div class="card-header bg-white border-0 px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-cart bx-md text-info me-2"></i>
                                    <h5 class="mb-0 fw-semibold text-dark">Unit Terjual</h5>
                                </div>
                            </div>
                            <div class="card-body p-4 d-flex flex-column justify-content-center">
                                <div class="list-group list-group-flush">
                                    <div
                                        class="list-group-item px-0 py-3 border-0 d-flex justify-content-between align-items-center">
                                        <span class="text-muted fs-5">Hari ini</span>
                                        <strong
                                            class="fs-4 text-primary">{{ number_format($sold['today'] ?? 0) }}</strong>
                                    </div>
                                    <div
                                        class="list-group-item px-0 py-3 border-0 d-flex justify-content-between align-items-center">
                                        <span class="text-muted fs-5">Minggu ini</span>
                                        <strong
                                            class="fs-4 text-primary">{{ number_format($sold['this_week'] ?? 0) }}</strong>
                                    </div>
                                    <div
                                        class="list-group-item px-0 py-3 border-0 d-flex justify-content-between align-items-center">
                                        <span class="text-muted fs-5">Bulan ini</span>
                                        <strong
                                            class="fs-4 text-primary">{{ number_format($sold['this_month'] ?? 0) }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <br>

                <!-- PRODUK TERLARIS - Card Modern -->
                <div class="card border-0 shadow-lg rounded-4 mb-4">
                    <div class="card-header bg-white border-0 px-4 py-3 d-flex align-items-center">
                        <i class="bx bx-star bx-md text-warning me-2"></i>
                        <h5 class="mb-0 fw-semibold text-dark">Produk Terlaris</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            @foreach (['today' => 'Hari ini', 'this_week' => 'Minggu ini', 'this_month' => 'Bulan ini'] as $key => $label)
                                <div class="col-lg-4">
                                    <div class="card border-0 shadow-sm rounded-3 h-100 transition-all hover-lift">
                                        <div class="card-header bg-light border-0 px-4 py-3 sticky-top"
                                            style="border-radius: 12px 12px 0 0;">
                                            <h6 class="mb-0 fw-bold text-dark text-uppercase small"
                                                style="letter-spacing: 1px;">{{ $label }}</h6>
                                        </div>

                                        <div class="card-body p-0"
                                            style="max-height: 350px; overflow-y: auto; overflow-x: hidden;">
                                            @if ($topProducts[$key]->isEmpty())
                                                <div class="text-center py-5 text-muted">
                                                    <i class="bx bx-shopping-bag bx-lg mb-2 opacity-50"></i><br>
                                                    <span class="small">Belum ada penjualan</span>
                                                </div>
                                            @else
                                                <div class="list-group list-group-flush">
                                                    @foreach ($topProducts[$key] as $item)
                                                        <div
                                                            class="list-group-item px-4 py-3 border-0 border-bottom d-flex justify-content-between align-items-center hover-bg-light transition-all">
                                                            <div class="me-2 text-truncate" style="max-width: 70%;">
                                                                <span class="text-dark fw-medium d-block text-truncate"
                                                                    title="{{ $item->produk?->nama_produk }}">
                                                                    {{ $item->produk?->nama_produk ?? '(Produk tidak ditemukan)' }}
                                                                </span>
                                                            </div>
                                                            <span
                                                                class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-bold">
                                                                {{ number_format($item->total_qty) }}×
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <div class="card-footer bg-white border-0 py-2"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @elseif(auth()->user()->jabatan == 'Kasir')
                <!-- Welcome Card -->
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="card bg-label-primary border-0 shadow-sm" style="overflow: hidden;">
                            <div class="d-flex align-items-center row">
                                <div class="col-sm-8">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-wrap mb-2">
                                            <h4 class="card-title text-primary mb-0 me-2">
                                                <span id="greeting">Selamat Datang</span>, {{ Auth::user()->name }}! 🎊
                                            </h4>
                                            <span class="badge bg-white text-info shadow-sm border-0 py-2 px-3">
                                                <i class="bx bx-briefcase-alt-2 me-1"></i>
                                                {{ auth()->user()->jabatan }}
                                            </span>
                                        </div>

                                        <p class="mb-3">
                                            Anda terhubung dengan sistem <span
                                                class="fw-bold text-dark">{{ $konf->instansi_setting ?? 'POS System' }}
                                            </span> Lokasi {{ auth()->user()->region->nama_region ?? 'General' }}.
                                        </p>
                                        <div class="d-flex flex-wrap gap-2 mb-4">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-center text-sm-left px-0">
                                    <div class="card-body pb-0 px-0 px-md-4">
                                        <img src="{{ asset('admin/assets/img/illustrations/man-with-laptop-light.png') }}"
                                            height="160" alt="Welcome Illustration"
                                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                            data-app-light-img="illustrations/man-with-laptop-light.png"
                                            style="filter: drop-shadow(5px 5px 10px rgba(0,0,0,0.1)); transform: scaleX(-1);" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RINGKASAN PENJUALAN PRIBADI KASIR -->
                <div class="row g-4 mb-6">
                    <div class="col-xl-4 col-md-6">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all hover-lift">
                            <div class="card-body bg-gradient-warning text-white p-4 position-relative">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <small class="text-white-75 fw-medium d-block mb-1">Penjualan Hari Ini</small>
                                        <h3 class="mb-0 fw-bold text-white">Rp
                                            {{ number_format($kasirStats['income']['today'] ?? 0, 0, ',', '.') }}</h3>
                                    </div>
                                    <div
                                        class="avatar avatar-xl bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bx-cart bx-lg text-black"
                                            style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-md-6">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all hover-lift">
                            <div class="card-body bg-gradient-info text-white p-4 position-relative">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <small class="text-white-75 fw-medium d-block mb-1">Penjualan Minggu Ini</small>
                                        <h3 class="mb-0 fw-bold text-white">Rp
                                            {{ number_format($kasirStats['income']['this_week'] ?? 0, 0, ',', '.') }}</h3>
                                    </div>
                                    <div
                                        class="avatar avatar-xl bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bx-cart bx-lg text-black"
                                            style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-12">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden transition-all hover-lift">
                            <div class="card-body bg-gradient-primary text-white p-4 position-relative">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <small class="text-white-75 fw-medium d-block mb-1">Penjualan Bulan Ini</small>
                                        <h3 class="mb-0 fw-bold text-white">Rp
                                            {{ number_format($kasirStats['income']['this_month'] ?? 0, 0, ',', '.') }}</h3>
                                    </div>
                                    <div
                                        class="avatar avatar-xl bg-white bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bx-cart bx-lg text-black"
                                            style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <br>

                <!-- PRODUK TERLARIS OLEH KASIR INI (mirip tampilan Admin) -->
                <div class="card border-0 shadow-lg rounded-4 mb-4">
                    <div class="card-header bg-white border-0 px-4 py-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-star bx-md text-warning me-2"></i>
                            <h5 class="mb-0 fw-semibold text-dark">Produk Terlaris Anda</h5>
                        </div>
                        <span class="badge bg-light text-muted border fw-normal">Berdasarkan Volume Penjualan</span>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-4">
                            @foreach (['today' => 'Hari ini', 'this_week' => 'Minggu ini', 'this_month' => 'Bulan ini'] as $key => $label)
                                <div class="col-lg-4">
                                    <div
                                        class="card border border-light-subtle shadow-sm rounded-4 h-100 transition-all hover-lift">
                                        <div class="card-header bg-dark rounded-top-4 px-4 py-3">
                                            <h6 class="mb-0 fw-semibold text-white d-flex align-items-center">
                                                <i class="bx bx-calendar-event me-2"></i> {{ $label }}
                                            </h6>
                                        </div>

                                        <div class="card-body p-0" style="max-height: 320px; overflow-y: auto;">
                                            @if (empty($kasirStats['topProducts'][$key]) || $kasirStats['topProducts'][$key]->isEmpty())
                                                <div class="text-center py-5">
                                                    <i class="bx bx-receipt bx-lg mb-2 text-light"></i>
                                                    <p class="text-muted small mb-0">Belum ada data penjualan</p>
                                                </div>
                                            @else
                                                <div class="list-group list-group-flush">
                                                    @foreach ($kasirStats['topProducts'][$key] as $index => $item)
                                                        <div
                                                            class="list-group-item px-4 py-3 border-0 border-bottom d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center text-truncate me-2">
                                                                <span
                                                                    class="fw-bold text-primary me-3 opacity-50">#{{ $loop->iteration }}</span>
                                                                <span class="text-dark fw-medium text-truncate"
                                                                    title="{{ $item->produk?->nama_produk }}">
                                                                    {{ $item->produk?->nama_produk ?? '(Produk tidak ditemukan)' }}
                                                                </span>
                                                            </div>
                                                            <span
                                                                class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 fw-bold">
                                                                {{ number_format($item->total_qty) }} <small>unit</small>
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="card-footer bg-transparent border-0 py-2"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <!-- Welcome Card -->
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="card bg-label-primary border-0 shadow-sm" style="overflow: hidden;">
                            <div class="d-flex align-items-center row">
                                <div class="col-sm-8">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-wrap mb-2">
                                            <h4 class="card-title text-primary mb-0 me-2">
                                                <span id="greeting">Selamat Datang</span>, {{ Auth::user()->name }}! 🎊
                                            </h4>
                                            <span class="badge bg-white text-info shadow-sm border-0 py-2 px-3">
                                                <i class="bx bx-briefcase-alt-2 me-1"></i>
                                                {{ auth()->user()->jabatan }}
                                            </span>
                                        </div>

                                        <p class="mb-3">
                                            Anda terhubung dengan sistem <span
                                                class="fw-bold text-dark">{{ $konf->instansi_setting ?? 'POS System' }}
                                            </span> Lokasi {{ auth()->user()->region->nama_region ?? 'General' }}.
                                        </p>
                                        <div class="d-flex flex-wrap gap-2 mb-4">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-center text-sm-left px-0">
                                    <div class="card-body pb-0 px-0 px-md-4">
                                        <img src="{{ asset('admin/assets/img/illustrations/man-with-laptop-light.png') }}"
                                            height="160" alt="Welcome Illustration"
                                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                            data-app-light-img="illustrations/man-with-laptop-light.png"
                                            style="filter: drop-shadow(5px 5px 10px rgba(0,0,0,0.1)); transform: scaleX(-1);" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            @endif
        </div>
    </div>

    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Line Chart
            new ApexCharts(document.querySelector("#revenueChart"), {
                chart: {
                    type: 'line',
                    height: 420,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                series: [{
                    name: 'Pendapatan',
                    data: @json($revenueValues ?? [])
                }],
                xaxis: {
                    categories: @json($chartDates ?? []),
                    title: {
                        text: 'Tanggal'
                    },
                    labels: {
                        rotate: -45
                    }
                },
                yaxis: {
                    title: {
                        text: 'Pendapatan (Rp)'
                    },
                    labels: {
                        formatter: val => 'Rp ' + val.toLocaleString('id-ID')
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                colors: ['#7367F0'],
                tooltip: {
                    y: {
                        formatter: val => 'Rp ' + val.toLocaleString('id-ID')
                    }
                }
            }).render();

            // Bar Chart
            new ApexCharts(document.querySelector("#soldChart"), {
                chart: {
                    type: 'bar',
                    height: 280,
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Unit Terjual',
                    data: @json($soldValues ?? [])
                }],
                plotOptions: {
                    bar: {
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    }
                },
                xaxis: {
                    categories: @json($chartDates ?? [])
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Unit'
                    }
                },
                colors: ['#28C76F'],
                tooltip: {
                    y: {
                        formatter: val => val + " unit"
                    }
                }
            }).render();

            // Donut Chart
            new ApexCharts(document.querySelector("#topProductsChart"), {
                chart: {
                    type: 'donut',
                    height: 280
                },
                series: @json($topProductQtys ?? [0]),
                labels: @json($topProductNames ?? ['Belum ada penjualan']),
                colors: ['#7367F0', '#28C76F', '#EA5455', '#FF9F43', '#1E9DFF'],
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    fontSize: '13px'
                },
                tooltip: {
                    y: {
                        formatter: val => val + " unit"
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: val => val.toFixed(1) + "%"
                }
            }).render();
        });
    </script>

    <script>
        function updateDashboardClock() {
            const now = new Date();
            const hours = now.getHours();

            // Update Greeting
            let greet = "Selamat Malam";
            if (hours < 11) greet = "Selamat Pagi";
            else if (hours < 15) greet = "Selamat Siang";
            else if (hours < 19) greet = "Selamat Sore";
            document.getElementById('greeting').innerText = greet;

            // Update Clock
            const timeString = now.toLocaleTimeString('id-ID', {
                hour12: false
            });
            document.getElementById('realtime-clock').innerText = timeString + " WIB";
        }

        setInterval(updateDashboardClock, 1000);
        updateDashboardClock();
    </script>


@endsection
