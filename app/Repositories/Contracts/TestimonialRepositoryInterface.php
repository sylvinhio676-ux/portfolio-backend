<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface TestimonialRepositoryInterface
 * 
 * Repository pour la gestion des témoignages
 */
interface TestimonialRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les témoignages visibles
     *
     * @return Collection
     */
    public function getVisible(): Collection;

    /**
     * Récupérer les témoignages avec étoiles
     *
     * @param int $minStars
     * @return Collection
     */
    public function getWithMinStars(int $minStars): Collection;
}