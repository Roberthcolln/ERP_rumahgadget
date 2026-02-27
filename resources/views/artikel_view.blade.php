@extends('layouts.web')

@section('isi')
    <section class="food_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>Artikel & Berita Terbaru</h2>
                <p>Dapatkan informasi terbaru seputar gadget dan tips harian</p>
            </div>

            <div class="row mt-4">
                @foreach ($artikels as $art)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                            <img src="{{ asset('file/berita/' . $art->gambar_berita) }}" class="card-img-top"
                                style="height: 200px; object-fit: cover;" alt="{{ $art->judul_berita }}">
                            <div class="card-body">
                                <small
                                    class="text-warning">{{ \Carbon\Carbon::parse($art->tanggal_berita)->format('d M Y') }}</small>
                                <h5 class="card-title mt-2 font-weight-bold">
                                    <a href="{{ url('artikel/' . $art->slug_berita) }}" style="color: #222;">
                                        {{ Str::limit($art->judul_berita, 50) }}
                                    </a>
                                </h5>
                                <p class="card-text text-muted" style="font-size: 14px;">
                                    {{ Str::limit(strip_tags($art->isi_berita), 100) }}
                                </p>
                                <a href="{{ url('artikel/' . $art->slug_berita) }}"
                                    class="btn btn-warning btn-sm rounded-pill">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $artikels->links() }}
            </div>
        </div>
    </section>
@endsection
