@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Kategori Aksesoris /</span> {{ $title }}
        </h4>

        <div class="card">
            <h5 class="card-header">Tambah Kategori Aksesoris</h5>

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

                <form action="{{ route('kategori_aksesoris.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">
                            Kategori Aksesoris <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nama_kategori_aksesoris" class="form-control"
                            placeholder="Enter kategori Aksesoris name..." value="{{ old('nama_kategori_aksesoris') }}">
                    </div>



                    <div class="d-flex justify-content-end">
                        <a href="{{ route('kategori_aksesoris.index') }}" class="btn btn-secondary me-2">
                            Back
                        </a>
                        <button type="submit" class="btn btn-dark">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

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

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => console.error(error));
    </script>
@endsection
