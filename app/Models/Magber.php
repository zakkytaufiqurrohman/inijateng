<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magber extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul',
        'keterangan',
        'status',
        'start_date',
        'end_date',
        'link_group',
        'banner'
    ];
}
