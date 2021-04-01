<?php

namespace Database\Seeders;

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
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-delete',
            'role-edit',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'barang-list',
            'barang-create',
            'barang-delete',
            'barang-edit',
            'invoice-list',
            'invoice-create',
            'invoice-delete',
            'invoice-edit',
        ];

        foreach ($permissions as $permission) {
            $toPermission = Permission::firstOrCreate([
                'name' => $permission
            ]);
        }
    }
}
