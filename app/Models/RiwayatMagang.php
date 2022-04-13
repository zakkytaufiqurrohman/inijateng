<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatMagang extends Model
{
    use HasFactory;

    protected $table = "riwayat_magang";

    protected $fillable = [
        'penerima_magang',
        'tempat_magang',
        'wilayah_kerja',
        'masa_magang',
        'tgl_no_surat',
        'magang_ke',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
