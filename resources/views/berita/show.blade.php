@extends('layouts.index')

@section('content')
    {{-- CSS Tambahan untuk Merapikan Konten --}}
    <style>
        .article-content img {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 8px;
            margin: 15px 0;
            display: block;
        }

        .article-content {
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        /* Jika Anda menggunakan CKEditor, terkadang ada class image */
        .article-content figure.image {
            margin: 0;
            max-width: 100%;
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    {{-- Gambar Headline --}}
                    <img src="{{ asset('file/berita/' . $berita->gambar_berita) }}" class="card-img-top"
                        style="max-height: 450px; width: 100%; object-fit: cover;">

                    <div class="card-body p-4 p-md-5">
                        {{-- Judul dan Info --}}
                        <h2 class="fw-bold mb-3 text-dark">{{ $berita->judul_berita }}</h2>
                        <div class="text-muted small mb-4 d-flex align-items-center">
                            <i class="bx bx-calendar me-1"></i>
                            {{ \Carbon\Carbon::parse($berita->tanggal_berita)->isoFormat('D MMMM Y') }}
                            <span class="mx-2">|</span>
                            <i class="bx bx-user me-1"></i> Admin
                        </div>

                        <hr class="my-4">

                        {{-- Isi Berita (Dibungkus class article-content) --}}
                        <div class="article-content" style="line-height: 1.8; color: #333; font-size: 1.05rem;">
                            {!! $berita->isi_berita !!}
                        </div>

                        <div class="mt-5 pt-3">
                            <a href="{{ route('berita.index') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-arrow-back me-1"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
