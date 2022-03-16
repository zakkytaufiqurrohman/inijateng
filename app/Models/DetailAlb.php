<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAlb extends Model
{
    use HasFactory;
    
    protected $table = 'detail_alb';

    protected $fillable = [
        'user_id',
        'no_alb',
        's1',
        's2',
        'tgl_lulus_s1',
        'tgl_lulus_s2',
        'ijazah_s1',
        'ijazah_s2',
        'bukti_terdaftar',
    ];
}
