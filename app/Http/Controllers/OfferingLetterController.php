<?php

namespace App\Http\Controllers;

use App\Models\OfferingLetter;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Pastikan sudah install dompdf

class OfferingLetterController extends Controller
{
    public function index()
    {
        $title = 'Daftar Offering Letter'; // Tambahkan ini
        $letters = OfferingLetter::latest()->get();
        return view('offering_letter.index', compact('letters', 'title')); // Pastikan title dikirim
    }

    public function create()
    {
        $title = 'Daftar Offering Letter';
        return view('offering_letter.create', compact('title'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kandidat' => 'required',
            'posisi' => 'required',
            'status_kerja' => 'required',
            'tanggal_mulai' => 'required|date',
            'penempatan' => 'required',
            'masa_training' => 'required|numeric',
            'maks_training' => 'required|numeric',
            'min_training' => 'required|numeric',
            'gaji_training' => 'required|numeric',
            'gaji_lulus' => 'required|numeric',
            'ruang_lingkup' => 'required',
            'nda_klausul' => 'required',
        ]);

        // Generate nomor surat otomatis sederhana
        $data['nomor_surat'] = 'RG/' . date('m-Y') . '/' . str_pad(OfferingLetter::count() + 1, 3, '0', STR_PAD_LEFT);

        OfferingLetter::create($data);
        return redirect()->route('offering-letter.index')->with('Sukses', 'Offering Letter berhasil dibuat');
    }

    public function printPdf($id)
    {
        $ol = OfferingLetter::findOrFail($id);
        $pdf = Pdf::loadView('offering_letter.pdf_template', compact('ol'))->setPaper('a4', 'portrait');
        return $pdf->stream('Offering-Letter-' . $ol->nama_kandidat . '.pdf');
    }
}
