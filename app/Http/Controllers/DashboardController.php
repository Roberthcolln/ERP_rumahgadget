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

        $completedStatus = ['selesai', 'paid', 'completed', 'lunas'];

        $selectedRegionId = null;
        $regions = Region::all();

        // --- 1. Total Penghasilan (semua region untuk Admin, hanya region sendiri untuk Kasir) ---
        $incomeQuery = Penjualan::whereIn('status', $completedStatus);

        if (auth()->user()->jabatan === 'Kasir') {
            $incomeQuery->whereHas('user', fn($q) => $q->where('id_region', auth()->user()->id_region));
        } elseif (auth()->user()->jabatan === 'Admin' && $request->filled('region_id')) {
            $selectedRegionId = (int) $request->region_id;
            if ($selectedRegionId > 0) {
                $incomeQuery->whereHas('user', fn($q) => $q->where('id_region', $selectedRegionId));
            }
        }

        $income = [
            'today'      => (clone $incomeQuery)->whereDate('created_at', $today)->sum('total'),
            'this_week'  => (clone $incomeQuery)->whereBetween('created_at', [$startOfWeek, $now])->sum('total'),
            'this_month' => (clone $incomeQuery)->whereBetween('created_at', [$startOfMonth, $now])->sum('total'),
        ];

        // --- 2. Stok Produk (diasumsikan global, tidak difilter region) ---
        $produkStok = Produk::with(['stok'])
            ->orderBy('nama_produk', 'asc')
            ->take(10)
            ->get()
            ->map(function ($produk) {
                $produk->stok_total = $produk->stok->sum('qty');
                return $produk;
            });

        $totalStock = $produkStok->sum('stok_total');

        // --- 3. Unit Terjual (jumlah qty terjual) ---
        $soldBase = PenjualanDetail::query()
            ->join('penjualan', 'penjualan_detail.id_penjualan', '=', 'penjualan.id_penjualan')
            ->whereIn('penjualan.status', $completedStatus);

        if (auth()->user()->jabatan === 'Kasir') {
            $soldBase->whereExists(function ($sub) {
                $sub->select(DB::raw(1))
                    ->from('users')
                    ->whereColumn('users.id', 'penjualan.id_user')
                    ->where('users.id_region', auth()->user()->id_region);
            });
        } elseif (auth()->user()->jabatan === 'Admin' && $request->filled('region_id')) {
            $regionId = (int) $request->region_id;
            if ($regionId > 0) {
                $soldBase->whereExists(function ($sub) use ($regionId) {
                    $sub->select(DB::raw(1))
                        ->from('users')
                        ->whereColumn('users.id', 'penjualan.id_user')
                        ->where('users.id_region', $regionId);
                });
            }
        }

        $sold = [
            'today'      => (clone $soldBase)->whereDate('penjualan.created_at', $today)->sum('penjualan_detail.qty'),
            'this_week'  => (clone $soldBase)->whereBetween('penjualan.created_at', [$startOfWeek, $now])->sum('penjualan_detail.qty'),
            'this_month' => (clone $soldBase)->whereBetween('penjualan.created_at', [$startOfMonth, $now])->sum('penjualan_detail.qty'),
        ];

        // --- 4. Top 5 Produk Terlaris ---
        $topProductsQuery = function ($dateFilter) use ($completedStatus) {
            $q = PenjualanDetail::query()
                ->join('penjualan', 'penjualan_detail.id_penjualan', '=', 'penjualan.id_penjualan')
                ->whereIn('penjualan.status', $completedStatus);

            if (auth()->user()->jabatan === 'Kasir') {
                $q->whereExists(function ($sub) {
                    $sub->select(DB::raw(1))
                        ->from('users')
                        ->whereColumn('users.id', 'penjualan.id_user')
                        ->where('users.id_region', auth()->user()->id_region);
                });
            } elseif (auth()->user()->jabatan === 'Admin' && request()->filled('region_id')) {
                $regionId = (int) request()->region_id;
                if ($regionId > 0) {
                    $q->whereExists(function ($sub) use ($regionId) {
                        $sub->select(DB::raw(1))
                            ->from('users')
                            ->whereColumn('users.id', 'penjualan.id_user')
                            ->where('users.id_region', $regionId);
                    });
                }
            }

            $dateFilter($q);

            return $q->select('penjualan_detail.id_produk', DB::raw('SUM(penjualan_detail.qty) as total_qty'))
                ->groupBy('penjualan_detail.id_produk')
                ->orderByDesc('total_qty')
                ->with('produk:id_produk,nama_produk')
                ->take(5)
                ->get();
        };

        $topProducts = [
            'today'      => $topProductsQuery(fn($q) => $q->whereDate('penjualan.created_at', $today)),
            'this_week'  => $topProductsQuery(fn($q) => $q->whereBetween('penjualan.created_at', [$startOfWeek, $now])),
            'this_month' => $topProductsQuery(fn($q) => $q->whereBetween('penjualan.created_at', [$startOfMonth, $now])),
        ];

        // --- 5. Chart 7 Hari Terakhir ---
        $revenueQuery = Penjualan::whereIn('status', $completedStatus)
            ->whereBetween('created_at', [$startLast7, $endLast7]);

        if (auth()->user()->jabatan === 'Kasir') {
            $revenueQuery->whereHas('user', fn($q) => $q->where('id_region', auth()->user()->id_region));
        } elseif (auth()->user()->jabatan === 'Admin' && $request->filled('region_id')) {
            $regionId = (int) $request->region_id;
            if ($regionId > 0) {
                $revenueQuery->whereHas('user', fn($q) => $q->where('id_region', $regionId));
            }
        }

        $revenueRaw = $revenueQuery->select(DB::raw('DATE(created_at) as date'), DB::raw('COALESCE(SUM(total), 0) as revenue'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('revenue', 'date')
            ->toArray();

        $soldRawQuery = PenjualanDetail::query()
            ->join('penjualan', 'penjualan_detail.id_penjualan', '=', 'penjualan.id_penjualan')
            ->whereIn('penjualan.status', $completedStatus)
            ->whereBetween('penjualan.created_at', [$startLast7, $endLast7]);

        if (auth()->user()->jabatan === 'Kasir') {
            $soldRawQuery->whereExists(function ($sub) {
                $sub->select(DB::raw(1))
                    ->from('users')
                    ->whereColumn('users.id', 'penjualan.id_user')
                    ->where('users.id_region', auth()->user()->id_region);
            });
        } elseif (auth()->user()->jabatan === 'Admin' && $request->filled('region_id')) {
            $regionId = (int) $request->region_id;
            if ($regionId > 0) {
                $soldRawQuery->whereExists(function ($sub) use ($regionId) {
                    $sub->select(DB::raw(1))
                        ->from('users')
                        ->whereColumn('users.id', 'penjualan.id_user')
                        ->where('users.id_region', $regionId);
                });
            }
        }

        $soldRaw = $soldRawQuery->select(DB::raw('DATE(penjualan.created_at) as date'), DB::raw('COALESCE(SUM(penjualan_detail.qty), 0) as total_qty'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total_qty', 'date')
            ->toArray();

        $chartDates    = [];
        $revenueValues = [];
        $soldValues    = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $dateKey   = $date->format('Y-m-d');
            $dateLabel = $date->format('d M');

            $chartDates[]    = $dateLabel;
            $revenueValues[] = $revenueRaw[$dateKey] ?? 0;
            $soldValues[]    = $soldRaw[$dateKey] ?? 0;
        }

        // --- 6. Donut Chart (produk terlaris bulan ini - semua data sesuai filter) ---
        $topThisMonth = $topProducts['this_month'];

        $topProductNames = [];
        $topProductQtys  = [];

        if ($topThisMonth->isNotEmpty()) {
            foreach ($topThisMonth as $item) {
                $nama = $item->produk ? trim($item->produk->nama_produk) : '(Produk tidak ditemukan)';
                $topProductNames[] = $nama;
                $topProductQtys[]  = (int) $item->total_qty;
            }
        }

        if (empty($topProductNames)) {
            $topProductNames = ['Tidak ada penjualan bulan ini'];
            $topProductQtys  = [0];
        } else {
            while (count($topProductNames) < 5) {
                $topProductNames[] = 'Lainnya';
                $topProductQtys[]  = 0;
            }
        }

        // --- TAMBAHAN KHUSUS UNTUK KASIR ---
        $kasirStats = null;
        if (auth()->user()->jabatan === 'Kasir') {
            $userId = auth()->id();

            // Total penjualan pribadi
            $kasirIncome = [
                'today'     => Penjualan::where('id_user', $userId)->whereIn('status', $completedStatus)->whereDate('created_at', $today)->sum('total'),
                'this_week' => Penjualan::where('id_user', $userId)->whereIn('status', $completedStatus)->whereBetween('created_at', [$startOfWeek, $now])->sum('total'),
                'this_month' => Penjualan::where('id_user', $userId)->whereIn('status', $completedStatus)->whereBetween('created_at', [$startOfMonth, $now])->sum('total'),
            ];

            // Produk terlaris per periode (top 5)
            $topProductsKasirQuery = function ($dateConstraint) use ($userId, $completedStatus) {
                return PenjualanDetail::query()
                    ->join('penjualan', 'penjualan_detail.id_penjualan', '=', 'penjualan.id_penjualan')
                    ->where('penjualan.id_user', $userId)
                    ->whereIn('penjualan.status', $completedStatus)
                    ->select('penjualan_detail.id_produk', DB::raw('SUM(penjualan_detail.qty) as total_qty'))
                    ->groupBy('penjualan_detail.id_produk')
                    ->orderByDesc('total_qty')
                    ->with('produk:id_produk,nama_produk')
                    ->take(5)
                    ->when($dateConstraint, fn($q) => $dateConstraint($q))
                    ->get();
            };

            $kasirTopProducts = [
                'today'     => $topProductsKasirQuery(fn($q) => $q->whereDate('penjualan.created_at', $today)),
                'this_week' => $topProductsKasirQuery(fn($q) => $q->whereBetween('penjualan.created_at', [$startOfWeek, $now])),
                'this_month' => $topProductsKasirQuery(fn($q) => $q->whereBetween('penjualan.created_at', [$startOfMonth, $now])),
            ];

            $kasirStats = [
                'income'      => $kasirIncome,
                'topProducts' => $kasirTopProducts,   // sekarang array dengan key 'today', 'this_week', 'this_month'
            ];
        }

        return view('dashboard.index', compact(
            'title',
            'konf',

            'income',
            'produkStok',
            'totalStock',
            'sold',
            'topProducts',
            'chartDates',
            'revenueValues',
            'soldValues',
            'topProductNames',
            'topProductQtys',
            'regions',
            'selectedRegionId',
            'kasirStats'          // ← dikirim ke view untuk Kasir
        ));
    }
}
