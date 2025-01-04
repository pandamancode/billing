<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name'  => 'admin',
                    'email' => 'admin',
                    'password'  => bcrypt('rahasia'),
                    'level'  => 'admin',
                ],
            ]
        );

        DB::table('categories')->insert(
            [
                [
                    'nama_kategori'  => 'MAKANAN & MINUMAN',
                ],
            ]
        );
    }
}
