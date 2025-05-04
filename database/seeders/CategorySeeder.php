<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Catégories racines
        $objects = DB::table('categories')->insertGetId([
            'title' => 'Objets',
            'description' => 'Tous types d\'objets à prêter ou échanger entre voisins',
            'parent' => null,
        ]);

        $services = DB::table('categories')->insertGetId([
            'title' => 'Services',
            'description' => 'Services et coups de main entre voisins',
            'parent' => null,
        ]);

        // Sous-catégories pour Objets
        $objetsCuisine = DB::table('categories')->insertGetId([
            'title' => 'Cuisine et Alimentation',
            'description' => 'Ustensiles, appareils de cuisine et produits alimentaires',
            'parent' => $objects,
        ]);

        $objetsBricolage = DB::table('categories')->insertGetId([
            'title' => 'Bricolage et Outils',
            'description' => 'Outils et matériel pour les travaux et le bricolage',
            'parent' => $objects,
        ]);

        $objetsJardinage = DB::table('categories')->insertGetId([
            'title' => 'Jardinage et Extérieur',
            'description' => 'Équipements et matériel pour le jardin et l\'extérieur',
            'parent' => $objects,
        ]);

        $objetsJeux = DB::table('categories')->insertGetId([
            'title' => 'Jeux et Loisirs',
            'description' => 'Jeux, livres, équipements sportifs et de divertissement',
            'parent' => $objects,
        ]);

        $objetsElectronique = DB::table('categories')->insertGetId([
            'title' => 'Électronique et Multimédia',
            'description' => 'Équipements électroniques, informatiques et multimédias',
            'parent' => $objects,
        ]);

        $objetsVehicules = DB::table('categories')->insertGetId([
            'title' => 'Véhicules et Mobilité',
            'description' => 'Vélos, trottinettes, accessoires auto et autres moyens de transport',
            'parent' => $objects,
        ]);

        $objetsMaison = DB::table('categories')->insertGetId([
            'title' => 'Maison et Décoration',
            'description' => 'Mobilier, décoration, électroménager',
            'parent' => $objects,
        ]);

        $objetsVetements = DB::table('categories')->insertGetId([
            'title' => 'Vêtements et Accessoires',
            'description' => 'Vêtements, chaussures, accessoires de mode',
            'parent' => $objects,
        ]);

        $objetsBebe = DB::table('categories')->insertGetId([
            'title' => 'Bébé et Enfant',
            'description' => 'Équipements, jouets et vêtements pour enfants',
            'parent' => $objects,
        ]);

        // Sous-catégories pour Services
        $servicesBricolage = DB::table('categories')->insertGetId([
            'title' => 'Bricolage et Travaux',
            'description' => 'Aide pour bricolage, petits travaux, montage de meubles',
            'parent' => $services,
        ]);

        $servicesJardinage = DB::table('categories')->insertGetId([
            'title' => 'Jardinage et Plantes',
            'description' => 'Entretien du jardin, conseils, arrosage de plantes',
            'parent' => $services,
        ]);

        $servicesCuisine = DB::table('categories')->insertGetId([
            'title' => 'Cuisine et Repas',
            'description' => 'Préparation de repas, cours de cuisine, partage de repas',
            'parent' => $services,
        ]);

        $servicesEducation = DB::table('categories')->insertGetId([
            'title' => 'Éducation et Formation',
            'description' => 'Cours, soutien scolaire, aide aux devoirs',
            'parent' => $services,
        ]);

        $servicesTransport = DB::table('categories')->insertGetId([
            'title' => 'Transport et Covoiturage',
            'description' => 'Covoiturage, aide aux déplacements',
            'parent' => $services,
        ]);

        $servicesAnimaux = DB::table('categories')->insertGetId([
            'title' => 'Animaux de compagnie',
            'description' => 'Garde d\'animaux, promenade de chiens',
            'parent' => $services,
        ]);

        $servicesInformatique = DB::table('categories')->insertGetId([
            'title' => 'Informatique et Technologie',
            'description' => 'Dépannage informatique, aide à l\'utilisation d\'appareils',
            'parent' => $services,
        ]);

        $servicesBienEtre = DB::table('categories')->insertGetId([
            'title' => 'Bien-être et Soins',
            'description' => 'Coiffure, soins esthétiques, relaxation',
            'parent' => $services,
        ]);

        // Sous-catégories de niveau 3 pour Objets - Cuisine
        DB::table('categories')->insert([
            [
                'title' => 'Ustensiles et Équipements',
                'description' => 'Ustensiles de cuisine, plats, moules',
                'parent' => $objetsCuisine,
            ],
            [
                'title' => 'Appareils électroménagers',
                'description' => 'Robots, batteurs, mixeurs, friteuses',
                'parent' => $objetsCuisine,
            ],
            [
                'title' => 'Réception et Fêtes',
                'description' => 'Équipements pour réceptions et grandes occasions',
                'parent' => $objetsCuisine,
            ],
            [
                'title' => 'Livres de cuisine',
                'description' => 'Recettes, guides culinaires',
                'parent' => $objetsCuisine,
            ],
        ]);

        // Sous-catégories de niveau 3 pour Objets - Bricolage
        DB::table('categories')->insert([
            [
                'title' => 'Outils à main',
                'description' => 'Tournevis, marteaux, clés',
                'parent' => $objetsBricolage,
            ],
            [
                'title' => 'Outils électriques',
                'description' => 'Perceuses, ponceuses, scies',
                'parent' => $objetsBricolage,
            ],
            [
                'title' => 'Échelles et escabeaux',
                'description' => 'Échelles, escabeaux, marchepieds',
                'parent' => $objetsBricolage,
            ],
            [
                'title' => 'Matériel de peinture',
                'description' => 'Pinceaux, rouleaux, bâches',
                'parent' => $objetsBricolage,
            ],
        ]);

        // Sous-catégories de niveau 3 pour Objets - Jardinage
        DB::table('categories')->insert([
            [
                'title' => 'Outils de jardinage',
                'description' => 'Pelles, râteaux, sécateurs',
                'parent' => $objetsJardinage,
            ],
            [
                'title' => 'Équipements motorisés',
                'description' => 'Tondeuses, taille-haies, débroussailleuses',
                'parent' => $objetsJardinage,
            ],
            [
                'title' => 'Mobilier de jardin',
                'description' => 'Tables, chaises, parasols',
                'parent' => $objetsJardinage,
            ],
            [
                'title' => 'Arrosage et irrigation',
                'description' => 'Tuyaux, arrosoirs, systèmes d\'irrigation',
                'parent' => $objetsJardinage,
            ],
        ]);

        // Sous-catégories de niveau 3 pour Objets - Jeux
        DB::table('categories')->insert([
            [
                'title' => 'Jeux de société',
                'description' => 'Jeux de plateau, cartes, jeux familiaux',
                'parent' => $objetsJeux,
            ],
            [
                'title' => 'Jeux vidéo',
                'description' => 'Consoles, jeux, accessoires',
                'parent' => $objetsJeux,
            ],
            [
                'title' => 'Équipements sportifs',
                'description' => 'Ballons, raquettes, accessoires de sport',
                'parent' => $objetsJeux,
            ],
            [
                'title' => 'Livres et BD',
                'description' => 'Romans, bandes dessinées, magazines',
                'parent' => $objetsJeux,
            ],
            [
                'title' => 'Instruments de musique',
                'description' => 'Guitares, claviers, percussions',
                'parent' => $objetsJeux,
            ],
        ]);

        // Sous-catégories pour Services - Bricolage
        DB::table('categories')->insert([
            [
                'title' => 'Montage de meubles',
                'description' => 'Aide au montage de meubles en kit',
                'parent' => $servicesBricolage,
            ],
            [
                'title' => 'Réparations domestiques',
                'description' => 'Petites réparations dans la maison',
                'parent' => $servicesBricolage,
            ],
            [
                'title' => 'Peinture et décoration',
                'description' => 'Aide à la peinture et décoration',
                'parent' => $servicesBricolage,
            ],
        ]);

        // Sous-catégories pour Services - Jardinage
        DB::table('categories')->insert([
            [
                'title' => 'Tonte de pelouse',
                'description' => 'Aide pour tondre la pelouse',
                'parent' => $servicesJardinage,
            ],
            [
                'title' => 'Arrosage de plantes',
                'description' => 'Arrosage pendant les absences',
                'parent' => $servicesJardinage,
            ],
            [
                'title' => 'Conseils en jardinage',
                'description' => 'Conseils pour l\'entretien de plantes et du jardin',
                'parent' => $servicesJardinage,
            ],
        ]);
    }
}
