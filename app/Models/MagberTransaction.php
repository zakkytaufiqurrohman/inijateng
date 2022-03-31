<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagberTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'magber_id',
        'magber_ke',
        'bukti_bayar',
        'bendahara_status',
        'bendahara_status',
        'kode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail_alb()
    {
        return $this->belongsTo(DetailAlb::class);
    }
}
