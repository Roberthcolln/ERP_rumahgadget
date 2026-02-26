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
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Something went wrong!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Nama Produk --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Nama Produk *</label>
                            <input type="text" name="nama_produk" class="form-control"
                                value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                        </div>

                        {{-- Kategori & Supplier --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori *</label>
                            <select name="id_kategori" id="kategori-dd" class="form-select" required>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori }}"
                                        {{ $produk->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
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

                        {{-- Jenis & Tipe --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis *</label>
                            <select name="id_jenis" id="jenis-dd" class="form-select" required>
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->id_jenis }}"
                                        {{ $produk->id_jenis == $j->id_jenis ? 'selected' : '' }}>
                                        {{ $j->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe *</label>
                            <select name="id_tipe" id="tipe-dd" class="form-select" required>
                                @foreach ($tipe as $t)
                                    <option value="{{ $t->id_tipe }}"
                                        {{ $produk->id_tipe == $t->id_tipe ? 'selected' : '' }}>
                                        {{ $t->nama_tipe }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Varian & Warna --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Varian</label>
                            <select name="id_varian" class="form-select">
                                <option value="">-- Pilih Varian --</option>
                                @foreach ($varian as $v)
                                    <option value="{{ $v->id_varian }}"
                                        {{ old('id_varian', $produk->id_varian) == $v->id_varian ? 'selected' : '' }}>
                                        {{ $v->nama_varian }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Warna</label>
                            <select name="id_warna" class="form-select">
                                <option value="">-- Pilih Warna --</option>
                                @foreach ($warna as $w)
                                    <option value="{{ $w->id_warna }}"
                                        {{ old('id_warna', $produk->id_warna) == $w->id_warna ? 'selected' : '' }}>
                                        {{ $w->nama_warna }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Produk</label>
                        <textarea name="deskripsi_produk" id="editor" class="form-control" rows="6">{{ old('deskripsi_produk', $produk->deskripsi_produk) }}</textarea>
                    </div>

                    {{-- Harga & Stok --}}
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga Modal</label>
                            <input type="number" name="harga_produk" class="form-control"
                                value="{{ old('harga_produk', $produk->harga_produk) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga Jual</label>
                            <input type="number" name="harga_jual_produk" class="form-control"
                                value="{{ old('harga_jual_produk', $produk->harga_jual_produk) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga Promo</label>
                            <input type="number" name="harga_promo_produk" class="form-control"
                                value="{{ old('harga_promo_produk', $produk->harga_promo_produk) }}">
                        </div>
                    </div>

                    <div class="row bg-light p-3 rounded mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-primary fw-bold">Gudang Penyimpanan</label>
                            <select name="id_gudang" class="form-select border-primary shadow-sm">
                                @foreach ($gudang as $g)
                                    {{-- Mengambil ID Gudang dari relasi pivot stok --}}
                                    <option value="{{ $g->id_gudang }}"
                                        {{ $produk->gudang->contains('id_gudang', $g->id_gudang) ? 'selected' : '' }}>
                                        {{ $g->nama_gudang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label text-primary fw-bold">Update Stok (Qty)</label>
                            <input type="number" name="qty" class="form-control border-primary shadow-sm"
                                value="{{ $produk->gudang->first()->pivot->qty ?? 0 }}">
                        </div>
                    </div>

                    {{-- Upload Gambar --}}
                    <div class="mb-3">
                        <label class="form-label">Gambar Produk</label>
                        <input type="file" name="gambar_produk" id="inputImg" class="form-control" accept="image/*">
                        <div class="mt-3">
                            <img id="previewImg"
                                src="{{ $produk->gambar_produk ? asset('file/produk/' . $produk->gambar_produk) : asset('assets/img/no-image.png') }}"
                                class="rounded border" style="max-width:200px;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary me-2">Back</a>
                        <button type="submit" class="btn btn-dark">Update Produk</button>
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
