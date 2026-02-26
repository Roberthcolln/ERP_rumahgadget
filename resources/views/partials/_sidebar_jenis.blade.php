<h6 class="fw-bold mb-3 d-flex align-items-center">
    <span class="bg-warning rounded-pill me-2" style="width: 4px; height: 18px; display: inline-block;"></span>
    BRAND / JENIS
</h6>
<div class="brand-menu shadow-sm rounded-20 overflow-hidden border">
    @forelse ($jenis as $j)
        @php $isActive = request('jenis') == $j->id_jenis; @endphp
        <a href="javascript:void(0)" data-id="{{ $j->id_jenis }}"
            class="brand-item d-flex justify-content-between align-items-center py-3 px-4 btn-filter-jenis {{ $isActive ? 'active-brand' : '' }}">
            <span class="brand-name">{{ $j->nama_jenis }}</span>
            <i class="fa fa-chevron-right small opacity-50 icon-move"></i>
        </a>
    @empty
        <div class="p-4 text-center">
            <i class="fa fa-folder-open text-light fa-2x mb-2"></i>
            <p class="text-muted small mb-0">Pilih kategori terlebih dahulu</p>
        </div>
    @endforelse

    @if (request('jenis'))
        <a href="javascript:void(0)" data-id=""
            class="list-group-item list-group-item-light py-3 text-center small fw-bold text-primary btn-filter-jenis border-0"
            style="background: #f0f3ff;">
            <i class="fa fa-refresh me-1"></i> TAMPILKAN SEMUA
        </a>
    @endif
</div>

<style>
    .brand-menu {
        background: white;
    }

    .brand-item {
        text-decoration: none !important;
        color: #444;
        border-bottom: 1px solid #f8f9fa;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: 500;
    }

    .brand-item:last-child {
        border-bottom: none;
    }

    .brand-item:hover {
        background: #fffcf5;
        color: #ffbe33;
        padding-left: 30px !important;
    }

    .active-brand {
        background: #222831 !important;
        color: #ffbe33 !important;
        border-left: 4px solid #ffbe33;
    }

    .active-brand .icon-move {
        opacity: 1 !important;
        transform: translateX(5px);
    }

    .brand-item:hover .icon-move {
        transform: translateX(5px);
    }
</style>
