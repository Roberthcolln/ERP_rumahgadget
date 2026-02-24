@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> Detail Karyawan
            </h4>
            <a href="{{ route('anggota.index') }}" class="btn btn-label-secondary">
                <i class="bx bx-chevron-left me-1"></i> Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                @if ($anggota->foto)
                                    <img class="img-fluid rounded my-4" src="{{ asset('file/foto/' . $anggota->foto) }}"
                                        height="110" width="110" alt="User avatar" />
                                @else
                                    <div class="avatar avatar-xl my-4">
                                        <span
                                            class="avatar-initial rounded bg-label-primary fs-1">{{ substr($anggota->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="user-info text-center">
                                    <h4 class="mb-2">{{ $anggota->name }}</h4>
                                    <span class="badge bg-label-info">{{ $anggota->jabatan }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                            <div class="d-flex align-items-start me-4 mt-3 gap-3">
                                <span class="badge bg-label-primary p-2 rounded"><i class="bx bx-id-card bx-sm"></i></span>
                                <div>
                                    <h5 class="mb-0">
                                        @if ($anggota->id_kategori_anggota == 1)
                                            A
                                        @elseif($anggota->id_kategori_anggota == 2)
                                            B
                                        @else
                                            K
                                        @endif
                                        - {{ str_pad($anggota->id, 5, '0', STR_PAD_LEFT) }}
                                    </h5>
                                    <small>ID Karyawan</small>
                                </div>
                            </div>
                        </div>
                        <h5 class="pb-2 border-bottom mb-4">Kontak Personal</h5>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-3">
                                    <span class="fw-bold me-2 text-dark text-uppercase">Email:</span>
                                    <span class="text-muted">{{ $anggota->email }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2 text-dark text-uppercase">No. HP:</span>
                                    <span class="text-muted">+62{{ $anggota->no_hp }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2 text-dark text-uppercase">Status:</span>
                                    <span class="badge bg-label-success">{{ ucfirst($anggota->status) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7 col-md-7">
                <div class="card mb-4">
                    <h5 class="card-header"><i class="bx bx-user me-2"></i>Informasi Biodata</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label text-uppercase text-muted fw-bold small">NIK</label>
                                <p class="mb-0 text-dark fw-semibold">{{ $anggota->nik }}</p>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label text-uppercase text-muted fw-bold small">Tanggal Lahir</label>
                                <p class="mb-0 text-dark fw-semibold">
                                    {{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->isoFormat('dddd, D MMMM Y') }}</p>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label text-uppercase text-muted fw-bold small">Alamat Lengkap</label>
                                <p class="mb-0 text-dark fw-semibold">{{ $anggota->alamat }}</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <h5 class="card-header"><i class="bx bx-briefcase me-2"></i>Penempatan Kerja</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label text-uppercase text-muted fw-bold small">Kategori</label>
                                <p class="mb-0 text-dark fw-semibold">{{ $anggota->nama_kategori_anggota }}</p>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label text-uppercase text-muted fw-bold small">Pusat / Region</label>
                                <p class="mb-0 text-dark fw-semibold">{{ $anggota->nama_pusat }} /
                                    {{ $anggota->nama_region }}</p>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label class="form-label text-uppercase text-muted fw-bold small">Divisi</label>
                                <p class="mb-0 text-dark fw-semibold">{{ $anggota->nama_divisi }}</p>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label class="form-label text-uppercase text-muted fw-bold small">Departement</label>
                                <p class="mb-0 text-dark fw-semibold">{{ $anggota->nama_departement }}</p>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <label class="form-label text-uppercase text-muted fw-bold small">Tanggal Gabung</label>
                                <p class="mb-0 text-dark fw-semibold">
                                    {{ \Carbon\Carbon::parse($anggota->tanggal_gabung)->isoFormat('D MMMM Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light-primary rounded-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small text-muted italic">Terdaftar sejak
                                {{ \Carbon\Carbon::parse($anggota->created_at)->diffForHumans() }}</span>
                            <button class="btn btn-primary btn-sm" onclick="window.print()">
                                <i class="bx bx-printer me-1"></i> Cetak Profil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
