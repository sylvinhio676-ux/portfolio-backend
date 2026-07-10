<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
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
     * Récupère toutes les expériences triées par date
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
}