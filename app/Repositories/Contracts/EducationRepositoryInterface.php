<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface EducationRepositoryInterface
 *
 * Repository pour la gestion des formations
 */
interface EducationRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les formations visibles
     *
     * @return Collection
     */
    public function getVisible(): Collection;

    /**
     * Récupérer les formations visibles avec relations
     *
     * @param array $relations
     * @return Collection
     */
    public function getVisibleWith(array $relations): Collection;

    /**
     * Récupérer toutes les formations avec relations
     *
     * @param array $relations
     * @return Collection
     */
    public function getAllWithRelations(array $relations): Collection;

    /**
     * Trouver une formation visible par son id (avec relations)
     *
     * @param int $id
     * @return Model|null
     */
    public function findVisibleById(int $id): ?Model;

    /**
     * Récupérer les formations mises en avant
     *
     * @return Collection
     */
    public function getFeatured(): Collection;
}
