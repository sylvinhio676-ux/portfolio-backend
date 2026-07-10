<?php

namespace App\Repositories\Eloquent;

use App\Models\ProjectTechnology;
use App\Repositories\Contracts\ProjectTechnologyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ProjectTechnologyRepository
 * 
 * Repository pour la gestion des technologies de projets
 */
class ProjectTechnologyRepository extends BaseRepository implements ProjectTechnologyRepositoryInterface
{
    /**
     * ProjectTechnologyRepository constructor.
     *
     * @param ProjectTechnology $model
     */
    public function __construct(ProjectTechnology $model)
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
            ->get();
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
    public function createMany(int $projectId, array $technologies): Collection
    {
        $created = [];

        foreach ($technologies as $tech) {
            $created[] = $this->create([
                'project_id' => $projectId,
                'name' => $tech['name'],
                'color' => $tech['color'] ?? null,
                'icon' => $tech['icon'] ?? null,
            ]);
        }

        return new Collection($created);
    }
}