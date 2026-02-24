@extends('layouts.index')

@section('content')
    <div class="container-xxl container-p-y">

        <h4 class="fw-bold mb-4">
            <span class="text-muted">Supplier /</span> {{ $title }}
        </h4>

        <div class="card shadow-sm border-0">

            <div class="card-header">
                Tambah Supplier
            </div>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('supplier.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nama Supplier *</label>
                            <input type="text" name="nama_supplier" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kode Supplier *</label>
                            <input type="text" name="kode_supplier" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Perusahaan</label>
                            <input type="text" name="perusahaan" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="telepon" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control"></textarea>
                        </div>

                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary me-2">
                            Back
                        </a>

                        <button class="btn btn-dark">
                            Save
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
