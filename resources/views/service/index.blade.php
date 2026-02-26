@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> {{ $title }}
            </h4>
            <a href="{{ route('service.create') }}" class="btn btn-primary shadow-sm">
                <i class="bx bx-plus me-1"></i> Tambah Service
            </a>
        </div>

        @if ($message = Session::get('Sukses'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bx bx-check-circle me-2"></i>
                    {{ $message }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="card-header border-bottom bg-transparent py-3">
                <h5 class="card-title mb-0">Daftar Harga Service</h5>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0" id="example3">
                    <thead class="table-light text-uppercase">
                        <tr>
                            <th class="text-center" width="70">No</th>
                            <th>Kategori</th>
                            <th>Type / Model</th>
                            <th>Macbook</th>
                            <th class="text-center" width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $row)
                            <tr>
                                <td class="text-center fw-medium">{{ $loop->iteration }}</td>
                                <td><span class="badge bg-label-info">{{ $row->kategori->nama_kategori_service }}</span>
                                </td>
                                <td><span class="fw-semibold text-dark">{{ $row->type }}</span></td>
                                <td>{{ $row->macbook ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('service.edit', $row->id_service) }}"
                                            class="btn btn-icon btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                            title="Edit Data">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>

                                        <form action="{{ route('service.destroy', $row->id_service) }}" method="POST"
                                            class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-icon btn-sm btn-outline-danger show_confirm"
                                                data-bs-toggle="tooltip" title="Hapus Data">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        document.querySelectorAll('.show_confirm').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let form = this.closest("form");
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data service ini akan dihapus permanen!",
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
