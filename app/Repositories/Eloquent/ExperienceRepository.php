<?php

namespace App\Repositories\Eloquent;

use App\Models\Experience;
use App\Repositories\Contracts\ExperienceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ExperienceRepository
 * 
 * Repository pour la gestion des expériences
 */
class ExperienceRepository extends BaseRepository implements ExperienceRepositoryInterface
{
    /**
     * ExperienceRepository constructor.
     *
     * @param Experience $model
     */
    public function __construct(Experience $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderedByDate(): Collection
    {
        return $this->query()
            ->orderBy('start_date', 'desc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getByType(string $type): Collection
    {
        return $this->query()
            ->where('type', $type)
            ->orderBy('start_date', 'desc')
            ->get();
    }
}