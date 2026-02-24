@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Master /</span> {{ $title }}
        </h4>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Desa / Kelurahan</h5>
                <a href="{{ route('kelurahan.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i> Tambah Data
                </a>
            </div>

            <div class="card-body">
                @if ($message = Session::get('Sukses'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div class="d-flex">
                            <i class="bx bx-check-circle me-2"></i>
                            <div>{{ $message }}</div>
                        </div>
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
                                <th>Kecamatan/Cabang</th>
                                <th>Desa/Kelurahan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($kelurahan as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama_provinsi }}</td>
                                    <td>{{ $row->nama_kota }}</td>
                                    <td>{{ $row->nama_kecamatan }}</td>
                                    <td>
                                        <span class="badge bg-label-success">{{ $row->nama_kelurahan }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('kelurahan.edit', $row->id_kelurahan) }}"
                                                class="btn btn-icon btn-outline-primary btn-sm me-2"
                                                data-bs-toggle="tooltip" title="Edit">
                                                <i class="bx bx-edit-alt"></i>
                                            </a>
                                            <form action="{{ route('kelurahan.destroy', $row->id_kelurahan) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-icon btn-outline-danger btn-sm show_confirm"
                                                    data-bs-toggle="tooltip" title="Hapus">
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
