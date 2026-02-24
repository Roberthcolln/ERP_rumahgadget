@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Header Page --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> {{ $title }}
            </h4>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    {{-- Dekorasi Atas --}}
                    <div class="bg-primary p-4 text-center">
                        <div class="avatar avatar-xl mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-white shadow-sm">
                                <i class="bx bx-buildings bx-lg text-primary"></i>
                            </span>
                        </div>
                        <h5 class="text-white mb-0 fw-bold">Informasi Kantor Pusat</h5>
                        <p class="text-white opacity-75 small mb-0">Kelola identitas utama organisasi Anda</p>
                    </div>

                    <div class="card-body p-4">
                        {{-- Notifikasi Sukses --}}
                        @if ($message = Session::get('Sukses'))
                            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4"
                                role="alert">
                                <div class="d-flex">
                                    <i class="bx bx-check-circle me-2 fs-4"></i>
                                    <div>{{ $message }}</div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="list-group list-group-flush border rounded-3 mb-4">
                            @foreach ($pusat as $row)
                                <div class="list-group-item p-3">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div>
                                            <small class="text-muted d-block text-uppercase fw-semibold mb-1"
                                                style="font-size: 0.7rem; letter-spacing: 1px;">Nama Perusahaan
                                                Pusat</small>
                                            <h4 class="mb-0 text-dark fw-bold">{{ $row->nama_pusat }}</h4>
                                        </div>
                                        <div class="badge bg-label-primary rounded-pill px-3">Primary Identity</div>
                                    </div>
                                </div>
                                <div class="list-group-item p-3 bg-light">
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-info-circle me-2 text-primary"></i>
                                        <small class="text-muted italic">Data ini digunakan sebagai identitas utama pada
                                            sistem.</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-grid">
                            @foreach ($pusat as $row)
                                <a href="{{ route('pusat.edit', $row->id_pusat) }}" class="btn btn-primary btn-lg shadow">
                                    <i class="bx bx-edit-alt me-2"></i> Perbarui Data Pusat
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Footer Info --}}
                <div class="text-center mt-3 text-muted">
                    <small><i class="bx bx-lock-alt me-1"></i> Data pusat bersifat tunggal dan tidak dapat dihapus untuk
                        menjaga integritas sistem.</small>
                </div>
            </div>
        </div>
    </div>
@endsection
