<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;
    protected $table = 'perusahaan';
    protected $fillable = ['perusahaan','alamat','user_id'];
    public function user() { return $this->belongsTo(User::class); }
    public function stokCabang() { return $this->hasMany(StokCabang::class,'cabang_id'); }
    public function suratPengajuan() { return $this->hasMany(SuratPengajuan::class,'cabang_id'); }
    public function barangKeluars()
    {
        return $this->hasMany(BarangKeluar::class);
    }
}
