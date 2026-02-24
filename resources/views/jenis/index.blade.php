@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> {{ $title }}
            </h4>
            <a href="{{ route('jenis.create') }}" class="btn btn-primary shadow-sm">
                <i class="bx bx-plus me-1"></i> Tambah Jenis
            </a>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show m-0 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bx bx-check-circle me-2"></i>
                    {{ $message }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-header border-bottom bg-transparent py-3">
                <h5 class="card-title mb-0">Manajemen Jenis Produk</h5>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0" id="example3">
                    <thead class="table-light text-uppercase">
                        <tr>
                            <th class="text-center" width="70">No</th>
                            <th>Kategori Parent</th>
                            <th>Nama Jenis</th>
                            <th class="text-center" width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jenis as $row)
                            <tr>
                                <td class="text-center fw-medium">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-label-secondary text-capitalize">
                                        <i class="bx bx-folder me-1"></i> {{ $row->nama_kategori }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xs me-2">
                                            <span class="avatar-initial rounded bg-label-info">
                                                <i class="bx bx-purchase-tag-alt" style="font-size: 0.8rem;"></i>
                                            </span>
                                        </div>
                                        <span class="fw-semibold text-dark">{{ $row->nama_jenis }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('jenis.edit', $row->id_jenis) }}"
                                            class="btn btn-icon btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                            title="Edit Jenis">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>

                                        <form action="{{ route('jenis.destroy', $row->id_jenis) }}" method="POST"
                                            class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-icon btn-sm btn-outline-danger show_confirm"
                                                data-bs-toggle="tooltip" title="Hapus Jenis">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bx bx-info-circle d-block mb-2 fs-3"></i>
                                    Belum ada data jenis yang tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Init Bootstrap Tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // SweetAlert Delete Confirmation
        document.querySelectorAll('.show_confirm').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let form = this.closest("form");

                Swal.fire({
                    title: 'Hapus data jenis?',
                    text: "Produk yang terhubung dengan jenis ini mungkin akan terpengaruh!",
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
