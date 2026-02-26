<div class="row grid">
    @forelse ($aksesoris as $pro)
        {{-- Isotope memfilter berdasarkan class cat-ID --}}
        <div class="col-sm-6 col-lg-4 all cat-{{ $pro->id_kategori_aksesoris }}">
            <div class="box shadow-sm">
                <div class="img-box">
                    <img src="{{ asset('file/aksesoris/' . $pro->gambar_aksesoris) }}"
                        onerror="this.src='https://placehold.co/400x300?text={{ urlencode($pro->nama_aksesoris) }}'"
                        alt="{{ $pro->nama_aksesoris }}">
                </div>
                <div class="detail-box">
                    <h5>{{ $pro->nama_aksesoris }}</h5>
                    <p class="text-muted small">
                        {{ $pro->kategori_aksesoris->nama_kategori_aksesoris ?? 'Umum' }}
                    </p>
                    <div class="options">
                        <h6>Rp {{ number_format($pro->harga_jual_aksesoris, 0, ',', '.') }}</h6>
                        <a href="https://wa.me/{{ $konf->nomor_wa ?? '' }}?text=Halo, saya ingin pesan {{ $pro->nama_aksesoris }}"
                            target="_blank">
                            <i class="fa fa-shopping-cart text-white"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Maaf, aksesoris tidak ditemukan.</p>
        </div>
    @endforelse
</div>
