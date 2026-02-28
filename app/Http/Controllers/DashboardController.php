<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use App\Models\Region;

use App\Models\Stok;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Dashboard';
        $konf  = DB::table('setting')->first();

        $fromDate = $request->input('from');
        $toDate = $request->input('to');

        // Query Dasar
        $orderQuery = \App\Models\Order::query();
        $incomeQuery = \App\Models\Order::where('status_pembayaran', 'success');

        if ($fromDate && $toDate) {
            $start = $fromDate . ' 00:00:00';
            $end = $toDate . ' 23:59:59';

            $orderQuery->whereBetween('created_at', [$start, $end]);
            $incomeQuery->whereBetween('created_at', [$start, $end]);
            $labelStats = "Periode " . \Carbon\Carbon::parse($fromDate)->format('d/m/Y') . " - " . \Carbon\Carbon::parse($toDate)->format('d/m/Y');
        } else {
            $orderQuery->whereDate('created_at', \Carbon\Carbon::today());
            $labelStats = "Hari Ini (" . \Carbon\Carbon::today()->format('d/m/Y') . ")";
        }

        $totalOrder = $orderQuery->count();
        $totalPendapatan = $incomeQuery->sum('total_harga');

        // --- PERBAIKAN DI SINI ---
        // Ambil data terbaru berdasarkan filter yang sedang aktif
        // Kita clone query-nya agar tidak merusak hitungan count di atas
        $recentOrders = (clone $orderQuery)->with('details')->latest()->take(10)->get();

        return view('dashboard.index', compact(
            'title',
            'konf',
            'totalOrder',
            'totalPendapatan',
            'recentOrders',
            'labelStats'
        ));
    }
}
