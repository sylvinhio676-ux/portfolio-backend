<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'slug' => 'getime',
                'title' => 'GeTime',
                'tagline' => 'Plateforme intelligente de gestion des emplois du temps académiques',
                'description' => "GeTime est une plateforme SaaS de gestion d'emplois du temps pour établissements scolaires et universitaires. Elle automatise la planification académique, détecte les conflits en temps réel et intègre un assistant IA pour analyser les documents académiques.",
                'problem' => "Les établissements scolaires africains souffrent de conflits d'emplois du temps entre enseignants, salles et ressources. La gestion manuelle engendre des erreurs, des retards et perturbe les programmes pédagogiques.",
                'solution' => "GeTime automatise la planification académique, détecte les conflits en temps réel et intègre un assistant IA pour analyser les documents académiques et accélérer la création des plannings.",
                'challenge' => "L'intégration de l'IA pour analyser des documents non structurés (PDF, Word) et en extraire des données structurées (horaires, matières, enseignants) avec un bon niveau de fiabilité.",
                'result' => "Réduction significative des conflits d'organisation et amélioration de la productivité des équipes administratives.",
                'architecture' => "Architecture multi-tenant avec Laravel 13, React 19, TypeScript, Tailwind CSS, MySQL, Redis.",
                'github_url' => 'https://github.com/sylviniho676-u/getime',
                'demo_url' => 'https://getime.demo.com',
                'video_url' => 'https://youtube.com/watch?v=getime',
                'cover_image' => 'https://images.unsplash.com/photo-1506784365847-bbad939e9335?w=800&h=500&fit=crop&q=80',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 1,
            ],
            [
                'slug' => 'formcam',
                'title' => 'FormCam',
                'tagline' => 'Plateforme SaaS d\'e-learning avec monétisation native',
                'description' => "FormCam est une plateforme e-learning qui permet aux créateurs de contenu de diffuser leurs cours vidéo, créer des quiz, gérer des abonnements et suivre leurs revenus.",
                'problem' => "Les créateurs de contenu éducatif manquent d'une plateforme all-in-one qui combine cours, quiz, paiement et investissement sans commission excessive.",
                'solution' => "FormCam offre un écosystème complet : création de cours vidéo (streaming HLS + mode hors-ligne), quiz, abonnements, parrainage, investissement avec suivi financier.",
                'challenge' => "L'implémentation du streaming HLS et la gestion du contenu hors-ligne tout en maintenant la protection contre le téléchargement non autorisé.",
                'result' => "Une plateforme capable de soutenir créateurs et investisseurs avec une monétisation flexible et transparente.",
                'architecture' => "Laravel 12, Vue 3, TypeScript, Tailwind CSS, MySQL, HLS Streaming.",
                'github_url' => 'https://github.com/sylviniho676-u/formcam',
                'demo_url' => 'https://formcam.demo.com',
                'video_url' => 'https://youtube.com/watch?v=formcam',
                'cover_image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&h=500&fit=crop&q=80',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 2,
            ],
            [
                'slug' => 'whatsmark',
                'title' => 'WhatsMark',
                'tagline' => 'Plateforme de marketing conversationnel WhatsApp API',
                'description' => "WhatsMark intègre l'API WhatsApp Cloud officielle dans une interface intuitive permettant la gestion des contacts, la création de templates, l'automatisation et le suivi analytique.",
                'problem' => "Les entreprises n'ont pas d'outil simple pour automatiser leurs campagnes WhatsApp, gérer leurs contacts et analyser leurs performances sans développement custom coûteux.",
                'solution' => "WhatsMark intégre l'API WhatsApp Cloud officielle dans une interface intuitive permettant la gestion des contacts, la création de templates, l'automatisation et le suivi analytique.",
                'challenge' => "La gestion des webhooks WhatsApp en temps réel et la conformité avec les politiques Meta pour l'envoi massif de messages.",
                'result' => "Permet aux entreprises de gérer leur communication WhatsApp depuis un seul tableau de bord professionnel.",
                'architecture' => "Laravel, PHP 8.2, MySQL, Redis, Node.js",
                'github_url' => 'https://github.com/sylviniho676-u/whatsmark',
                'demo_url' => 'https://whatsmark.demo.com',
                'video_url' => 'https://youtube.com/watch?v=whatsmark',
                'cover_image' => 'https://images.unsplash.com/photo-1611606063065-ee7946f0787a?w=800&h=500&fit=crop&q=80',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 3,
            ],
            [
                'slug' => 'estuaire-emplois',
                'title' => 'Estuaire Emplois',
                'tagline' => 'Plateforme de mise en relation emploi et recrutement',
                'description' => "Estuaire Emplois est une plateforme de matching entre candidats et offres d'emploi avec profils, candidatures, alertes et tableau de bord recruteur.",
                'problem' => "Les chercheurs d'emploi et les recruteurs manquent d'une plateforme locale adaptée au marché africain avec des fonctionnalités modernes.",
                'solution' => "Plateforme de matching entre candidats et offres d'emploi avec profils, candidatures, alertes et tableau de bord recruteur.",
                'challenge' => "L'adaptation de l'UX au contexte local tout en proposant une expérience moderne et responsive.",
                'result' => "Mise en relation efficace entre entreprises et candidats avec un parcours utilisateur simplifié.",
                'architecture' => "Laravel, Vue.js, MySQL, Tailwind CSS",
                'github_url' => 'https://github.com/sylviniho676-u/estuaire-emplois',
                'demo_url' => 'https://estuaire-emplois.demo.com',
                'video_url' => null,
                'cover_image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800&h=500&fit=crop&q=80',
                'is_featured' => true,
                'status' => 'published',
                'sort_order' => 4,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}