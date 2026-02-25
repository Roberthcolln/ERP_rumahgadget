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


        $now          = Carbon::now();
        $today        = $now->copy()->startOfDay();
        $startOfWeek  = $now->copy()->startOfWeek();
        $startOfMonth = $now->copy()->startOfMonth();
        $startLast7   = Carbon::today()->subDays(6);
        $endLast7     = $now;


        return view('dashboard.index', compact(
            'title',
            'konf',
        ));
    }
}
