<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface ProjectImageRepositoryInterface
 * 
 * Repository pour la gestion des images de projets
 */
interface ProjectImageRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les images d'un projet
     *
     * @param int $projectId
     * @return Collection
     */
    public function getByProject(int $projectId): Collection;

    /**
     * Récupérer l'image principale d'un projet
     *
     * @param int $projectId
     * @return Model|null
     */
    public function getMainImage(int $projectId): ?Model;

    /**
     * Supprimer toutes les images d'un projet
     *
     * @param int $projectId
     * @return bool
     */
    public function deleteByProjectId(int $projectId): bool;

    /**
     * Définir l'ordre des images
     *
     * @param int $imageId
     * @param int $sortOrder
     * @return Model
     */
    public function setSortOrder(int $imageId, int $sortOrder): Model;
}