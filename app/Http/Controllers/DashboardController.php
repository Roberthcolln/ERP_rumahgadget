<?php

namespace App\Http\Controllers;

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

        $today = Carbon::today();

        // Mengambil statistik ringkas
        $totalOrderHariIni = \App\Models\Order::whereDate('created_at', $today)->count();
        $totalPendapatan   = \App\Models\Order::where('status_pembayaran', 'success')->sum('total_harga');

        // Mengambil 5 order terbaru dengan relasi details
        $recentOrders = \App\Models\Order::with('details')->latest()->take(5)->get();

        return view('dashboard.index', compact(
            'title',
            'konf',
            'totalOrderHariIni',
            'totalPendapatan',
            'recentOrders'
        ));
    }
}
