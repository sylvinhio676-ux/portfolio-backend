<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            // Général
            'site_name' => 'Negoue Tamo Sylvinhio',
            'logo_url' => null,
            'favicon_url' => null,
            'contact_email' => 'sylvinhio676@gmail.com',
            'contact_phone' => '+237 600 000 000',
            'contact_location' => 'Yaoundé, Cameroun',
            'is_available' => true,
            'availability_message' => 'Disponible pour de nouveaux projets',
            'maintenance_mode' => false,
            // Apparence
            'theme_default' => 'dark',
            'primary_color' => '#00E5C3',
            'font_heading' => 'Space Grotesk',
            'font_body' => 'Inter',
            'border_radius' => '8px',
            // SEO / Analytics
            'analytics_id' => null,
            'search_console_verification' => null,
            'default_og_image' => null,
            'default_robots' => 'index,follow',
            'sitemap_enabled' => true,
        ]);
    }
}
