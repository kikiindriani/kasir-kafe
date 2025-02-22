<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('member')->insert([
            [
                'username' => 'member01',
                'password' => 'password', 
                'telp' => '081234567890',
                'id_pegawai' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'member02',
                'password' => 'password', 
                'telp' => '081234567891',
                'id_pegawai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'member03',
                'password' => 'password', 
                'telp' => '081234567892',
                'id_pegawai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'member04',
                'password' => 'password', 
                'telp' => '081234567893',
                'id_pegawai' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'member05',
                'password' => 'password', 
                'telp' => '081234567894',
                'id_pegawai' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
