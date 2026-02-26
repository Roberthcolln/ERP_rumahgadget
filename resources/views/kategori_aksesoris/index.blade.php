@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> {{ $title }}
            </h4>
            <a href="{{ route('kategori_aksesoris.create') }}" class="btn btn-primary shadow-sm">
                <i class="bx bx-plus me-1"></i> Tambah Kategori Aksesoris
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
                <h5 class="card-title mb-0">Daftar Kategori Aksesoris</h5>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0" id="example3">
                    <thead class="table-light text-uppercase">
                        <tr>
                            <th class="text-center" width="70">No</th>
                            <th>Nama Kategori Aksesoris</th>
                            <th class="text-center" width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori_aksesoris as $row)
                            <tr>
                                <td class="text-center fw-medium">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-xs me-2">
                                            <span class="avatar-initial rounded bg-label-primary text-uppercase"
                                                style="font-size: 0.7rem;">
                                                {{ substr($row->nama_kategori_aksesoris, 0, 1) }}
                                            </span>
                                        </div>
                                        <span class="fw-semibold text-dark">{{ $row->nama_kategori_aksesoris }}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('kategori_aksesoris.edit', $row->id_kategori_aksesoris) }}"
                                            class="btn btn-icon btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                            title="Edit Data">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>

                                        <form
                                            action="{{ route('kategori_aksesoris.destroy', $row->id_kategori_aksesoris) }}"
                                            method="POST" class="m-0">
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
        // Initialize Tooltips (Bootstrap)
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // SweetAlert Delete Confirmation
        document.querySelectorAll('.show_confirm').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let form = this.closest("form");

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data kategori_aksesoris ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ff3e1d', // Sneat Danger Color
                    cancelButtonColor: '#8592a3', // Sneat Secondary Color
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
