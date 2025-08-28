<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengajuan extends Model
{
    use HasFactory;
    protected $table = 'surat_pengajuan'; 
    protected $fillable = ['cabang_id','barang_id','jumlah','status'];
    public function cabang() { return $this->belongsTo(Perusahaan::class,'cabang_id'); }
    public function barang() { return $this->belongsTo(Barang::class,'barang_id'); }
}
