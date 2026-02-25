@extends('layouts.web')

@section('isi')
    {{-- 1. HERO SECTION: Meniru Gambar Pertama --}}
    <div class="hero overlay"
        style="background-image: url('{{ asset('web/images/hero_bg_1.jpg') }}'); height: 100vh; min-height: 600px;">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <h1 class="text-white fw-bold mb-4" style="font-size: 2.5rem; letter-spacing: -1px;">
                        Solusi Terlengkap Cari Gadget Impian
                    </h1>

                    {{-- Search Bar Melayang --}}
                    <form action="{{ url()->current() }}" method="GET"
                        class="d-flex p-2 bg-white rounded-pill shadow-lg mx-auto" style="max-width: 600px;">
                        <input type="text" name="search"
                            class="form-control border-0 bg-transparent px-4 py-3 rounded-pill"
                            placeholder="Cari Gadget Anda .." value="{{ request('search') }}" style="box-shadow: none;">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 fw-bold"
                            style="background-color: #00564d; border: none;">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. PRICE LIST SECTION: Meniru Gambar Kedua --}}
    <div class="section bg-light" style="padding-top: 80px; padding-bottom: 80px;">
        <div class="container">

            {{-- Tombol Apple/Android di Tengah --}}
            <div class="d-flex justify-content-center gap-2 mb-5" data-aos="fade-up">
                <a href="#" class="btn-toggle-custom active">Apple</a>
                <a href="#" class="btn-toggle-custom">Android</a>
            </div>

            <div class="row g-4">
                {{-- Sidebar Kategori (Kiri) --}}
                <div class="col-lg-3" data-aos="fade-right">
                    <div class="sticky-top" style="top: 100px;">
                        <div class="list-group list-group-flush shadow-sm rounded-4 overflow-hidden border-0">
                            @foreach ($kategori as $kat)
                                <a href="?kategori={{ $kat->id_kategori }}"
                                    class="list-group-item list-group-item-action py-3 px-4 border-0 {{ request('kategori') == $kat->id_kategori ? 'active-sidebar' : 'bg-dark text-white' }}">
                                    {{ $kat->nama_kategori }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Tabel Daftar Harga (Kanan) --}}
                <div class="col-lg-9" data-aos="fade-left">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        {{-- Header Hitam Update Terakhir --}}
                        <div class="bg-black text-white p-3 d-flex justify-content-between align-items-center">
                            <div class="small opacity-75">Daftar Harga Unit</div>
                            <div class="text-end" style="line-height: 1.2;">
                                <span class="d-block x-small text-uppercase opacity-50">Update Terakhir</span>
                                <span class="fw-bold small">{{ date('d/m/Y') }}</span><br>
                                <span class="fw-bold small">{{ date('H:i') }}</span>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 py-3 text-uppercase small fw-bold">Tipe</th>
                                        <th class="py-3 text-uppercase small fw-bold">Varian</th>
                                        <th class="py-3 text-uppercase small fw-bold">Harga</th>
                                        <th class="py-3 text-uppercase small fw-bold">Warna / Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produk as $row)
                                        <tr>
                                            <td class="ps-4 fw-bold text-dark">{{ $row->nama_produk }}</td>
                                            <td><span
                                                    class="badge bg-light text-dark border">{{ $row->varian->nama_varian ?? '-' }}</span>
                                            </td>
                                            <td>
                                                @if ($row->harga_promo_produk > 0)
                                                    <small class="text-danger text-decoration-line-through d-block">Rp
                                                        {{ number_format($row->harga_jual_produk, 0, ',', '.') }}</small>
                                                    <span class="fw-bold text-dark">Rp
                                                        {{ number_format($row->harga_promo_produk, 0, ',', '.') }}
                                                        🔥</span>
                                                @else
                                                    <span class="fw-bold text-dark">Rp
                                                        {{ number_format($row->harga_jual_produk, 0, ',', '.') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $row->warna->nama_warna ?? '-' }}</small>
                                                @if ($row->stok <= 0)
                                                    <span class="text-danger fw-bold ms-2 small">SOLD</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">Data tidak ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $produk->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Navigation: Meniru Gambar Pertama (Mobile) --}}
    <div class="fixed-bottom bg-white border-top d-lg-none shadow-lg">
        <div class="container">
            <div class="row text-center py-2">
                <div class="col">
                    <a href="#" class="text-dark text-decoration-none small">
                        <i class="icon-home d-block mb-1 fs-5"></i> Home
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="text-primary text-decoration-none small">
                        <i class="icon-search d-block mb-1 fs-5"></i> Harga
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="text-dark text-decoration-none small">
                        <i class="icon-shopping-bag d-block mb-1 fs-5"></i> Jual
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="text-dark text-decoration-none small">
                        <i class="icon-menu d-block mb-1 fs-5"></i> Lainnya
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* CSS Untuk Meniru Tombol Apple/Android */
        .btn-toggle-custom {
            padding: 12px 40px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            background: #e9ecef;
            color: #6c757d;
            transition: 0.3s;
        }

        .btn-toggle-custom.active {
            background: #a5a5a5;
            color: white;
        }

        /* Sidebar Style */
        .active-sidebar {
            background-color: #fff !important;
            color: #000 !important;
            font-weight: bold;
            border-left: 5px solid #000 !important;
        }

        .list-group-item-action:hover {
            background-color: #333 !important;
            color: white !important;
        }

        /* Table Style */
        .table thead th {
            font-size: 11px;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #f8f9fa;
        }

        .table tbody td {
            padding-top: 15px;
            padding-bottom: 15px;
            font-size: 14px;
        }

        .x-small {
            font-size: 10px;
        }

        /* Hilangkan padding bawah untuk mobile karena ada bottom nav */
        @media (max-width: 991px) {
            body {
                padding-bottom: 70px;
            }
        }
    </style>
@endsection
