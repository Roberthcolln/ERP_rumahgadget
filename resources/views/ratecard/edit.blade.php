@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Manajemen / <a href="{{ route('ratecard.index') }}">Rate Card</a> /</span> Edit
            Layanan
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-white py-3">
                        <h5 class="mb-0 fw-bold">Edit Layanan: {{ $ratecard->nama_layanan }}</h5>
                    </div>
                    <div class="card-body mt-4">
                        <form action="{{ route('ratecard.update', $ratecard->id_rate_card) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                {{-- Nama Layanan --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Nama Layanan</label>
                                    <input type="text" name="nama_layanan" class="form-control"
                                        value="{{ $ratecard->nama_layanan }}" required>
                                </div>

                                {{-- Platform (Multiple Select) --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Platform <span class="text-danger">*</span></label>
                                    <select name="platform[]" class="form-select @error('platform') is-invalid @enderror"
                                        multiple required>
                                        @php
                                            // Mengonversi data dari database (string/json) menjadi array
                                            $selectedPlatforms = is_array($ratecard->platform)
                                                ? $ratecard->platform
                                                : explode(',', $ratecard->platform);

                                            // Pilihan platform yang tersedia
                                            $availablePlatforms = [
                                                'Instagram',
                                                'Story Intsagram++',
                                                'Di Samperin Trio Kocak',
                                                'TikTok',
                                                'YouTube',
                                                'Twitter/X',
                                                'Facebook',
                                            ];
                                        @endphp

                                        @foreach ($availablePlatforms as $plat)
                                            <option value="{{ $plat }}"
                                                {{ in_array($plat, old('platform', $selectedPlatforms)) ? 'selected' : '' }}>
                                                {{ $plat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Tekan Ctrl (Win) / Command (Mac) untuk memilih lebih dari
                                        satu.</small>
                                </div>

                                {{-- Harga --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Harga Layanan (Rp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" name="harga" class="form-control"
                                            value="{{ $ratecard->harga }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Talent </label>
                                    <input type="number" name="talent" class="form-control"
                                        value="{{ $ratecard->talent }}" required>
                                </div>

                                {{-- Gambar --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Ubah Thumbnail (Kosongkan jika tidak diganti)</label>
                                    <input type="file" name="gambar_layanan" id="inputImg" class="form-control"
                                        accept="image/*">
                                    <div class="mt-2">
                                        <small class="text-muted d-block mb-1">Preview:</small>
                                        {{-- Menampilkan gambar lama sebagai default --}}
                                        <img id="previewImg" src="{{ asset('file/ratecard/' . $ratecard->gambar_layanan) }}"
                                            class="rounded shadow-sm" width="120" style="object-fit: cover">
                                    </div>
                                </div>

                                {{-- Deskripsi dengan Editor --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Deskripsi Layanan</label>
                                    <div class="editor-container">
                                        <textarea name="deskripsi_layanan" id="editor" class="form-control">{{ $ratecard->deskripsi_layanan }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bx bx-check-circle me-1"></i> Update Perubahan
                                </button>
                                <a href="{{ route('ratecard.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script Inisialisasi Editor & Preview --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        // Preview Gambar saat Upload
        document.getElementById('inputImg').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('previewImg').setAttribute('src', event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });

        // Inisialisasi CKEditor 5
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                    'insertTable', 'undo', 'redo'
                ]
            })
            .then(editor => {
                editor.editing.view.change(writer => {
                    writer.setStyle('min-height', '250px', editor.editing.view.document.getRoot());
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <style>
        .ck-editor__editable_inline {
            min-height: 250px !important;
        }

        .ck.ck-editor__main>.ck-editor__editable {
            background-color: #fff;
        }
    </style>
@endsection
