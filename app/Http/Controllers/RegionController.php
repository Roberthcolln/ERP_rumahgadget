<?php

namespace App\Http\Controllers;

use App\Models\Pusat;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Region';
        $region = DB::table('region')
        ->join('pusat', 'region.id_pusat', 'pusat.id_pusat')
        ->get();
        return view('region.index', compact('title', 'region'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Region';
        $pusat = Pusat::all();
        return view('region.create', compact('title', 'pusat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pusat' => 'required',
            'nama_region' => 'required'
        ]);
        Region::create($request->all());
        return redirect()->route('region.index')->with('Sukses', 'Berhasil Tambahkan Region');
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        $title = 'Edit Region';
        $pusat = Pusat::all();
        return view('region.edit', compact('title', 'pusat', 'region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Region $region)
    {
        $update = [
            'nama_region' => $request->nama_region,
            'id_pusat' => $request->id_pusat,
        ];
        $region->update($update);
        return redirect()->route('region.index')->with('Sukses', 'Berhasil Edit Region');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Region');
    }
}
