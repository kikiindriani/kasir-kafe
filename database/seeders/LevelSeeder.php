<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('levels')->insert([
            [
                'level' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level' => 'manajer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'level' => 'kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
