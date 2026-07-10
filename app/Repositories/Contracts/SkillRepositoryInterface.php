<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SkillRepositoryInterface
 * 
 * Repository pour la gestion des compétences
 */
interface SkillRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les compétences visibles
     *
     * @return Collection
     */
    public function getVisible(): Collection;

    /**
     * Récupérer les compétences par catégorie
     *
     * @param int $categoryId
     * @return Collection
     */
    public function getByCategory(int $categoryId): Collection;

    /**
     * Récupérer les compétences avec leur catégorie
     *
     * @return Collection
     */
    public function getWithCategory(): Collection;
}