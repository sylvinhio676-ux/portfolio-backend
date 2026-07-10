<?php

namespace App\Repositories\Eloquent;

use App\Models\ProjectImage;
use App\Repositories\Contracts\ProjectImageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectImageRepository
 * 
 * Repository pour la gestion des images de projets
 */
class ProjectImageRepository extends BaseRepository implements ProjectImageRepositoryInterface
{
    /**
     * ProjectImageRepository constructor.
     *
     * @param ProjectImage $model
     */
    public function __construct(ProjectImage $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritdoc}
     */
    public function getByProject(int $projectId): Collection
    {
        return $this->query()
            ->where('project_id', $projectId)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getMainImage(int $projectId): ?Model
    {
        return $this->query()
            ->where('project_id', $projectId)
            ->orderBy('sort_order', 'asc')
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteByProjectId(int $projectId): bool
    {
        return $this->query()
            ->where('project_id', $projectId)
            ->delete();
    }

    /**
     * {@inheritdoc}
     */
    public function setSortOrder(int $imageId, int $sortOrder): Model
    {
        $image = $this->findOrFail($imageId);
        $image->update(['sort_order' => $sortOrder]);
        return $image->fresh();
    }
}