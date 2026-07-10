<?php

namespace Database\Seeders;

use App\Models\SeoSetting;
use Illuminate\Database\Seeder;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Page d'accueil
        SeoSetting::create([
            'page' => 'home',
            'title' => 'Negoue Tamo Sylvinhio — Full Stack Software Engineer & Mobile Developer',
            'description' => 'Portfolio de Negoue Tamo Sylvinhio, Full Stack Software Engineer spécialisé en applications web et mobiles modernes, performantes et évolutives.',
            'keywords' => 'Full Stack Developer, Mobile Developer, Laravel, Next.js, React, Vue.js, Symfony, PHP, JavaScript, Cameroon, Douala',
            'og_title' => 'Negoue Tamo Sylvinhio — Full Stack Software Engineer',
            'og_description' => 'Découvrez mes projets et compétences en développement web et mobile.',
            'og_image' => 'https://res.cloudinary.com/demo/image/upload/v1/portfolio/seo/og-image.jpg',
            'robots' => 'index,follow',
        ]);

        // Page projets
        SeoSetting::create([
            'page' => 'projects',
            'title' => 'Projets — Negoue Tamo Sylvinhio',
            'description' => 'Découvrez mes projets réalisés : GeTime, FormCam, WhatsApp, Estuaire Emplois et plus encore.',
            'keywords' => 'projets, portfolio, GeTime, FormCam, WhatsApp API, Estuaire Emplois',
            'og_title' => 'Mes Projets — Negoue Tamo Sylvinhio',
            'og_description' => 'Explorez les projets que j\'ai conçus et développés.',
            'og_image' => 'https://res.cloudinary.com/demo/image/upload/v1/portfolio/seo/projects-og.jpg',
            'robots' => 'index,follow',
        ]);

        // Page compétences
        SeoSetting::create([
            'page' => 'skills',
            'title' => 'Compétences — Negoue Tamo Sylvinhio',
            'description' => 'Mes compétences techniques en développement Full Stack : Laravel, Next.js, React, Vue.js, PHP, JavaScript, TypeScript, MySQL, etc.',
            'keywords' => 'compétences, technologies, Full Stack, Laravel, Next.js, React, Vue.js, PHP, JavaScript',
            'og_title' => 'Mes Compétences — Negoue Tamo Sylvinhio',
            'og_description' => 'Les technologies et compétences que je maîtrise.',
            'og_image' => 'https://res.cloudinary.com/demo/image/upload/v1/portfolio/seo/skills-og.jpg',
            'robots' => 'index,follow',
        ]);

        // Page contact
        SeoSetting::create([
            'page' => 'contact',
            'title' => 'Contact — Negoue Tamo Sylvinhio',
            'description' => 'Contactez-moi pour vos projets de développement web et mobile. Je suis disponible pour des collaborations et missions.',
            'og_image' => 'https://res.cloudinary.com/demo/image/upload/v1/portfolio/seo/contact-og.jpg',
            'keywords' => 'contact, collaborer, projet, développement, freelance, Cameroun',
            'og_title' => 'Contact — Negoue Tamo Sylvinhio',
            'og_description' => 'Parlons de votre projet !',
            'robots' => 'index,follow',
        ]);
    }
}