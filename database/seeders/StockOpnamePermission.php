<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class StockOpnamePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
            'stockOpname-list',
            'stockOpname-create',
            'stockOpname-edit',
            'stockOpname-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name'=>$permission]);
        }
    }
}
