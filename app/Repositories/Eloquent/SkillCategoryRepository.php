<?php

namespace App\Repositories\Eloquent;

use App\Models\SkillCategory;
use App\Repositories\Contracts\SkillCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SkillCategoryRepository
 * 
 * Repository pour la gestion des catégories de compétences
 */
class SkillCategoryRepository extends BaseRepository implements SkillCategoryRepositoryInterface
{
    /**
     * SkillCategoryRepository constructor.
     *
     * @param SkillCategory $model
     */
    public function __construct(SkillCategory $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllWithSkills(): Collection
    {
        return $this->query()
            ->with(['skills' => function ($query) {
                $query->orderBy('sort_order', 'asc');
            }])
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getWithVisibleSkills(): Collection
    {
        return $this->query()
            ->with(['skills' => function ($query) {
                $query->where('is_visible', true)
                    ->orderBy('sort_order', 'asc');
            }])
            ->where('is_visible', true)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->filter(function ($category) {
                return $category->skills->isNotEmpty();
            })
            ->values();
    }
}