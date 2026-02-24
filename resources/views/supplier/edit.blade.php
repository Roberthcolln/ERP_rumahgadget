@extends('layouts.index')

@section('content')
    <div class="container-xxl container-p-y">

        <h4 class="fw-bold mb-4">
            <span class="text-muted">Supplier /</span> {{ $title }}
        </h4>

        <div class="card shadow-sm border-0">

            <div class="card-header">
                Edit Supplier
            </div>

            <div class="card-body">

                <form action="{{ route('supplier.update', $supplier->id_supplier) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nama Supplier</label>
                            <input type="text" name="nama_supplier" class="form-control"
                                value="{{ $supplier->nama_supplier }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kode Supplier</label>
                            <input type="text" name="kode_supplier" class="form-control"
                                value="{{ $supplier->kode_supplier }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Perusahaan</label>
                            <input type="text" name="perusahaan" class="form-control"
                                value="{{ $supplier->perusahaan }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="telepon" class="form-control" value="{{ $supplier->telepon }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $supplier->email }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="aktif" {{ $supplier->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ $supplier->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                                </option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control">{{ $supplier->alamat }}</textarea>
                        </div>

                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary me-2">
                            Back
                        </a>

                        <button class="btn btn-dark">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
