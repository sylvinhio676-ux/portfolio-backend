<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Education\StoreEducationRequest;
use App\Http\Requests\Education\UpdateEducationRequest;
use App\Http\Requests\Education\StoreEducationImageRequest;
use App\Http\Requests\Education\StoreEducationDocumentRequest;
use App\Http\Resources\EducationResource;
use App\Http\Resources\EducationDetailResource;
use App\Services\EducationService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class EducationController extends Controller
{
    public function __construct(
        private readonly EducationService $educationService
    ) {}

    /**
     * Liste toutes les formations (admin)
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $education = $this->educationService->getAll();
            return ApiResponse::success(
                EducationResource::collection($education),
                'Formations récupérées avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des formations',
                $e->getMessage()
            );
        }
    }

    /**
     * Crée une nouvelle formation
     *
     * @param StoreEducationRequest $request
     * @return JsonResponse
     */
    public function store(StoreEducationRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $skills = $request->input('skills', []);

            $education = $this->educationService->create($validated, $skills);

            return ApiResponse::created(
                new EducationDetailResource($education),
                'Formation créée avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la création de la formation',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour une formation
     *
     * @param UpdateEducationRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateEducationRequest $request, int $id): JsonResponse
    {
        try {
            $education = $this->educationService->getAll()->find($id);

            if (!$education) {
                return ApiResponse::notFound('Formation non trouvée');
            }

            $validated = $request->validated();
            $skills = $request->input('skills', null);

            $updatedEducation = $this->educationService->update($education, $validated, $skills);

            return ApiResponse::success(
                new EducationDetailResource($updatedEducation),
                'Formation mise à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour de la formation',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime une formation
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $education = $this->educationService->getAll()->find($id);

            if (!$education) {
                return ApiResponse::notFound('Formation non trouvée');
            }

            $this->educationService->delete($education);

            return ApiResponse::message('Formation supprimée avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression de la formation',
                $e->getMessage()
            );
        }
    }

    /**
     * Ajoute des images à une formation
     *
     * @param StoreEducationImageRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function addImage(StoreEducationImageRequest $request, int $id): JsonResponse
    {
        try {
            $education = $this->educationService->getAll()->find($id);

            if (!$education) {
                return ApiResponse::notFound('Formation non trouvée');
            }

            $files = $request->file('images');
            $alts = $request->input('alts', []);

            $this->educationService->addImages($education, $files, $alts);

            return ApiResponse::message('Images ajoutées avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de l\'ajout des images',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime une image d'une formation
     *
     * @param int $educationId
     * @param int $imageId
     * @return JsonResponse
     */
    public function deleteImage(int $educationId, int $imageId): JsonResponse
    {
        try {
            $image = \App\Models\EducationImage::find($imageId);

            if (!$image) {
                return ApiResponse::notFound('Image non trouvée');
            }

            $this->educationService->deleteImage($image);

            return ApiResponse::message('Image supprimée avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression de l\'image',
                $e->getMessage()
            );
        }
    }

    /**
     * Ajoute des documents à une formation
     *
     * @param StoreEducationDocumentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function addDocument(StoreEducationDocumentRequest $request, int $id): JsonResponse
    {
        try {
            $education = $this->educationService->getAll()->find($id);

            if (!$education) {
                return ApiResponse::notFound('Formation non trouvée');
            }

            $files = $request->file('documents');
            $types = $request->input('types', []);
            $names = $request->input('names', []);

            $this->educationService->addDocuments($education, $files, $types, $names);

            return ApiResponse::message('Documents ajoutés avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de l\'ajout des documents',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime un document d'une formation
     *
     * @param int $educationId
     * @param int $documentId
     * @return JsonResponse
     */
    public function deleteDocument(int $educationId, int $documentId): JsonResponse
    {
        try {
            $document = \App\Models\EducationDocument::find($documentId);

            if (!$document) {
                return ApiResponse::notFound('Document non trouvé');
            }

            $this->educationService->deleteDocument($document);

            return ApiResponse::message('Document supprimé avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression du document',
                $e->getMessage()
            );
        }
    }
}
