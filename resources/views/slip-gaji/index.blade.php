@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Header Page --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold mb-1">
                    <span class="text-muted fw-light">Master /</span> {{ $title }}
                </h4>
                <p class="text-muted small mb-0">Kelola dan pantau riwayat slip gaji karyawan secara efisien.</p>
            </div>
            @if (auth()->user()->is_admin == 1 || auth()->user()->jabatan == 'HRD')
                <a href="{{ route('slip-gaji.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bx bx-plus me-1"></i> Tambah Slip Gaji
                </a>
            @endif
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 py-3 px-4 mt-2">
                <div class="d-flex align-items-center">
                    <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-primary">
                            <i class="bx bx-receipt fs-4"></i>
                        </span>
                    </div>
                    <h5 class="card-title mb-0 fw-semibold">Daftar Riwayat Gaji</h5>
                </div>
            </div>

            <div class="card-body">
                {{-- Notifikasi Sukses --}}
                @if ($message = Session::get('Sukses'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex">
                            <i class="bx bx-check-circle me-2 fs-4"></i>
                            <div>
                                <strong>Berhasil!</strong> {{ $message }}
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="70" class="text-center">No</th>
                                <th>Karyawan</th>
                                <th>Periode Gaji</th>
                                <th>Total Diterima</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($slipGaji as $item)
                                <tr>
                                    <td class="text-center text-muted fw-medium">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded-circle bg-label-info text-uppercase">
                                                    {{ substr($item->user->name, 0, 2) }}
                                                </span>
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block">{{ $item->user->name }}</span>
                                                <small class="text-muted">Karyawan Aktif</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-label-primary px-3 py-2 rounded-pill">
                                            <i class="bx bx-calendar me-1"></i> {{ $item->periode }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success fs-6">
                                            Rp {{ number_format($item->total_gaji, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-2">
                                            {{-- Tombol Detail --}}
                                            <a href="{{ route('slip-gaji.show', $item->id) }}"
                                                class="btn btn-sm btn-icon btn-outline-info" data-bs-toggle="tooltip"
                                                title="Lihat Detail">
                                                <i class="bx bx-show"></i>
                                            </a>

                                            {{-- Tombol Hapus (Hanya Admin) --}}
                                            @if (auth()->user()->is_admin == 1)
                                                <form action="{{ route('slip-gaji.destroy', $item->id) }}" method="POST"
                                                    class="m-0 d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-icon btn-outline-danger show_confirm"
                                                        data-bs-toggle="tooltip" title="Hapus Data">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="py-4">
                                            <i class="bx bx-file-blank display-1 text-light mb-3"></i>
                                            <h6 class="text-muted">Belum ada data slip gaji tersedia.</h6>
                                            <p class="small text-muted">Data yang baru dibuat akan muncul di tabel ini.</p>
                                        </div>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inisialisasi Tooltip Bootstrap
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Handle Konfirmasi Hapus
            document.querySelectorAll('.show_confirm').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    let form = this.closest("form");

                    Swal.fire({
                        title: 'Hapus Slip Gaji?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ff3e1d',
                        cancelButtonColor: '#8592a3',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        customClass: {
                            confirmButton: 'btn btn-danger me-3',
                            cancelButton: 'btn btn-label-secondary'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
