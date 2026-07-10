<?php

namespace App\Repositories\Eloquent;

use App\Models\WorkflowStep;
use App\Repositories\Contracts\WorkflowStepRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class WorkflowStepRepository
 *
 * Repository pour la gestion des étapes de la méthode de travail.
 */
class WorkflowStepRepository extends BaseRepository implements WorkflowStepRepositoryInterface
{
    public function __construct(WorkflowStep $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritdoc}
     */
    public function getVisible(): Collection
    {
        return $this->query()
            ->where('is_visible', true)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getOrdered(): Collection
    {
        return $this->query()
            ->orderBy('sort_order', 'asc')
            ->get();
    }
}
