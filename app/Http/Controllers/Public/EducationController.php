<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
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

    public function index(): JsonResponse
    {
        try {
            $education = $this->educationService->getVisible();
            return ApiResponse::success(EducationResource::collection($education));
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des formations',
                $e->getMessage()
            );
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $education = $this->educationService->findVisibleById($id);

            if (!$education) {
                return ApiResponse::notFound('Formation non trouvée');
            }

            return ApiResponse::success(new EducationDetailResource($education));
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération de la formation',
                $e->getMessage()
            );
        }
    }
}
