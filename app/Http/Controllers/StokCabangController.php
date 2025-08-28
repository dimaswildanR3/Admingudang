<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokCabang;
use App\Models\Perusahaan;
use App\Models\Barang;

class StokCabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stokCabangs = StokCabang::with(['cabang', 'barang'])->get();
        $perusahaans = Perusahaan::all();
        $barangs = Barang::all();
        // $stokCabangs = St;
        // var_dump($barangs);
        // die;
        return view('stok_cabang.index', compact('stokCabangs', 'perusahaans', 'barangs'));
    }
/**
 * Display all stok for a specific cabang.
 */
public function viewByCabang($cabang_id)
{
    // Ambil semua stok di cabang tertentu beserta data barang
    $stokCabangs = StokCabang::with('barang')
                    ->where('cabang_id', $cabang_id)
                    ->get();

    return response()->json([
        'data' => $stokCabangs
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cabang_id' => 'required|exists:perusahaan,id',
            'barang_id' => 'required|exists:barangs,id',
            
            'stok_minimum' => 'required|integer|min:0',
        ]);

        StokCabang::create($request->all());

        return response()->json([
            'message' => 'Stok Cabang berhasil ditambahkan',
            'status' => 'success'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stokCabang = StokCabang::findOrFail($id);
        return response()->json([
            'data' => $stokCabang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cabang_id' => 'required|exists:perusahaan,id',
            'barang_id' => 'required|exists:barangs,id',
            
            'stok_minimum' => 'required|integer|min:0',
        ]);

        $stokCabang = StokCabang::findOrFail($id);
        $stokCabang->update($request->all());

        return response()->json([
            'message' => 'Stok Cabang berhasil diupdate',
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $stokCabang = StokCabang::findOrFail($id);
        $stokCabang->delete();

        return response()->json([
            'message' => 'Stok Cabang berhasil dihapus',
            'status' => 'success'
        ]);
    }
}
