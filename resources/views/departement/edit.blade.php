@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Master /</span> {{ $title }}
        </h4>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Edit Departement</h5>
                <a href="{{ route('departement.index') }}" class="btn btn-warning btn-sm">
                    <i class="bx bx-arrow-back"></i> Kembali
                </a>
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

                <form action="{{ route('departement.update', $departement->id_departement) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama_departement" class="form-label">Nama Departement</label>
                        <input type="text" id="nama_departement" class="form-control" name="nama_departement"
                            placeholder="Masukkan nama Departement disini..." value="{{ $departement->nama_departement }}">
                    </div>

                    <button type="submit" class="btn btn-dark">Save</button>
                </form>

            </div>
        </div>
    </div>
@endsection
