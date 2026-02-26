@extends('layouts.web')

@section('isi')
    <section class="food_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2 class="mb-4">Aksesoris Kami</h2>
            </div>

            {{-- Filter Kategori --}}
            <ul class="filters_menu">
                <li class="active" data-filter="*">All</li>
                @foreach ($kategori as $kat)
                    <li data-filter=".cat-{{ $kat->id_kategori_aksesoris }}">
                        {{ $kat->nama_kategori_aksesoris }}
                    </li>
                @endforeach
            </ul>

            <div class="filters-content mt-4">
                <div class="row grid">
                    @forelse ($aksesoris as $pro)
                        <div class="col-sm-6 col-lg-4 all cat-{{ $pro->id_kategori_aksesoris }}">
                            <div class="box">
                                <div class="img-box">
                                    <img src="{{ asset('file/aksesoris/' . $pro->gambar_aksesoris) }}"
                                        onerror="this.src='https://placehold.co/400x300?text=No+Image'">
                                </div>
                                <div class="detail-box">
                                    <h5>{{ $pro->nama_aksesoris }}</h5>
                                    <p class="text-muted small">
                                        {{ $pro->kategori_aksesoris->nama_kategori_aksesoris ?? 'Umum' }}
                                    </p>
                                    <div class="options">
                                        <h6>Rp {{ number_format($pro->harga_jual_aksesoris, 0, ',', '.') }}</h6>
                                        <a
                                            href="https://wa.me/{{ $konf->nomor_wa ?? '' }}?text=Halo, saya ingin pesan {{ $pro->nama_aksesoris }}">
                                            <i class="fa fa-shopping-cart text-white"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Produk tidak ditemukan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Tambahkan ini agar konten turun dan tidak tertutup header */
        .food_section {
            padding-top: 50px;
            background-color: #f8f9fa;
            /* Memberi warna background terang agar produk terlihat jelas */
            min-height: 80vh;
        }

        /* Pastikan menu filter memiliki z-index agar selalu di depan */
        .filters_menu {
            position: relative;
            z-index: 10;
            margin-bottom: 40px;
        }

        /* Perbaikan agar filter terlihat jelas */
        .filters_menu li {
            cursor: pointer;
            padding: 7px 20px;
            border-radius: 25px;
            transition: all 0.3s;
            display: inline-block;
            margin: 5px;
            background: #eee;
        }

        .filters_menu li.active {
            background-color: #222831;
            color: #ffffff;
        }

        /* Box aksesoris */
        .food_section .box {
            position: relative;
            z-index: 5;
            background-color: #ffffff;
            /* ... sisa style Anda ... */
        }
    </style>
@endsection
