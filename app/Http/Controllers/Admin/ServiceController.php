<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
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
     * Liste tous les services
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $services = $this->serviceService->getAll();
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

    /**
     * Crée un nouveau service
     *
     * @param StoreServiceRequest $request
     * @return JsonResponse
     */
    public function store(StoreServiceRequest $request): JsonResponse
    {
        try {
            $service = $this->serviceService->create($request->validated());
            return ApiResponse::created(
                new ServiceResource($service),
                'Service créé avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la création du service',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour un service
     *
     * @param UpdateServiceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateServiceRequest $request, int $id): JsonResponse
    {
        try {
            $service = $this->serviceService->getAll()->find($id);
            
            if (!$service) {
                return ApiResponse::notFound('Service non trouvé');
            }

            $updatedService = $this->serviceService->update($service, $request->validated());
            
            return ApiResponse::success(
                new ServiceResource($updatedService),
                'Service mis à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour du service',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime un service
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $service = $this->serviceService->getAll()->find($id);
            
            if (!$service) {
                return ApiResponse::notFound('Service non trouvé');
            }

            $this->serviceService->delete($service);
            
            return ApiResponse::message('Service supprimé avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression du service',
                $e->getMessage()
            );
        }
    }
}