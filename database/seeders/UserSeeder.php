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
        User::create([
            'role_id'=>1,
            'name'=>'Sultan Aulia Alfarizki',
            'nik'=>'3578160711980001',
            'jenis_kelamin'=>'L',
            'alamat'=>'Sidotopo Sekolahan 10/21a',
            'no_telfon'=>'085156261204',
            'username'=>'sull_aa',
            'password'=>'123456',
        ]);
    }
}
