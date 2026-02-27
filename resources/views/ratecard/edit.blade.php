@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen / <a href="{{ route('ratecard.index') }}">Rate Card</a> /</span> Edit
            Layanan
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-white py-3">
                        <h5 class="mb-0 fw-bold">Edit Layanan: {{ $ratecard->nama_layanan }}</h5>
                    </div>
                    <div class="card-body mt-4">
                        <form action="{{ route('ratecard.update', $ratecard->id_rate_card) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                {{-- Nama Layanan --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Nama Layanan</label>
                                    <input type="text" name="nama_layanan" class="form-control"
                                        value="{{ $ratecard->nama_layanan }}" required>
                                </div>

                                {{-- Platform --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Platform</label>
                                    <select name="platform" class="form-select" required>
                                        @php $platforms = ['Instagram', 'TikTok', 'YouTube', 'Twitter/X', 'Facebook']; @endphp
                                        @foreach ($platforms as $p)
                                            <option value="{{ $p }}"
                                                {{ $ratecard->platform == $p ? 'selected' : '' }}>{{ $p }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Harga --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Harga Layanan (Rp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="harga" class="form-control"
                                            value="{{ $ratecard->harga }}" required>
                                    </div>
                                </div>

                                {{-- Gambar --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Ubah Thumbnail (Kosongkan jika tidak diganti)</label>
                                    <input type="file" name="gambar_layanan" class="form-control" accept="image/*">
                                    <div class="mt-2">
                                        <small class="text-muted d-block mb-1">Preview Saat Ini:</small>
                                        <img src="{{ asset('file/ratecard/' . $ratecard->gambar_layanan) }}"
                                            class="rounded shadow-sm" width="100" height="60"
                                            style="object-fit: cover">
                                    </div>
                                </div>

                                {{-- Deskripsi --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Deskripsi Layanan</label>
                                    <textarea name="deskripsi_layanan" id="editor" class="form-control" rows="4">{{ $ratecard->deskripsi_layanan }}</textarea>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bx bx-check-circle me-1"></i> Update Perubahan
                                </button>
                                <a href="{{ route('ratecard.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
