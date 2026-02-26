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
                        <div class="col-sm-6 col-lg-4 all cat-{{ $pro->id_kategori }}">
                            <div class="box">
                                <div>
                                    <div class="img-box">
                                        <img src="{{ asset('file/produk/' . $pro->gambar_produk) }}"
                                            alt="{{ $pro->nama_produk }}">
                                    </div>
                                    <div class="detail-box">
                                        <h5>{{ $pro->nama_produk }}</h5>
                                        <p style="font-size: 13px; color: #bbb;">Tersedia stok baru dan second berkualitas.
                                        </p>
                                        <div class="options">
                                            <h6>Rp {{ number_format($pro->harga_jual_produk, 0, ',', '.') }}</h6>
                                            <a href="https://wa.me/{{ $konf->no_hp_setting }}" target="_blank">
                                                <i class="fa fa-whatsapp" style="color:white"></i>
                                            </a>
                                        </div>
                                    </div>
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
