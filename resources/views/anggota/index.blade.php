@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> {{ $title }}
            </h4>
            @if (auth()->user()->is_admin == 1 || auth()->user()->jabatan == 'HRD')
                <a href="{{ route('anggota.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bx bx-plus me-1"></i> Tambah Anggota
                </a>
            @endif
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h5 class="mb-0 fw-semibold">Daftar Anggota</h5>
            </div>

            <div class="card-body">
                {{-- Alert Sukses --}}
                @if ($message = Session::get('Sukses'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bx bx-check-circle me-2"></i> {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Filter Section --}}
                {{-- Filter Section --}}
                @if (auth()->user()->is_admin == 1)
                    {{-- Menggunakan is_admin sesuai logic controller --}}
                    <form method="GET" action="{{ route('anggota.index') }}" class="mb-4">
                        <div class="row g-3 bg-light p-3 rounded-3 mx-0 shadow-sm">
                            {{-- Search --}}
                            <div class="col-md-4">
                                <label class="small pb-1">Cari Anggota</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Nama, email, atau HP..." value="{{ request('search') }}">
                                </div>
                            </div>

                            {{-- Filter Region --}}
                            <div class="col-md-3">
                                <label class="small pb-1">Wilayah / Region</label>
                                <select name="id_region" class="form-select">
                                    <option value="">-- Semua Region --</option>
                                    @foreach ($regions as $reg)
                                        <option value="{{ $reg->id_region }}"
                                            {{ request('id_region') == $reg->id_region ? 'selected' : '' }}>
                                            {{ $reg->nama_region }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Filter Status --}}
                            <div class="col-md-2">
                                <label class="small pb-1">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">-- Semua --</option>
                                    <option value="Verifikasi" {{ request('status') == 'Verifikasi' ? 'selected' : '' }}>
                                        Verifikasi</option>
                                    <option value="Non Verifikasi"
                                        {{ request('status') == 'Non Verifikasi' ? 'selected' : '' }}>Non Verifikasi
                                    </option>
                                </select>
                            </div>

                            {{-- Buttons --}}
                            <div class="col-md-3 d-flex align-items-end gap-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bx bx-filter-alt"></i> Filter
                                </button>
                                <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                            </div>
                        </div>
                    </form>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="50" class="text-center">No</th>
                                <th>Profil</th>
                                <th>Info Anggota</th>
                                <th>Region/Unit</th>
                                <th>Jabatan</th>
                                <th class="text-center">Status</th>
                                <th width="100" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($anggota as $row)
                                @if ($row->id > 1)
                                    <tr>
                                        <td class="text-center text-muted">
                                            {{ ($anggota->currentPage() - 1) * $anggota->perPage() + $loop->iteration }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-md me-3">
                                                    @if ($row->foto && file_exists(public_path('file/foto/' . $row->foto)))
                                                        <img src="{{ asset('file/foto/' . $row->foto) }}" alt="Avatar"
                                                            class="rounded-circle object-fit-cover shadow-sm"
                                                            style="width: 45px; height: 45px;">
                                                    @else
                                                        <div class="rounded-circle bg-label-secondary d-flex align-items-center justify-content-center shadow-sm text-uppercase fw-bold"
                                                            style="width: 45px; height: 45px;">
                                                            {{ substr($row->name, 0, 2) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-dark">{{ $row->name }}</span>
                                                <small class="text-muted">{{ $row->email ?? '-' }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-label-info">{{ $row->nama_region }}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-medium">{{ $row->jabatan }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span
                                                class="badge rounded-pill bg-{{ $row->status == 'aktif' ? 'success' : 'danger' }}">
                                                {{ ucfirst($row->status) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded fs-4"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2">
                                                    @if (auth()->user()->is_admin == 1 || auth()->user()->jabatan == 'HRD')
                                                        <a class="dropdown-item text-primary py-2"
                                                            href="{{ route('anggota.edit', $row->id) }}">
                                                            <i class="bx bx-edit-alt me-2"></i> Edit Data
                                                        </a>
                                                        <a class="dropdown-item text-warning py-2"
                                                            href="{{ route('anggota.show', $row->id) }}">
                                                            <i class="bx bx-show me-2"></i> Lihat Detail
                                                        </a>
                                                        <a class="dropdown-item text-success py-2"
                                                            href="{{ url('anggota/cetak-kartu', $row->id) }}"
                                                            target="_blank">
                                                            <i class="bx bx-printer me-2"></i> Cetak Kartu
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <form action="{{ route('anggota.destroy', $row->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button type="button"
                                                                class="dropdown-item text-danger py-2 show_confirm">
                                                                <i class="bx bx-trash me-2"></i> Hapus
                                                            </button>
                                                        </form>
                                                    @elseif ($row->id == auth()->id())
                                                        <a class="dropdown-item text-primary py-2"
                                                            href="{{ route('anggota.edit', $row->id) }}">
                                                            <i class="bx bx-edit-alt me-2"></i> Edit Profil
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bx bx-info-circle fs-1 mb-2"></i>
                                            <p class="mb-0">Data anggota tidak ditemukan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $anggota->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.show_confirm').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    let form = this.closest("form");
                    Swal.fire({
                        title: 'Hapus Data?',
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
