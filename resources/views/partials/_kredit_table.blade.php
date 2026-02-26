<table class="table table-hover mb-0">
    <thead class="bg-dark text-white text-center">
        <tr>
            <th rowspan="2" class="align-middle">Tipe</th>
            <th rowspan="2" class="align-middle">Harga</th>
            <th rowspan="2" class="align-middle">DP</th>
            <th colspan="3" class="border-bottom-0">Cicilan</th>
        </tr>
        <tr class="bg-secondary text-white">
            <th>6X</th>
            <th>9X</th>
            <th>12X</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kredit as $id_tipe => $items)
            @php $first = $items->first(); @endphp
            <tr>
                <td class="font-weight-bold py-3 pl-4">
                    {{ $first->tipe->nama_tipe }}
                    <small class="d-block text-muted">{{ $first->varian->nama_varian }}</small>
                </td>
                <td class="text-center align-middle">Rp {{ number_format($first->harga_kredit, 0, ',', '.') }}</td>
                <td class="text-center align-middle text-danger">Rp {{ number_format($first->dp, 0, ',', '.') }}</td>
                @foreach ([6, 9, 12] as $tenor)
                    <td class="text-center align-middle">
                        @php $dataTenor = $items->where('cicilan', $tenor)->first(); @endphp
                        @if ($dataTenor)
                            <span class="badge badge-light-primary p-2">Rp
                                {{ number_format($dataTenor->harga_cicilan, 0, ',', '.') }}</span>
                        @else
                            -
                        @endif
                    </td>
                @endforeach
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-5">Data cicilan tidak tersedia untuk brand ini.</td>
            </tr>
        @endforelse
    </tbody>
</table>
