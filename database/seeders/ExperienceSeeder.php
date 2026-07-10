<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experiences = [
            [
                'position' => 'Full Stack Software Engineer',
                'company' => 'GeTime',
                'type' => 'freelance',
                'location' => 'Douala, Cameroun',
                'start_date' => '2024-01-01',
                'end_date' => null,
                'description' => "Développement de la plateforme GeTime de gestion d'emplois du temps académiques avec IA.",
                'sort_order' => 1,
                'is_current' => true,
            ],
            [
                'position' => 'Full Stack Developer',
                'company' => 'FormCam',
                'type' => 'freelance',
                'location' => 'Yaoundé, Cameroun',
                'start_date' => '2023-06-01',
                'end_date' => '2023-12-31',
                'description' => "Conception et développement de la plateforme e-learning FormCam avec streaming vidéo HLS et système de paiement.",
                'sort_order' => 2,
                'is_current' => false,
            ],
            [
                'position' => 'Lead Developer',
                'company' => 'WhatsMark',
                'type' => 'freelance',
                'location' => 'Douala, Cameroun',
                'start_date' => '2023-01-01',
                'end_date' => '2023-12-31',
                'description' => "Développement de la plateforme de marketing conversationnel WhatsApp API avec gestion de campagnes et analytics.",
                'sort_order' => 3,
                'is_current' => false,
            ],
            [
                'position' => 'Software Engineer',
                'company' => 'Estuaire Emplois',
                'type' => 'freelance',
                'location' => 'Libreville, Gabon',
                'start_date' => '2022-09-01',
                'end_date' => '2023-05-31',
                'description' => "Développement de la plateforme de mise en relation emploi et recrutement.",
                'sort_order' => 4,
                'is_current' => false,
            ],
            [
                'position' => 'Web Developer',
                'company' => 'Freelance',
                'type' => 'freelance',
                'location' => 'Remote',
                'start_date' => '2021-01-01',
                'end_date' => '2022-08-31',
                'description' => "Développement de sites web et applications pour divers clients internationaux.",
                'sort_order' => 5,
                'is_current' => false,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }
    }
}