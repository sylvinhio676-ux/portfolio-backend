<?php

namespace App\Repositories\Eloquent;

use App\Models\Certification;
use App\Repositories\Contracts\CertificationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CertificationRepository
 *
 * Repository pour la gestion des certifications
 */
class CertificationRepository extends BaseRepository implements CertificationRepositoryInterface
{
    /**
     * CertificationRepository constructor.
     *
     * @param Certification $model
     */
    public function __construct(Certification $model)
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
