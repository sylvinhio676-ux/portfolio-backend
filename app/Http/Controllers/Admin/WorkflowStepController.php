<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkflowStep\StoreWorkflowStepRequest;
use App\Http\Requests\WorkflowStep\UpdateWorkflowStepRequest;
use App\Http\Resources\WorkflowStepResource;
use App\Services\WorkflowStepService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class WorkflowStepController extends Controller
{
    public function __construct(
        private readonly WorkflowStepService $workflowStepService
    ) {}

    /**
     * Liste toutes les étapes.
     */
    public function index(): JsonResponse
    {
        try {
            $steps = $this->workflowStepService->getAll();
            return ApiResponse::success(
                WorkflowStepResource::collection($steps),
                'Étapes récupérées avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des étapes',
                $e->getMessage()
            );
        }
    }

    /**
     * Crée une nouvelle étape.
     */
    public function store(StoreWorkflowStepRequest $request): JsonResponse
    {
        try {
            $step = $this->workflowStepService->create($request->validated());
            return ApiResponse::created(
                new WorkflowStepResource($step),
                'Étape créée avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la création de l\'étape',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour une étape.
     */
    public function update(UpdateWorkflowStepRequest $request, int $id): JsonResponse
    {
        try {
            $step = $this->workflowStepService->getAll()->find($id);

            if (!$step) {
                return ApiResponse::notFound('Étape non trouvée');
            }

            $updated = $this->workflowStepService->update($step, $request->validated());

            return ApiResponse::success(
                new WorkflowStepResource($updated),
                'Étape mise à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour de l\'étape',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime une étape.
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $step = $this->workflowStepService->getAll()->find($id);

            if (!$step) {
                return ApiResponse::notFound('Étape non trouvée');
            }

            $this->workflowStepService->delete($step);

            return ApiResponse::message('Étape supprimée avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression de l\'étape',
                $e->getMessage()
            );
        }
    }
}
