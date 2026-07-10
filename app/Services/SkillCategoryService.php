<?php

namespace App\Services;

use App\Models\SkillCategory;
use App\Repositories\Contracts\SkillCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SkillCategoryService
{
    public function __construct(
        private readonly SkillCategoryRepositoryInterface $categoryRepository
    ) {}

    /**
     * Retourne toutes les catégories avec leurs compétences.
     *
     * @return Collection<int, SkillCategory>
     */
    public function getAllWithSkills(): Collection
    {
        return $this->categoryRepository->getAllWithSkills();
    }

    /**
     * Retourne toutes les catégories sans les compétences (pour le dashboard).
     *
     * @return Collection<int, SkillCategory>
     */
    public function getAll(): Collection
    {
        return $this->categoryRepository->all();
    }

    /**
     * Crée une nouvelle catégorie.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): SkillCategory
    {
        return $this->categoryRepository->create($data);
    }

    /**
     * Met à jour une catégorie existante.
     *
     * @param array<string, mixed> $data
     */
    public function update(SkillCategory $category, array $data): SkillCategory
    {
        return $this->categoryRepository->update($category, $data);
    }

    /**
     * Supprime une catégorie et ses compétences associées.
     */
    public function delete(SkillCategory $category): void
    {
        $this->categoryRepository->delete($category);
    }
}