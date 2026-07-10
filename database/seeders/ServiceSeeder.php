<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Développement Web Full Stack',
                'description' => 'Conception et développement d\'applications web modernes avec Laravel, Next.js, React ou Vue.js. Architecture robuste, scalable et performante.',
                'icon' => 'Globe',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Développement Mobile',
                'description' => 'Création d\'applications mobiles cross-platform avec React Native ou Flutter. Expérience utilisateur fluide et design adapté.',   
                'icon' => 'Smartphone',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'API & Intégration',
                'description' => 'Développement d\'API RESTful et GraphQL, intégration avec des services tiers et gestion des flux de données.',
                'icon' => 'Code2',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Architecture & Conseil Technique',
                'description' => 'Conseil en architecture logicielle, choix technologiques et meilleures pratiques pour assurer la qualité et la maintenabilité des projets.',
                'icon' => 'Building',
                'is_visible' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'SaaS & Plateformes',
                'description' => 'Développement de plateformes SaaS multi-tenant avec gestion des abonnements, paiements et tableaux de bord.',
                'icon' => 'Cloud',
                'is_visible' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}