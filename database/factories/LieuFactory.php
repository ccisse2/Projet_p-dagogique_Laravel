<?php

namespace Database\Factories;

use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lieu>
 */
class LieuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $monuments = [
            'Eiffel Tower', 'Great Wall of China', 'Machu Picchu', 'Statue of Liberty',
            'Colosseum', 'Taj Mahal', 'Christ the Redeemer', 'Big Ben',
            'Sydney Opera House', 'Golden Gate Bridge', 'Angkor Wat', 'Louvre Museum',
            'Acropolis of Athens', 'Stonehenge', 'Mount Fuji', 'Petra',
            'Burj Khalifa', 'Sagrada Familia', 'Kremlin and Red Square', 'Alhambra',
            'Chichen Itza', 'Niagara Falls', 'Hagia Sophia', 'Mount Rushmore',
            'Versailles Palace', 'Grand Canyon', 'Brandenburg Gate', 'Forbidden City',
            'Neuschwanstein Castle', 'Blue Mosque', 'Pompeii', 'Santorini Cliffs',
            'Banff National Park', 'Victoria Falls', 'Pyramids of Giza', 'Yellowstone National Park',
            'Notre-Dame Cathedral', 'Times Square', 'Hollywood Sign', 'Mecca',
            'Shwedagon Pagoda', 'Moulin Rouge', 'Pantheon', 'St. Basil’s Cathedral',
            'Vatican City', 'Tower of London', 'Guggenheim Museum', 'Opera Garnier',
            'Hawa Mahal', 'Singapore Gardens by the Bay', 'Iguazu Falls',
            'Temple of Heaven', 'Moai Statues', 'Matterhorn', 'Lake Bled',
            'Mont Saint-Michel', 'Canals of Venice', 'Hoover Dam', 'Himeji Castle',
            'Galapagos Islands', 'Rialto Bridge', 'Brooklyn Bridge', 'Charles Bridge',
            'Edinburgh Castle', 'Palace of Knossos', 'Château de Chambord',
            'Matterhorn Mountain', 'Petronas Towers', 'Kilimanjaro', 'Kiyomizu-dera Temple',
            'Buckingham Palace', 'Giant’s Causeway', 'Terracotta Army', 'Seljalandsfoss',
            'Dubai Fountain', 'Table Mountain', 'Mount Everest', 'Westminster Abbey',
            'Pont du Gard', 'Castle Howard', 'Hermitage Museum', 'Cliffs of Moher',
            'Fushimi Inari Shrine', 'Wailing Wall', 'Arashiyama Bamboo Forest',
            'Nymphenburg Palace', 'Rock of Gibraltar', 'Meteora Monasteries',
            'Matterhorn Glacier Paradise', 'Okinawa Churaumi Aquarium', 'Tokyo Tower',
            'Fisherman’s Bastion', 'Sequoia National Park', 'Cabo da Roca', 'Mount Etna'
        ];
        return [
            'nom' => $this->faker->randomElement($monuments),
            'latitude' => $this->faker->latitude($min = -90, $max = 90),
            'longitude' => $this->faker->longitude($min = -180, $max = 180),
            'rue' => $this->faker->streetAddress,
            'ville_id' =>Ville::factory()  ?? Ville::inRandomOrder()->first()->id ,
        ];
    }
}
