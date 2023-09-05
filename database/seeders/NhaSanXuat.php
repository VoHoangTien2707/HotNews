<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NhaSanXuat extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nhasanxuat')->insert([
            'ten' => 'samsung',
            'logo' => 'images/samsung.jpg',
            'status' => 1
        ]);
    }
}
