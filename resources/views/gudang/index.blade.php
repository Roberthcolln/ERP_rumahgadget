@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Gudang /</span> {{ $title }}
            </h4>
            <a href="{{ route('gudang.create') }}" class="btn btn-primary shadow-sm">
                <i class="bx bx-plus me-1"></i> Tambah Gudang
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header border-bottom bg-transparent py-3">
                <h5 class="card-title mb-0">Manajemen Lokasi Gudang</h5>
            </div>

            <div class="card-body p-0">
                @if ($message = Session::get('Sukses'))
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-check-circle me-2"></i> {{ $message }}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover align-middle mb-0" id="example3">
                        <thead class="table-light text-uppercase">
                            <tr>
                                <th class="text-center" width="70">No</th>
                                <th>Informasi Gudang</th>
                                <th>Alamat Lokasi</th>
                                <th>Person In Charge (PIC)</th>
                                <th>Status Operasional</th>
                                <th class="text-center" width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($gudang as $row)
                                <tr>
                                    <td class="text-center fw-medium">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-3">
                                                <span class="avatar-initial rounded bg-label-secondary">
                                                    <i class="bx bx-home-alt"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-dark">{{ $row->nama_gudang }}</span>
                                                <small class="text-muted" style="font-size: 0.75rem;">ID:
                                                    {{ $row->kode_gudang }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-wrap" style="max-width: 250px;">
                                            <i class="bx bx-map text-danger me-1"></i>
                                            <small class="text-muted">{{ $row->alamat_gudang }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bx bx-user-circle me-2 text-info"></i>
                                            <span class="fw-medium">{{ $row->penanggung_jawab }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($row->status == 'aktif')
                                            <span class="badge bg-label-success border-success px-3">
                                                <i class="bx bxs-circle me-1" style="font-size: 8px;"></i> Aktif
                                            </span>
                                        @else
                                            <span class="badge bg-label-danger border-danger px-3">
                                                <i class="bx bxs-circle me-1" style="font-size: 8px;"></i> Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-icon btn-outline-secondary hide-arrow shadow-none"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                                <a href="{{ route('gudang.edit', $row->id_gudang) }}"
                                                    class="dropdown-item py-2">
                                                    <i class="bx bx-edit-alt me-2 text-warning"></i> Edit Gudang
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('gudang.destroy', $row->id_gudang) }}" method="POST"
                                                    class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="dropdown-item py-2 text-danger show_confirm">
                                                        <i class="bx bx-trash me-2"></i> Hapus Gudang
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bx bx-store-alt d-block mb-2 fs-1"></i>
                                        Belum ada data gudang terdaftar.
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // SweetAlert Delete Confirmation
        document.querySelectorAll('.show_confirm').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let form = this.closest("form");

                Swal.fire({
                    title: 'Hapus Gudang?',
                    text: "Menghapus gudang akan berisiko menghilangkan data stok yang tersimpan di dalamnya!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ff3e1d',
                    cancelButtonColor: '#8592a3',
                    confirmButtonText: 'Ya, Hapus Gudang!',
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
