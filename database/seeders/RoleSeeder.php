<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles_array = [
            'admin',
            'user',
        ];

        foreach ($roles_array as $role) {
            $toRole = Role::firstOrCreate(['name' => $role]);

            if( $toRole->name == 'admin' ) {
                $toRole->givePermissionTo(Permission::all());
            } else {
                $toRole->givePermissionTo(['invoice-list','invoice-create','invoice-delete','invoice-edit']);
            }
        }
    }
}
