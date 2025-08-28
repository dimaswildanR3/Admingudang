<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokCabang extends Model
{
    use HasFactory;
    protected $table = 'stok_cabang';
    protected $fillable = ['cabang_id','barang_id','stok','stok_minimum'];
    public function cabang() { return $this->belongsTo(Perusahaan::class,'cabang_id'); }
    public function barang() { return $this->belongsTo(Barang::class,'barang_id'); }
}
