@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Master</a></li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-xl">
                <div class="card shadow-sm mb-4 border-0">
                    {{-- Header dengan Gradasi Halus --}}
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom bg-light">
                        <h5 class="mb-0 fw-bold"><i class="bx bx-user-plus me-2 text-primary"></i>Tambah {{ $title }}
                        </h5>
                        <small class="text-muted float-end">Silahkan lengkapi data anggota</small>
                    </div>

                    <div class="card-body pt-4">
                        @if ($errors->any())
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="bx bx-error-circle me-2"></i>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Section 1: Kredensial Akun --}}
                            <div class="divider text-start divider-primary">
                                <div class="divider-text fw-bold text-uppercase">Informasi Akun</div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Nama Lengkap</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" name="name" placeholder="John Doe"
                                            value="{{ old('name') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Email Resmi</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="email@perusahaan.com" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Password</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-lock-alt"></i></span>
                                        <input type="password" class="form-control" name="password" placeholder="••••••••">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Konfirmasi Password</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-lock-check"></i></span>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="••••••••">
                                    </div>
                                </div>
                            </div>

                            {{-- Section 2: Informasi Pekerjaan --}}
                            <div class="divider text-start divider-primary">
                                <div class="divider-text fw-bold text-uppercase">Struktur Organisasi</div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Kategori Karyawan</label>
                                    <select name="id_kategori_anggota" class="form-select border-primary-subtle">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori_anggota as $row)
                                            <option value="{{ $row->id_kategori_anggota }}">
                                                {{ $row->nama_kategori_anggota }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Departement</label>
                                    <select name="id_departement" class="form-select">
                                        <option value="">Pilih Departement</option>
                                        @foreach ($departement as $row)
                                            <option value="{{ $row->id_departement }}">{{ $row->nama_departement }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Divisi</label>
                                    <select name="id_divisi" class="form-select">
                                        <option value="">Pilih Divisi</option>
                                        @foreach ($divisi as $row)
                                            <option value="{{ $row->id_divisi }}">{{ $row->nama_divisi }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Pusat</label>
                                    <select name="id_pusat" id="pusat-dd" class="form-select">
                                        <option value="">Pilih Pusat</option>
                                        @foreach ($pusat as $row)
                                            <option value="{{ $row->id_pusat }}">{{ $row->nama_pusat }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Unit / Region</label>
                                    <select name="id_region" id="region-dd" class="form-select border-info-subtle"></select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control"
                                        placeholder="Contoh: Manager Operasional" value="{{ old('jabatan') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Tanggal Bergabung</label>
                                    <input type="date" name="tanggal_gabung" class="form-control"
                                        value="{{ old('tanggal_gabung') }}">
                                </div>
                            </div>

                            {{-- Section 3: Data Pribadi --}}
                            <div class="divider text-start divider-primary">
                                <div class="divider-text fw-bold text-uppercase">Biodata Pribadi</div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">No. HP (WhatsApp)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-success text-white">+62</span>
                                        <input type="number" class="form-control" name="no_hp" placeholder="812xxxx"
                                            value="{{ old('no_hp') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">NIK (No. Induk Kependudukan)</label>
                                    <input type="number" name="nik" class="form-control"
                                        placeholder="16 digit angka" value="{{ old('nik') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                        value="{{ old('tanggal_lahir') }}">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Alamat Domisili</label>
                                    <input type="text" name="alamat" class="form-control"
                                        placeholder="Jl. Raya No. 123..." value="{{ old('alamat') }}">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Foto Profil</label>
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        <div class="preview-container border rounded bg-light d-flex align-items-center justify-content-center"
                                            style="width: 100px; height: 100px; overflow: hidden;">
                                            <img id="previewImg" src="{{ asset('assets/img/avatars/1.png') }}"
                                                alt="preview" class="d-none w-100 h-100 object-fit-cover">
                                            <i id="placeholderIcon" class="bx bx-image-add fs-1 text-muted"></i>
                                        </div>
                                        <div class="button-wrapper">
                                            <label for="inputImg" class="btn btn-primary btn-sm me-2 mb-2"
                                                tabindex="0">
                                                <span class="d-none d-sm-block">Upload Foto</span>
                                                <i class="bx bx-upload d-block d-sm-none"></i>
                                                <input id="inputImg" type="file" accept="image/*" name="foto"
                                                    hidden />
                                            </label>
                                            <p class="text-muted mb-0 small">Allowed JPG, GIF or PNG. Max size of 2MB</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5 border-top pt-4">
                                <button type="submit" class="btn btn-primary px-5 shadow">
                                    <i class="bx bx-save me-1"></i> Simpan Data Anggota
                                </button>
                                <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('inputImg').addEventListener('change', function() {
            const input = this;
            const preview = document.getElementById('previewImg');
            const placeholder = document.getElementById('placeholderIcon');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.setAttribute('src', e.target.result);
                    preview.classList.remove("d-none");
                    placeholder.classList.add("d-none");
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection
