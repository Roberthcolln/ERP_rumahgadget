@extends('layouts.index')

@section('content')
    <div class="container-xxl container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Inventory /</span> {{ $title }}
        </h4>

        <div class="card">

            <div class="card-body">

                <form action="{{ route('inventory.stokKeluar') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id_produk" value="{{ $inventory->id_produk }}">
                    <input type="hidden" name="id_gudang" value="{{ $inventory->id_gudang }}">

                    <div class="mb-3">
                        <label>Produk</label>
                        <input type="text" class="form-control" value="{{ $inventory->produk->nama_produk }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label>Gudang</label>
                        <input type="text" class="form-control" value="{{ $inventory->gudang->nama_gudang }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label>Qty Keluar</label>
                        <input type="number" name="qty" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('inventory.index') }}" class="btn btn-secondary me-2">Back</a>
                        <button class="btn btn-danger">Kurangi Stok</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
