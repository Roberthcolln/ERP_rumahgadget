@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Aksesoris /</span> {{ $title }}
        </h4>

        <div class="card">
            <h5 class="card-header">Tambah Aksesoris Baru</h5>
            <div class="card-body">

                {{-- Alert untuk Error Validasi Form --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="d-flex">
                            <i class="bx bx-error-circle me-2 mt-1"></i>
                            <div>
                                <strong class="d-block mb-1">Gagal Menyimpan Data!</strong>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Alert untuk Error dari Database/Controller (Session) --}}
                @if (session('Error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <div class="d-flex">
                            <i class="bx bx-info-circle me-2 mt-1"></i>
                            <div>
                                <strong>Kesalahan Sistem:</strong>
                                <p class="mb-0 mt-1 small text-dark">{{ session('Error') }}</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Alert Sukses --}}
                @if (session('Sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <div class="d-flex">
                            <i class="bx bx-check-circle me-2 mt-1"></i>
                            <div>
                                <strong>Berhasil!</strong> {{ session('Sukses') }}
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('aksesoris.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Aksesoris *</label>
                        <input type="text" name="nama_aksesoris" class="form-control"
                            placeholder="Masukkan nama produk..." value="{{ old('nama_aksesoris') }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori Aksesoris *</label>
                            <select name="id_kategori_aksesoris" class="form-select" required>
                                <option value="">-- Pilih Kategori Aksesoris--</option>
                                @foreach ($kategori_aksesoris as $k)
                                    <option value="{{ $k->id_kategori_aksesoris }}">{{ $k->nama_kategori_aksesoris }}
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
                                        {{ old('id_supplier') == $s->id_supplier ? 'selected' : '' }}>
                                        {{ $s->nama_supplier }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="deskripsi_aksesoris" id="editor" class="form-control" rows="6">{{ old('deskripsi_aksesoris') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga Modal *</label>
                            <input type="number" name="harga_aksesoris" class="form-control"
                                value="{{ old('harga_aksesoris', 0) }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga Jual *</label>
                            <input type="number" name="harga_jual_aksesoris" class="form-control"
                                value="{{ old('harga_jual_aksesoris', 0) }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Harga Promo</label>
                            <input type="number" name="harga_promo_aksesoris" class="form-control"
                                value="{{ old('harga_promo_aksesoris', 0) }}">
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
                        <input type="file" name="gambar_aksesoris" id="inputImg" accept="image/*" class="form-control"
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
