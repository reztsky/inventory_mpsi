<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'name'=>'Admin',
            'nik'=>'3578160000000001',
            'jenis_kelamin'=>'L',
            'alamat'=>'xyz',
            'no_telfon'=>'0000000000',
            'username'=>'admin',
            'password'=>'123456',
        ]);

        $user->assignRole('superadmin');

    }
}
