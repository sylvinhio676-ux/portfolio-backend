<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
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
     * Récupère les étapes visibles de la méthode de travail.
     */
    public function index(): JsonResponse
    {
        try {
            $steps = $this->workflowStepService->getVisible();
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
}
