<?php

namespace App\Http\Controllers;

use App\Models\SlipGaji;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SlipGajiController extends Controller
{
    /**
     * Helper untuk cek apakah user memiliki akses manajemen (Admin atau HRD)
     */
    private function hasManagementAccess()
    {
        return auth()->user()->is_admin == 1 || auth()->user()->jabatan == 'HRD';
    }

    public function index()
    {
        $title = 'Data Slip Gaji';

        // Admin dan HRD bisa melihat semua data
        if ($this->hasManagementAccess()) {
            $slipGaji = SlipGaji::with('user')->latest()->get();
        } else {
            // Karyawan biasa hanya melihat milik sendiri
            $slipGaji = SlipGaji::with('user')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        return view('slip-gaji.index', compact('title', 'slipGaji'));
    }

    public function create()
    {
        if (!$this->hasManagementAccess()) {
            abort(403);
        }

        $title = 'Tambah Slip Gaji';
        // Mengambil semua user kecuali Super Admin (id 1)
        $users = User::where('id', '!=', 1)->get();

        return view('slip-gaji.create', compact('title', 'users'));
    }

    public function store(Request $request)
    {
        if (!$this->hasManagementAccess()) {
            abort(403);
        }

        $request->validate([
            'user_id' => 'required|array',
            'user_id.*' => 'exists:users,id',
            'periode' => 'required',
            'gaji_pokok' => 'required|numeric',
            'tunjangan' => 'nullable|numeric',
            'biaya_layanan' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
        ]);

        $tunjangan = $request->tunjangan ?? 0;
        $biaya_layanan = $request->biaya_layanan ?? 0;
        $potongan = $request->potongan ?? 0;

        $totalGaji = $request->gaji_pokok + $tunjangan + $biaya_layanan - $potongan;

        foreach ($request->user_id as $userId) {
            SlipGaji::create([
                'user_id' => $userId,
                'periode' => $request->periode,
                'gaji_pokok' => $request->gaji_pokok,
                'tunjangan' => $tunjangan,
                'biaya_layanan' => $biaya_layanan,
                'potongan' => $potongan,
                'total_gaji' => $totalGaji,
                'tanggal_cetak' => now()
            ]);
        }

        return redirect()->route('slip-gaji.index')
            ->with('Sukses', 'Slip gaji berhasil ditambahkan oleh ' . auth()->user()->jabatan);
    }

    public function show($id)
    {
        $slip = SlipGaji::with('user')->findOrFail($id);

        // Jika bukan Admin/HRD DAN bukan pemilik slip, maka dilarang
        if (!$this->hasManagementAccess() && $slip->user_id != auth()->id()) {
            abort(403);
        }

        $title = 'Detail Slip Gaji';
        return view('slip-gaji.show', compact('title', 'slip'));
    }

    public function destroy($id)
    {
        if (!$this->hasManagementAccess()) {
            abort(403);
        }

        SlipGaji::findOrFail($id)->delete();

        return redirect()->back()
            ->with('Sukses', 'Slip gaji berhasil dihapus');
    }

    public function printPdf($id)
    {
        $slip = SlipGaji::with('user')->findOrFail($id);

        if (!$this->hasManagementAccess() && $slip->user_id != auth()->id()) {
            abort(403);
        }

        $pdf = Pdf::loadView('slip-gaji.pdf', [
            'slip' => $slip
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('slip-gaji-' . $slip->periode . '.pdf');
    }
}
