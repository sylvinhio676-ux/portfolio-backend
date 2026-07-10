<?php

namespace App\Services;

use App\Models\Skill;
use App\Repositories\Contracts\SkillRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SkillService
{
    public function __construct(
        private readonly SkillRepositoryInterface $skillRepository
    ) {}

    /**
     * Retourne toutes les compétences visibles (site public).
     *
     * @return Collection<int, Skill>
     */
    public function getVisible(): Collection
    {
        return $this->skillRepository->getVisible();
    }

    /**
     * Retourne toutes les compétences (dashboard admin).
     *
     * @return Collection<int, Skill>
     */
    public function getAll(): Collection
    {
        return $this->skillRepository->all();
    }

    /**
     * Crée une nouvelle compétence.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Skill
    {
        return $this->skillRepository->create($data);
    }

    /**
     * Met à jour une compétence existante.
     *
     * @param array<string, mixed> $data
     */
    public function update(Skill $skill, array $data): Skill
    {
        return $this->skillRepository->update($skill, $data);
    }

    /**
     * Supprime une compétence.
     */
    public function delete(Skill $skill): void
    {
        $this->skillRepository->delete($skill);
    }
}