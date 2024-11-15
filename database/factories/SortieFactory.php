<?php

namespace Database\Factories;

use App\Models\Campus;
use App\Models\Etat;
use App\Models\Lieu;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sortie>
 */
class SortieFactory extends Factory
{
    /**
     * Détermine l'état en fonction des dates.
     *
     * @param \DateTime $dateCloture
     * @param \DateTime $dateDebut
     * @param \DateTime $dateFin
     * @return int
     */
    protected function determineEtatId($dateCloture, $dateDebut, $dateFin)
    {
        $today = Carbon::now();

        if ($today->lt($dateCloture)) {
            return Etat::where('libelle', 'ouverte')->first()->id;
        } elseif ($today->gte($dateCloture) && $today->lt($dateDebut)) {
            return Etat::where('libelle', 'clôturée')->first()->id;
        } elseif ($today->gte($dateDebut) && $today->lt($dateFin)) {
            return Etat::where('libelle', 'activité en cours')->first()->id;
        } elseif ($today->gte($dateFin) && $today->diffInMonths($dateFin) < 1) {
            return Etat::where('libelle', 'activité terminée')->first()->id;
        } else {
            return Etat::where('libelle', 'activité historisée')->first()->id;
        }
    }

    /**
     * Définition de l'état par défaut pour le modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Définition des dates de sortie
        $dateDebut = Carbon::instance($this->faker->dateTimeBetween('+1 day', '+2 months'));
        $duree = $this->faker->numberBetween(1, 8) * 60; // Durée en minutes
        $dateFin = (clone $dateDebut)->addMinutes($duree);
        $dateCloture = $this->faker->dateTimeBetween('-1 week', $dateDebut);

        return [
            'nom' => $this->faker->sentence(3),
            'dateHeureDebut' => $dateDebut,
            'duree' => $duree,
            'dateLimiteInscription' => $dateCloture,
            'nbInscriptionsMax' => $this->faker->numberBetween(5, 30),
            'infosSortie' => $this->faker->paragraph(6),
            'etat_id' => $this->determineEtatId($dateCloture, $dateDebut, $dateFin),
            'campus_id' => Campus::inRandomOrder()->first()->id ?? Campus::factory(),
            'organisateur_id' => Participant::inRandomOrder()->first()->id ?? Participant::factory(),
            'lieu_id' => Lieu::inRandomOrder()->first()->id ?? Lieu::factory(),
        ];
    }
}
