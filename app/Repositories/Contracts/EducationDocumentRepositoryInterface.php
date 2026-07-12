<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface EducationDocumentRepositoryInterface
 *
 * Repository pour la gestion des documents de formations
 */
interface EducationDocumentRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les documents d'une formation
     *
     * @param int $educationId
     * @return Collection
     */
    public function getByEducation(int $educationId): Collection;

    /**
     * Supprimer tous les documents d'une formation
     *
     * @param int $educationId
     * @return bool
     */
    public function deleteByEducationId(int $educationId): bool;
}
