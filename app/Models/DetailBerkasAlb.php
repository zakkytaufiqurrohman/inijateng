<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBerkasAlb extends Model
{
    use HasFactory;

    protected $table = 'detail_berkas_alb';

    protected $fillable = [
        'user_id',
        'ktp',
        'suket_pengda',
        'pengantar_magang',
        'rekomendasi_pengda',
        'ttmb1',
        'ttmb2',
        'ttmb3',
        'ttmb4'
    ];
}
