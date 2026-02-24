@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Produk /</span> {{ $title }}
        </h4>

        <div class="card">
            <h5 class="card-header">Edit Produk</h5>

            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Something went wrong!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama Produk --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Produk *</label>
                        <input type="text" name="nama_produk" class="form-control"
                            value="{{ old('nama_produk', $produk->nama_produk) }}">
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori *</label>
                        <select name="id_kategori" id="kategori-dd" class="form-select">

                            @foreach ($kategori as $k)
                                <option value="{{ $k->id_kategori }}"
                                    {{ $produk->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Supplier --}}
                    <div class="mb-3">
                        <label class="form-label">Supplier</label>

                        <select name="id_supplier" class="form-select">

                            <option value="">-- Pilih Supplier --</option>

                            @foreach ($supplier as $s)
                                <option value="{{ $s->id_supplier }}"
                                    {{ old('id_supplier', $produk->id_supplier) == $s->id_supplier ? 'selected' : '' }}>
                                    {{ $s->nama_supplier }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- Jenis --}}
                    <div class="mb-3">
                        <label class="form-label">Jenis *</label>
                        <select name="id_jenis" id="jenis-dd" class="form-select">

                            @foreach ($jenis as $j)
                                <option value="{{ $j->id_jenis }}"
                                    {{ $produk->id_jenis == $j->id_jenis ? 'selected' : '' }}>
                                    {{ $j->nama_jenis }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Tipe --}}
                    <div class="mb-3">
                        <label class="form-label">Tipe *</label>
                        <select name="id_tipe" id="tipe-dd" class="form-select">

                            @foreach ($tipe as $t)
                                <option value="{{ $t->id_tipe }}"
                                    {{ $produk->id_tipe == $t->id_tipe ? 'selected' : '' }}>
                                    {{ $t->nama_tipe }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Produk</label>
                        <textarea name="deskripsi_produk" id="editor" class="form-control" rows="6">
{{ old('deskripsi_produk', $produk->deskripsi_produk) }}
</textarea>
                    </div>

                    {{-- Harga --}}
                    <div class="mb-3">
                        <label class="form-label">Harga Modal</label>
                        <input type="number" name="harga_produk" class="form-control"
                            value="{{ old('harga_produk', $produk->harga_produk) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Jual</label>
                        <input type="number" name="harga_jual_produk" class="form-control"
                            value="{{ old('harga_jual_produk', $produk->harga_jual_produk) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Promo</label>
                        <input type="number" name="harga_promo_produk" class="form-control"
                            value="{{ old('harga_promo_produk', $produk->harga_promo_produk) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gudang</label>

                        <select name="id_gudang" class="form-select">

                            @foreach ($gudang as $g)
                                <option value="{{ $g->id_gudang }}"
                                    {{ optional($produk->gudang->first())->id_gudang == $g->id_gudang ? 'selected' : '' }}>

                                    {{ $g->nama_gudang }}

                                </option>
                            @endforeach

                        </select>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Qty Gudang</label>

                        <input type="number" name="qty" class="form-control"
                            value="{{ optional($produk->gudang->first())->pivot->qty ?? 0 }}">
                    </div>



                    {{-- Upload Gambar --}}
                    <div class="mb-3">
                        <label class="form-label">Ganti Gambar Produk</label>
                        <input type="file" name="gambar_produk" id="inputImg" class="form-control">
                    </div>

                    {{-- Preview --}}
                    <div class="mb-3">
                        <label class="form-label">Image Preview</label><br>

                        <img id="previewImg" src="{{ asset('file/produk/' . $produk->gambar_produk) }}" class="rounded"
                            style="max-width:200px;">
                    </div>

                    <div class="d-flex justify-content-end">

                        <a href="{{ route('produk.index') }}" class="btn btn-secondary me-2">
                            Back
                        </a>

                        <button type="submit" class="btn btn-dark">
                            Update
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

    {{-- CKEDITOR --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor.create(document.querySelector('#editor'))
            .catch(error => console.error(error));
    </script>

    {{-- Preview Image --}}
    <script>
        document.getElementById('inputImg').addEventListener('change', function() {

            const preview = document.getElementById('previewImg');
            const file = this.files[0];

            if (file) {

                const reader = new FileReader();

                reader.onload = e => preview.src = e.target.result;

                reader.readAsDataURL(file);

            }

        });
    </script>
@endsection
