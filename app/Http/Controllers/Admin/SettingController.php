<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UpdateSettingRequest;
use App\Http\Resources\SettingResource;
use App\Services\SettingService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function __construct(
        private readonly SettingService $settingService
    ) {}

    /**
     * Récupère les paramètres globaux
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        try {
            $setting = $this->settingService->get();
            return ApiResponse::success(
                new SettingResource($setting),
                'Paramètres récupérés avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des paramètres',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour les paramètres globaux (upsert de la ligne unique)
     *
     * @param UpdateSettingRequest $request
     * @return JsonResponse
     */
    public function update(UpdateSettingRequest $request): JsonResponse
    {
        try {
            $setting = $this->settingService->update($request->validated());
            return ApiResponse::success(
                new SettingResource($setting),
                'Paramètres mis à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour des paramètres',
                $e->getMessage()
            );
        }
    }
}
