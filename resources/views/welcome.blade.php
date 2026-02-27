@extends('layouts.web')

@section('isi')
    <section class="offer_section layout_padding-bottom">
        <div class="container">
            <div class="row">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="box d-flex align-items-end"
                            style="background-image: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0)), url('{{ asset('web/images/o' . $i . '.jpg') }}');
                        background-size: cover;
                        background-position: center;
                        min-height: 250px;
                        border-radius: 15px;
                        overflow: hidden;
                        border: 1px solid rgba(255,190,51, 0.3);">
                            <div class="detail-box w-100 p-3 text-center">
                                <a href="{{ url('harga') }}" class="btn btn-warning btn-sm rounded-pill px-4"
                                    style="font-weight: 600;">Cek Harga</a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
    <section class="food_section layout_padding-bottom">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Gadget Kami</h2>
            </div>

            <ul class="filters_menu">
                <li class="active" data-filter="*">Semua</li>
                @foreach ($kategori as $kat)
                    <li data-filter=".cat-{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</li>
                @endforeach
            </ul>

            <div class="filters-content">
                <div class="row grid">
                    @foreach ($produk as $pro)
                        <div class="col-sm-6 col-lg-4 all cat-{{ $pro->id_kategori }} mb-4">
                            <div class="box h-100 shadow-sm border-0"
                                style="transition: all 0.3s ease; border-radius: 15px; overflow: hidden; background: #fff;">
                                <div class="img-box"
                                    style="position: relative; background: #f8f9fa; padding: 20px; text-align: center; height: 250px; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('file/produk/' . $pro->gambar_produk) }}"
                                        alt="{{ $pro->nama_produk }}"
                                        style="max-width: 100%; max-height: 100%; object-fit: contain; transition: transform 0.5s;">

                                    {{-- Badge Kondisi --}}
                                    <div style="position: absolute; top: 10px; left: 10px;">
                                        <span class="badge badge-dark px-3 py-2"
                                            style="border-radius: 50px; font-weight: 500; font-size: 10px; letter-spacing: 1px;">
                                            {{ $pro->jenis->nama_jenis ?? 'ORIGINAL' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="detail-box p-3">
                                    <h5 class="font-weight-bold mb-1"
                                        style="color: #222; font-size: 1.1rem; height: 2.4em; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        {{ $pro->nama_produk }}
                                    </h5>

                                    <div class="mb-3" style="font-size: 12px; line-height: 1.4; color: #666 !important;">
                                        {!! $pro->deskripsi_produk !!}
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="price-box">
                                            @if ($pro->harga_promo_produk > 0)
                                                {{-- Tampilan jika ada Promo --}}
                                                <h6 class="text-warning font-weight-bold m-0" style="font-size: 1.2rem;">
                                                    Rp {{ number_format($pro->harga_promo_produk, 0, ',', '.') }}
                                                </h6>
                                                <span class="text-danger"
                                                    style="text-decoration: line-through; font-size: 11px; font-weight: 500;">
                                                    Rp {{ number_format($pro->harga_jual_produk, 0, ',', '.') }}
                                                </span>
                                            @else
                                                {{-- Tampilan jika tidak ada Promo (harga_promo_produk == 0) --}}
                                                <h6 class="text-warning font-weight-bold m-0" style="font-size: 1.2rem;">
                                                    Rp {{ number_format($pro->harga_jual_produk, 0, ',', '.') }}
                                                </h6>
                                            @endif
                                        </div>

                                        <a href="https://wa.me/{{ $konf->no_hp_setting }}?text=Halo Admin, saya tertarik dengan {{ $pro->nama_produk }}"
                                            target="_blank"
                                            class="btn btn-success d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px; border-radius: 10px; box-shadow: 0 4px 10px rgba(40, 167, 69, 0.3);">
                                            <i class="fa fa-whatsapp"></i>
                                        </a>
                                    </div>

                                    <button type="button"
                                        class="btn btn-outline-dark btn-block btn-detail font-weight-bold"
                                        style="border-radius: 10px; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s;"
                                        data-id="{{ $pro->id_produk }}">
                                        <i class="fa fa-eye mr-1"></i> Lihat Detail
                                    </button>

                                    <button type="button" class="btn btn-primary btn-block add-to-cart mt-2"
                                        data-id="{{ $pro->id_produk }}" style="border-radius: 10px;">
                                        <i class="fa fa-shopping-cart"></i> Tambah Keranjang
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>



            <div class="btn-box">
                <a href="{{ url('harga') }}">Lihat Semua Produk</a>
            </div>
        </div>
    </section>
    <section class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="{{ asset('web/images/about-img.png') }}" alt="Tentang Kami">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>{{ $konf->instansi_setting }}</h2>
                        </div>
                        <p>{!! $konf->tentang_setting !!}</p>
                        <a href="{{ url('about') }}">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
