<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'name' => 'Negoue Tamo Sylvinhio',
            'title' => 'Full Stack Software Engineer & Mobile Developer',
            'location' => 'Yaoundé, Cameroun',
            'email' => 'sylvinhio676@gmail.com',
            'availability' => 'Disponible pour travailler',
            'tagline' => 'Je conçois des applications web et mobiles modernes, performantes et évolutives qui résolvent de véritables problèmes métier.',
            'bio' => "Ingénieur Full Stack passionné avec une expertise en développement d'applications web et mobiles. J'accompagne les entreprises dans leur transformation digitale en concevant des solutions sur mesure, robustes et adaptées aux besoins du marché africain.

Avec plusieurs années d'expérience, j'ai développé une approche centrée sur l'utilisateur et la performance. Ma vision est de créer des produits technologiques qui ont un impact réel sur la vie des utilisateurs et des organisations.

Je maîtrise l'ensemble du cycle de développement : de la conception architecturale au déploiement en passant par le développement frontend, backend et mobile. Mon engagement : livrer des solutions de qualité, maintenables et évolutives.",
            'philosophy' => "Chaque projet est pour moi une opportunité de créer de la valeur. J'analyse, je conçois, je développe et j'optimise des solutions robustes, scalables et centrées utilisateur.",
            'photo_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=600&fit=crop&q=80',
            'cv_url' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
            'stat_projects' => 8,
            'stat_years' => 5,
            'stat_techs' => 15,
            'stat_clients' => 10,
            'hero_cta1_label' => 'Voir mes projets',
            'hero_cta1_url' => '/projects',
            'hero_cta2_label' => 'Me contacter',
            'hero_cta2_url' => '/contact',
        ]);
    }
}