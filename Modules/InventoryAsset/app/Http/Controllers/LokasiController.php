<?php

namespace Modules\InventoryAsset\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InventoryAsset\app\Models\Lokasi;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lokasi = Lokasi::latest()->get();

        return view('inventoryasset::lokasi.index', compact('lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_lokasi' => 'required|string|unique:lokasi,kode_lokasi',
            'nama_lokasi' => 'required|string|unique:lokasi,nama_lokasi',
            'tipe_lokasi' => 'required|in:gudang,rak,toko,cabang,etalase',
            'keterangan'  => 'nullable|string',
        ], [
            'kode_lokasi.unique' => 'Kode lokasi sudah terdaftar',
            'nama_lokasi.unique' => 'Nama lokasi sudah terdaftar',
        ]);

        Lokasi::create([
            'kode_lokasi' => $request->kode_lokasi,
            'nama_lokasi' => $request->nama_lokasi,
            'tipe_lokasi' => $request->tipe_lokasi,
            'keterangan'  => $request->keterangan,
        ]);

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Data lokasi berhasil ditambahkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $lokasi = Lokasi::findOrFail($id);

        $request->validate([
            'kode_lokasi' => 'required|string|unique:lokasi,kode_lokasi,' . $lokasi->id,
            'nama_lokasi' => 'required|string|unique:lokasi,nama_lokasi,' . $lokasi->id,
            'tipe_lokasi' => 'required|in:gudang,rak,toko,cabang,etalase',
            'keterangan'  => 'nullable|string',
        ], [
            'kode_lokasi.unique' => 'Kode lokasi sudah terdaftar',
            'nama_lokasi.unique' => 'Nama lokasi sudah terdaftar',
        ]);

        $lokasi->update($request->all());

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Data lokasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete();

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Data lokasi berhasil dihapus');
    }
}
