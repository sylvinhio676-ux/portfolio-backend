<?php

namespace App\Repositories\Eloquent;

use App\Models\CertificationDocument;
use App\Repositories\Contracts\CertificationDocumentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class CertificationDocumentRepository
 *
 * Repository pour la gestion des documents de certifications
 */
class CertificationDocumentRepository extends BaseRepository implements CertificationDocumentRepositoryInterface
{
    /**
     * CertificationDocumentRepository constructor.
     *
     * @param CertificationDocument $model
     */
    public function __construct(CertificationDocument $model)
    {
        parent::__construct($model);
    }

    /**
     * {@inheritdoc}
     */
    public function getByCertification(int $certificationId): Collection
    {
        return $this->query()
            ->where('certification_id', $certificationId)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteByCertificationId(int $certificationId): bool
    {
        return $this->query()
            ->where('certification_id', $certificationId)
            ->delete();
    }
}
