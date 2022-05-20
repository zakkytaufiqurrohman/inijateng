<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alb extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'keterangan',
        'status',
        'start_date',
        'end_date',
        'link_group',
        'banner',
        'nomor',
        'tempat',
        'tanggal',
        'no_perkumpulan',
        'no_sk',
        'ketua',
        'sekretaris',
    ];
}
