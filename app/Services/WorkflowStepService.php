<?php

namespace App\Services;

use App\Models\WorkflowStep;
use App\Repositories\Contracts\WorkflowStepRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class WorkflowStepService
{
    public function __construct(
        private readonly WorkflowStepRepositoryInterface $workflowStepRepository
    ) {}

    /**
     * Retourne les étapes visibles (site public).
     *
     * @return Collection<int, WorkflowStep>
     */
    public function getVisible(): Collection
    {
        return $this->workflowStepRepository->getVisible();
    }

    /**
     * Retourne toutes les étapes (dashboard admin).
     *
     * @return Collection<int, WorkflowStep>
     */
    public function getAll(): Collection
    {
        return $this->workflowStepRepository->getOrdered();
    }

    /**
     * Crée une nouvelle étape.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): WorkflowStep
    {
        return $this->workflowStepRepository->create($data);
    }

    /**
     * Met à jour une étape existante.
     *
     * @param array<string, mixed> $data
     */
    public function update(WorkflowStep $workflowStep, array $data): WorkflowStep
    {
        return $this->workflowStepRepository->update($workflowStep, $data);
    }

    /**
     * Supprime une étape.
     */
    public function delete(WorkflowStep $workflowStep): void
    {
        $this->workflowStepRepository->delete($workflowStep);
    }
}
