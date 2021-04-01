<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang')->insert([
            'nama'       => 'Body Lotion',
            'harga'      => '55000',
            'stok'       => '10',
            'discount'   => '20',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('barang')->insert([
            'nama'       => 'Sabun Cair',
            'harga'      => '23000',
            'stok'       => '15',
            'discount'   => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('barang')->insert([
            'nama'       => 'Shampo',
            'harga'      => '25000',
            'stok'       => '3',
            'discount'   => '50',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // for($i = 1; $i <= 5; $i++){
        //     DB::table('member')->insert([
        //         'name'       => 'Member '.$i,
        //         'email'      => 'member'.$i.'@demo.id',
        //         'hp'         => '083843549167',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]);
        // }
    }
}
