<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ordre d'exécution (respect des contraintes de clés étrangères)
        $this->call([
            UserSeeder::class,
            AboutSeeder::class,
            SeoSettingSeeder::class,
            SkillCategorySeeder::class,
            SkillSeeder::class,
            WorkflowStepSeeder::class,
            ServiceSeeder::class,
            SocialSeeder::class,
            TestimonialSeeder::class,
            ExperienceSeeder::class,
            ProjectSeeder::class,
            ProjectImageSeeder::class,
            ProjectTechnologySeeder::class,
        ]);
    }
}