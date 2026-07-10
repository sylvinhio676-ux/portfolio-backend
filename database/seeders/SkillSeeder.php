<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Base CDN Devicon (logos colorés fiables) — pour les tests locaux.
        // En production, ces URLs seront remplacées par des uploads Cloudinary.
        $icon = 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/';

        // Frontend
        $frontend = SkillCategory::where('slug', 'frontend')->first();
        $skills = [
            [
                'category_id' => $frontend->id,
                'name' => 'React.js',
                'logo_url' => $icon . 'react/react-original.svg',
                'level' => 90,
                'color' => '#61DAFB',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $frontend->id,
                'name' => 'Next.js',
                'logo_url' => $icon . 'nextjs/nextjs-original.svg',
                'level' => 85,
                'color' => '#000000',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'category_id' => $frontend->id,
                'name' => 'Vue.js',
                'logo_url' => $icon . 'vuejs/vuejs-original.svg',
                'level' => 80,
                'color' => '#4FC08D',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'category_id' => $frontend->id,
                'name' => 'TypeScript',
                'logo_url' => $icon . 'typescript/typescript-original.svg',
                'level' => 85,
                'color' => '#3178C6',
                'is_visible' => true,
                'sort_order' => 4,
            ],
            [
                'category_id' => $frontend->id,
                'name' => 'Tailwind CSS',
                'logo_url' => $icon . 'tailwindcss/tailwindcss-original.svg',
                'level' => 90,
                'color' => '#06B6D4',
                'is_visible' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Backend
        $backend = SkillCategory::where('slug', 'backend')->first();
        $skills = [
            [
                'category_id' => $backend->id,
                'name' => 'Laravel',
                'logo_url' => $icon . 'laravel/laravel-original.svg',
                'level' => 95,
                'color' => '#FF2D20',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $backend->id,
                'name' => 'PHP',
                'logo_url' => $icon . 'php/php-original.svg',
                'level' => 90,
                'color' => '#777BB4',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'category_id' => $backend->id,
                'name' => 'Node.js',
                'logo_url' => $icon . 'nodejs/nodejs-original.svg',
                'level' => 75,
                'color' => '#339933',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'category_id' => $backend->id,
                'name' => 'Symfony',
                'logo_url' => $icon . 'symfony/symfony-original.svg',
                'level' => 80,
                'color' => '#000000',
                'is_visible' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Database
        $database = SkillCategory::where('slug', 'database')->first();
        $skills = [
            [
                'category_id' => $database->id,
                'name' => 'MySQL',
                'logo_url' => $icon . 'mysql/mysql-original.svg',
                'level' => 90,
                'color' => '#4479A1',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $database->id,
                'name' => 'PostgreSQL',
                'logo_url' => $icon . 'postgresql/postgresql-original.svg',
                'level' => 75,
                'color' => '#336791',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'category_id' => $database->id,
                'name' => 'MongoDB',
                'logo_url' => $icon . 'mongodb/mongodb-original.svg',
                'level' => 70,
                'color' => '#47A248',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'category_id' => $database->id,
                'name' => 'Redis',
                'logo_url' => $icon . 'redis/redis-original.svg',
                'level' => 75,
                'color' => '#DC382D',
                'is_visible' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // DevOps & Cloud
        $devops = SkillCategory::where('slug', 'devops')->first();
        $skills = [
            [
                'category_id' => $devops->id,
                'name' => 'Docker',
                'logo_url' => $icon . 'docker/docker-original.svg',
                'level' => 80,
                'color' => '#2496ED',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $devops->id,
                'name' => 'Git',
                'logo_url' => $icon . 'git/git-original.svg',
                'level' => 90,
                'color' => '#F05032',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'category_id' => $devops->id,
                'name' => 'AWS',
                'logo_url' => $icon . 'amazonwebservices/amazonwebservices-original-wordmark.svg',
                'level' => 70,
                'color' => '#FF9900',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'category_id' => $devops->id,
                'name' => 'Kubernetes',
                'logo_url' => $icon . 'kubernetes/kubernetes-original.svg',
                'level' => 70,
                'color' => '#326CE5',
                'is_visible' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Mobile
        $mobile = SkillCategory::where('slug', 'mobile')->first();
        $skills = [
            [
                'category_id' => $mobile->id,
                'name' => 'React Native',
                'logo_url' => $icon . 'react/react-original.svg',
                'level' => 80,
                'color' => '#61DAFB',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $mobile->id,
                'name' => 'Flutter',
                'logo_url' => $icon . 'flutter/flutter-original.svg',
                'level' => 65,
                'color' => '#02569B',
                'is_visible' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Design & Outils
        $design = SkillCategory::where('slug', 'design')->first();
        $skills = [
            [
                'category_id' => $design->id,
                'name' => 'Figma',
                'logo_url' => $icon . 'figma/figma-original.svg',
                'level' => 80,
                'color' => '#F24E1E',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'category_id' => $design->id,
                'name' => 'Postman',
                'logo_url' => $icon . 'postman/postman-original.svg',
                'level' => 90,
                'color' => '#FF6C37',
                'is_visible' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
