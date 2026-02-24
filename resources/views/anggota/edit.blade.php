@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master / {{ $title }} /</span> Edit Data
            </h4>
            <a href="{{ route('anggota.index') }}" class="btn btn-label-secondary">
                <i class="bx bx-arrow-back me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @php
                $isAdmin = auth()->user()->jabatan === 'Admin';
            @endphp

            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="bx bx-user me-2"></i>Informasi Akun</h5>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-alert-light-danger alert-dismissible" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name" placeholder="John Doe"
                                        value="{{ old('name', $anggota->name) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="john@example.com"
                                        value="{{ old('email', $anggota->email) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-warning">Ganti Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="••••••••">
                                    <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="••••••••">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bx bx-id-card me-2"></i>Informasi Personal</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">NIK (Nomor Induk Kependudukan)</label>
                                    <input type="number" name="nik" class="form-control" value="{{ $anggota->nik }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">No. HP</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">ID (+62)</span>
                                        <input type="number" name="no_hp" class="form-control"
                                            value="{{ $anggota->no_hp }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select select2">
                                        <option value="Laki-laki"
                                            {{ $anggota->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="Perempuan"
                                            {{ $anggota->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                        value="{{ $anggota->tanggal_lahir }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Tanggal Gabung</label>
                                    <input type="date" name="tanggal_gabung" class="form-control"
                                        value="{{ $anggota->tanggal_gabung }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="2">{{ $anggota->alamat }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class="card mb-4">
                        <div class="card-header bg-label-primary">
                            <h5 class="mb-0"><i class="bx bx-buildings me-2"></i>Struktur Organisasi</h5>
                        </div>
                        <div class="card-body pt-3">
                            <div class="row g-3">
                                @if (!$isAdmin)
                                    <div class="alert alert-info small">Hanya Admin yang dapat merubah struktur organisasi.
                                    </div>
                                @endif

                                <div class="col-12" {{ !$isAdmin ? 'style=display:none' : '' }}>
                                    <label class="form-label">Kategori Anggota</label>
                                    <select name="id_kategori_anggota" class="form-select">
                                        @foreach ($kategori_anggota as $row)
                                            <option value="{{ $row->id_kategori_anggota }}"
                                                {{ $anggota->id_kategori_anggota == $row->id_kategori_anggota ? 'selected' : '' }}>
                                                {{ $row->nama_kategori_anggota }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12" {{ !$isAdmin ? 'style=display:none' : '' }}>
                                    <label class="form-label">Divisi</label>
                                    <select name="id_divisi" class="form-select">
                                        @foreach ($divisi as $row)
                                            <option value="{{ $row->id_divisi }}"
                                                {{ $anggota->id_divisi == $row->id_divisi ? 'selected' : '' }}>
                                                {{ $row->nama_divisi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12" {{ !$isAdmin ? 'style=display:none' : '' }}>
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" name="jabatan" class="form-control"
                                        value="{{ $anggota->jabatan }}">
                                </div>

                                <div class="col-12" {{ !$isAdmin ? 'style=display:none' : '' }}>
                                    <label class="form-label">Pusat / Unit</label>
                                    <select name="id_pusat" id="pusat-dd" class="form-select mb-2">
                                        @foreach ($pusat as $row)
                                            <option value="{{ $row->id_pusat }}"
                                                {{ $anggota->id_pusat == $row->id_pusat ? 'selected' : '' }}>
                                                {{ $row->nama_pusat }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select name="id_region" id="region-dd" class="form-select text-primary">
                                        <option value="{{ $anggota->id_region }}">{{ $anggota->nama_region }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4 text-center">
                        <div class="card-header">
                            <h5 class="mb-0">Foto Profil</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center">
                                <img src="{{ asset('file/foto/' . $anggota->foto) }}" alt="Avatar" id="previewImg"
                                    class="rounded-circle mb-3 border p-1"
                                    style="width: 150px; height: 150px; object-fit: cover;">

                                <div class="input-group">
                                    <input type="file" name="foto" id="inputImg" class="form-control"
                                        accept="image/*">
                                </div>
                                <label class="form-label mt-2 small text-muted">Format: JPG, PNG (Max 2MB)</label>
                            </div>
                        </div>
                    </div>

                    <div class="card border-primary">
                        <div class="card-body p-3">
                            <button type="submit" class="btn btn-primary w-100 btn-lg shadow">
                                <i class="bx bx-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Preview Gambar
        document.getElementById('inputImg').addEventListener('change', function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = document.getElementById('previewImg');
                    preview.setAttribute('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        // Gunakan gaya hidden 'style=display:none' lebih baik daripada atribut 'hidden' 
        // agar space layout tetap konsisten saat dirender CSS.
    </script>
@endsection
