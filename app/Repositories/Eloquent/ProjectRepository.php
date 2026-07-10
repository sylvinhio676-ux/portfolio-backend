<?php

namespace App\Repositories\Eloquent;

use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectRepository
 * 
 * Repository pour la gestion des projets
 */
class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    /**
     * ProjectRepository constructor.
     *
     * @param Project $model
     */
    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritdoc}
     */
    public function getPublished(): Collection
    {
        return $this->query()
            ->where('status', 'published')
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getPublishedWith(array $relations): Collection
    {
        return $this->query()
            ->with($relations)
            ->where('status', 'published')
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
    public function findPublishedBySlug(string $slug): ?Model
    {
        return $this->query()
            ->with(['images', 'technologies'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function getFeatured(): Collection
    {
        return $this->query()
            ->where('status', 'published')
            ->where('is_featured', true)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getByStatus(string $status): Collection
    {
        return $this->query()
            ->where('status', $status)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function updateStatus(Model $project, string $status): Model
    {
        $project->update(['status' => $status]);
        return $project->fresh();
    }
}