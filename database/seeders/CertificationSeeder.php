<?php

namespace Database\Seeders;

use App\Models\Certification;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class CertificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certifications = [
            [
                'title' => 'AWS Certified Solutions Architect – Associate',
                'provider' => 'Amazon Web Services',
                'provider_logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/amazonwebservices/amazonwebservices-original-wordmark.svg',
                'category' => 'cloud',
                'credential_id' => 'AWS-SAA-2024-0012',
                'issue_date' => '2024-03-15',
                'expiration_date' => '2027-03-15',
                'never_expire' => false,
                'verification_url' => 'https://www.credly.com/badges/aws-saa-demo',
                'certificate_url' => 'https://certificates.aws/saa-demo.pdf',
                'badge' => 'https://images.credly.com/size/340x340/images/aws-saa.png',
                'description' => "Certification validant la conception d'architectures distribuées, sécurisées et résilientes sur AWS.",
                'duration_hours' => 40,
                'score' => '870/1000',
                'language' => 'English',
                'level' => 'Associate',
                'featured' => true,
                'is_visible' => true,
                'sort_order' => 1,
                // Compétences associées (par nom, résolues plus bas)
                'skills' => ['Docker', 'AWS', 'Kubernetes'],
            ],
            [
                'title' => 'Meta Front-End Developer Professional Certificate',
                'provider' => 'Meta (Coursera)',
                'provider_logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg',
                'category' => 'frontend',
                'credential_id' => 'META-FE-2023-0451',
                'issue_date' => '2023-11-02',
                'expiration_date' => null,
                'never_expire' => true,
                'verification_url' => 'https://coursera.org/verify/professional-cert/meta-fe-demo',
                'certificate_url' => 'https://certificates.coursera.org/meta-fe-demo.pdf',
                'badge' => 'https://images.credly.com/size/340x340/images/meta-front-end.png',
                'description' => "Programme professionnel couvrant React, l'UI responsive et les bonnes pratiques front-end modernes.",
                'duration_hours' => 96,
                'score' => '98%',
                'language' => 'English',
                'level' => 'Professional',
                'featured' => true,
                'is_visible' => true,
                'sort_order' => 2,
                'skills' => ['React.js', 'TypeScript', 'Tailwind CSS'],
            ],
            [
                'title' => 'Laravel Certified Developer',
                'provider' => 'Laravel',
                'provider_logo' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg',
                'category' => 'backend',
                'credential_id' => 'LARAVEL-2024-0099',
                'issue_date' => '2024-06-20',
                'expiration_date' => '2026-06-20',
                'never_expire' => false,
                'verification_url' => 'https://certification.laravel.com/verify/demo',
                'certificate_url' => 'https://certification.laravel.com/demo.pdf',
                'badge' => 'https://images.credly.com/size/340x340/images/laravel-certified.png',
                'description' => "Certification officielle attestant la maîtrise du framework Laravel, d'Eloquent et de l'écosystème PHP moderne.",
                'duration_hours' => 60,
                'score' => '92%',
                'language' => 'English',
                'level' => 'Advanced',
                'featured' => false,
                'is_visible' => true,
                'sort_order' => 3,
                'skills' => ['Laravel', 'PHP', 'MySQL'],
            ],
        ];

        foreach ($certifications as $data) {
            // On isole les compétences pour les synchroniser via le pivot
            $skillNames = $data['skills'] ?? [];
            unset($data['skills']);

            $certification = Certification::create($data);

            // Résolution des compétences par leur nom puis synchronisation Many-To-Many
            $skillIds = Skill::whereIn('name', $skillNames)->pluck('id')->all();
            $certification->skills()->sync($skillIds);
        }
    }
}
