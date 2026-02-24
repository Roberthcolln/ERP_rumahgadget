@extends('layouts.index')

@section('content')
    <div class="container-xxl container-p-y">

        <h4 class="fw-bold mb-4">
            <span class="text-muted">Gudang /</span> {{ $title }}
        </h4>

        <div class="card shadow-sm border-0">

            <div class="card-header">
                Edit Gudang
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

                <form action="{{ route('gudang.update', $gudang->id_gudang) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nama Gudang *</label>
                            <input type="text" name="nama_gudang" class="form-control"
                                value="{{ old('nama_gudang', $gudang->nama_gudang) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kode Gudang *</label>
                            <input type="text" name="kode_gudang" class="form-control"
                                value="{{ old('kode_gudang', $gudang->kode_gudang) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Penanggung Jawab</label>
                            <input type="text" name="penanggung_jawab" class="form-control"
                                value="{{ old('penanggung_jawab', $gudang->penanggung_jawab) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="aktif" {{ $gudang->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ $gudang->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                                </option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat_gudang" class="form-control">{{ old('alamat_gudang', $gudang->alamat_gudang) }}</textarea>
                        </div>

                    </div>

                    <div class="text-end mt-4">
                        <a href="{{ route('gudang.index') }}" class="btn btn-secondary me-2">
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
