<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailNotaris extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'npwp',
        'telephone',
        'alamat_kantor',
        'no_kta_ini',
        'no_kta_ppt',
        'ktp_img',
        'sk_notaris',
        'sk_ppt',
    ];
}
