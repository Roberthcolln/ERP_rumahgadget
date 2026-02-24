@extends('layouts.index')

@section('content')
    <div class="container-xxl container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Inventory /</span> {{ $title }}
        </h4>

        <div class="card">

            <div class="card-body">

                <form action="{{ route('inventory.stokMasuk') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Produk</label>
                        <select name="id_produk" class="form-select">
                            @foreach ($produk as $p)
                                <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Gudang</label>
                        <select name="id_gudang" class="form-select">
                            @foreach ($gudang as $g)
                                <option value="{{ $g->id_gudang }}">{{ $g->nama_gudang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Qty Masuk</label>
                        <input type="number" name="qty" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('inventory.index') }}" class="btn btn-secondary me-2">Back</a>
                        <button class="btn btn-dark">Save</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
