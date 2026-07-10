<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Skill\StoreSkillRequest;
use App\Http\Requests\Skill\UpdateSkillRequest;
use App\Http\Resources\SkillResource;
use App\Services\SkillService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{
    public function __construct(
        private readonly SkillService $skillService
    ) {}

    /**
     * Liste toutes les compétences
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $skills = $this->skillService->getAll();
            return ApiResponse::success(
                SkillResource::collection($skills),
                'Compétences récupérées avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des compétences',
                $e->getMessage()
            );
        }
    }

    /**
     * Crée une nouvelle compétence
     *
     * @param StoreSkillRequest $request
     * @return JsonResponse
     */
    public function store(StoreSkillRequest $request): JsonResponse
    {
        try {
            $skill = $this->skillService->create($request->validated());
            return ApiResponse::created(
                new SkillResource($skill),
                'Compétence créée avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la création de la compétence',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour une compétence
     *
     * @param UpdateSkillRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateSkillRequest $request, int $id): JsonResponse
    {
        try {
            $skill = $this->skillService->getAll()->find($id);
            
            if (!$skill) {
                return ApiResponse::notFound('Compétence non trouvée');
            }

            $updatedSkill = $this->skillService->update($skill, $request->validated());
            
            return ApiResponse::success(
                new SkillResource($updatedSkill),
                'Compétence mise à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour de la compétence',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime une compétence
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $skill = $this->skillService->getAll()->find($id);
            
            if (!$skill) {
                return ApiResponse::notFound('Compétence non trouvée');
            }

            $this->skillService->delete($skill);
            
            return ApiResponse::message('Compétence supprimée avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression de la compétence',
                $e->getMessage()
            );
        }
    }
}