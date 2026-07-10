<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Seeder;

class ProjectImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Images de galerie de test (Unsplash, fiables). En production, elles
     * seront remplacées par des uploads Cloudinary via le dashboard.
     */
    public function run(): void
    {
        // Pool d'images « app / dashboard / code » réutilisées en rotation.
        $pool = [
            'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=500&fit=crop&q=80',
            'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=500&fit=crop&q=80',
            'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=800&h=500&fit=crop&q=80',
            'https://images.unsplash.com/photo-1487058792275-0ad4aaf24ca7?w=800&h=500&fit=crop&q=80',
            'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800&h=500&fit=crop&q=80',
            'https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?w=800&h=500&fit=crop&q=80',
        ];

        $poolCount = count($pool);
        $projects = Project::all()->values();

        foreach ($projects as $projectIndex => $project) {
            for ($i = 0; $i < 3; $i++) {
                $poolIndex = ($projectIndex * 3 + $i) % $poolCount;
                ProjectImage::create([
                    'project_id' => $project->id,
                    'url'        => $pool[$poolIndex],
                    'public_id'  => "portfolio/projects/{$project->slug}/image_{$i}",
                    'alt'        => "{$project->title} — aperçu " . ($i + 1),
                    'sort_order' => $i,
                ]);
            }
        }
    }
}
