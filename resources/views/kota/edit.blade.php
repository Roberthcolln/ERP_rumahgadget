@extends('layouts.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Master / kota /</span> {{ $title }}
        </h4>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">{{ $title }}</h5>
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

                <form action="{{ route('kota.update', $kota->id_kota) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_provinsi" class="form-label">Pilih provinsi</label>
                        <select name="id_provinsi" id="id_provinsi" class="form-select">
                            <option value="">-- Pilih provinsi --</option>
                            @foreach ($provinsi as $item)
                                <option value="{{ $item->id_provinsi }}" @if ($kota->id_provinsi == $item->id_provinsi) selected @endif>
                                    {{ $item->nama_provinsi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_kota" class="form-label">Nama kota</label>
                        <input type="text" name="nama_kota" id="nama_kota" class="form-control"
                            placeholder="Masukkan nama kota disini..." value="{{ $kota->nama_kota }}">
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
