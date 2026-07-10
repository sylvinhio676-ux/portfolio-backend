<?php

namespace App\Repositories\Eloquent;

use App\Models\Skill;
use App\Repositories\Contracts\SkillRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SkillRepository
 * 
 * Repository pour la gestion des compétences
 */
class SkillRepository extends BaseRepository implements SkillRepositoryInterface
{
    /**
     * SkillRepository constructor.
     *
     * @param Skill $model
     */
    public function __construct(Skill $model)
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
    public function getByCategory(int $categoryId): Collection
    {
        return $this->query()
            ->where('skill_category_id', $categoryId)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getWithCategory(): Collection
    {
        return $this->query()
            ->with('category')
            ->orderBy('sort_order', 'asc')
            ->get();
    }
}