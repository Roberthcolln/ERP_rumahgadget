<div class="card border-0 shadow-sm rounded-20 overflow-hidden">
    <div class="bg-dark text-white p-3 px-4 d-flex justify-content-between align-items-center">
        <div>
            <h6 class="mb-0 fw-bold" style="letter-spacing: 1px;">DAFTAR HARGA UNIT</h6>
            <small class="text-warning small" style="font-size: 10px;">Harga dapat berubah sewaktu-waktu</small>
        </div>
        <div class="text-end">
            <span class="d-block text-uppercase opacity-50" style="font-size: 9px;">Update Terakhir</span>
            <span class="fw-bold small">{{ date('d M Y') }}</span>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 text-uppercase text-muted border-0" style="font-size: 11px;">Tipe & Produk</th>
                    <th class="py-3 text-uppercase text-muted border-0 text-center" style="font-size: 11px;">Varian</th>
                    <th class="py-3 text-uppercase text-muted border-0" style="font-size: 11px;">Harga</th>
                    <th class="py-3 text-uppercase text-muted border-0 text-center" style="font-size: 11px;">
                        Status/Warna</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produk as $row)
                    <tr>
                        <td class="ps-4 py-3">
                            <span class="fw-bold text-dark d-block mb-1">{{ $row->nama_produk }}</span>
                            <a href="javascript:void(0)"
                                class="btn-detail text-warning fw-bold d-inline-flex align-items-center"
                                data-id="{{ $row->id_produk }}" style="font-size: 11px; text-decoration: none;">
                                <i class="fa fa-info-circle me-1"></i> Detail Spesifikasi
                            </a>
                        </td>
                        <td class="text-center">
                            <span class="px-2 py-1 bg-white border rounded text-muted small" style="font-size: 11px;">
                                {{ $row->varian->nama_varian ?? '-' }}
                            </span>
                        </td>
                        <td>
                            @if ($row->harga_promo_produk > 0)
                                <small class="text-danger text-decoration-line-through d-block"
                                    style="font-size: 10px;">Rp
                                    {{ number_format($row->harga_jual_produk, 0, ',', '.') }}</small>
                                <span class="fw-bold text-success" style="font-size: 15px;">Rp
                                    {{ number_format($row->harga_promo_produk, 0, ',', '.') }}</span>
                            @else
                                <span class="fw-bold text-dark" style="font-size: 15px;">Rp
                                    {{ number_format($row->harga_jual_produk, 0, ',', '.') }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($row->total_qty <= 0)
                                <span class="badge rounded-pill bg-soft-danger text-danger border border-danger px-3">
                                    SOLD OUT
                                </span>
                            @else
                                <div class="d-flex flex-column align-items-center">
                                    <span class="badge rounded-pill bg-soft-dark text-dark border border-dark px-3 mb-1"
                                        style="font-weight: 500;">
                                        {{ $row->warna->nama_warna ?? '-' }}
                                    </span>
                                    <small class="text-success fw-bold" style="font-size: 9px;">● Ready Stock</small>
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <img src="{{ asset('web/images/no-product.png') }}" class="mb-3 opacity-20" width="80">
                            <p class="text-muted">Oops! Produk yang Anda cari tidak tersedia.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($produk->hasPages())
        <div class="p-3 bg-light border-top d-flex justify-content-center">
            {{ $produk->links() }}
        </div>
    @endif
</div>

<style>
    .bg-soft-danger {
        background-color: rgba(220, 53, 69, 0.1);
    }

    .bg-soft-dark {
        background-color: rgba(34, 40, 49, 0.05);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(255, 190, 51, 0.03);
        transition: 0.2s;
    }
</style>
