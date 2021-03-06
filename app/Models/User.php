<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\PasswordReset;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Province;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nik',
        'wa',
        'kota',
        'provinsi',
        'tempat_lahir',
        'tgl_lahir',
        'status_anggota',
        'foto'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    public function detail_notaris()
    {
        return $this->hasOne(DetailNotaris::class,'user_id','id');
    }

    public function v_alb()
    {
        return $this->hasOne(VAlb::class,'id','id');
    }

    public function kotas()
    {
        return $this->belongsTo(City::class,'kota','id');
    }

    public function provincies()
    {
        return $this->belongsTo(Province::class,'provinsi','id');
    }

    public function lahir()
    {
        return $this->belongsTo(City::class,'tempat_lahir','id');
    }
}
