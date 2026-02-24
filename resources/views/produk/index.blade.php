@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4">
            <h4 class="fw-bold mb-0">
                <span class="text-muted fw-light">Master /</span> {{ $title }}
            </h4>
            <a href="{{ route('produk.create') }}" class="btn btn-primary shadow-sm">
                <i class="bx bx-plus me-1"></i> Tambah Produk
            </a>
        </div>

        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('produk.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-uppercase">Cari Produk</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-search"></i></span>
                                <input type="text" name="nama_produk" class="form-control" placeholder="Nama produk..."
                                    value="{{ request('nama_produk') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold text-uppercase">Kategori</label>
                            <select name="id_kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori }}"
                                        {{ request('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
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
                            <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary w-100">
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
                            <th>Detail Produk</th>
                            <th>Klasifikasi</th>
                            <th>Harga Jual</th>
                            <th>Stok & Gudang</th>
                            <th class="text-center" width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produk as $row)
                            <tr>
                                <td class="text-center fw-medium">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md me-3 shadow-sm border rounded">
                                            <img src="{{ asset('file/produk/' . $row->gambar_produk) }}"
                                                alt="Product Image" class="rounded object-fit-cover"
                                                onerror="this.src='https://placehold.co/100x100?text=No+Image'">
                                        </div>
                                        <div>
                                            <span class="d-block fw-bold text-dark">{{ $row->nama_produk }}</span>
                                            <small class="text-muted text-uppercase" style="font-size: 0.7rem;">ID:
                                                #{{ $row->id_produk }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        <span
                                            class="badge bg-label-primary w-fit-content">{{ $row->kategori->nama_kategori }}</span>
                                        <span
                                            class="badge bg-label-info w-fit-content">{{ $row->jenis->nama_jenis }}</span>
                                        <span
                                            class="badge bg-label-warning w-fit-content">{{ $row->tipe->nama_tipe }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span
                                        class="fw-bold text-dark">Rp{{ number_format($row->harga_jual_produk, 0, ',', '.') }}</span>
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
                                        <a href="{{ route('produk.edit', $row->id_produk) }}"
                                            class="btn btn-icon btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                            title="Edit Produk">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <form action="{{ route('produk.destroy', $row->id_produk) }}" method="POST"
                                            class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-icon btn-sm btn-outline-danger show_confirm"
                                                data-bs-toggle="tooltip" title="Hapus Produk">
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
                                        Tidak ada produk ditemukan.
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

<style>
    .w-fit-content {
        width: fit-content;
    }

    .object-fit-cover {
        object-fit: cover;
    }

    .avatar-md {
        width: 48px;
        height: 48px;
    }

    .table thead th {
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Init Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function(el) {
            return new bootstrap.Tooltip(el)
        });

        // SweetAlert Delete
        document.querySelectorAll('.show_confirm').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                let form = this.closest("form");
                Swal.fire({
                    title: 'Hapus Produk?',
                    text: "Seluruh data stok terkait produk ini juga akan terhapus!",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#ff3e1d',
                    cancelButtonColor: '#8592a3',
                    confirmButtonText: 'Ya, Hapus Sekarang!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    });
</script>
