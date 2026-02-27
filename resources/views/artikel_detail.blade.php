@extends('layouts.web')

@section('isi')
    <style>
        .article-content {
            line-height: 1.8;
            color: #333;
            font-size: 1.1rem;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
            font-size: 12px;
            color: #6c757d;
        }

        .sidebar-rek {
            position: sticky;
            top: 100px;
        }

        .rek-item:hover h6 {
            color: #ffbe33;
            /* Warna tema kuning gadget Anda */
            transition: 0.3s;
        }

        .rek-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>

    <section class="about_section layout_padding">
        <div class="container">
            {{-- Breadcrumb Modern --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-light rounded-pill px-4 py-2" style="font-size: 0.9rem;">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-dark"><i class="fa fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ url('/artikel') }}" class="text-dark">Artikel</a></li>
                    <li class="breadcrumb-item active text-warning" aria-current="page">
                        {{ Str::limit($artikel->judul_berita, 30) }}</li>
                </ol>
            </nav>

            <div class="row">
                {{-- Main Content --}}
                <div class="col-lg-8">
                    <div class="detail-box">
                        <h1 class="font-weight-bold mb-3" style="color: #ffffff; font-size: 2.5rem; line-height: 1.2;">
                            {{ $artikel->judul_berita }}
                        </h1>

                        <div class="d-flex align-items-center mb-4 text-muted">
                            <div class="mr-4">
                                <i class="fa fa-calendar-o text-warning mr-2"></i>
                                {{ \Carbon\Carbon::parse($artikel->tanggal_berita)->format('d F Y') }}
                            </div>
                            <div>
                                <i class="fa fa-user-o text-warning mr-2"></i> Admin
                            </div>
                        </div>

                        <div class="position-relative mb-5 shadow-sm" style="border-radius: 20px; overflow: hidden;">
                            <img src="{{ asset('file/berita/' . $artikel->gambar_berita) }}" class="img-fluid w-100"
                                style="max-height: 500px; object-fit: cover;" alt="{{ $artikel->judul_berita }}">
                        </div>

                        <div class="text-white article-content pr-lg-4">
                            {!! $artikel->isi_berita !!}
                        </div>

                        <div
                            class="share-box mt-5 p-4 border-top border-bottom d-flex align-items-center justify-content-between">
                            <span class="font-weight-bold">Bagikan Artikel:</span>
                            <div class="social-links">
                                <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}"
                                    target="_blank" class="btn btn-success btn-sm rounded-circle mx-1"><i
                                        class="fa fa-whatsapp"></i></a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                    target="_blank" class="btn btn-primary btn-sm rounded-circle mx-1"><i
                                        class="fa fa-facebook"></i></a>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ url('artikel') }}" class="btn btn-outline-dark rounded-pill px-4">
                                <i class="fa fa-arrow-left mr-2"></i> Kembali ke Daftar Artikel
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <div class="sidebar-rek">
                        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                            <div class="card-body p-4">
                                <h5 class="text-dark font-weight-bold mb-4"
                                    style="border-left: 4px solid #ffbe33; padding-left: 15px;">
                                    Artikel Terkait
                                </h5>

                                @foreach ($rekomendasi as $rek)
                                    <div class="rek-item mb-4 transition">
                                        <a href="{{ url('artikel/' . $rek->slug_berita) }}"
                                            class="text-decoration-none d-flex align-items-start">
                                            <img src="{{ asset('file/berita/' . $rek->gambar_berita) }}"
                                                class="rek-img mr-3 shadow-sm" alt="{{ $rek->judul_berita }}">
                                            <div>
                                                <h6 class="mb-1 text-dark font-weight-bold"
                                                    style="font-size: 0.95rem; line-height: 1.4;">
                                                    {{ Str::limit($rek->judul_berita, 45) }}
                                                </h6>
                                                <small class="text-muted">
                                                    <i class="fa fa-calendar-o mr-1"></i>
                                                    {{ \Carbon\Carbon::parse($rek->tanggal_berita)->format('d M Y') }}
                                                </small>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach

                                <div class="promo-box mt-4 p-3 bg-warning text-center" style="border-radius: 15px;">
                                    <h6 class="font-weight-bold text-white mb-2">Butuh Gadget Baru?</h6>
                                    <p class="text-white small mb-3">Cek koleksi terbaru kami dengan harga terbaik.</p>
                                    <a href="{{ url('harga') }}"
                                        class="btn btn-light btn-sm btn-block rounded-pill font-weight-bold">Cek
                                        Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
