<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surats'; 
    protected $fillable = [
        'nomor_surat',
        'judul',
        'isi',
        'jenis',
        'pengirim',
        'penerima',
        'tanggal_surat',
        'file_surat',
        'status',
    ];
}
