@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Supplier /</span> {{ $title }}
            </h4>
            <a href="{{ route('supplier.create') }}" class="btn btn-primary shadow-sm">
                <i class="bx bx-plus me-1"></i> Tambah Supplier
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header border-bottom bg-transparent py-3">
                <h5 class="card-title mb-0">Daftar Supplier</h5>
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
                                <th>Profil Supplier</th>
                                <th>Perusahaan</th>
                                <th>Kontak</th>
                                <th>Status</th>
                                <th class="text-center" width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($supplier as $row)
                                <tr>
                                    <td class="text-center fw-medium">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-dark">{{ $row->nama_supplier }}</span>
                                            <span class="badge bg-label-secondary w-fit-content mt-1"
                                                style="font-size: 0.7rem;">
                                                <i class="bx bx-hash me-1"></i>{{ $row->kode_supplier }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bx bx-buildings me-2 text-primary"></i>
                                            <span>{{ $row->perusahaan }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <small class="text-dark fw-medium"><i
                                                    class="bx bx-phone me-1"></i>{{ $row->telepon }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($row->status == 'aktif')
                                            <span class="badge bg-label-success border-success">
                                                <span class="badge-dot bg-success me-1"></span> Aktif
                                            </span>
                                        @else
                                            <span class="badge bg-label-danger border-danger">
                                                <span class="badge-dot bg-danger me-1"></span> Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-icon btn-outline-secondary hide-arrow shadow-none"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow border-0">
                                                <a href="{{ route('supplier.edit', $row->id_supplier) }}"
                                                    class="dropdown-item py-2">
                                                    <i class="bx bx-edit-alt me-2 text-warning"></i> Edit Detail
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('supplier.destroy', $row->id_supplier) }}"
                                                    method="POST" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="dropdown-item py-2 text-danger show_confirm">
                                                        <i class="bx bx-trash me-2"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bx bx-user-x d-block mb-2 fs-1"></i>
                                        Data supplier belum terdaftar.
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

<style>
    .w-fit-content {
        width: fit-content;
    }

    .badge-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }

    .table thead th {
        font-weight: 600;
        font-size: 0.75rem;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // SweetAlert Delete Confirmation
        document.querySelectorAll('.show_confirm').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let form = this.closest("form");

                Swal.fire({
                    title: 'Hapus Supplier?',
                    text: "Menghapus supplier akan berdampak pada riwayat pengadaan barang!",
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
