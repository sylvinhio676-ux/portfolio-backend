<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface CertificationDocumentRepositoryInterface
 *
 * Repository pour la gestion des documents de certifications
 */
interface CertificationDocumentRepositoryInterface extends RepositoryInterface
{
    /**
     * Récupérer les documents d'une certification
     *
     * @param int $certificationId
     * @return Collection
     */
    public function getByCertification(int $certificationId): Collection;

    /**
     * Supprimer tous les documents d'une certification
     *
     * @param int $certificationId
     * @return bool
     */
    public function deleteByCertificationId(int $certificationId): bool;
}
