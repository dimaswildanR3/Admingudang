<?php
// app/Http/Controllers/TulisSuratController.php
namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TulisSuratController extends Controller
{
    /**
     * Menampilkan form tulis surat
     */
    public function index()
    {
        return view('tulis.index');
    }

    /**
     * Menyimpan surat yang ditulis
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat'   => 'required|unique:surats',
            'judul'         => 'required',
            'isi'           => 'required',
            'file_surat'    => 'nullable|file|mimes:pdf,doc,docx',
            'jenis'         => 'required|in:masuk,keluar',
        ]);
    
        $data = $request->all();
        $data['pengirim'] = Auth::user()->name; // nama pengirim
        $data['tanggal_surat'] = now(); 
    
        // Upload file jika ada
        if ($request->hasFile('file_surat')) {
            $data['file_surat'] = $request->file('file_surat')->store('surat_files', 'public');
        }
    
        $surat = Surat::create($data);
    
        // --- Buat notifikasi untuk role pertama (misal role_id = 1) ---
        $users = \App\Models\User::where('role_id', 1)->get();
        foreach ($users as $user) {
            \App\Models\Notification::create([
                'user_id' => $user->id,
                'title' => 'Surat Baru',
                'message' => "Surat baru '{$surat->judul}' dari {$surat->pengirim} telah dibuat.",
                'is_read' => false,
            ]);
        }
    
        return redirect()->back()->with('success', 'Surat berhasil dikirim dan notifikasi terkirim ke user.');
    }
    
}
