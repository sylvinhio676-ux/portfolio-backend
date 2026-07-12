<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\CertificationResource;
use App\Http\Resources\CertificationDetailResource;
use App\Services\CertificationService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CertificationController extends Controller
{
    public function __construct(
        private readonly CertificationService $certificationService
    ) {}

    public function index(): JsonResponse
    {
        try {
            $certifications = $this->certificationService->getVisible();
            return ApiResponse::success(CertificationResource::collection($certifications));
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des certifications',
                $e->getMessage()
            );
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $certification = $this->certificationService->getById($id);
            return ApiResponse::success(new CertificationDetailResource($certification));
        } catch (ModelNotFoundException $e) {
            return ApiResponse::notFound('Certification non trouvée');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération de la certification',
                $e->getMessage()
            );
        }
    }
}
