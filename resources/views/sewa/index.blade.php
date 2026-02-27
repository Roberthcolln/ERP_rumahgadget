@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0"><span class="text-muted fw-light">Master /</span> {{ $title }}</h4>
            <a href="{{ route('sewa.create') }}" class="btn btn-primary shadow-sm">
                <i class="bx bx-plus me-1"></i> Tambah Sewa
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
                            <th>Produk</th>
                            <th>24 Jam</th>
                            <th>7 Hari</th>
                            <th>1 Bulan</th>
                            <th>Per Jam</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sewa as $row)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('file/produk/' . $row->produk->gambar_produk) }}" width="40"
                                            class="rounded me-2">
                                        <div>
                                            <span class="d-block fw-bold">{{ $row->produk->nama_produk }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>Rp{{ number_format($row->harga_24_jam, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($row->harga_7_hari, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($row->harga_1_bulan, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($row->harga_per_jam, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('sewa.edit', $row->id_sewa) }}"
                                            class="btn btn-sm btn-outline-primary"><i class="bx bx-edit-alt"></i></a>
                                        <form action="{{ route('sewa.destroy', $row->id_sewa) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Hapus data?')"><i class="bx bx-trash"></i></button>
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
