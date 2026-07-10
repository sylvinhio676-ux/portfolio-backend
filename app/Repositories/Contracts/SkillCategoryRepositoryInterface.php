<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SkillCategoryRepositoryInterface
 * 
 * Repository pour la gestion des catégories de compétences
 */
interface SkillCategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer toutes les catégories avec leurs compétences
     *
     * @return Collection
     */
    public function getAllWithSkills(): Collection;

    /**
     * Récupérer les catégories avec leurs compétences visibles
     *
     * @return Collection
     */
    public function getWithVisibleSkills(): Collection;
}