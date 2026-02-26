@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0"><span class="text-muted fw-light">Master /</span> {{ $title }}</h4>
            <a href="{{ route('kredit.create') }}" class="btn btn-primary shadow-sm">
                <i class="bx bx-plus me-1"></i> Tambah Skema Kredit
            </a>
        </div>

        @if ($message = Session::get('Sukses'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Klasifikasi Produk</th>
                            <th>Harga Kredit</th>
                            <th>DP (Uang Muka)</th>
                            <th>Tenor</th>
                            <th>Angsuran/Bln</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kredit as $row)
                            @php
                                $angsuran = ($row->harga_kredit - $row->dp) / $row->cicilan;
                            @endphp
                            <tr>
                                <td>
                                    <small class="d-block fw-bold">{{ $row->kategori->nama_kategori }} -
                                        {{ $row->jenis->nama_jenis }}</small>
                                    <small class="text-muted">{{ $row->tipe->nama_tipe }} ({{ $row->varian->nama_varian }} /
                                        {{ $row->warna->nama_warna }})</small>
                                </td>
                                <td>Rp{{ number_format($row->harga_kredit, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($row->dp, 0, ',', '.') }}</td>
                                <td><span class="badge bg-label-info">{{ $row->cicilan }}x</span></td>
                                <td>
                                    <span class="fw-bold text-primary">
                                        Rp{{ number_format($row->harga_cicilan, 0, ',', '.') }}
                                    </span>
                                    <small class="text-muted">/ bulan</small>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('kredit.edit', $row->id_kredit) }}"
                                            class="btn btn-icon btn-sm btn-outline-primary"><i
                                                class="bx bx-edit-alt"></i></a>
                                        <form action="{{ route('kredit.destroy', $row->id_kredit) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-icon btn-sm btn-outline-danger show_confirm"><i
                                                    class="bx bx-trash"></i></button>
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
@endsection
