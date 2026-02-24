@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Inventory /</span> {{ $title }}
        </h4>

        <div class="card">

            <h5 class="card-header d-flex justify-content-between align-items-center">
                Data Inventory

                <a href="{{ route('inventory.create') }}" class="btn btn-dark btn-sm">
                    <i class="bx bx-plus"></i> Stok Masuk
                </a>
            </h5>

            <div class="table-responsive text-nowrap">

                @if ($message = Session::get('Sukses'))
                    <div class="alert alert-success m-3">
                        {{ $message }}
                    </div>
                @endif

                <table class="table table-border-bottom-0 align-middle">

                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Produk</th>
                            <th>Gudang</th>
                            <th>Stok</th>
                            <th width="80">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($inventory as $row)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $row->produk->nama_produk }}</strong>
                                </td>

                                <td>
                                    <span class="badge bg-label-primary">
                                        {{ $row->gudang->nama_gudang }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-label-success">
                                        {{ $row->qty }}
                                    </span>
                                </td>

                                <td>

                                    <div class="dropdown">

                                        <button class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">

                                            <i class="bx bx-dots-vertical-rounded"></i>

                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end px-2">

                                            <div class="d-flex flex-column gap-2">

                                                <a href="#" class="btn btn-sm btn-outline-success">
                                                    <i class="bx bx-plus"></i> Stok Masuk
                                                </a>

                                                <a href="#" class="btn btn-sm btn-outline-danger">
                                                    <i class="bx bx-minus"></i> Stok Keluar
                                                </a>

                                            </div>

                                        </div>

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
