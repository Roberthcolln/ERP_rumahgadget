@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen / <a href="{{ route('ratecard.index') }}">Rate Card</a> /</span>
            Tambah Layanan
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-white py-3">
                        <h5 class="mb-0 fw-bold">Form Tambah Layanan Baru</h5>
                    </div>
                    <div class="card-body mt-4">
                        <form action="{{ route('ratecard.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                {{-- Nama Layanan --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Nama Layanan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="nama_layanan"
                                        class="form-control @error('nama_layanan') is-invalid @enderror"
                                        placeholder="Contoh: Instagram Feed Post" value="{{ old('nama_layanan') }}">
                                    @error('nama_layanan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Platform (Multiple Select) --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Platform <span class="text-danger">*</span></label>
                                    <select name="platform[]" class="form-select @error('platform') is-invalid @enderror"
                                        multiple>
                                        @php
                                            $oldPlatforms = old('platform', []);
                                        @endphp
                                        <option value="Instagram"
                                            {{ in_array('Instagram', $oldPlatforms) ? 'selected' : '' }}>Instagram</option>
                                        <option value="Story Intsagram++"
                                            {{ in_array('Story Intsagram++', $oldPlatforms) ? 'selected' : '' }}>
                                            Story Intsagram++</option>
                                        <option value="Di Samperin Trio Kocak"
                                            {{ in_array('Di Samperin Trio Kocak', $oldPlatforms) ? 'selected' : '' }}>
                                            Di Samperin Trio Kocak</option>
                                        <option value="TikTok" {{ in_array('TikTok', $oldPlatforms) ? 'selected' : '' }}>
                                            TikTok</option>
                                        <option value="YouTube" {{ in_array('YouTube', $oldPlatforms) ? 'selected' : '' }}>
                                            YouTube</option>
                                        <option value="Twitter/X"
                                            {{ in_array('Twitter/X', $oldPlatforms) ? 'selected' : '' }}>Twitter/X</option>
                                        <option value="Facebook"
                                            {{ in_array('Facebook', $oldPlatforms) ? 'selected' : '' }}>Facebook</option>
                                    </select>
                                    <small class="text-muted">Tekan Ctrl (Windows) atau Command (Mac) untuk memilih lebih
                                        dari satu.</small>
                                    @error('platform')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Harga --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Harga Layanan (Rp) <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="harga"
                                            class="form-control @error('harga') is-invalid @enderror" placeholder="0"
                                            value="{{ old('harga') }}">
                                    </div>
                                    @error('harga')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Talent <span class="text-danger">*</span></label>
                                    <input type="number" name="talent"
                                        class="form-control @error('talent') is-invalid @enderror"
                                        value="{{ old('talent') }}">
                                    @error('talent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Gambar --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Thumbnail/Icon Layanan <span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="gambar_layanan" id="inputImg"
                                        class="form-control @error('gambar_layanan') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted d-block mb-2">Format: JPG, JPEG, PNG. Maks 2MB.</small>

                                    {{-- Area Preview Gambar --}}
                                    <div class="mt-2">
                                        <img id="previewImg" src="#" alt="Preview"
                                            class="img-fluid rounded shadow-sm d-none" style="max-height: 150px;">
                                    </div>

                                    @error('gambar_layanan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Deskripsi --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Deskripsi Layanan</label>
                                    {{-- Wrapper div sering membantu CKEditor merender lebih stabil --}}
                                    <div class="editor-container">
                                        <textarea name="deskripsi_layanan" id="editor" class="form-control">{{ old('deskripsi_layanan') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bx bx-save me-1"></i> Simpan Data
                                </button>
                                <a href="{{ route('ratecard.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Load script di akhir body section --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        // 1. Script Preview Gambar (Memperbaiki id inputImg)
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

        // 2. Inisialisasi CKEditor 5
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    ckfinder: {
                        uploadUrl: "{{ route('image.upload', ['_token' => csrf_token()]) }}",
                    },
                    // Opsi tambahan untuk toolbar jika diperlukan
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                        'blockQuote', 'insertTable', 'mediaEmbed', 'undo', 'redo'
                    ]
                })
                .then(editor => {
                    // Mengatur tinggi editor melalui script jika CSS tidak cukup
                    editor.editing.view.change(writer => {
                        writer.setStyle('min-height', '300px', editor.editing.view.document.getRoot());
                    });
                    console.log('Editor was initialized');
                })
                .catch(error => {
                    console.error('Ada kendala saat inisialisasi editor:', error);
                });
        });
    </script>

    <style>
        /* Memastikan editor memiliki tinggi yang cukup */
        .ck-editor__editable_inline {
            min-height: 300px !important;
        }

        /* Styling UI Editor */
        .ck.ck-editor__main>.ck-editor__editable {
            border-bottom-left-radius: 8px !important;
            border-bottom-right-radius: 8px !important;
            background-color: #fff;
        }

        .ck.ck-toolbar {
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
            border-color: #d1d1d1 !important;
        }
    </style>
@endsection
