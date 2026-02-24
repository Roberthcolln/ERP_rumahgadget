<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Offering Letter - {{ $ol->nama_kandidat }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11pt;
            line-height: 1.5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18pt;
            color: #000;
        }

        .header p {
            margin: 2px 0;
            font-size: 9pt;
        }

        .content {
            margin: 0 40px;
        }

        .title {
            text-align: center;
            text-decoration: underline;
            font-weight: bold;
            font-size: 14pt;
            margin-bottom: 5px;
        }

        .nomor-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .details-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .details-table td {
            vertical-align: top;
            padding: 2px 0;
        }

        .details-table td.label {
            width: 180px;
        }

        .details-table td.separator {
            width: 20px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 15px;
            text-decoration: underline;
        }

        .list-items {
            margin-left: -20px;
        }

        .footer {
            margin-top: 30px;
            width: 100%;
        }

        .signature {
            float: right;
            width: 200px;
            text-align: center;
            margin-top: 20px;
        }

        .page-break {
            page-break-after: always;
        }

        /* Style untuk list dari CKEditor */
        ul {
            padding-left: 20px;
            margin-top: 5px;
        }

        li {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>PT. RUMAH GADGET</h1>
        <p>Jalan Gunung Agung No. 140A, Denpasar, Bali.</p>
        <p>No. Telepon +6281297600976 | Email: rumahgadgetbali01@gmail.com</p>
    </div>

    <div class="content">
        <div class="title">OFFERING LETTER</div>
        <div class="nomor-surat">No: {{ $ol->nomor_surat }}</div>

        <p>Yth. <strong>{{ strtoupper($ol->nama_kandidat) }}</strong>,</p>

        <p>Sehubungan dengan proses seleksi yang telah Saudara/i ikuti, dengan ini kami menyampaikan penawaran kerja
            untuk posisi <strong>{{ $ol->posisi }}</strong> di Rumah Gadget dengan rincian sebagai berikut:</p>

        <table class="details-table">
            <tr>
                <td class="label">Posisi</td>
                <td class="separator">:</td>
                <td>{{ $ol->posisi }}</td>
            </tr>
            <tr>
                <td class="label">Status Kerja</td>
                <td class="separator">:</td>
                <td>{{ $ol->status_kerja }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Mulai Kerja</td>
                <td class="separator">:</td>
                <td>{{ \Carbon\Carbon::parse($ol->tanggal_mulai)->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
                <td class="label">Penempatan</td>
                <td class="separator">:</td>
                <td>{{ $ol->penempatan }}</td>
            </tr>
        </table>

        <div class="section-title">1. Masa Training</div>
        <p>Saudara/i akan menjalani masa training selama {{ $ol->masa_training }} (dua) bulan, dengan ketentuan:</p>
        <ul>
            <li>Dapat diperpanjang menjadi maksimal {{ $ol->maks_training }} (tiga) bulan apabila diperlukan evaluasi
                tambahan.</li>
            <li>Dapat dipercepat menjadi {{ $ol->min_training }} (satu) bulan apabila performa dinilai memenuhi standar
                perusahaan.</li>
            <li>Hasil evaluasi selama dan setelah masa training berakhir akan menentukan status kerja (PKWTT/PKWT)
                ataupun durasi kontraknya.</li>
        </ul>

        <p><strong>Kompensasi Selama Training:</strong></p>
        <ul>
            <li>Gaji Pokok: Rp {{ number_format($ol->gaji_training, 0, ',', '.') }},- per bulan</li>
            <li>Uang Makan: Rp 15.000,- per hari kerja</li>
        </ul>

        <div class="section-title">2. Kompensasi Setelah Lulus Training (Staff {{ $ol->posisi }})</div>
        <ul>
            <li>Gaji Pokok: Rp {{ number_format($ol->gaji_lulus, 0, ',', '.') }},- per bulan</li>
            <li>Tunjangan Makan & Transport: Sesuai kebijakan perusahaan yang berlaku</li>
        </ul>

        <div class="section-title">3. Ruang Lingkup Pekerjaan</div>
        <div class="list-items">
            {!! $ol->ruang_lingkup !!}
        </div>

        <div class="section-title">4. Klausul Kerahasiaan (Non-Disclosure Agreement / NDA)</div>
        <p>Saudara/i wajib menjaga kerahasiaan seluruh informasi perusahaan, termasuk namun tidak terbatas pada:</p>
        <div class="list-items">
            {!! $ol->nda_klausul !!}
        </div>
        <p>Kewajiban menjaga kerahasiaan ini berlaku selama masa kerja dan tetap mengikat setelah hubungan kerja
            berakhir.</p>

        <p>Penawaran ini berlaku hingga
            <strong>{{ \Carbon\Carbon::parse($ol->created_at)->addDays(3)->translatedFormat('l, d F Y') }}</strong>.
            Kami berharap Saudara/i dapat bergabung dan berkembang bersama Rumah Gadget.
        </p>

        <p>Demikian penawaran ini kami sampaikan. Atas perhatian dan kerja samanya, kami ucapkan terima kasih.</p>

        <div class="footer">
            <div class="signature">
                <p>Hormat kami,</p>
                <br><br><br>
                <p><strong>HRD Rumah Gadget</strong></p>
            </div>
        </div>
    </div>
</body>

</html>
