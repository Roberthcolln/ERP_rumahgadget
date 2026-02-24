<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Print Receipt - {{ $penjualan->kode_invoice }}</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            width: 280px;
            /* Standar Thermal 58mm */
            margin: 10px auto;
            color: #000;
            line-height: 1.2;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .line {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }

        .brand {
            text-transform: uppercase;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .info-header {
            font-size: 11px;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .item-name {
            padding-top: 5px;
            font-weight: bold;
        }

        .item-details {
            padding-bottom: 5px;
            font-size: 11px;
        }

        .total-table {
            margin-top: 5px;
        }

        .total-table td {
            padding: 1px 0;
        }

        .bold {
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 11px;
            font-style: italic;
        }

        /* Hilangkan elemen saat print jika ada tombol */
        @print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print();">

    {{-- HEADER INSTANSI --}}
    <div class="center">
        <div class="brand">{{ $konf->instansi_setting }}</div>
        <div class="info-header">
            {{ $konf->alamat_setting }} <br>
            Telp: {{ $konf->no_hp_setting }}
        </div>
    </div>

    <div class="line"></div>

    {{-- INFO TRANSAKSI --}}
    <div style="font-size: 11px;">
        <table style="font-size: 11px;">
            <tr>
                <td>No: {{ $penjualan->kode_invoice }}</td>
                <td class="right">{{ $penjualan->created_at->format('d/m/y H:i') }}</td>
            </tr>
            <tr>
                <td>Kasir: {{ auth()->user()->nama ?? 'Admin' }}</td>
                <td class="right">Cust: {{ Str::limit($penjualan->pelanggan->nama_pelanggan, 10) }}</td>
            </tr>
        </table>
    </div>

    <div class="line"></div>

    {{-- DETAIL PRODUK --}}
    <table>
        @foreach ($penjualan->detail as $d)
            <tr>
                <td colspan="2" class="item-name">{{ $d->produk->nama_produk }}</td>
            </tr>
            <tr class="item-details">
                <td>{{ $d->qty }} x {{ number_format($d->harga, 0, ',', '.') }}</td>
                <td class="right">{{ number_format($d->subtotal, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <div class="line"></div>

    {{-- TOTAL PEMBAYARAN --}}
    <table class="total-table">
        <tr>
            <td class="bold">TOTAL</td>
            <td class="right bold" style="font-size: 14px;">
                Rp {{ number_format($penjualan->total, 0, ',', '.') }}
            </td>
        </tr>
        <tr>
            <td>TUNAI</td>
            <td class="right">
                {{ number_format($penjualan->bayar, 0, ',', '.') }}
            </td>
        </tr>
        <tr>
            <td>KEMBALI</td>
            <td class="right">
                {{ number_format($penjualan->kembali, 0, ',', '.') }}
            </td>
        </tr>
    </table>

    <div class="line"></div>

    {{-- FOOTER --}}
    <div class="center footer">
        *** Terima Kasih *** <br>
        Barang yang sudah dibeli <br>
        tidak dapat ditukar/dikembalikan. <br>
        <span style="font-style: normal; font-size: 10px; margin-top: 5px; display: block;">
            Powered by POS System {{ $konf->instansi_setting }}
        </span>
    </div>

</body>

</html>
