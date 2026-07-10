<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface ProjectTechnologyRepositoryInterface
 * 
 * Repository pour la gestion des technologies de projets
 */
interface ProjectTechnologyRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les technologies d'un projet
     *
     * @param int $projectId
     * @return Collection
     */
    public function getByProject(int $projectId): Collection;

    /**
     * Supprimer toutes les technologies d'un projet
     *
     * @param int $projectId
     * @return bool
     */
    public function deleteByProjectId(int $projectId): bool;

    /**
     * Créer plusieurs technologies pour un projet
     *
     * @param int $projectId
     * @param array $technologies
     * @return Collection
     */
    public function createMany(int $projectId, array $technologies): Collection;
}