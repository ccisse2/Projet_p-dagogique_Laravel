<?php

namespace Database\Seeders;

use App\Models\Sortie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SortieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sortie::factory()->count(50)->create();
    }
}
