<?php

namespace App\Repositories\Eloquent;

use App\Models\Social;
use App\Repositories\Contracts\SocialRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SocialRepository
 * 
 * Repository pour la gestion des réseaux sociaux
 */
class SocialRepository extends BaseRepository implements SocialRepositoryInterface
{
    /**
     * SocialRepository constructor.
     *
     * @param Social $model
     */
    public function __construct(Social $model)
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