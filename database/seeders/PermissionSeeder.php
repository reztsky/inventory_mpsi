<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'barang-list',
            'barang-create',
            'barang-edit',
            'barang-delete',
            'barangMasuk-list',
            'barangMasuk-create',
            'barangMasuk-edit',
            'barangMasuk-delete',
            'barangKeluar-list',
            'barangKeluar-create',
            'barangKeluar-edit',
            'barangKeluar-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name'=>$permission]);
        }
    }
}
