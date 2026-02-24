@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Header Page --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> {{ $title }}
            </h4>
            <a href="{{ route('departement.create') }}" class="btn btn-primary shadow-sm">
                <i class="bx bx-plus me-1"></i> Tambah Departement
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 py-3 px-4 mt-2">
                <div class="d-flex align-items-center">
                    <i class="bx bx-buildings bx-md text-primary me-2"></i>
                    <h5 class="card-title mb-0 fw-semibold">Daftar Departement</h5>
                </div>
            </div>

            <div class="card-body">
                {{-- Notifikasi Sukses --}}
                @if ($message = Session::get('Sukses'))
                    <div class="alert alert-success alert-dismissible fade show mx-2" role="alert">
                        <i class="bx bx-check-circle me-2"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover align-middle border-top" id="example1">
                        <thead class="table-light">
                            <tr>
                                <th width="70" class="text-center">No</th>
                                <th>Informasi Departement</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($departement as $row)
                                <tr>
                                    <td class="text-center text-muted fw-medium">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded bg-label-primary">
                                                    <i class="bx bx-briefcase-alt-2"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark d-block">{{ $row->nama_departement }}</span>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded fs-4"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end shadow border-0 py-2">
                                                <a class="dropdown-item text-primary py-2"
                                                    href="{{ route('departement.edit', $row->id_departement) }}">
                                                    <i class="bx bx-edit-alt me-2"></i> Edit Nama
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('departement.destroy', $row->id_departement) }}"
                                                    method="POST" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="dropdown-item text-danger py-2 show_confirm">
                                                        <i class="bx bx-trash me-2"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bx bx-objects-horizontal-left fs-1 mb-2"></i>
                                            <p class="mb-0">Data departement belum tersedia.</p>
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
            document.querySelectorAll('.show_confirm').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    let form = this.closest("form");

                    Swal.fire({
                        title: 'Hapus Departement?',
                        text: "Seluruh data anggota di departement ini akan kehilangan relasinya!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ff3e1d',
                        cancelButtonColor: '#8592a3',
                        confirmButtonText: 'Ya, Hapus Tetap!',
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
