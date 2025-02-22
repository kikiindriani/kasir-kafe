<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_pemesanan')->insert([
            [
                'id_pemesanan' => 1, 
                'id_menu' => 1, 
                'jumlah' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pemesanan' => 1, 
                'id_menu' => 2, 
                'jumlah' => 0, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pemesanan' => 2, 
                'id_menu' => 2, 
                'jumlah' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pemesanan' => 3, 
                'id_menu' => 3, 
                'jumlah' => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pemesanan' => 3, 
                'id_menu' => 4, 
                'jumlah' => 0, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pemesanan' => 4, 
                'id_menu' => 7, 
                'jumlah' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
