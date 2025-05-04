<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class PublicMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

                // Création d'informations de base pour nos voisins
                $neighbors = [
                    1 => [
                        'name' => 'Sophie',
                        'occupation' => 'infirmière',
                        'apartment' => '3A',
                        'style' => 'amicale et serviable'
                    ],
                    2 => [
                        'name' => 'Thomas',
                        'occupation' => 'développeur web',
                        'apartment' => '5B',
                        'style' => 'discret mais disponible'
                    ],
                    3 => [
                        'name' => 'Marie',
                        'occupation' => 'professeure des écoles',
                        'apartment' => '2C',
                        'style' => 'organisée et énergique'
                    ],
                    4 => [
                        'name' => 'Paul',
                        'occupation' => 'retraité',
                        'apartment' => '1D',
                        'style' => 'bricoleur et bavard'
                    ],
                ];

                // Thèmes de discussion entre voisins
                $messageTemplates = [
                    // Entraide
                    "Bonjour chers voisins ! Quelqu'un pourrait-il me prêter une perceuse ce weekend ? Merci d'avance !",
                    "Est-ce que quelqu'un aurait un escabeau à me prêter pour la journée ? J'ai besoin de changer une ampoule au plafond.",
                    "Je cherche une cocotte minute pour ce soir, quelqu'un en aurait une à me prêter ?",
                    "Auriez-vous un peu de farine à me dépanner ? J'en manque pour terminer ma recette.",
                    "Quelqu'un pourrait-il m'aider à déplacer une armoire demain ? Je ne peux pas le faire seul(e).",

                    // Services
                    "Si quelqu'un a besoin de faire garder ses plantes pendant les vacances, je suis disponible !",
                    "Je vais à la déchetterie samedi, si certains ont des encombrants à jeter, je peux les prendre.",
                    "Je propose de l'aide aux devoirs pour les enfants du quartier (niveau primaire).",
                    "Je peux promener votre chien cette semaine si besoin, j'aime beaucoup les animaux.",
                    "Je fais des gâteaux ce weekend, si ça intéresse quelqu'un de partager un moment convivial !",

                    // Événements
                    "Je vous rappelle la réunion de copropriété ce jeudi à 18h dans le hall d'entrée.",
                    "Qui serait intéressé par un barbecue commun dans le jardin ce dimanche ?",
                    "La mairie organise un vide-grenier le 15 juin, quelqu'un serait partant pour y réserver un stand ensemble ?",
                    "J'organise une petite fête d'anniversaire samedi, désolé par avance pour le bruit (ça finira à 23h max).",
                    "Quelqu'un veut participer au marathon de la ville ? On pourrait s'entraîner ensemble.",

                    // Problèmes
                    "Je vous informe que l'eau sera coupée demain entre 9h et 12h pour travaux.",
                    "Savez-vous pourquoi le chauffage ne fonctionne pas depuis ce matin ?",
                    "Quelqu'un a-t-il remarqué des bruits étranges au 2ème étage cette nuit ?",
                    "Attention, il y a eu des tentatives de cambriolage dans le quartier. Restons vigilants.",
                    "L'ascenseur est encore en panne, j'ai appelé le technicien qui devrait venir demain.",

                    // Questions
                    "Connaissez-vous un bon plombier dans le quartier ? J'ai un problème de fuite.",
                    "Quel est le jour de ramassage des encombrants ce mois-ci ?",
                    "À quelle heure ferme l'épicerie du coin le dimanche ?",
                    "Savez-vous s'il y a un médecin qui fait des visites à domicile dans le quartier ?",
                    "Est-ce que quelqu'un sait comment contacter le nouveau gardien ?",

                    // Annonces
                    "Je donne un canapé en bon état, photos disponibles sur demande.",
                    "J'ai des livres pour enfants à donner, si ça intéresse quelqu'un.",
                    "Je vends mon vélo d'appartement presque neuf, faites-moi une offre si intéressé.",
                    "Je cherche quelqu'un pour un covoiturage quotidien vers le centre-ville (départ 8h, retour 18h).",
                    "Si quelqu'un cherche une baby-sitter, ma fille de 18 ans est disponible les weekends."
                ];

                // Réponses possibles
                $responses = [
                    "Bien sûr, je peux t'aider avec ça !",
                    "Désolé, je ne suis pas disponible ce jour-là.",
                    "J'en ai un(e) que je peux te prêter, passe chez moi quand tu veux.",
                    "Je t'envoie un message privé pour en discuter.",
                    "Merci pour l'info !",
                    "Bonne idée, je suis partant(e) !",
                    "Est-ce que quelqu'un d'autre serait intéressé ?",
                    "Je note la date, merci du rappel.",
                    "Ça m'intéresse, comment peut-on s'organiser ?",
                    "Je peux te dépanner ce weekend.",
                    "J'ai rencontré le même problème la semaine dernière.",
                    "As-tu essayé de contacter le syndic à ce sujet ?",
                    "Je confirme, j'ai aussi remarqué ce problème.",
                    "Excellente initiative, merci !",
                    "N'hésitez pas à sonner chez moi si besoin d'aide.",
                    "Je connais quelqu'un qui pourrait t'aider, je te donne son contact.",
                    "Combien demandes-tu pour ça ?",
                    "Ça tombe bien, j'en cherchais justement un(e) !",
                    "C'est noté, merci pour le partage.",
                    "Je suis nouveau/nouvelle dans l'immeuble, ravi(e) de faire votre connaissance !"
                ];

                // Réponses spécifiques aux voisins
                $personalizedResponses = [
                    1 => [
                        "En tant qu'infirmière, je peux aussi vous proposer de vérifier votre tension si vous ne vous sentez pas bien.",
                        "Je rentre tard ce soir de l'hôpital, merci de ne pas faire trop de bruit après 22h.",
                        "Je fais un gâteau ce weekend, j'en déposerai une part devant votre porte !",
                        "Si quelqu'un a besoin de conseils santé, n'hésitez pas à me demander.",
                        "Je serais ravie de participer, mais mon planning de garde est assez chargé ce mois-ci."
                    ],
                    2 => [
                        "Je peux vous aider avec vos problèmes informatiques, n'hésitez pas à me solliciter.",
                        "Je télétravaille, donc je suis souvent disponible pour réceptionner les colis.",
                        "J'ai créé un petit site web pour notre résidence, voici le lien si ça vous intéresse.",
                        "Je suis partant pour organiser un atelier d'initiation au code pour les enfants du quartier.",
                        "Désolé pour le bruit hier soir, j'étais en visioconférence avec des collègues à l'étranger."
                    ],
                    3 => [
                        "Je propose de garder les enfants ce mercredi après-midi et d'organiser des activités éducatives.",
                        "Si certains parents ont des questions sur l'école du quartier, je peux vous renseigner.",
                        "J'ai des livres scolaires à donner, ils peuvent servir pour l'aide aux devoirs.",
                        "Je suis en train d'organiser une petite bibliothèque partagée dans le hall, qu'en pensez-vous ?",
                        "Attention, demain c'est la journée portes ouvertes à l'école, il y aura du monde dans le quartier."
                    ],
                    4 => [
                        "J'ai réparé l'étagère de l'entrée qui était branlante, ça devrait tenir maintenant.",
                        "Je vais à la pêche samedi, si certains veulent du poisson frais, faites-moi signe !",
                        "J'ai connu ce quartier dans les années 70, si ça intéresse quelqu'un de connaître son histoire.",
                        "Je peux vous aider à réparer ça, j'ai tous les outils nécessaires.",
                        "À mon époque, on organisait des repas de quartier tous les mois, on devrait reprendre cette tradition !"
                    ]
                ];

                // Tableau pour stocker les messages dans l'ordre chronologique
                $messages = [];

                // Date de début (il y a 10 jours)
                $startDate = Carbon::now()->subDays(10)->startOfDay();

                // Générer un fil de discussion cohérent
                for ($i = 0; $i < 100; $i++) {
                    // Déterminer qui poste ce message
                    $ownerId = rand(1, 4);

                    // Calculer la date/heure (progression chronologique)
                    $minutes = rand(30, 240); // Entre 30 minutes et 4 heures après le message précédent
                    if ($i === 0) {
                        $createdAt = $startDate;
                    } else {
                        $createdAt = Carbon::parse($messages[$i-1]['created_at'])->addMinutes($minutes);
                    }

                    // Si on dépasse la date actuelle, on arrête
                    if ($createdAt > Carbon::now()) {
                        break;
                    }

                    // Déterminer le contenu du message
                    $messageContent = '';

                    // 1 chance sur 5 de commencer une nouvelle discussion
                    if ($i === 0 || rand(1, 5) === 1) {
                        $messageContent = Arr::random($messageTemplates);
                    }
                    // Sinon, on répond à la discussion en cours
                    else {
                        // 1 chance sur 3 d'avoir une réponse personnalisée
                        if (rand(1, 3) === 1 && !empty($personalizedResponses[$ownerId])) {
                            $messageContent = Arr::random($personalizedResponses[$ownerId]);
                        } else {
                            $messageContent = Arr::random($responses);
                        }

                        // Parfois on ajoute une mention du voisin précédent
                        if (rand(1, 3) === 1 && isset($messages[$i-1])) {
                            $prevOwnerId = $messages[$i-1]['owner'];
                            $prevName = $neighbors[$prevOwnerId]['name'];
                            $messageContent = "@{$prevName} " . $messageContent;
                        }
                    }

                    // Ajout occasionnel d'émojis
                    if (rand(1, 3) === 1) {
                        $emojis = ["😊", "👍", "🙏", "❤️", "👋", "🎉", "😁", "🤔", "💪", "👏"];
                        $messageContent .= " " . Arr::random($emojis);
                    }

                    // Construire le message
                    $messages[] = [
                        'owner' => $ownerId,
                        'message' => $messageContent,
                        'created_at' => $createdAt,
                        'neighborhood_id' => 1
                    ];
                }

                // Insertion des messages dans la base de données
                // Note: Adaptez le nom de la table selon votre structure
                foreach ($messages as $message) {
                    DB::table('public_messages')->insert([
                        'owner' => $message['owner'],
                        'message' => $message['message'],
                        'created_at' => $message['created_at'],
                        'neighborhood' => $message['neighborhood_id']
                    ]);
                }
    }
}
