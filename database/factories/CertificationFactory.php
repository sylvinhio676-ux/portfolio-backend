<?php

namespace Database\Factories;

use App\Models\Certification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Certification>
 */
class CertificationFactory extends Factory
{
    protected $model = Certification::class;

    public function definition(): array
    {
        $issueDate = $this->faker->dateTimeBetween('-3 years', 'now');
        $neverExpire = $this->faker->boolean(30);

        return [
            'title'            => $this->faker->sentence(3),
            'provider'         => $this->faker->randomElement(['Coursera', 'Udemy', 'AWS', 'Google', 'Microsoft', 'Meta']),
            'provider_logo'    => null,
            'category'         => $this->faker->randomElement(['cloud', 'frontend', 'backend', 'devops', 'security']),
            'credential_id'    => strtoupper($this->faker->bothify('CERT-####-????')),
            'issue_date'       => $issueDate,
            'expiration_date'  => $neverExpire ? null : $this->faker->dateTimeBetween($issueDate, '+3 years'),
            'never_expire'     => $neverExpire,
            'verification_url' => $this->faker->url(),
            'certificate_url'  => $this->faker->url(),
            'badge'            => null,
            'description'      => $this->faker->paragraph(),
            'duration_hours'   => $this->faker->numberBetween(5, 120),
            'score'            => $this->faker->numberBetween(70, 100) . '%',
            'language'         => $this->faker->randomElement(['Français', 'English']),
            'level'            => $this->faker->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'featured'         => $this->faker->boolean(40),
            'is_visible'       => true,
            'sort_order'       => $this->faker->numberBetween(0, 20),
        ];
    }
}
