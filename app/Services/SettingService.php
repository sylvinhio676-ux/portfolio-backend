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
    public function get(): ?Setting
    {
        /** @var Setting|null $setting */
        $setting = $this->settingRepository->getSetting();

        return $setting;
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
