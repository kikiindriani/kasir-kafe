<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('menu')->insert([
        [
            'nama_menu' => 'Kopi Hitam',
            'jenis_menu' => 'Minuman',
            'harga' => 15000,
            'image_name' => 'kopi_hitam.jpg', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_menu' => 'Kopi Latte',
            'jenis_menu' => 'Minuman',
            'harga' => 25000,
            'image_name' => 'kopi_latte.jpg', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_menu' => 'Teh Manis',
            'jenis_menu' => 'Minuman',
            'harga' => 12000,
            'image_name' => 'teh_manis.jpg', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_menu' => 'Es Teh',
            'jenis_menu' => 'Minuman',
            'harga' => 15000,
            'image_name' => 'es_teh.jpg', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_menu' => 'Roti Bakar Coklat',
            'jenis_menu' => 'Makanan',
            'harga' => 18000,
            'image_name' => 'roti_bakar_coklat.jpg', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_menu' => 'Sandwich Ayam',
            'jenis_menu' => 'Makanan',
            'harga' => 22000,
            'image_name' => 'sandwich_ayam.jpg', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_menu' => 'Pasta Carbonara',
            'jenis_menu' => 'Makanan',
            'harga' => 35000,
            'image_name' => 'pasta_carbonara.jpg', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_menu' => 'Pizza Margherita',
            'jenis_menu' => 'Makanan',
            'harga' => 60000,
            'image_name' => 'pizza_margherita.jpg', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_menu' => 'Smoothie Mangga',
            'jenis_menu' => 'Minuman',
            'harga' => 27000,
            'image_name' => 'smoothie_mangga.jpg', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'nama_menu' => 'Cappuccino',
            'jenis_menu' => 'Minuman',
            'harga' => 25000,
            'image_name' => 'cappuccino.jpg', 
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
}

}
