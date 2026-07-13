<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface SettingRepositoryInterface
 *
 * Repository pour la gestion des paramètres globaux (ligne unique).
 */
interface SettingRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les paramètres globaux
     *
     * @return Model|null
     */
    public function getSetting(): ?Model;

    /**
     * Mettre à jour les paramètres globaux
     *
     * @param array $data
     * @return Model
     */
    public function updateSetting(array $data): Model;
}
