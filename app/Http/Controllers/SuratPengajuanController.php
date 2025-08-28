<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratPengajuan;
use App\Models\Perusahaan;
use App\Models\Barang;

class SuratPengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua data SuratPengajuan beserta relasi cabang & barang
        $suratPengajuans = SuratPengajuan::with(['cabang', 'barang'])->get();
        $perusahaans = Perusahaan::all();
        $barangs = Barang::all();

        return view('surat_pengajuan.index', compact('suratPengajuans','perusahaans','barangs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cabang_id' => 'required|exists:perusahaan,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|string'
        ]);

        $surat = SuratPengajuan::create($request->all());

        return response()->json([
            'message' => 'Data surat pengajuan berhasil disimpan',
            'data' => $surat
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $surat = SuratPengajuan::findOrFail($id);
        return response()->json([
            'data' => $surat
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
            'jumlah' => 'required|integer|min:1',
            'status' => 'required|string'
        ]);

        $surat = SuratPengajuan::findOrFail($id);
        $surat->update($request->all());

        return response()->json([
            'message' => 'Data surat pengajuan berhasil diupdate',
            'data' => $surat
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $surat = SuratPengajuan::findOrFail($id);
        $surat->delete();

        return response()->json([
            'message' => 'Data surat pengajuan berhasil dihapus'
        ]);
    }
}
