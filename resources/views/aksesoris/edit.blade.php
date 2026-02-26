@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Aksesoris /</span> {{ $title }}</h4>

        <div class="card">
            <div class="card-body">
                {{-- Alert Error --}}
                @if (session('Error'))
                    <div class="alert alert-danger">{{ session('Error') }}</div>
                @endif

                <form action="{{ route('aksesoris.update', $aksesoris->id_aksesoris) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Nama Aksesoris *</label>
                            <input type="text" name="nama_aksesoris" class="form-control"
                                value="{{ old('nama_aksesoris', $aksesoris->nama_aksesoris) }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori Aksesoris *</label>
                            <select name="id_kategori_aksesoris" class="form-select" required>
                                @foreach ($kategori_aksesoris as $k)
                                    <option value="{{ $k->id_kategori_aksesoris }}"
                                        {{ $aksesoris->id_kategori_aksesoris == $k->id_kategori_aksesoris ? 'selected' : '' }}>
                                        {{ $k->nama_kategori_aksesoris }}
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
                                        {{ old('id_supplier', $aksesoris->id_supplier) == $s->id_supplier ? 'selected' : '' }}>
                                        {{ $s->nama_supplier }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Produk</label>
                        <textarea name="deskripsi_aksesoris" id="editor" class="form-control">{{ old('deskripsi_aksesoris', $aksesoris->deskripsi_aksesoris) }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga Modal</label>
                            <input type="number" name="harga_aksesoris" class="form-control"
                                value="{{ old('harga_aksesoris', $aksesoris->harga_aksesoris) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga Jual</label>
                            <input type="number" name="harga_jual_aksesoris" class="form-control"
                                value="{{ old('harga_jual_aksesoris', $aksesoris->harga_jual_aksesoris) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga Promo</label>
                            <input type="number" name="harga_promo_aksesoris" class="form-control"
                                value="{{ old('harga_promo_aksesoris', $aksesoris->harga_promo_aksesoris) }}">
                        </div>
                    </div>

                    <div class="row bg-light p-3 rounded mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Gudang Penyimpanan</label>
                            <select name="id_gudang" class="form-select border-primary" required>
                                @foreach ($gudang as $g)
                                    <option value="{{ $g->id_gudang }}"
                                        {{ $aksesoris->gudang->contains('id_gudang', $g->id_gudang) ? 'selected' : '' }}>
                                        {{ $g->nama_gudang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Stok (Qty)</label>
                            <input type="number" name="qty" class="form-control border-primary"
                                value="{{ $aksesoris->gudang->first()->pivot->qty ?? 0 }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gambar Produk</label>
                        <input type="file" name="gambar_aksesoris" id="inputImg" class="form-control" accept="image/*">
                        <div class="mt-3">
                            <img id="previewImg"
                                src="{{ $aksesoris->gambar_aksesoris ? asset('file/aksesoris/' . $aksesoris->gambar_aksesoris) : asset('assets/img/no-image.png') }}"
                                class="rounded border" style="max-width:200px;">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('aksesoris.index') }}" class="btn btn-outline-secondary me-2">Back</a>
                        <button type="submit" class="btn btn-dark">Update Aksesoris</button>
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
