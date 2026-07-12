<?php

namespace App\Repositories\Eloquent;

use App\Models\EducationDocument;
use App\Repositories\Contracts\EducationDocumentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class EducationDocumentRepository
 *
 * Repository pour la gestion des documents de formations
 */
class EducationDocumentRepository extends BaseRepository implements EducationDocumentRepositoryInterface
{
    /**
     * EducationDocumentRepository constructor.
     *
     * @param EducationDocument $model
     */
    public function __construct(EducationDocument $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritdoc}
     */
    public function getByEducation(int $educationId): Collection
    {
        return $this->query()
            ->where('education_id', $educationId)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteByEducationId(int $educationId): bool
    {
        return $this->query()
            ->where('education_id', $educationId)
            ->delete();
    }
}
