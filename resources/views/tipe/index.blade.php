@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> {{ $title }}
            </h4>
            <a href="{{ route('tipe.create') }}" class="btn btn-primary shadow-sm">
                <i class="bx bx-plus me-1"></i> Tambah Tipe
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
                <h5 class="card-title mb-0">Manajemen Tipe Produk</h5>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0" id="example3">
                    <thead class="table-light text-uppercase">
                        <tr>
                            <th class="text-center" width="70">No</th>
                            <th>Klasifikasi (Kategori > Jenis)</th>
                            <th>Nama Tipe</th>
                            <th class="text-center" width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tipe as $row)
                            <tr>
                                <td class="text-center fw-medium">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <small class="text-muted mb-1">
                                            <i class="bx bx-folder-open text-warning"></i> {{ $row->nama_kategori }}
                                        </small>
                                        <span class="badge bg-label-secondary w-fit-content">
                                            <i class="bx bx-chevron-right me-1"></i>{{ $row->nama_jenis }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xs me-2">
                                            <span class="avatar-initial rounded bg-label-success">
                                                <i class="bx bx-layer" style="font-size: 0.8rem;"></i>
                                            </span>
                                        </div>
                                        <span class="fw-bold text-dark">{{ $row->nama_tipe }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('tipe.edit', $row->id_tipe) }}"
                                            class="btn btn-icon btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                            title="Edit Tipe">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>

                                        <form action="{{ route('tipe.destroy', $row->id_tipe) }}" method="POST"
                                            class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-icon btn-sm btn-outline-danger show_confirm"
                                                data-bs-toggle="tooltip" title="Hapus Tipe">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="bx bx-layer-minus d-block mb-2 fs-2"></i>
                                    Data tipe belum tersedia.
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
        // Init Tooltips
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
                    title: 'Hapus Tipe Ini?',
                    text: "Data yang terhapus tidak bisa dikembalikan!",
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

<style>
    .w-fit-content {
        width: fit-content;
    }
</style>
