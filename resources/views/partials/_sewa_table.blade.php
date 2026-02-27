<div class="table-responsive shadow-sm rounded-20 bg-white">
    <table class="table table-hover mb-0">
        <thead style="background: #333; color: #fff;">
            <tr>
                <th class="py-3 px-4 border-0">TIPE IPHONE</th>
                <th class="py-3 text-center border-0">24 Jam</th>
                <th class="py-3 text-center border-0">2 Hari</th>
                <th class="py-3 text-center border-0">3 Hari</th>
                <th class="py-3 text-center border-0">7 Hari</th>
                <th class="py-3 text-center border-0">14 Hari</th>
                <th class="py-3 text-center border-0">1 Bulan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sewa as $s)
                <tr>
                    <td class="py-3 px-4 font-weight-bold text-dark">
                        {{ $s->produk->nama_produk }}
                        <small class="text-muted d-block">{{ $s->produk->varian->nama_varian ?? '' }}</small>
                    </td>
                    <td class="py-3 text-center font-weight-bold">{{ number_format($s->harga_24_jam / 1000, 0) }}K</td>
                    <td class="py-3 text-center font-weight-bold">{{ number_format($s->harga_2_hari / 1000, 0) }}K</td>
                    <td class="py-3 text-center font-weight-bold">{{ number_format($s->harga_3_hari / 1000, 0) }}K</td>
                    <td class="py-3 text-center font-weight-bold">{{ number_format($s->harga_7_hari / 1000, 0) }}K</td>
                    <td class="py-3 text-center font-weight-bold">{{ number_format($s->harga_14_hari / 1000, 0) }}K</td>
                    <td class="py-3 text-center font-weight-bold text-warning">
                        {{ number_format($s->harga_1_bulan / 1000, 0) }}K</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">Data harga sewa belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
