<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'nik' => '123456789',
            'wa' => '+62',
            'name' => 'admin',
            'kota' => '1',
            'provinsi' => '1',
            'tempat_lahir' => '1',
            'tgl_lahir' => '2022-10-01',
            'status_anggota' => 'alb',
            'foto'=>'default.png'

        ]);
    }
}
