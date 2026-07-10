<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socials = [
            [
                'platform' => 'GitHub',
                'url' => 'https://github.com/sylviniho676-u',
                'icon' => 'Github',
                'label' => 'GitHub',
                'is_visible' => true,
                'sort_order' => 1,
            ],
            [
                'platform' => 'LinkedIn',
                'url' => 'https://linkedin.com/in/sylvinhio',
                'icon' => 'Linkedin',
                'label' => 'LinkedIn',
                'is_visible' => true,
                'sort_order' => 2,
            ],
            [
                'platform' => 'WhatsApp',
                'url' => 'https://wa.me/237676735138',
                'icon' => 'MessageCircle',
                'label' => 'WhatsApp',
                'is_visible' => true,
                'sort_order' => 3,
            ],
            [
                'platform' => 'Email',
                'url' => 'mailto:sylviniho676@gmail.com',
                'icon' => 'Mail',
                'label' => 'Email',
                'is_visible' => true,
                'sort_order' => 4,
            ],
            [
                'platform' => 'Twitter',
                'url' => 'https://twitter.com/sylvinhio',
                'icon' => 'Twitter',
                'label' => 'Twitter',
                'is_visible' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($socials as $social) {
            Social::create($social);
        }
    }
}