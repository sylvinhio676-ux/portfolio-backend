<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface WorkflowStepRepositoryInterface
 *
 * Repository pour la gestion des étapes de la méthode de travail.
 */
interface WorkflowStepRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les étapes visibles, triées.
     *
     * @return Collection
     */
    public function getVisible(): Collection;

    /**
     * Récupérer toutes les étapes, triées.
     *
     * @return Collection
     */
    public function getOrdered(): Collection;
}
