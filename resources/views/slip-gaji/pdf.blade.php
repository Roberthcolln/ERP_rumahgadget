<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

$konf = DB::table('setting')->first();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }

        .container {
            width: 100%;
        }

        /* ================= KOP PERUSAHAAN ================= */
        .company-header {
            width: 100%;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .company-header table {
            width: 100%;
        }

        .company-header .logo {
            width: 90px;
        }

        .company-header img {
            width: 160px;
        }

        .company-info {
            text-align: center;
        }

        .company-info h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .company-info p {
            margin: 2px 0;
            font-size: 11px;
        }

        /* ================= TITLE ================= */
        .title {
            text-align: center;
            margin: 20px 0;
        }

        .title h3 {
            margin: 0;
            font-size: 16px;
            letter-spacing: 1px;
        }

        .title p {
            margin: 5px 0 0;
            font-size: 12px;
        }

        /* ================= INFO ================= */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .info-table td {
            padding: 6px;
            border: 1px solid #000;
        }

        .info-table td.label {
            width: 25%;
            background: #f2f2f2;
            font-weight: bold;
        }

        /* ================= GAJI ================= */
        .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .salary-table th,
        .salary-table td {
            border: 1px solid #000;
            padding: 8px;
        }

        .salary-table th {
            background: #f2f2f2;
            text-align: left;
        }

        .salary-table td.amount {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
            background: #e6f2ff;
        }

        /* ================= NOTES ================= */
        .notes {
            margin-top: 20px;
            font-size: 11px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 11px;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- ================= KOP PERUSAHAAN ================= -->
        <div class="company-header">
            <table>
                <tr>
                    <td class="logo">
                        <img src="logo/logo.png" alt="Logo">
                    </td>
                    <td class="company-info">
                        <h2>{{ $konf->instansi_setting }}</h2>
                        <p>{{ $konf->alamat_setting }}</p>
                        <p>Telp: {{ $konf->no_hp_setting }} | Email: {{ $konf->email_setting }}</p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- ================= TITLE ================= -->
        <div class="title">
            <h3>SLIP GAJI KARYAWAN</h3>
            <p>Periode: {{ $slip->periode }}</p>
        </div>

        <!-- ================= INFO KARYAWAN ================= -->
        <table class="info-table">
            <tr>
                <td class="label">Nama Karyawan</td>
                <td>{{ $slip->user->name }}</td>
                <td class="label">Jabatan</td>
                <td>{{ $slip->user->jabatan ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Cetak</td>
                <td colspan="3">{{ now()->format('d F Y') }}</td>
            </tr>
        </table>


        <!-- ================= RINCIAN GAJI ================= -->
        <table class="salary-table">
            <tr>
                <th>Keterangan</th>
                <th style="width: 30%">Jumlah</th>
            </tr>
            <tr>
                <td>Gaji Pokok</td>
                <td class="amount">Rp {{ number_format($slip->gaji_pokok, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Tunjangan</td>
                <td class="amount">Rp {{ number_format($slip->tunjangan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Layanan</td>
                <td class="amount">
                    Rp {{ number_format($slip->biaya_layanan, 0, ',', '.') }}
                </td>
            </tr>

            <tr>
                <td>Potongan</td>
                <td class="amount">Rp {{ number_format($slip->potongan, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>Total Gaji Diterima</td>
                <td class="amount">
                    Rp {{ number_format($slip->total_gaji, 0, ',', '.') }}
                </td>
            </tr>
        </table>

        <!-- ================= NOTES ================= -->
        <div class="notes">
            <strong>Catatan:</strong>
            <ul>
                <li>Slip gaji ini diterbitkan secara otomatis oleh sistem.</li>
                <li>Tidak memerlukan tanda tangan basah.</li>
                <li>Jika terdapat perbedaan data, silakan hubungi HR/Keuangan.</li>
            </ul>
        </div>

        <!-- ================= FOOTER ================= -->
        <div class="footer">
            Dicetak oleh sistem pada {{ now()->format('d F Y H:i') }}
        </div>

    </div>

</body>

</html>
