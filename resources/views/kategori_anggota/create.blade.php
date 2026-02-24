@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Master /</span> {{ $title }}
        </h4>

        <div class="card">

            <h5 class="card-header">
                Tambah Kategori Anggota
            </h5>

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

                <form action="{{ route('kategori_anggota.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_kategori_anggota" class="form-label">Nama Kategori Anggota</label>
                        <input type="text" id="nama_kategori_anggota" name="nama_kategori_anggota" class="form-control"
                            placeholder="Masukkan nama kategori anggota disini..."
                            value="{{ old('nama_kategori_anggota') }}" required>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-dark">
                            <i class="bx bx-save"></i> Simpan
                        </button>
                        <a href="{{ route('kategori_anggota.index') }}" class="btn btn-outline-secondary">
                            <i class="bx bx-arrow-back"></i> Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
