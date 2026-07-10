<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectTechnology;
use Illuminate\Database\Seeder;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            $technologies = [];

            switch ($project->slug) {
                case 'getime':
                    $technologies = [
                        ['name' => 'Laravel', 'color' => '#FF2D20', 'icon' => 'Laravel'],
                        ['name' => 'React', 'color' => '#61DAFB', 'icon' => 'React'],
                        ['name' => 'TypeScript', 'color' => '#3178C6', 'icon' => 'TypeScript'],
                        ['name' => 'Tailwind CSS', 'color' => '#06B6D4', 'icon' => 'TailwindCSS'],
                        ['name' => 'MySQL', 'color' => '#4479A1', 'icon' => 'MySQL'],
                        ['name' => 'Redis', 'color' => '#DC382D', 'icon' => 'Redis'],
                    ];
                    break;

                case 'formcam':
                    $technologies = [
                        ['name' => 'Laravel', 'color' => '#FF2D20', 'icon' => 'Laravel'],
                        ['name' => 'Vue.js', 'color' => '#4FC08D', 'icon' => 'VueJS'],
                        ['name' => 'TypeScript', 'color' => '#3178C6', 'icon' => 'TypeScript'],
                        ['name' => 'Tailwind CSS', 'color' => '#06B6D4', 'icon' => 'TailwindCSS'],
                        ['name' => 'MySQL', 'color' => '#4479A1', 'icon' => 'MySQL'],
                    ];
                    break;

                case 'whatsmark':
                    $technologies = [
                        ['name' => 'Laravel', 'color' => '#FF2D20', 'icon' => 'Laravel'],
                        ['name' => 'PHP', 'color' => '#777BB4', 'icon' => 'PHP'],
                        ['name' => 'Node.js', 'color' => '#339933', 'icon' => 'NodeJS'],
                        ['name' => 'MySQL', 'color' => '#4479A1', 'icon' => 'MySQL'],
                        ['name' => 'Redis', 'color' => '#DC382D', 'icon' => 'Redis'],
                    ];
                    break;

                case 'estuaire-emplois':
                    $technologies = [
                        ['name' => 'Laravel', 'color' => '#FF2D20', 'icon' => 'Laravel'],
                        ['name' => 'Vue.js', 'color' => '#4FC08D', 'icon' => 'VueJS'],
                        ['name' => 'MySQL', 'color' => '#4479A1', 'icon' => 'MySQL'],
                        ['name' => 'Tailwind CSS', 'color' => '#06B6D4', 'icon' => 'TailwindCSS'],
                    ];
                    break;

                default:
                    $technologies = [
                        ['name' => 'Laravel', 'color' => '#FF2D20', 'icon' => 'Laravel'],
                        ['name' => 'React', 'color' => '#61DAFB', 'icon' => 'React'],
                        ['name' => 'MySQL', 'color' => '#4479A1', 'icon' => 'MySQL'],
                    ];
            }

            foreach ($technologies as $tech) {
                ProjectTechnology::create([
                    'project_id' => $project->id,
                    'name' => $tech['name'],
                    'color' => $tech['color'],
                    'icon' => $tech['icon'],
                ]);
            }
        }
    }
}