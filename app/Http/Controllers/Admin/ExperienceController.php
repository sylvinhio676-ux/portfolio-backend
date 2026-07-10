<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Experience\StoreExperienceRequest;
use App\Http\Requests\Experience\UpdateExperienceRequest;
use App\Http\Resources\ExperienceResource;
use App\Services\ExperienceService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    public function __construct(
        private readonly ExperienceService $experienceService
    ) {}

    /**
     * Liste toutes les expériences
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $experiences = $this->experienceService->getAll();
            return ApiResponse::success(
                ExperienceResource::collection($experiences),
                'Expériences récupérées avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des expériences',
                $e->getMessage()
            );
        }
    }

    /**
     * Crée une nouvelle expérience
     *
     * @param StoreExperienceRequest $request
     * @return JsonResponse
     */
    public function store(StoreExperienceRequest $request): JsonResponse
    {
        try {
            $experience = $this->experienceService->create($request->validated());
            return ApiResponse::created(
                new ExperienceResource($experience),
                'Expérience créée avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la création de l\'expérience',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour une expérience
     *
     * @param UpdateExperienceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateExperienceRequest $request, int $id): JsonResponse
    {
        try {
            $experience = $this->experienceService->getAll()->find($id);
            
            if (!$experience) {
                return ApiResponse::notFound('Expérience non trouvée');
            }

            $updatedExperience = $this->experienceService->update($experience, $request->validated());
            
            return ApiResponse::success(
                new ExperienceResource($updatedExperience),
                'Expérience mise à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour de l\'expérience',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime une expérience
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $experience = $this->experienceService->getAll()->find($id);
            
            if (!$experience) {
                return ApiResponse::notFound('Expérience non trouvée');
            }

            $this->experienceService->delete($experience);
            
            return ApiResponse::message('Expérience supprimée avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression de l\'expérience',
                $e->getMessage()
            );
        }
    }
}