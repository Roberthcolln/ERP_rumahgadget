<?php

namespace App\Http\Controllers;

use App\Models\Pusat;
use App\Models\Region;
use Illuminate\Http\Request;

class PusatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Pusat';
        $pusat = Pusat::all();
        return view('pusat.index', compact('title', 'pusat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Pusat';
        return view('pusat.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pusat' => 'required',
        ]);
        Pusat::create($request->all());
        return redirect()->route('pusat.index')->with('Sukses', 'Berhasil Tambah Pusat');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pusat $pusat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pusat $pusat)
    {
        $title = 'Edit Pusat';
        return view('pusat.edit', compact('title', 'pusat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pusat $pusat)
    {
        $update = [
            'nama_pusat' => $request->nama_pusat,
        ];
        $pusat->update($update);
        return redirect()->route('pusat.index')->with('Sukses', 'Berhasil Edit Pusat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pusat $pusat)
    {
        $pusat->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data Pusat');
    }

    public function fetchRegion(Request $request)
    {
        $data['region'] = Region::where("id_pusat", $request->id_pusat)->get(["nama_region", "id_region"]);
        return response()->json($data);
    }
}
