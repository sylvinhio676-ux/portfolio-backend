<?php

namespace App\Repositories\Eloquent;

use App\Models\Testimonial;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TestimonialRepository
 * 
 * Repository pour la gestion des témoignages
 */
class TestimonialRepository extends BaseRepository implements TestimonialRepositoryInterface
{
    /**
     * TestimonialRepository constructor.
     *
     * @param Testimonial $model
     */
    public function __construct(Testimonial $model)
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
    public function getWithMinStars(int $minStars): Collection
    {
        return $this->query()
            ->where('is_visible', true)
            ->where('stars', '>=', $minStars)
            ->orderBy('sort_order', 'asc')
            ->get();
    }
}