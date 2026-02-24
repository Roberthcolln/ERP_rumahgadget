<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Pelanggan';

        $search = $request->input('search');
        $from = $request->input('from');
        $to = $request->input('to');

        $pelanggan = Pelanggan::withCount(['penjualan' => function ($query) {
            $query->where('status', 'selesai');
        }])
            // Eager loading relasi untuk menghindari N+1 Query
            ->with([
                'penjualan' => function ($q) {
                    $q->where('status', 'selesai')->orderBy('tanggal_penjualan', 'desc');
                },
                'penjualan.detail.produk'
            ])
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nama_pelanggan', 'like', '%' . $search . '%')
                        ->orWhere('no_hp', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->when($from, function ($query, $from) {
                return $query->whereDate('created_at', '>=', $from);
            })
            ->when($to, function ($query, $to) {
                return $query->whereDate('created_at', '<=', $to);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pelanggan.index', compact('pelanggan', 'title'));
    }

    public function destroy($id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->delete();
            return back()->with('success', 'Data pelanggan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function fetchLurah(Request $request)
    {
        $kelurahan = Kelurahan::where("id_kecamatan", $request->id_kecamatan)
            ->get(["nama_kelurahan", "id_kelurahan"]);
        return response()->json($kelurahan);
    }
}
