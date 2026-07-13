<?php

namespace App\Services;

use App\Models\Setting;
use App\Repositories\Contracts\SettingRepositoryInterface;

class SettingService
{
    public function __construct(
        private readonly SettingRepositoryInterface $settingRepository
    ) {}

    /**
     * Retourne l'enregistrement unique des paramètres.
     */
    public function get(): Setting
    {
        /** @var Setting|null $setting */
        $setting = $this->settingRepository->getSetting();

        // Résilience : si aucune ligne n'existe (base non seedée, ex. en prod),
        // on crée la ligne unique avec des valeurs par défaut cohérentes
        // (mêmes réglages de base que le SettingSeeder).
        return $setting ?? Setting::firstOrCreate([], [
            'theme_default'   => 'dark',
            'primary_color'   => '#00E5C3',
            'font_heading'    => 'Space Grotesk',
            'font_body'       => 'Inter',
            'border_radius'   => '8px',
            'is_available'    => true,
            'default_robots'  => 'index,follow',
            'sitemap_enabled' => true,
        ]);
    }

    /**
     * Met à jour ou crée l'enregistrement des paramètres.
     *
     * @param array<string, mixed> $data
     */
    public function update(array $data): Setting
    {
        /** @var Setting $setting */
        $setting = $this->settingRepository->updateSetting($data);

        return $setting;
    }
}
