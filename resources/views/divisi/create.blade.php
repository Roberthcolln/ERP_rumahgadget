@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Master / Divisi /</span> {{ $title }}
        </h4>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Tambah Divisi</h5>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Error!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('divisi.store') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="form-group mb-3">
                        <label for="">Nama Divisi</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama divisi disini..."
                            name="nama_divisi">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-dark">
                            <i class="bx bx-save"></i> Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
