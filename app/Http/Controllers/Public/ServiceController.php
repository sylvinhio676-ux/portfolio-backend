<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Services\ServiceService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function __construct(
        private readonly ServiceService $serviceService
    ) {}

    /**
     * Récupère tous les services visibles
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $services = $this->serviceService->getVisible();
            return ApiResponse::success(
                ServiceResource::collection($services),
                'Services récupérés avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des services',
                $e->getMessage()
            );
        }
    }
}