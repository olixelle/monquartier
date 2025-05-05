<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('fr_FR');

        $offerTitles = [
            'Prêt de perceuse électrique',
            'Service de jardinage',
            'Cours de guitare',
            'Prêt d\'échelle',
            'Aide pour déménagement',
            'Garde d\'animaux',
            'Prêt de tondeuse',
            'Cours de cuisine',
            'Aide aux devoirs',
            'Prêt d\'outils de bricolage',
            'Transport solidaire',
            'Prêt de livre',
            'Réparation de vélo',
            'Prêt de machine à coudre',
            'Cours d\'informatique',
            'Prêt de taille-haie',
            'Babysitting',
            'Prêt de matériel de camping',
            'Aide administrative',
            'Prêt de barbecue',
        ];

        $types = ['offer', 'request'];

        for ($i = 0; $i < 50; $i++) {
            $isOffer = $faker->boolean(80); // 80% de chances que ce soit une offre plutôt qu'une demande
            $title = $faker->randomElement($offerTitles);

            // Prix: souvent 0 mais parfois plus
            $price = $faker->boolean(70) ? 0 : $faker->numberBetween(5, 50);

            DB::table('offers')->insert([
                'title' => $title,
                'owner' => $faker->numberBetween(3, 6),
                'neighborhood' => 1,
                'category' => $faker->numberBetween(1, 40),
                'type' => $isOffer ? 'offer' : 'request',
                'status' => 'enabled',
                'price' => $price,
                'image' => null,
                'description' => $faker->paragraph(3) . "\n\n" . $faker->paragraph(2),
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                'updated_at' => $faker->dateTimeBetween('-6 months', 'now'),
            ]);
        }
    }
}
