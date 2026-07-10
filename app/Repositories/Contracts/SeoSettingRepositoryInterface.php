<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface SeoSettingRepositoryInterface
 * 
 * Repository pour la gestion des paramètres SEO
 */
interface SeoSettingRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les paramètres SEO par page
     *
     * @param string $page
     * @return Model|null
     */
    public function getByPage(string $page): ?Model;

    /**
     * Mettre à jour les paramètres SEO d'une page
     *
     * @param string $page
     * @param array $data
     * @return Model
     */
    public function updateForPage(string $page, array $data): Model;
}