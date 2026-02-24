@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Master /</span> {{ $title }}
        </h4>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Kecamatan</h5>
                <a href="{{ route('kecamatan.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Tambah Data
                </a>
            </div>

            <div class="card-body">
                @if ($message = Session::get('Sukses'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="example2">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Provinsi</th>
                                <th>Kota/ Kabupaten</th>
                                <th>Kecamatan</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($kecamatan as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama_provinsi }}</td>
                                    <td>{{ $row->nama_kota }}</td>
                                    <td>
                                        <span class="badge bg-label-primary">{{ $row->nama_kecamatan }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('kecamatan.edit', $row->id_kecamatan) }}"
                                                class="btn btn-icon btn-outline-primary btn-sm me-2">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                            <form action="{{ route('kecamatan.destroy', $row->id_kecamatan) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-icon btn-outline-danger btn-sm show_confirm">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
