@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Master / Kelurahan /</span> {{ $title }}
        </h4>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ $title }}</h5>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kelurahan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="provinsi-dd" class="form-label">Provinsi</label>
                        <select name="id_provinsi" id="provinsi-dd" class="form-select">
                            <option value="">-- Pilih provinsi --</option>
                            @foreach ($provinsi as $row)
                                <option value="{{ $row->id_provinsi }}">{{ $row->nama_provinsi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kota-dd" class="form-label">Pilih Kota / Kabupaten</label>
                        <select name="id_kota" id="kota-dd" class="form-select">
                            <option value="">-- Pilih Kota --</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kecamatan-dd" class="form-label">Pilih Kecamatan</label>
                        <select name="id_kecamatan" id="kecamatan-dd" class="form-select">
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_kelurahan" class="form-label">Nama Desa / Kelurahan</label>
                        <input type="text" name="nama_kelurahan" id="nama_kelurahan" class="form-control"
                            placeholder="Masukkan nama desa/kelurahan" value="{{ old('nama_kelurahan') }}">
                    </div>

                    <div class="card-footer d-flex justify-content-end px-0">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-dark">
                            <i class="fas fa-save me-1"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
