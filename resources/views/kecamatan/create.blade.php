@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Master / Kecamatan /</span> {{ $title }}
        </h4>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
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

                <form action="{{ route('kecamatan.store') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="id_kota" class="form-label">Pilih Kota / Kabupaten</label>
                        <select name="id_kota" id="id_kota" class="form-select">
                            <option value="">-- Pilih Kota --</option>
                            @foreach ($kota as $item)
                                <option value="{{ $item->id_kota }}"
                                    {{ old('id_kota') == $item->id_kota ? 'selected' : '' }}>
                                    {{ $item->nama_kota }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_kecamatan" class="form-label">Nama Kecamatan </label>
                        <input type="text" name="nama_kecamatan" id="nama_kecamatan" class="form-control"
                            placeholder="Masukkan nama kecamatan" value="{{ old('nama_kecamatan') }}">
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
