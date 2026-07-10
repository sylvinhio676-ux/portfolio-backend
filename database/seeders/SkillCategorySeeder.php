<?php

namespace Database\Seeders;

use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class SkillCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Frontend Development',
                'slug' => 'frontend',
                'description' => 'Technologies pour le développement d\'interfaces utilisateur modernes et réactives.',
                'icon' => 'Layout',
                'sort_order' => 1,
            ],
            [
                'name' => 'Backend Development',
                'slug' => 'backend',
                'description' => 'Technologies pour le développement de serveurs et d\'API robustes.',
                'icon' => 'Server',
                'sort_order' => 2,
            ],
            [
                'name' => 'Base de Données',
                'slug' => 'database',
                'description' => 'Systèmes de gestion de bases de données et optimisation.',
                'icon' => 'Database',
                'sort_order' => 3,
            ],
            [
                'name' => 'DevOps & Cloud',
                'slug' => 'devops',
                'description' => 'Outils de déploiement, conteneurisation et services cloud.',
                'icon' => 'Cloud',
                'sort_order' => 4,
            ],
            [
                'name' => 'Mobile Development',
                'slug' => 'mobile',
                'description' => 'Technologies de développement d\'applications mobiles.',
                'icon' => 'Smartphone',
                'sort_order' => 5,
            ],
            [
                'name' => 'Design & Outils',
                'slug' => 'design',
                'description' => 'Outils de conception UI/UX et développement.',
                'icon' => 'Palette',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            SkillCategory::create($category);
        }
    }
}