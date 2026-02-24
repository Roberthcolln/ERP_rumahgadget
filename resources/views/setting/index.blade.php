@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Pengaturan /</span> {{ $title }}
        </h4>

        <div class="row">
            <div class="col-md-12">
                @if ($message = Session::get('Sukses'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="bx bx-check-circle me-2"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('setting.update', $setting->id_setting) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card shadow-sm">
                        {{-- Navigasi Tab --}}
                        <div class="card-header border-bottom p-0">
                            <ul class="nav nav-tabs nav-fill" role="tablist">
                                <li class="nav-item">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-general">
                                        <i class="tf-icons bx bx-info-circle me-1"></i> Informasi Umum
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-contact">
                                        <i class="tf-icons bx bx-phone me-1"></i> Kontak & Sosmed
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-media">
                                        <i class="tf-icons bx bx-image me-1"></i> Branding & Media
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-location">
                                        <i class="tf-icons bx bx-map me-1"></i> Lokasi Toko
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body mt-3">
                            <div class="tab-content p-0 shadow-none border-0">

                                {{-- Tab 1: General --}}
                                <div class="tab-pane fade show active" id="navs-general" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Nama Aplikasi / Instansi</label>
                                            <input type="text" name="instansi_setting" class="form-control"
                                                value="{{ $setting->instansi_setting }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Nama Pimpinan</label>
                                            <input type="text" name="pimpinan_setting" class="form-control"
                                                value="{{ $setting->pimpinan_setting }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold">Meta Keywords (SEO)</label>
                                            <input type="text" name="keyword_setting" class="form-control"
                                                placeholder="pisahkan dengan koma" value="{{ $setting->keyword_setting }}">
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-semibold">Deskripsi / Tentang Aplikasi</label>
                                            <textarea name="tentang_setting" id="editor" class="form-control">{{ $setting->tentang_setting }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tab 2: Contact --}}
                                <div class="tab-pane fade" id="navs-contact" role="tabpanel">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold"><i class="bx bxl-youtube text-danger"></i>
                                                Youtube</label>
                                            <input type="text" name="youtube_setting" class="form-control"
                                                value="{{ $setting->youtube_setting }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold"><i
                                                    class="bx bxl-instagram text-primary"></i> Instagram</label>
                                            <input type="text" name="instagram_setting" class="form-control"
                                                value="{{ $setting->instagram_setting }}">
                                        </div>
                                        <hr class="my-2">
                                        <div class="col-md-6">
                                            <label class="form-label d-flex justify-content-between">
                                                <span>Email Utama</span>
                                                <span class="badge bg-label-warning">Cabang Gunung Agung</span>
                                            </label>
                                            <input type="email" name="email_setting" class="form-control"
                                                value="{{ $setting->email_setting }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label d-flex justify-content-between">
                                                <span>Email Alternatif</span>
                                                <span class="badge bg-label-info">Cabang Teuku Umar</span>
                                            </label>
                                            <input type="email" name="email_setting_2" class="form-control"
                                                value="{{ $setting->email_setting_2 }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">No. HP (Gunung Agung)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                                <input type="text" name="no_hp_setting" class="form-control"
                                                    value="{{ $setting->no_hp_setting }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">No. HP (Teuku Umar)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                                <input type="text" name="no_hp_setting_2" class="form-control"
                                                    value="{{ $setting->no_hp_setting_2 }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tab 3: Media --}}
                                <div class="tab-pane fade" id="navs-media" role="tabpanel">
                                    <div class="row g-4 align-items-center">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                <img src="{{ asset('logo/' . $setting->logo_setting) }}" alt="logo"
                                                    class="d-block rounded border p-2" height="100" width="100"
                                                    id="uploadedLogo">
                                                <div class="button-wrapper">
                                                    <label class="form-label fw-bold">Update Logo Utama</label>
                                                    <input type="file" name="logo_setting" class="form-control mb-1">
                                                    <small class="text-muted">Format: JPG, PNG. Maks 2MB</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 border-start">
                                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                <img src="{{ asset('favicon/' . $setting->favicon_setting) }}"
                                                    alt="favicon" class="d-block rounded border p-2" height="60"
                                                    width="60" id="uploadedFav">
                                                <div class="button-wrapper">
                                                    <label class="form-label fw-bold">Update Favicon</label>
                                                    <input type="file" name="favicon_setting"
                                                        class="form-control mb-1">
                                                    <small class="text-muted">Format: ICO, PNG (Square)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tab 4: Location --}}
                                <div class="tab-pane fade" id="navs-location" role="tabpanel">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold badge bg-warning text-dark mb-2">Cabang Gunung
                                                Agung</label>
                                            <textarea name="maps_setting" class="form-control mb-2" rows="2" placeholder="Embed URL dari Google Maps">{{ $setting->maps_setting }}</textarea>
                                            <input type="text" name="alamat_setting" class="form-control mb-2"
                                                placeholder="Alamat Lengkap" value="{{ $setting->alamat_setting }}">
                                            <div class="ratio ratio-21x9 rounded overflow-hidden border">
                                                <iframe src="{{ $setting->maps_setting }}" style="border:0;"
                                                    allowfullscreen></iframe>
                                            </div>
                                        </div>
                                        <div class="col-md-6 border-start">
                                            <label class="form-label fw-bold badge bg-info text-white mb-2">Cabang Teuku
                                                Umar</label>
                                            <textarea name="maps_setting_2" class="form-control mb-2" rows="2" placeholder="Embed URL dari Google Maps">{{ $setting->maps_setting_2 }}</textarea>
                                            <input type="text" name="alamat_setting_2" class="form-control mb-2"
                                                placeholder="Alamat Lengkap" value="{{ $setting->alamat_setting_2 }}">
                                            <div class="ratio ratio-21x9 rounded overflow-hidden border">
                                                <iframe src="{{ $setting->maps_setting_2 }}" style="border:0;"
                                                    allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer bg-light border-top text-end">
                            <button type="reset" class="btn btn-outline-secondary me-2">Reset</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote']
            })
            .catch(error => console.error(error));
    </script>

    <style>
        /* Custom Styling untuk Tab agar lebih clean */
        .nav-tabs .nav-link.active {
            border-bottom: 2px solid #696cff !important;
            color: #696cff !important;
            background: transparent !important;
        }

        .nav-tabs .nav-link {
            border: none;
            padding: 1rem;
        }

        .card-header {
            background-color: #f8f9fa;
        }
    </style>
@endsection
