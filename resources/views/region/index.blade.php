@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- Header Page --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master / Region /</span> {{ $title }}
            </h4>
            <a href="{{ route('region.create') }}" class="btn btn-primary shadow-sm">
                <i class="bx bx-plus me-1"></i> Tambah Region
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 py-3 px-4 mt-2">
                <div class="d-flex align-items-center">
                    <i class="bx bx-map-alt bx-md text-primary me-2"></i>
                    <h5 class="card-title mb-0 fw-semibold">Daftar Wilayah (Region)</h5>
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
                    <table class="table table-hover align-middle border-top" id="example2">
                        <thead class="table-light">
                            <tr>
                                <th width="70" class="text-center">No</th>
                                <th>Unit Pusat</th>
                                <th>Nama Region</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($region as $row)
                                <tr>
                                    <td class="text-center text-muted fw-medium">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-label-secondary p-2 rounded me-2">
                                                <i class="bx bx-buildings text-secondary" style="font-size: 1.2rem;"></i>
                                            </div>
                                            <span class="text-muted small fw-bold">{{ $row->nama_pusat }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-label-primary p-2 rounded me-3">
                                                <i class="bx bx-map-pin"></i>
                                            </div>
                                            <span class="fw-bold text-dark fs-6">{{ $row->nama_region }}</span>
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
                                                    href="{{ route('region.edit', $row->id_region) }}">
                                                    <i class="bx bx-edit-alt me-2"></i> Edit Region
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <form action="{{ route('region.destroy', $row->id_region) }}" method="POST"
                                                    class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="dropdown-item text-danger py-2 show_confirm">
                                                        <i class="bx bx-trash me-2"></i> Hapus Data
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bx bx-map-off fs-1 mb-2"></i>
                                            <p class="mb-0">Belum ada data region yang terdaftar.</p>
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
                        title: 'Hapus Region?',
                        text: "Data wilayah ini akan dihapus permanen dari sistem!",
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
