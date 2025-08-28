<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        // Kalau foto statis, langsung tulis nama file
        $foto = 'pengumuman1.jpg';

        // Kalau dari database, bisa ambil dari model
        // $foto = Pengumuman::latest()->first()->foto;

        return view('pengumuman.index', compact('foto'));
    }
}
