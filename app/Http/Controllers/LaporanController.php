<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Region;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Tampilkan semua laporan penjualan
     */
    public function index(Request $request)
    {
        $title = 'Laporan Penjualan';
        $regions = Region::all(); // Untuk isi dropdown filter

        $laporanAll = Penjualan::with(['detail.produk', 'user.region'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('laporan.index', compact('title', 'laporanAll', 'regions'));
    }

    public function filter(Request $request)
    {
        $title = 'Laporan Penjualan';
        $from = $request->from;
        $to = $request->to;
        $id_region = $request->id_region; // Ambil input region
        $regions = Region::all();

        $query = Penjualan::with(['detail.produk', 'user.region']);

        // Filter Tanggal
        if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        } elseif ($from) {
            $query->whereDate('created_at', $from);
        }

        // Filter Berdasarkan Region (melalui relasi user)
        if ($id_region) {
            $query->whereHas('user', function ($q) use ($id_region) {
                $q->where('id_region', $id_region);
            });
        }

        $laporanAll = $query->orderBy('created_at', 'desc')->get();

        return view('laporan.index', compact('title', 'laporanAll', 'from', 'to', 'id_region', 'regions'));
    }

    public function exportPDF(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $id_region = $request->id_region;

        $query = Penjualan::query();

        // Filter Tanggal
        if ($from && $to && $from != $to) {
            $query->whereBetween('created_at', [$from, $to]);
            $periode = $from . '_sampai_' . $to;
        } elseif ($from) {
            $query->whereDate('created_at', $from);
            $periode = $from;
        } else {
            $periode = 'semua_data';
        }

        // Filter Region
        if ($id_region) {
            $query->whereHas('user', function ($q) use ($id_region) {
                $q->where('id_region', $id_region);
            });
            $periode .= '_region_' . $id_region;
        }

        $laporan = $query->get();
        $filename = 'laporan_' . str_replace(['/', '\\', ' '], ['-', '-', '_'], $periode) . '.pdf';

        $pdf = FacadePdf::loadView('laporan.pdf', compact('laporan', 'from', 'to', 'periode'));
        return $pdf->download($filename);
    }
}
