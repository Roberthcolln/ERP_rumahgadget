<div class="row g-4 align-items-center">
    <div class="col-md-5">
        <div class="position-relative">
            @if ($p->gambar_produk)
                <img src="{{ asset('file/produk/' . $p->gambar_produk) }}" class="img-fluid rounded-20 shadow-lg w-100"
                    alt="Produk" style="object-fit: cover; min-height: 300px;">
            @else
                <div class="bg-light rounded-20 d-flex flex-column align-items-center justify-content-center shadow-inner"
                    style="height: 300px;">
                    <i class="fa fa-image fa-3x text-light mb-2"></i>
                    <span class="text-muted small">Gambar tidak tersedia</span>
                </div>
            @endif
            {{-- Badge Diskon jika ada --}}
            @if ($p->harga_promo_produk > 0)
                <div class="position-absolute top-0 start-0 m-3">
                    <span class="badge bg-danger px-3 py-2 rounded-pill shadow">PROMO</span>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-7">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2 bg-transparent p-0" style="font-size: 12px;">
                <li class="breadcrumb-item text-warning">{{ $p->kategori->nama_kategori }}</li>
                <li class="breadcrumb-item active">{{ $p->jenis->nama_jenis }}</li>
            </ol>
        </nav>

        <h3 class="fw-bold text-dark mb-3">{{ $p->nama_produk }}</h3>

        <div class="row g-2 mb-4">
            <div class="col-6">
                <div class="p-2 border rounded-15 bg-light text-center">
                    <small class="text-muted d-block" style="font-size: 10px; text-uppercase;">Varian</small>
                    <span class="fw-bold small text-dark">{{ $p->varian->nama_varian ?? '-' }}</span>
                </div>
            </div>
            <div class="col-6">
                <div class="p-2 border rounded-15 bg-light text-center">
                    <small class="text-muted d-block" style="font-size: 10px; text-uppercase;">Warna</small>
                    <span class="fw-bold small text-dark">{{ $p->warna->nama_warna ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="mb-4">
            @if ($p->harga_promo_produk > 0)
                <small class="text-muted text-decoration-line-through">Rp
                    {{ number_format($p->harga_jual_produk, 0, ',', '.') }}</small>
                <h2 class="text-success fw-bold mb-0">Rp {{ number_format($p->harga_promo_produk, 0, ',', '.') }}</h2>
            @else
                <small class="text-muted">Harga Terbaik:</small>
                <h2 class="text-dark fw-bold mb-0">Rp {{ number_format($p->harga_jual_produk, 0, ',', '.') }}</h2>
            @endif
        </div>

        <div class="specs-box border-top pt-3">
            <h6 class="fw-bold small text-uppercase mb-2 text-muted" style="letter-spacing: 1px;">Spesifikasi Produk
            </h6>
            <div class="text-muted small lh-lg" style="font-size: 13px;">
                {!! $p->deskripsi_produk ?: '<i>Deskripsi teknis belum ditambahkan.</i>' !!}
            </div>
        </div>

        <a href="https://wa.me/{{ $konf->whatsapp ?? '' }}?text=Halo, saya ingin tanya ketersediaan {{ $p->nama_produk }} - {{ $p->varian->nama_varian ?? '' }}"
            target="_blank"
            class="btn btn-success w-100 mt-4 rounded-pill fw-bold py-3 shadow-sm d-flex align-items-center justify-content-center">
            <i class="fa fa-whatsapp fa-lg me-2"></i> TANYA VIA WHATSAPP
        </a>
    </div>
</div>
