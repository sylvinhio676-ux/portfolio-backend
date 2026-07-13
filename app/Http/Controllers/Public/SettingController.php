<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublicSettingResource;
use App\Services\SettingService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function __construct(
        private readonly SettingService $settingService
    ) {}

    /**
     * Récupère les paramètres globaux publics (ligne unique)
     *
     * @return JsonResponse
     */
    public function show(): JsonResponse
    {
        try {
            $setting = $this->settingService->get();
            return ApiResponse::success(new PublicSettingResource($setting));
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des paramètres',
                $e->getMessage()
            );
        }
    }
}
