<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'alb_id',
        'kode',
        'nama',
        'nik',
        'email',
        'wa',
        'tempat_lahir',
        'tanggal_lahir',
        'provinsi',
        'kota',
        's1',
        'tahun_s1',
        's2',
        'tahun_s2',
        'foto',
        'suket',
        'ijazah_s1',
        'ijazah_s2',
        'ktp',
        'bukti_bayar',
        'bendahara_status',
        'verifikator_status'
    ];
}
