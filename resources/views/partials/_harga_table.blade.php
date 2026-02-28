<div class="card border-0 shadow-sm rounded-20 overflow-hidden fade-in-up">
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
        <table class="table align-middle mb-0 custom-table">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4 py-3 text-uppercase text-muted border-0" style="font-size: 11px; width: 30%;">Tipe
                    </th>
                    <th class="py-3 text-uppercase text-muted border-0 text-center"
                        style="font-size: 11px; width: 15%;">Varian</th>
                    <th class="py-3 text-uppercase text-muted border-0 text-center"
                        style="font-size: 11px; width: 20%;">HARGA</th>
                    <th class="py-3 text-uppercase text-muted border-0" style="font-size: 11px; width: 35%;">Warna /
                        Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produk as $row)
                    @php
                        $hargaAsli = $row->harga_jual_produk;
                        $hargaFinal = $row->harga_final;
                        $isPromoEvent = !empty($row->id_promo);
                        $hasDiscount = $hargaFinal < $hargaAsli;
                    @endphp
                    <tr class="hover-row">
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center">
                                <div>
                                    <span class="fw-bold text-dark d-block mb-1">{{ $row->nama_produk }}</span>
                                    <a href="javascript:void(0)"
                                        class="btn-detail text-warning fw-bold d-inline-flex align-items-center"
                                        data-id="{{ $row->id_produk }}" style="font-size: 10px; text-decoration: none;">
                                        <i class="fa fa-info-circle me-1"></i> Detail Spesifikasi
                                    </a>
                                </div>

                                {{-- Animasi SALE Berputar --}}
                                @if ($isPromoEvent)
                                    <div class="ms-3 sale-container">
                                        <div class="sale-badge-rotate">
                                            <span>Promo</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </td>

                        <td class="text-center">
                            <span class="fw-bold text-muted">{{ $row->varian->nama_varian ?? '-' }}</span>
                        </td>

                        <td class="text-center">
                            @if ($hasDiscount)
                                <span class="text-danger text-decoration-line-through d-inline-block me-2"
                                    style="font-size: 12px;">
                                    {{ number_format($hargaAsli, 0, ',', '.') }}
                                </span><br>
                                <span class="fw-bold text-success" style="font-size: 15px;">
                                    {{ number_format($hargaFinal, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="fw-bold text-success" style="font-size: 15px;">
                                    {{ number_format($hargaAsli, 0, ',', '.') }}
                                </span>
                            @endif
                        </td>

                        <td class="py-3">
                            @if ($row->total_qty <= 0)
                                <span class="text-danger fw-bold italic-text">SOLD</span>
                            @else
                                <div class="d-flex flex-column">
                                    <span class="text-dark fw-medium">{{ $row->warna->nama_warna ?? '-' }}</span>

                                    @if ($isPromoEvent && $row->promo)
                                        <small class="text-dark mt-1">
                                            Harga Spesial <b class="promo-highlight">Rp
                                                {{ number_format($row->promo->nilai_promo, 0, ',', '.') }}</b>
                                            <span
                                                class="ms-1">{{ $row->promo->nama_promo ?? 'Khusus Pembeli Tercepat!' }}</span>
                                        </small>
                                    @endif
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <i class="fa fa-box-open fa-3x text-light mb-3"></i>
                            <p class="text-muted">Oops! Produk tidak ditemukan.</p>
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
    /* 1. Animasi Masuk Tabel */
    .fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* 2. Styling Tabel & Hover */
    .custom-table td {
        border-bottom: 1px solid #f3f3f3;
        transition: all 0.2s;
    }

    .hover-row:hover {
        background-color: rgba(255, 190, 51, 0.04) !important;
    }

    /* 3. Animasi SALE Berputar */
    .sale-container {
        perspective: 1000px;
    }

    .sale-badge-rotate {
        width: 38px;
        height: 38px;
        background: #ff3e3e;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        font-weight: 900;
        border: 2px dashed #ffffff;
        box-shadow: 0 3px 8px rgba(255, 62, 62, 0.3);
        animation: rotateRound 5s linear infinite;
    }

    .sale-badge-rotate span {
        display: inline-block;
        /* Opsional: agar teks tidak ikut berputar balik,
           tapi secara visual lebih menarik jika teks ikut berputar seperti segel */
    }

    @keyframes rotateRound {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    /* Efek saat baris di-hover */
    .hover-row:hover .sale-badge-rotate {
        animation-duration: 1.5s;
        /* Putaran lebih cepat saat mouse masuk */
        background: #2e59d9;
        /* Berubah biru mengikuti aksen promo */
    }

    /* 4. Highlight Promo (Biru sesuai Gambar) */
    .promo-highlight {
        background-color: #2e59d9;
        color: white;
        padding: 1px 6px;
        border-radius: 3px;
        font-weight: bold;
        display: inline-block;
    }

    /* 5. Utility */
    .italic-text {
        font-style: italic;
        letter-spacing: 1px;
    }

    .fw-medium {
        font-weight: 500;
    }

    .rounded-20 {
        border-radius: 15px !important;
    }

    .italic-text {
        font-style: italic;
    }
</style>
