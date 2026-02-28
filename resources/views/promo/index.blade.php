@extends('layouts.index')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Master /</span> Promo Gadget</h4>
            <a href="{{ route('promo.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> Tambah Promo
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Kode & Nama</th>
                            <th>Potongan</th>
                            <th>Minimal Belanja</th>
                            <th>Kuota</th>
                            <th>Masa Berlaku</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($promos as $p)
                            <tr>
                                <td>
                                    <span class="fw-bold d-block text-primary">{{ $p->kode_promo }}</span>
                                    <small class="text-muted">{{ $p->nama_promo }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-label-success">{{ $p->label_diskon }}</span>
                                </td>
                                <td>Rp {{ number_format($p->minimal_pembelian, 0, ',', '.') }}</td>
                                <td><i class="bx bx-user me-1"></i> {{ $p->kuota_total }}</td>
                                <td>
                                    <small class="d-block text-muted">Mulai: {{ $p->tgl_mulai->format('d/m/Y') }}</small>
                                    <small class="d-block text-muted">Selesai:
                                        {{ $p->tgl_selesai->format('d/m/Y') }}</small>
                                </td>
                                <td class="text-center">
                                    @if ($p->is_aktif)
                                        <span class="badge bg-label-primary">Aktif</span>
                                    @else
                                        <span class="badge bg-label-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded fs-5"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{ route('promo.edit', $p->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('promo.destroy', $p->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus promo ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="bx bx-trash me-1"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">Belum ada data promo.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
