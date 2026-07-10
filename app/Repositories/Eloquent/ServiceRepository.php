<?php

namespace App\Repositories\Eloquent;

use App\Models\Service;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ServiceRepository
 * 
 * Repository pour la gestion des services
 */
class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    /**
     * ServiceRepository constructor.
     *
     * @param Service $model
     */
    public function __construct(Service $model)
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