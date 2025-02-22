<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai')->insert([
            [
                'nama_pegawai' => 'Pangeran Diponegoro',
                'username' => 'admin',
                'password' => Hash::make('password'), 
                'id_level' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pegawai' => 'Kiki Setiawan',
                'username' => 'kiki123',
                'password' => Hash::make('12345678'), 
                'id_level' => 2, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pegawai' => 'Indri Yani',
                'username' => 'indri123',
                'password' => Hash::make('87654321'), 
                'id_level' => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pegawai' => 'Eko Prabowo',
                'username' => 'eko123',
                'password' => Hash::make('password'), 
                'id_level' => 3, 
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
