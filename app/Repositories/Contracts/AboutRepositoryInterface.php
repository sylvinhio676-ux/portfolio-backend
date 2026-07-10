<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface AboutRepositoryInterface
 * 
 * Repository pour la gestion des informations "À propos"
 */
interface AboutRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les informations "À propos"
     *
     * @return Model|null
     */
    public function getAbout(): ?Model;

    /**
     * Mettre à jour les informations "À propos"
     *
     * @param array $data
     * @return Model
     */
    public function updateAbout(array $data): Model;
}