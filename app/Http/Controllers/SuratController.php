<?php
namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->query('jenis');
    
        if ($jenis == 'masuk') {
            // Jika filter masuk, ambil semua surat (masuk dan keluar)
            $surats = Surat::latest()->paginate(10);
        } elseif ($jenis) {
            // Jika filter selain masuk, ambil sesuai jenis
            $surats = Surat::where('jenis', $jenis)->latest()->paginate(10);
        } else {
            // Default, semua surat
            $surats = Surat::latest()->paginate(10);
        }
    
        return view('surat.index', compact('surats', 'jenis'));
    }
    
    
    public function approve($id)
{
    $surat = Surat::findOrFail($id);

    if ($surat->status === 'diterima') {
        return redirect()->back()->with('info', 'Surat sudah disetujui sebelumnya.');
    }

    // Tambahkan notifikasi untuk surat keluar sebelum update status
    if ($surat->jenis == 'keluar') {
        $userRole = auth()->user()->role_id;

        if ($userRole == 1 && $surat->status == 'draft') {
            // Notifikasi ke role 2
            $users = \App\Models\User::where('role_id', 2)->get();
            foreach ($users as $user) {
                \App\Models\Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Surat Baru',
                    'message' => "Surat '{$surat->judul}' sudah siap untuk tahap berikutnya.",
                    'is_read' => false,
                ]);
            }
        }

        if ($userRole == 2 && $surat->status == 'dalam_proses') {
            // Notifikasi ke role 3
            $users = \App\Models\User::where('role_id', 3)->get();
            foreach ($users as $user) {
                \App\Models\Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Surat dalam Checking',
                    'message' => "Surat '{$surat->judul}' telah dipindahkan ke Checking.",
                    'is_read' => false,
                ]);
            }
        }

        if ($userRole == 3 && $surat->status == 'checking') {
            // Notifikasi ke role 3 atau internal
            $users = \App\Models\User::where('role_id', 3)->get();
            foreach ($users as $user) {
                \App\Models\Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Surat dalam Preparing',
                    'message' => "Surat '{$surat->judul}' telah dipindahkan ke Preparing.",
                    'is_read' => false,
                ]);
            }
        }
    }

    // Tambahkan notifikasi untuk surat masuk
    if ($surat->jenis == 'masuk' && $surat->status == 'draft') {
        $users = \App\Models\User::where('role_id', 2)->get();
        foreach ($users as $user) {
            \App\Models\Notification::create([
                'user_id' => $user->id,
                'title' => 'Surat Masuk Disetujui',
                'message' => "Surat '{$surat->judul}' telah disetujui dan diterima.",
                'is_read' => false,
            ]);
        }
    }

    // --- Fungsi approve asli tetap jalan ---
    $surat->update([
        'status' => 'dalam_proses',
        'jenis'  => 'keluar'
    ]);

    if ($surat->jenis == 'keluar') {
        $userRole = auth()->user()->role_id;

        if ($userRole == 2 && $surat->status == 'dalam_proses') {
            $surat->update(['status' => 'checking']);
            return back()->with('success', 'Surat dipindahkan ke Checking.');
        }

        if ($userRole == 3 && $surat->status == 'checking') {
            $surat->update(['status' => 'preparing']);
            return back()->with('success', 'Surat dipindahkan ke Preparing.');
        }

        if ($userRole == 3 && $surat->status == 'preparing') {
            $surat->update(['status' => 'diterima']);
            return back()->with('success', 'Surat berhasil diterima.');
        }

        return back()->with('info', 'Anda tidak bisa approve surat ini pada tahap sekarang.');
    }

    if ($surat->status === 'diterima') {
        return back()->with('info', 'Surat sudah disetujui sebelumnya.');
    }

    $surat->update(['status' => 'diterima']);
    return back()->with('success', 'Surat telah disetujui.');
}

    

    
    public function reject($id)
    {
        $surat = Surat::findOrFail($id); // cari surat berdasarkan ID
        if ($surat->status === 'ditolak') {
            return redirect()->back()->with('info', 'Surat sudah ditolak sebelumnya.');
        }
    
        $surat->update(['status' => 'ditolak']);
        return redirect()->back()->with('success', 'Surat telah ditolak.');
    }
    
    
    public function indexTulis()
    {
        // langsung load view form tulis surat
        return view('tulis.index');
    }

    /**
     * Simpan surat yang ditulis
     */
    public function storeTulis(Request $request)
    {
        $request->validate([
            'nomor_surat'  => 'required|unique:surats',
            'judul'        => 'required',
            'isi'          => 'required',
            'tanggal_surat'=> 'required|date',
            'file_surat'   => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $data = $request->all();
        $data['jenis'] = 'tulis'; // otomatis tipe tulis

        if ($request->hasFile('file_surat')) {
            $data['file_surat'] = $request->file('file_surat')->store('surat_files','public');
        }

        Surat::create($data);

        return redirect()->back()->with('success', 'Surat berhasil dikirim');
    }
    public function create()
    {
        return view('surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surats',
            'judul' => 'required',
            'isi' => 'required',
            'jenis' => 'required|in:masuk,keluar',
            'tanggal_surat' => 'required|date',
        ]);

        $data = $request->all();

        // upload file
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat')->store('surat_files', 'public');
            $data['file_surat'] = $file;
        }

        Surat::create($data);

        return redirect()->route('surat.index', ['jenis' => $request->jenis])
                         ->with('success', 'Surat berhasil ditambahkan');
    }

    public function show(Surat $surat)
    {
        return view('surat.show', compact('surat'));
    }

    public function edit(Surat $surat)
    {
        return view('surat.edit', compact('surat'));
    }

    public function update(Request $request, Surat $surat)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'tanggal_surat' => 'required|date',
        ]);

        $data = $request->all();

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat')->store('surat_files', 'public');
            $data['file_surat'] = $file;
        }

        $surat->update($data);

        return redirect()->route('surat.index', ['jenis' => $surat->jenis])
                         ->with('success', 'Surat berhasil diperbarui');
    }

    public function destroy(Surat $surat)
    {
        $surat->delete();
        return redirect()->back()->with('success', 'Surat berhasil dihapus');
    }
}
