<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perusahaan;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    public function read($id)
{
    $notification = Notification::findOrFail($id);
    $notification->update(['is_read' => true]);
    return back();
}

    public function index()
    {
        $perusahaans = Perusahaan::all();
        return view('perusahaan.index', compact('perusahaans'));
    }

    public function getData()
{
    $perusahaans = Perusahaan::all();

    return response()->json([
        'data' => $perusahaans
    ]);
}

    public function create()
    {
        $users = User::all();
        return view('perusahaan.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            
        ]);

        Perusahaan::create([
            'perusahaan' => $request->perusahaan,
            'alamat' => $request->alamat,
        
        ]);
        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $perusahaan = Perusahaan::find($id);
        return response()->json([
            'data' => $perusahaan
        ]);
    }
    

    public function update(Request $request, Perusahaan $perusahaan)
    {
        $request->validate([
            'perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            
        ]);

        $perusahaan->update($request->all());
        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil diupdate');
    }

    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan->delete();
        return redirect()->route('perusahaan.index')->with('success', 'Perusahaan berhasil dihapus');
    }
}
