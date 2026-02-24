@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Breadcrumb & Title --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Manajemen Berita /</span> {{ $title }}
            </h4>
            <a href="{{ route('berita.index') }}" class="btn btn-label-secondary">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-xl">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-bottom py-3">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-edit text-primary fs-4 me-2"></i>
                            <h5 class="mb-0 fw-bold">Formulir Konten Berita</h5>
                        </div>
                    </div>

                    <div class="card-body pt-4">
                        {{-- Alert Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4"
                                role="alert">
                                <div class="fw-bold"><i class="bx bx-error-circle me-2"></i> Terjadi Kesalahan!</div>
                                <ul class="mb-0 mt-2 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <div class="row">
                                {{-- Kolom Judul --}}
                                <div class="col-md-12 mb-4">
                                    <label class="form-label fw-semibold">Judul Berita</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-heading"></i></span>
                                        <input type="text" class="form-control"
                                            placeholder="Tuliskan judul berita yang menarik..." name="judul_berita"
                                            value="{{ old('judul_berita') }}" required>
                                    </div>
                                </div>

                                {{-- Kolom Thumbnail --}}
                                <div class="col-md-12 mb-4">
                                    <label class="form-label fw-semibold">Thumbnail / Gambar Utama</label>
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        <img src="https://placehold.co/600x400?text=Preview" alt="preview"
                                            class="d-block rounded-3 object-fit-cover shadow-sm mb-2 d-none" id="previewImg"
                                            width="200" height="120">

                                        <div class="button-wrapper w-100">
                                            <label for="inputImg" class="btn btn-outline-primary me-2 mb-2 w-100"
                                                tabindex="0">
                                                <span class="d-none d-sm-block"><i class="bx bx-upload me-1"></i> Pilih Foto
                                                    Berita</span>
                                                <i class="bx bx-upload d-block d-sm-none"></i>
                                                <input type="file" id="inputImg" name="gambar_berita"
                                                    class="account-file-input" hidden
                                                    accept="image/png, image/jpeg, image/jpg">
                                            </label>
                                            <p class="text-muted mb-0 small text-uppercase fw-bold"
                                                style="font-size: 10px;">
                                                Format: JPG, PNG, atau JPEG. Maksimal ukuran: 2MB.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Kolom Isi Berita --}}
                                <div class="col-md-12 mb-4">
                                    <label class="form-label fw-semibold">Konten Berita</label>
                                    <div class="border rounded-3">
                                        <textarea name="isi_berita" id="editor" rows="15" class="form-control border-0">{{ old('isi_berita') }}</textarea>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="card-footer bg-light border-top d-flex justify-content-end py-3">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="bx bx-save me-1"></i> Publikasikan Berita
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        // 1. Script Preview Gambar
        document.getElementById('inputImg').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('previewImg');
                    preview.setAttribute('src', event.target.result);
                    preview.classList.remove("d-none");
                };
                reader.readAsDataURL(file);
            }
        });

        // 2. Inisialisasi CKEditor 5 (Hanya satu fungsi saja)
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    // Ini akan memanggil route image.upload yang mengarah ke storeImage
                    uploadUrl: "{{ route('image.upload', ['_token' => csrf_token()]) }}",
                }
            })
            .then(editor => {
                editor.editing.view.change(writer => {
                    writer.setStyle('min-height', '300px', editor.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <style>
        /* CSS Tambahan agar editor terlihat rapi di layout modern */
        .ck-editor__editable_inline {
            min-height: 300px;
        }

        .ck.ck-editor__main>.ck-editor__editable {
            border-bottom-left-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
        }

        .ck.ck-toolbar {
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
            border-bottom: none !important;
        }
    </style>
@endsection
