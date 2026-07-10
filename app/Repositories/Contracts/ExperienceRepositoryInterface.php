<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ExperienceRepositoryInterface
 * 
 * Repository pour la gestion des expériences
 */
interface ExperienceRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les expériences triées par date (plus récentes d'abord)
     *
     * @return Collection
     */
    public function getOrderedByDate(): Collection;

    /**
     * Récupérer les expériences par type
     *
     * @param string $type
     * @return Collection
     */
    public function getByType(string $type): Collection;
}