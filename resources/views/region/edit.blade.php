@extends('layouts.index')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Master / Region /</span> {{ $title }}
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

                <form action="{{ route('region.update', $region->id_region) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_pusat" class="form-label">Pilih Pusat</label>
                        <select name="id_pusat" id="id_pusat" class="form-select">
                            <option value="">-- Pilih Pusat --</option>
                            @foreach ($pusat as $item)
                                <option value="{{ $item->id_pusat }}" @if ($region->id_pusat == $item->id_pusat) selected @endif>
                                    {{ $item->nama_pusat }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama_region" class="form-label">Nama Region</label>
                        <input type="text" name="nama_region" id="nama_region" class="form-control"
                            placeholder="Masukkan nama region disini..." value="{{ $region->nama_region }}">
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
