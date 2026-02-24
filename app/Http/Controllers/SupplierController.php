<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $title = "Data Supplier";

        $supplier = Supplier::when(
            $request->nama_supplier,
            fn($q) => $q->where('nama_supplier', 'like', '%' . $request->nama_supplier . '%')
        )
            ->latest()
            ->get();

        return view('supplier.index', compact('title', 'supplier'));
    }

    public function create()
    {
        $title = "Tambah Supplier";
        return view('supplier.create', compact('title'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_supplier' => 'required',
            'kode_supplier' => 'required|unique:supplier,kode_supplier',
            'telepon' => 'nullable',
            'email' => 'nullable|email',
            'alamat' => 'nullable',
            'perusahaan' => 'nullable',
            'status' => 'required'
        ]);

        Supplier::create($validated);

        return redirect()
            ->route('supplier.index')
            ->with('Sukses', 'Supplier berhasil ditambahkan');
    }

    public function edit($id)
    {
        $title = "Edit Supplier";
        $supplier = Supplier::findOrFail($id);

        return view('supplier.edit', compact('title', 'supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $validated = $request->validate([
            'nama_supplier' => 'required',
            'kode_supplier' => 'required|unique:supplier,kode_supplier,' . $supplier->id_supplier . ',id_supplier',
            'telepon' => 'nullable',
            'email' => 'nullable|email',
            'alamat' => 'nullable',
            'perusahaan' => 'nullable',
            'status' => 'required'
        ]);

        $supplier->update($validated);

        return redirect()
            ->route('supplier.index')
            ->with('Sukses', 'Supplier berhasil diupdate');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->back()
            ->with('Sukses', 'Supplier berhasil dihapus');
    }
}
