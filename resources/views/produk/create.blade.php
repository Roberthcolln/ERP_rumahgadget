@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Produk /</span> {{ $title }}
        </h4>

        <div class="card">
            <h5 class="card-header">Tambah Produk Baru</h5>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Perhatian!</strong> Ada beberapa data yang belum sesuai.
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Produk *</label>
                        <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan nama produk..."
                            value="{{ old('nama_produk') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori *</label>
                            <select name="id_kategori" id="kategori-dd" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
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
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis *</label>
                            <select name="id_jenis" id="jenis-dd" class="form-select" required>
                                <option value="">-- Pilih Jenis --</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipe *</label>
                            <select name="id_tipe" id="tipe-dd" class="form-select" required>
                                <option value="">-- Pilih Tipe --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Varian</label>
                            <select name="id_varian" class="form-select">
                                <option value="">-- Pilih Varian --</option>
                                @foreach ($varian as $v)
                                    <option value="{{ $v->id_varian }}"
                                        {{ old('id_varian') == $v->id_varian ? 'selected' : '' }}>
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
                                        {{ old('id_warna') == $w->id_warna ? 'selected' : '' }}>
                                        {{ $w->nama_warna }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Produk</label>
                        <textarea name="deskripsi_produk" id="editor" class="form-control" rows="6">{{ old('deskripsi_produk') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga Modal *</label>
                            <input type="number" name="harga_produk" class="form-control"
                                value="{{ old('harga_produk', 0) }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga Jual *</label>
                            <input type="number" name="harga_jual_produk" class="form-control"
                                value="{{ old('harga_jual_produk', 0) }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga Promo</label>
                            <input type="number" name="harga_promo_produk" class="form-control"
                                value="{{ old('harga_promo_produk', 0) }}">
                        </div>
                    </div>

                    <div class="row bg-light p-3 rounded mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-success fw-bold">Pilih Gudang *</label>
                            <select name="id_gudang" class="form-select border-success" required>
                                <option value="">-- Pilih Gudang --</option>
                                @foreach ($gudang as $g)
                                    <option value="{{ $g->id_gudang }}">{{ $g->nama_gudang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-success fw-bold">Stok Awal *</label>
                            <input type="number" name="qty" class="form-control border-success"
                                placeholder="Jumlah stok..." required min="0">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Produk *</label>
                        <input type="file" name="gambar_produk" id="inputImg" accept="image/*" class="form-control"
                            required>
                        <div class="mt-3">
                            <img id="previewImg" class="d-none rounded border" style="max-width:200px;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary me-2">Back</a>
                        <button type="submit" class="btn btn-dark">Simpan Produk</button>
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
