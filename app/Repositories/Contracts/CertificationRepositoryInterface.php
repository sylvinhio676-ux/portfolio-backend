<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface CertificationRepositoryInterface
 *
 * Repository pour la gestion des certifications
 */
interface CertificationRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les certifications visibles
     *
     * @return Collection
     */
    public function getVisible(): Collection;

    /**
     * Récupérer les certifications visibles avec relations
     *
     * @param array $relations
     * @return Collection
     */
    public function getVisibleWith(array $relations): Collection;

    /**
     * Récupérer toutes les certifications avec relations
     *
     * @param array $relations
     * @return Collection
     */
    public function getAllWithRelations(array $relations): Collection;

    /**
     * Trouver une certification visible par son id (avec relations)
     *
     * @param int $id
     * @return Model|null
     */
    public function findVisibleById(int $id): ?Model;

    /**
     * Récupérer les certifications mises en avant
     *
     * @return Collection
     */
    public function getFeatured(): Collection;
}
