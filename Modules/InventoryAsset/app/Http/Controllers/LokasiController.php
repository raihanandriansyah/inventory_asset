<?php

namespace Modules\InventoryAsset\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $lokasi = $request->input('cari');

        $nean = Lokasi::query();

        if ($lokasi) {
            $nean->where(function ($query) use ($lokasi) {
                $query->where('kode_lokasi', 'like', '%' . $lokasi . '%')
                    ->orWhere('nama_lokasi', 'like', '%' . $lokasi . '%');
            });
            
        }
        $nean = $nean->latest()->paginate(10);

        return view('inventoryasset::lokasi.index', compact('nean', 'lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('inventoryasset::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('inventoryasset::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('inventoryasset::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
