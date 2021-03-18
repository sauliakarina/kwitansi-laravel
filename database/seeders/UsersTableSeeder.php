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
            'email' => 'admin@lpkn.org',
            'password' => Hash::make('123123'),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10)
        ]);

        $keuangan = User::firstOrCreate([
            'name' => 'Staff Keuangan',
            'email' => 'keuangan@lpkn.org',
            'password' => Hash::make('123123'),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10)
        ]);

        $panitia = User::firstOrCreate([
            'name' => 'Staff Panitia',
            'email' => 'panitia@lpkn.org',
            'password' => Hash::make('123123'),
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10)
        ]);

        $admin->assignRole('admin');
        $keuangan->assignRole('keuangan');
        $panitia->assignRole('panitia');

    }
}
