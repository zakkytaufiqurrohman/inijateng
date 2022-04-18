<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAlb extends Model
{
    use HasFactory;

    protected $fillable = [
        'alb_id',
        'alb_transaction_id',
        'nilai_wawancara',
        'nilai_tertulis',
        'status_lulus'
    ];
}
