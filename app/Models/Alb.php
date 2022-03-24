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
        'year',
        'banner'
    ];
}
