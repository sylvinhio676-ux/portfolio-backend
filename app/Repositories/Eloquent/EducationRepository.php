<?php

namespace App\Repositories\Eloquent;

use App\Models\Education;
use App\Repositories\Contracts\EducationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EducationRepository
 *
 * Repository pour la gestion des formations
 */
class EducationRepository extends BaseRepository implements EducationRepositoryInterface
{
    /**
     * EducationRepository constructor.
     *
     * @param Education $model
     */
    public function __construct(Education $model)
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
    public function getVisibleWith(array $relations): Collection
    {
        return $this->query()
            ->with($relations)
            ->where('is_visible', true)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getAllWithRelations(array $relations): Collection
    {
        return $this->query()
            ->with($relations)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function findVisibleById(int $id): ?Model
    {
        return $this->query()
            ->with(['images', 'documents', 'skills'])
            ->where('id', $id)
            ->where('is_visible', true)
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function getFeatured(): Collection
    {
        return $this->query()
            ->where('is_visible', true)
            ->where('featured', true)
            ->orderBy('sort_order', 'asc')
            ->get();
    }
}
