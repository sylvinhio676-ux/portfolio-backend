<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Quelques formations réalistes avec images, documents et compétences.
        $formations = [
            [
                'data' => [
                    'school_name'    => 'Université de Yaoundé I',
                    'school_logo'    => 'https://images.unsplash.com/photo-1592280771190-3e2e4d571952?w=200&h=200&fit=crop&q=80',
                    'diploma'        => 'Master en Génie Logiciel',
                    'field_of_study' => 'Génie Logiciel',
                    'academic_level' => 'Master',
                    'description'    => "Formation approfondie en architecture logicielle, conception d'applications distribuées et gestion de projet agile.",
                    'location'       => 'Yaoundé, Cameroun',
                    'website'        => 'https://uy1.uninet.cm',
                    'start_date'     => '2021-09-01',
                    'end_date'       => '2023-07-15',
                    'is_current'     => false,
                    'grade'          => '16/20',
                    'mention'        => 'Très bien',
                    'achievements'   => "Major de promotion — mémoire sur les architectures multi-tenant SaaS.",
                    'is_visible'     => true,
                    'featured'       => true,
                    'sort_order'     => 1,
                ],
                'skills'    => ['Laravel', 'PHP', 'MySQL'],
                'images'    => [
                    'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&h=500&fit=crop&q=80',
                ],
                'documents' => [
                    ['type' => 'memoire', 'name' => 'Mémoire de Master — Architectures multi-tenant', 'url' => 'https://example.com/documents/memoire-master.pdf'],
                    ['type' => 'diplome', 'name' => 'Diplôme de Master', 'url' => 'https://example.com/documents/diplome-master.pdf'],
                ],
            ],
            [
                'data' => [
                    'school_name'    => 'Université de Douala',
                    'school_logo'    => 'https://images.unsplash.com/photo-1562774053-701939374585?w=200&h=200&fit=crop&q=80',
                    'diploma'        => 'Licence en Informatique',
                    'field_of_study' => 'Systèmes d\'Information',
                    'academic_level' => 'Licence',
                    'description'    => "Bases solides en algorithmique, développement web et bases de données relationnelles.",
                    'location'       => 'Douala, Cameroun',
                    'website'        => 'https://univ-douala.cm',
                    'start_date'     => '2018-09-01',
                    'end_date'       => '2021-06-30',
                    'is_current'     => false,
                    'grade'          => '14/20',
                    'mention'        => 'Bien',
                    'achievements'   => "Projet de fin de cycle : plateforme de gestion de bibliothèque.",
                    'is_visible'     => true,
                    'featured'       => false,
                    'sort_order'     => 2,
                ],
                'skills'    => ['React.js', 'TypeScript'],
                'images'    => [
                    'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=800&h=500&fit=crop&q=80',
                ],
                'documents' => [
                    ['type' => 'rapport', 'name' => 'Rapport de projet — Gestion de bibliothèque', 'url' => 'https://example.com/documents/rapport-licence.pdf'],
                ],
            ],
            [
                'data' => [
                    'school_name'    => 'OpenClassrooms',
                    'school_logo'    => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=200&h=200&fit=crop&q=80',
                    'diploma'        => 'Certification Développeur d\'application PHP / Symfony',
                    'field_of_study' => 'Développement Web',
                    'academic_level' => 'Certification',
                    'description'    => "Parcours en ligne axé sur le développement backend moderne et les bonnes pratiques.",
                    'location'       => 'En ligne',
                    'website'        => 'https://openclassrooms.com',
                    'start_date'     => '2023-01-10',
                    'end_date'       => null,
                    'is_current'     => true,
                    'grade'          => null,
                    'mention'        => null,
                    'achievements'   => "Plusieurs projets professionnels validés par des mentors.",
                    'is_visible'     => true,
                    'featured'       => false,
                    'sort_order'     => 3,
                ],
                'skills'    => ['Symfony', 'PHP', 'Docker'],
                'images'    => [],
                'documents' => [],
            ],
        ];

        foreach ($formations as $formation) {
            $education = Education::create($formation['data']);

            // Attacher les compétences par leur nom
            $skillIds = Skill::whereIn('name', $formation['skills'])->pluck('id')->all();
            if (!empty($skillIds)) {
                $education->skills()->sync($skillIds);
            }

            // Créer les images
            foreach ($formation['images'] as $index => $imageUrl) {
                $education->images()->create([
                    'url'        => $imageUrl,
                    'public_id'  => null,
                    'alt'        => $formation['data']['school_name'] . ' — image ' . ($index + 1),
                    'sort_order' => $index,
                ]);
            }

            // Créer les documents
            foreach ($formation['documents'] as $index => $document) {
                $education->documents()->create([
                    'type'       => $document['type'],
                    'url'        => $document['url'],
                    'public_id'  => null,
                    'name'       => $document['name'],
                    'sort_order' => $index,
                ]);
            }
        }
    }
}
