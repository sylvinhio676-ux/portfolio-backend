<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Certification\StoreCertificationRequest;
use App\Http\Requests\Certification\UpdateCertificationRequest;
use App\Http\Requests\Certification\UploadBadgeRequest;
use App\Http\Requests\Certification\StoreCertificationDocumentRequest;
use App\Http\Resources\CertificationResource;
use App\Http\Resources\CertificationDetailResource;
use App\Http\Resources\CertificationDocumentResource;
use App\Services\CertificationService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class CertificationController extends Controller
{
    public function __construct(
        private readonly CertificationService $certificationService
    ) {}

    /**
     * Liste toutes les certifications (admin)
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $certifications = $this->certificationService->getAll();
            return ApiResponse::success(
                CertificationResource::collection($certifications),
                'Certifications récupérées avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des certifications',
                $e->getMessage()
            );
        }
    }

    /**
     * Crée une nouvelle certification
     *
     * @param StoreCertificationRequest $request
     * @return JsonResponse
     */
    public function store(StoreCertificationRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $skills = $request->input('skills', []);

            $certification = $this->certificationService->create($validated, $skills);

            return ApiResponse::created(
                new CertificationDetailResource($certification),
                'Certification créée avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la création de la certification',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour une certification
     *
     * @param UpdateCertificationRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateCertificationRequest $request, int $id): JsonResponse
    {
        try {
            $certification = $this->certificationService->getAll()->find($id);

            if (!$certification) {
                return ApiResponse::notFound('Certification non trouvée');
            }

            $validated = $request->validated();
            $skills = $request->input('skills', null);

            $updatedCertification = $this->certificationService->update($certification, $validated, $skills);

            return ApiResponse::success(
                new CertificationDetailResource($updatedCertification),
                'Certification mise à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour de la certification',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime une certification
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $certification = $this->certificationService->getAll()->find($id);

            if (!$certification) {
                return ApiResponse::notFound('Certification non trouvée');
            }

            $this->certificationService->delete($certification);

            return ApiResponse::message('Certification supprimée avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression de la certification',
                $e->getMessage()
            );
        }
    }

    /**
     * Téléverse (ou remplace) le badge d'une certification
     *
     * @param UploadBadgeRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function uploadBadge(UploadBadgeRequest $request, int $id): JsonResponse
    {
        try {
            $certification = $this->certificationService->getAll()->find($id);

            if (!$certification) {
                return ApiResponse::notFound('Certification non trouvée');
            }

            $file = $request->file('badge');

            $updatedCertification = $this->certificationService->uploadBadge($certification, $file);

            return ApiResponse::success(
                new CertificationDetailResource($updatedCertification),
                'Badge mis à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors du téléversement du badge',
                $e->getMessage()
            );
        }
    }

    /**
     * Ajoute un document à une certification
     *
     * @param StoreCertificationDocumentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function addDocument(StoreCertificationDocumentRequest $request, int $id): JsonResponse
    {
        try {
            $certification = $this->certificationService->getAll()->find($id);

            if (!$certification) {
                return ApiResponse::notFound('Certification non trouvée');
            }

            $file = $request->file('document');
            $type = $request->input('type');
            $name = $request->input('name');

            $document = $this->certificationService->addDocument($certification, $file, $type, $name);

            return ApiResponse::created(
                new CertificationDocumentResource($document),
                'Document ajouté avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de l\'ajout du document',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime un document d'une certification
     *
     * @param int $certificationId
     * @param int $documentId
     * @return JsonResponse
     */
    public function deleteDocument(int $certificationId, int $documentId): JsonResponse
    {
        try {
            $document = \App\Models\CertificationDocument::find($documentId);

            if (!$document) {
                return ApiResponse::notFound('Document non trouvé');
            }

            $this->certificationService->deleteDocument($document);

            return ApiResponse::message('Document supprimé avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression du document',
                $e->getMessage()
            );
        }
    }
}
