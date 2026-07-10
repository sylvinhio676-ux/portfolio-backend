<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
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
     * Récupère toutes les compétences visibles
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $skills = $this->skillService->getVisible();
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
}