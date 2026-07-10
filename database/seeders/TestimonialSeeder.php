<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Jean-Marc Nkolo',
                'role' => 'CEO, GeTime',
                'content' => "Sylvinhio a su comprendre nos besoins et proposer une solution technique à la hauteur de nos ambitions. Son expertise en Laravel et React a été déterminante pour le succès de notre plateforme GeTime. Un vrai professionnel !",
                'rating' => 5, // Changé de 'stars' à 'rating'
                'avatar_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop&q=80',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Marie-Claire Abessolo',
                'role' => 'Fondatrice, FormCam',
                'content' => "Travailler avec Sylvinhio a été une expérience exceptionnelle. Il a su transformer notre vision en une plateforme e-learning complète avec des fonctionnalités innovantes. Je recommande vivement ses services.",
                'rating' => 5, // Changé de 'stars' à 'rating'
                'avatar_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&h=150&fit=crop&q=80',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'David Essomba',
                'role' => 'Directeur Technique, Estuaire Emplois',
                'content' => "Sylvinhio maîtrise parfaitement l'écosystème JavaScript et PHP. Son sens de l'architecture et sa rigueur nous ont permis de livrer Estuaire Emplois dans les délais avec une qualité exceptionnelle.",
                'rating' => 5, // Changé de 'stars' à 'rating'
                'avatar_url' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=150&h=150&fit=crop&q=80',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Sophie Nganou',
                'role' => 'Project Manager, AMA Consulting',
                'content' => "Une collaboration très enrichissante ! Sylvinhio fait preuve d'une grande autonomie et d'une capacité d'adaptation remarquable. Il a développé des solutions complexes avec une grande efficacité.",
                'rating' => 4, // Changé de 'stars' à 'rating'
                'avatar_url' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&q=80',
                'is_visible' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}