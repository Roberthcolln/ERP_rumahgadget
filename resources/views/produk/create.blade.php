@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Produk /</span> {{ $title }}
        </h4>

        <div class="card">
            <h5 class="card-header">Add Product</h5>

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

                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Produk --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Produk *</label>
                        <input type="text" name="nama_produk" class="form-control" placeholder="Nama produk..."
                            value="{{ old('nama_produk') }}">
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori *</label>
                        <select name="id_kategori" id="kategori-dd" class="form-select">
                            <option value="">-- Pilih Kategori --</option>

                            @foreach ($kategori as $k)
                                <option value="{{ $k->id_kategori }}">
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
                                    {{ old('id_supplier') == $s->id_supplier ? 'selected' : '' }}>
                                    {{ $s->nama_supplier }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Jenis --}}
                    <div class="mb-3">
                        <label class="form-label">Jenis *</label>
                        <select name="id_jenis" id="jenis-dd" class="form-select">
                            <option value="">-- Pilih Jenis --</option>
                        </select>
                    </div>

                    {{-- Tipe --}}
                    <div class="mb-3">
                        <label class="form-label">Tipe *</label>
                        <select name="id_tipe" id="tipe-dd" class="form-select">
                            <option value="">-- Pilih Tipe --</option>
                        </select>
                    </div>



                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Produk</label>
                        <textarea name="deskripsi_produk" id="editor" class="form-control" rows="6">{{ old('deskripsi_produk') }}</textarea>
                    </div>

                    {{-- Harga --}}
                    <div class="mb-3">
                        <label class="form-label">Harga Modal</label>
                        <input type="number" name="harga_produk" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Jual</label>
                        <input type="number" name="harga_jual_produk" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Promo</label>
                        <input type="number" name="harga_promo_produk" class="form-control">
                    </div>

                    {{-- Stok --}}


                    <div class="mb-3">
                        <label>Gudang</label>
                        <select name="id_gudang" class="form-select">

                            @foreach ($gudang as $g)
                                <option value="{{ $g->id_gudang }}">
                                    {{ $g->nama_gudang }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Qty Gudang</label>
                        <input type="number" name="qty" class="form-control">
                    </div>

                    {{-- Gambar --}}
                    <div class="mb-3">
                        <label class="form-label">Gambar Produk *</label>
                        <input type="file" name="gambar_produk" id="inputImg" accept="image/*" class="form-control">

                        <img id="previewImg" class="d-none mt-3 rounded" style="max-width:200px;">
                    </div>

                    <div class="d-flex justify-content-end">

                        <a href="{{ route('produk.index') }}" class="btn btn-secondary me-2">
                            Back
                        </a>

                        <button type="submit" class="btn btn-dark">
                            Save
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

    {{-- PREVIEW IMAGE --}}
    <script>
        document.getElementById('inputImg').addEventListener('change', function() {

            const preview = document.getElementById('previewImg');
            const file = this.files[0];

            if (file) {

                const reader = new FileReader();

                reader.onload = e => {

                    preview.src = e.target.result;
                    preview.classList.remove('d-none');

                };

                reader.readAsDataURL(file);
            }

        });
    </script>


@endsection
