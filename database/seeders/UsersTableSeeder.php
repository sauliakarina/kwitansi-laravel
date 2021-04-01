<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@invoice.id',
            'password' => Hash::make('123123'),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10)
        ]);

        $user = User::firstOrCreate([
            'name' => 'User 1',
            'email' => 'user1@invoice.id',
            'password' => Hash::make('123123'),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10)
        ]);

        $user2 = User::firstOrCreate([
            'name' => 'User 2',
            'email' => 'user2@invoice.id',
            'password' => Hash::make('123123'),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10)
        ]);

        $admin->assignRole('admin');
        $user->assignRole('user');
        $user2->assignRole('user');

    }
}
