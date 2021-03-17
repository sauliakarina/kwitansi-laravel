<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name'              => 'admin',
            'email'             => 'admin@lpkn.org',
            'email_verified_at' => now(),
            'password'          => bcrypt('lpkn123##'),
            'remember_token'    => Str::random(10)
         ];


        DB::table('users')->insert($data);
    }
}
