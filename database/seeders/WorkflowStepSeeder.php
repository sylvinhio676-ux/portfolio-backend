<?php

namespace Database\Seeders;

use App\Models\WorkflowStep;
use Illuminate\Database\Seeder;

class WorkflowStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Étapes de la méthode de travail (section « Ma Méthode de Travail »).
     * Le champ icon référence un nom d'icône Lucide.
     */
    public function run(): void
    {
        $steps = [
            [
                'title' => 'Analyse',
                'description' => "Je comprends le besoin métier, les contraintes et les objectifs avant d'écrire la moindre ligne de code.",
                'icon' => 'Search',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'UX / UI',
                'description' => "Je conçois des parcours et des interfaces clairs, centrés sur l'utilisateur et fidèles à l'identité visuelle.",
                'icon' => 'PenTool',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Architecture',
                'description' => "Je définis une architecture robuste, scalable et maintenable adaptée au projet.",
                'icon' => 'Network',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Frontend',
                'description' => "Je développe des interfaces performantes et responsives avec React, TypeScript et Tailwind.",
                'icon' => 'MonitorSmartphone',
                'is_visible' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Backend',
                'description' => "Je construis des API sécurisées et bien structurées avec Laravel, en respectant les bonnes pratiques.",
                'icon' => 'Server',
                'is_visible' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Tests',
                'description' => "Je teste les fonctionnalités clés pour garantir fiabilité et non-régression.",
                'icon' => 'FlaskConical',
                'is_visible' => true,
                'sort_order' => 6,
            ],
            [
                'title' => 'Déploiement',
                'description' => "Je déploie l'application (Vercel, serveur PHP) avec HTTPS et intégration continue.",
                'icon' => 'Rocket',
                'is_visible' => true,
                'sort_order' => 7,
            ],
            [
                'title' => 'Maintenance',
                'description' => "J'assure le suivi, les évolutions et l'optimisation continue après la mise en ligne.",
                'icon' => 'Wrench',
                'is_visible' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($steps as $step) {
            WorkflowStep::create($step);
        }
    }
}
