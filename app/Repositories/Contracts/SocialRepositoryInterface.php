<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SocialRepositoryInterface
 * 
 * Repository pour la gestion des réseaux sociaux
 */
interface SocialRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les réseaux sociaux visibles
     *
     * @return Collection
     */
    public function getVisible(): Collection;

    /**
     * Récupérer les réseaux sociaux triés par ordre
     *
     * @return Collection
     */
    public function getOrdered(): Collection;
}