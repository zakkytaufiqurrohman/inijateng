<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTTMB extends Model
{
    use HasFactory;

    protected $table = "riwayat_ttmb";

    protected $fillable = [
        'pengwil',
        'tgl_pelaksanaan',
        'materi',
        'nilai',
        'tgl_nomor',
        'magang_ke',
        'user_id'
    ];
}
