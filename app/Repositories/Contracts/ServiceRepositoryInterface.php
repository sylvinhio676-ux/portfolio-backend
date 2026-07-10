<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ServiceRepositoryInterface
 * 
 * Repository pour la gestion des services
 */
interface ServiceRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les services visibles
     *
     * @return Collection
     */
    public function getVisible(): Collection;

    /**
     * Récupérer les services triés par ordre
     *
     * @return Collection
     */
    public function getOrdered(): Collection;
}