<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\About\UpdateAboutRequest;
use App\Http\Resources\AboutResource;
use App\Services\AboutService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class AboutController extends Controller
{
    public function __construct(
        private readonly AboutService $aboutService
    ) {}

    /**
     * Récupère les informations "À propos"
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        try {
            $about = $this->aboutService->get();
            return ApiResponse::success(
                new AboutResource($about),
                'Informations récupérées avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des informations',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour les informations "À propos"
     *
     * @param UpdateAboutRequest $request
     * @return JsonResponse
     */
    public function update(UpdateAboutRequest $request): JsonResponse
    {
        try {
            $about = $this->aboutService->update($request->validated());
            return ApiResponse::success(
                new AboutResource($about),
                'Informations mises à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour des informations',
                $e->getMessage()
            );
        }
    }
}