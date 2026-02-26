@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> {{ $title }}
            </h4>
            <a href="{{ route('aksesoris.create') }}" class="btn btn-primary shadow-sm">
                <i class="bx bx-plus me-1"></i> Tambah Aksesoris
            </a>
        </div>

        {{-- Filter Section --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('aksesoris.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-uppercase">Cari Aksesoris</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-search"></i></span>
                                <input type="text" name="nama_aksesoris" class="form-control"
                                    placeholder="Nama aksesoris..." value="{{ request('nama_aksesoris') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-uppercase">Kategori Aksesoris</label>
                            <select name="id_kategori_aksesoris" class="form-select">
                                <option value="">Semua Kategori Aksesoris</option>
                                @foreach ($kategori_aksesoris as $k)
                                    <option value="{{ $k->id_kategori_aksesoris }}"
                                        {{ request('id_kategori_aksesoris') == $k->id_kategori_aksesoris ? 'selected' : '' }}>
                                        {{ $k->nama_kategori_aksesoris }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-uppercase">Supplier</label>
                            <select name="id_supplier" class="form-select">
                                <option value="">Semua Supplier</option>
                                @foreach ($supplier as $s)
                                    <option value="{{ $s->id_supplier }}"
                                        {{ request('id_supplier') == $s->id_supplier ? 'selected' : '' }}>
                                        {{ $s->nama_supplier }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-secondary w-100">
                                <i class="bx bx-filter-alt me-1"></i> Filter
                            </button>
                            <a href="{{ route('aksesoris.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="bx bx-refresh me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if ($message = Session::get('Sukses'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bx bx-check-circle me-2"></i> {{ $message }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0" id="example3">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" width="50">No</th>
                            <th>Detail Aksesoris</th>
                            <th>Klasifikasi</th>
                            <th>Harga Jual</th>
                            <th>Stok & Gudang</th>
                            <th class="text-center" width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($aksesoris as $row)
                            <tr>
                                <td class="text-center fw-medium">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md me-3 shadow-sm border rounded">
                                            <img src="{{ asset('file/aksesoris/' . $row->gambar_aksesoris) }}"
                                                alt="Product Image" class="rounded object-fit-cover"
                                                onerror="this.src='https://placehold.co/100x100?text=No+Image'">
                                        </div>
                                        <div>
                                            <span class="d-block fw-bold text-dark">{{ $row->nama_aksesoris }}</span>
                                            <small class="text-muted text-uppercase" style="font-size: 0.7rem;">
                                                ID: #{{ $row->id_aksesoris }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1" style="max-width: 250px;">
                                        {{-- Perbaikan: Menggunakan nama relasi yang benar dan null-safe operator --}}
                                        @if ($row->kategori_aksesoris)
                                            <span class="badge bg-label-primary w-fit-content">
                                                {{ $row->kategori_aksesoris->nama_kategori_aksesoris }}
                                            </span>
                                        @else
                                            <span class="badge bg-label-secondary w-fit-content text-muted">
                                                Tanpa Kategori
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">
                                        Rp{{ number_format($row->harga_jual_aksesoris, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    @foreach ($row->gudang as $g)
                                        <div class="mb-1">
                                            <span class="badge bg-label-success border-success">
                                                <i class="bx bx-home-alt me-1"></i> {{ $g->nama_gudang }}:
                                                <strong>{{ $g->pivot->qty }}</strong>
                                            </span>
                                        </div>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('aksesoris.edit', $row->id_aksesoris) }}"
                                            class="btn btn-icon btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                            title="Edit aksesoris">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <form action="{{ route('aksesoris.destroy', $row->id_aksesoris) }}" method="POST"
                                            class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-icon btn-sm btn-outline-danger show_confirm"
                                                data-bs-toggle="tooltip" title="Hapus aksesoris">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bx bx-package fs-1 d-block mb-2"></i>
                                        Tidak ada aksesoris ditemukan.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
