<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\KategoriService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $title = 'Data Service';
        $services = Service::with('kategori')->get();
        return view('service.index', compact('title', 'services'));
    }

    public function create()
    {
        $title = 'Tambah Service';
        $kategori = KategoriService::all();
        return view('service.create', compact('title', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori_service' => 'required',
            'type' => 'required',
        ]);

        Service::create($request->all());
        return redirect()->route('service.index')->with('Sukses', 'Berhasil Tambah Data Service');
    }

    public function edit($id)
    {
        $title = 'Edit Service';
        $service = Service::findOrFail($id);
        $kategori = KategoriService::all();
        return view('service.edit', compact('title', 'service', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());
        return redirect()->route('service.index')->with('Sukses', 'Berhasil Update Data Service');
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data Service');
    }
}
