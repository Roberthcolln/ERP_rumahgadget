<div class="p-2">
    <div class="d-flex justify-content-between align-items-start mb-4 bg-light p-4 rounded-20">
        <div>
            <span class="badge bg-warning text-dark mb-2 px-3">Estimasi Part Saja</span>
            <h3 class="fw-bold text-dark mb-1">{{ $s->type }}</h3>
            <p class="text-muted mb-0 small">
                <i class="fa fa-tag me-1 text-warning"></i> {{ $s->kategori->nama_kategori_service }}
                <span class="mx-2">|</span>
                <i class="fa fa-microchip me-1 text-warning"></i> {{ $s->macbook ?? 'Smartphone Device' }}
            </p>
        </div>
        <div class="text-end">
            <i class="fa fa-wrench fa-3x text-light"></i>
        </div>
    </div>

    <div class="row g-3 px-2">
        @php
            $fields = [
                ['label' => 'LCD OEM', 'val' => $s->lcd_oem, 'icon' => 'fa-mobile-alt'],
                ['label' => 'LCD Original', 'val' => $s->lcd_original, 'icon' => 'fa-check-circle'],
                ['label' => 'Battery Replacement', 'val' => $s->battery, 'icon' => 'fa-battery-three-quarters'],
                ['label' => 'Kamera Belakang', 'val' => $s->back_cam_ori, 'icon' => 'fa-camera'],
                ['label' => 'Kamera Depan', 'val' => $s->front_cam, 'icon' => 'fa-portrait'],
                ['label' => 'Port Charger', 'val' => $s->charger_port, 'icon' => 'fa-bolt'],
                ['label' => 'Face ID / Touch ID', 'val' => $s->face_id, 'icon' => 'fa-user-lock'],
                ['label' => 'Ganti Kaca (Glass)', 'val' => $s->repair_glass, 'icon' => 'fa-magic'],
                ['label' => 'Housing / Body', 'val' => $s->housing_body, 'icon' => 'fa-mobile'],
            ];
        @endphp

        @foreach ($fields as $item)
            @if ($item['val'] > 0)
                <div class="col-md-4 col-6">
                    <div
                        class="p-3 border-0 rounded-15 bg-white shadow-sm h-100 text-center border-top border-warning border-3">
                        <i class="fa {{ $item['icon'] }} text-muted mb-2" style="font-size: 14px;"></i>
                        <small class="text-muted d-block" style="font-size: 11px;">{{ $item['label'] }}</small>
                        <span class="fw-bold text-dark" style="font-size: 14px;">Rp
                            {{ number_format($item['val'], 0, ',', '.') }}</span>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="mt-5 p-4 bg-soft-danger rounded-20">
        <div class="d-flex">
            <i class="fa fa-exclamation-triangle text-danger me-3 mt-1"></i>
            <div>
                <h6 class="fw-bold text-danger mb-1">PENTING:</h6>
                <p class="text-muted mb-0 small" style="line-height: 1.6;">
                    Harga yang tertera adalah estimasi untuk <strong>sparepart saja</strong>. Biaya belum termasuk jasa
                    teknisi/pemasangan. Kami menyarankan untuk melakukan pengecekan unit secara langsung di toko kami
                    (Gratis Konsultasi).
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-soft-danger {
        background-color: #fff5f5;
        border: 1px solid #ffebeb;
    }

    .rounded-15 {
        border-radius: 15px !important;
    }
</style>
