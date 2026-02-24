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
                            <i class="bx bx-edit-alt text-warning fs-4 me-2"></i>
                            <h5 class="mb-0 fw-bold">Edit Konten Berita</h5>
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

                        <form action="{{ route('berita.update', $berita->id_berita) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                {{-- Judul Berita --}}
                                <div class="col-md-12 mb-4">
                                    <label class="form-label fw-semibold">Judul Berita</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-heading"></i></span>
                                        <input type="text" class="form-control" name="judul_berita"
                                            value="{{ old('judul_berita', $berita->judul_berita) }}" required>
                                    </div>
                                </div>

                                {{-- Gambar / Thumbnail --}}
                                <div class="col-md-12 mb-4">
                                    <label class="form-label fw-semibold">Thumbnail Berita</label>
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        <img src="{{ asset('file/berita/' . $berita->gambar_berita) }}" alt="preview"
                                            class="d-block rounded-3 object-fit-cover shadow-sm mb-2" id="previewImg"
                                            width="200" height="120">

                                        <div class="button-wrapper w-100">
                                            <label for="inputImg" class="btn btn-outline-primary me-2 mb-2 w-100"
                                                tabindex="0">
                                                <span><i class="bx bx-upload me-1"></i> Ganti Foto</span>
                                                <input type="file" id="inputImg" name="gambar_berita" hidden
                                                    accept="image/*">
                                            </label>
                                            <p class="text-muted mb-0 small text-uppercase fw-bold"
                                                style="font-size: 10px;">
                                                Biarkan kosong jika tidak ingin mengubah gambar.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Isi Berita --}}
                                <div class="col-md-12 mb-4">
                                    <label class="form-label fw-semibold">Isi Konten Berita</label>
                                    <div class="border rounded-3">
                                        <textarea name="isi_berita" id="editor" class="form-control border-0">{{ old('isi_berita', $berita->isi_berita) }}</textarea>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="card-footer bg-light border-top d-flex justify-content-end py-3">
                        <button type="submit" class="btn btn-warning px-4 shadow-sm text-white">
                            <i class="bx bx-save me-1"></i> Simpan Perubahan
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Gunakan satu library CKEditor 5 saja --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        // Preview Gambar Saat Upload
        document.getElementById('inputImg').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        // Inisialisasi CKEditor 5
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    // Route image upload yang mengembalikan respons JSON
                    uploadUrl: "{{ route('image.upload', ['_token' => csrf_token()]) }}",
                }
            })
            .then(editor => {
                editor.editing.view.change(writer => {
                    writer.setStyle('min-height', '400px', editor.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
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
