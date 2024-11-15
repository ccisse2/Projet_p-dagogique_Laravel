<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('etats')->insert([
            ['libelle', 'En création'],
            ['libelle' => 'Ouverte'],
            ['libelle' => 'Clôturée'],
            ['libelle' => 'Activité en cours'],
            ['libelle' => 'Activité terminée'],
            ['libelle' => 'Activité historisée'],
            ['libelle' => 'Annulée'],
        ]);
    }
}
