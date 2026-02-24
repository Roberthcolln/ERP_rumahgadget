@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Header Page --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> {{ $title }}
            </h4>
            {{-- Tombol tambah bisa diletakkan di sini jika diperlukan di masa depan --}}
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 py-3 px-4">
                <div class="d-flex align-items-center">
                    <i class="bx bx-shield-quarter bx-md text-primary me-2"></i>
                    <h5 class="card-title mb-0 fw-semibold">Daftar Administrator</h5>
                </div>
            </div>

            <div class="card-body">
                {{-- Alert Sukses --}}
                @if ($message = Session::get('Sukses'))
                    <div class="alert alert-success alert-dismissible fade show mx-2" role="alert">
                        <i class="bx bx-check-circle me-2"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover align-middle border-top">
                        <thead class="table-light">
                            <tr>
                                <th width="50" class="text-center">No</th>
                                <th>Profil Admin</th>
                                <th>ID Akses</th>
                                <th>Kontak</th>
                                {{-- <th class="text-center">Status</th> --}}
                                {{-- <th width="100" class="text-center">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admin as $row)
                                <tr>
                                    <td class="text-center text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-3">
                                                <div class="rounded-circle bg-label-primary d-flex align-items-center justify-content-center fw-bold shadow-sm"
                                                    style="width: 40px; height: 40px;">
                                                    {{ substr($row->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-semibold">{{ $row->name }}</h6>
                                                <small class="text-muted">Administrator System</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <code class="fw-bold px-2 py-1 bg-light rounded text-primary">
                                            @if ($row->id_kategori_anggota == 1)
                                                ADM-A{{ str_pad($row->id, 4, '0', STR_PAD_LEFT) }}
                                            @elseif($row->id_kategori_anggota == 2)
                                                ADM-B{{ str_pad($row->id, 4, '0', STR_PAD_LEFT) }}
                                            @else
                                                ADM-K{{ str_pad($row->id, 4, '0', STR_PAD_LEFT) }}
                                            @endif
                                        </code>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="small"><i
                                                    class="bx bx-envelope me-1"></i>{{ $row->email }}</span>
                                            <span class="small text-muted"><i
                                                    class="bx bx-phone me-1"></i>+62{{ $row->no_hp }}</span>
                                        </div>
                                    </td>
                                    {{-- <td class="text-center">
                                        <span
                                            class="badge rounded-pill bg-{{ $row->status == 'aktif' ? 'success' : 'danger' }} bg-opacity-10 text-{{ $row->status == 'aktif' ? 'success' : 'danger' }} border border-{{ $row->status == 'aktif' ? 'success' : 'danger' }} px-3">
                                            {{ ucfirst($row->status) }}
                                        </span>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <img src="https://illustrations.popsy.co/gray/data-analysis.svg" alt="no-data"
                                            style="width: 120px;" class="mb-3 opacity-50">
                                        <p class="text-muted">Tidak ada data administrator yang ditemukan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Script tetap dipertahankan jika nantinya kolom Aksi diaktifkan kembali --}}
@endsection
