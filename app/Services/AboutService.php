<?php

namespace App\Services;

use App\Models\About;
use App\Repositories\Contracts\AboutRepositoryInterface;

class AboutService
{
    public function __construct(
        private readonly AboutRepositoryInterface $aboutRepository
    ) {}

    /**
     * Retourne l'enregistrement unique about.
     * Crée un enregistrement vide si inexistant.
     */
    public function get(): About
    {
        return $this->aboutRepository->getAbout();
    }

    /**
     * Met à jour ou crée l'enregistrement about.
     *
     * @param array<string, mixed> $data
     */
    public function update(array $data): About
    {
        return $this->aboutRepository->updateAbout($data);
    }
}