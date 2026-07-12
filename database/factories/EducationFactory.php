<?php

namespace Database\Factories;

use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Education>
 */
class EducationFactory extends Factory
{
    protected $model = Education::class;

    /**
     * Définit l'état par défaut d'une formation.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-8 years', '-2 years');
        $endDate = $this->faker->dateTimeBetween($startDate, '-1 year');

        return [
            'school_name'    => $this->faker->company(),
            'school_logo'    => null,
            'diploma'        => $this->faker->randomElement([
                'Licence en Informatique',
                'Master en Génie Logiciel',
                'BTS Systèmes Numériques',
                'Doctorat en Informatique',
            ]),
            'field_of_study' => $this->faker->randomElement([
                'Génie Logiciel',
                'Réseaux et Télécommunications',
                'Systèmes d\'Information',
                'Intelligence Artificielle',
            ]),
            'academic_level' => $this->faker->randomElement(['Licence', 'Master', 'Doctorat', 'BTS', 'DUT']),
            'description'    => $this->faker->paragraph(),
            'location'       => $this->faker->city(),
            'website'        => $this->faker->url(),
            'start_date'     => $startDate,
            'end_date'       => $endDate,
            'is_current'     => false,
            'grade'          => $this->faker->randomElement(['A', 'B', '15/20', '16/20']),
            'mention'        => $this->faker->randomElement(['Passable', 'Assez bien', 'Bien', 'Très bien']),
            'achievements'   => $this->faker->sentence(),
            'is_visible'     => true,
            'featured'       => $this->faker->boolean(30),
            'sort_order'     => 0,
        ];
    }
}
