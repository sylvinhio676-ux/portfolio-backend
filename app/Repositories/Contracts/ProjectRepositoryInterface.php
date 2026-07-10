<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface ProjectRepositoryInterface
 * 
 * Repository pour la gestion des projets
 */
interface ProjectRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les projets publiés
     *
     * @return Collection
     */
    public function getPublished(): Collection;

    /**
     * Récupérer les projets publiés avec relations
     *
     * @param array $relations
     * @return Collection
     */
    public function getPublishedWith(array $relations): Collection;

    /**
     * Récupérer tous les projets avec relations
     *
     * @param array $relations
     * @return Collection
     */
    public function getAllWithRelations(array $relations): Collection;

    /**
     * Trouver un projet publié par son slug
     *
     * @param string $slug
     * @return Model|null
     */
    public function findPublishedBySlug(string $slug): ?Model;

    /**
     * Récupérer les projets mis en avant
     *
     * @return Collection
     */
    public function getFeatured(): Collection;

    /**
     * Récupérer les projets par statut
     *
     * @param string $status
     * @return Collection
     */
    public function getByStatus(string $status): Collection;

    /**
     * Mettre à jour le statut d'un projet
     *
     * @param Model $project
     * @param string $status
     * @return Model
     */
    public function updateStatus(Model $project, string $status): Model;
}