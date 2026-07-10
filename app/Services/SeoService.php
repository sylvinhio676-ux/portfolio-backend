<?php

namespace App\Services;

use App\Models\SeoSetting;
use App\Repositories\Contracts\SeoSettingRepositoryInterface;

class SeoService
{
    public function __construct(
        private readonly SeoSettingRepositoryInterface $seoRepository
    ) {}

    /**
     * Retourne les paramètres SEO d'une page spécifique.
     */
    public function getByPage(string $page): SeoSetting
    {
        // Lecture pure : ne JAMAIS écraser les valeurs existantes.
        $seo = $this->seoRepository->getByPage($page);

        if ($seo instanceof SeoSetting) {
            return $seo;
        }

        // Page absente : on crée des valeurs par défaut une seule fois.
        return $this->seoRepository->updateForPage($page, [
            'title'       => 'Negoue Tamo Sylvinhio — Full Stack Engineer',
            'description' => 'Portfolio de Negoue Tamo Sylvinhio, Full Stack Software Engineer & Mobile Developer.',
            'robots'      => 'index,follow',
        ]);
    }

    /**
     * Met à jour les paramètres SEO d'une page.
     *
     * @param array<string, mixed> $data
     */
    public function update(string $page, array $data): SeoSetting
    {
        return $this->seoRepository->updateForPage($page, $data);
    }
}