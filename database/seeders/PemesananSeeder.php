<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pemesanan')->insert([
            [
                'jumlah' => 2,
                'total_harga' => 15000 * 2,  
                'tanggal_pemesanan' => Carbon::today()->toDateString(),
                'nomor_meja' => 1,
                'id_member' => 1, 
                'diskon' => 'false',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jumlah' => 1,
                'total_harga' => 25000 * 1,  
                'tanggal_pemesanan' => Carbon::today()->toDateString(),
                'nomor_meja' => 2,
                'id_member' => 2,
                'diskon' => 'false',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jumlah' => 3,
                'total_harga' => 12000 * 3,  
                'tanggal_pemesanan' => Carbon::today()->toDateString(),
                'nomor_meja' => 3,
                'id_member' => 3,
                'diskon' => 'true',  
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jumlah' => 1,
                'total_harga' => 35000 * 1,  
                'tanggal_pemesanan' => Carbon::today()->toDateString(),
                'nomor_meja' => 4,
                'id_member' => 4,
                'diskon' => 'false',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
