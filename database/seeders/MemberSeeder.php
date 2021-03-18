<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('member')->insert([
            'name'       => 'Saulia Karina',
            'email'      => 'sauliakarina@gmail.com',
            'hp'         => '083843549167',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        for($i = 1; $i <= 5; $i++){
            DB::table('member')->insert([
                'name'       => 'Member '.$i,
                'email'      => 'member'.$i.'@demo.id',
                'hp'         => '083843549167',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
