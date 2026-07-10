<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\SocialResource;
use App\Services\SocialService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class SocialController extends Controller
{
    public function __construct(
        private readonly SocialService $socialService
    ) {}

    /**
     * Récupère tous les réseaux sociaux visibles
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $socials = $this->socialService->getVisible();
            return ApiResponse::success(
                SocialResource::collection($socials),
                'Réseaux sociaux récupérés avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des réseaux sociaux',
                $e->getMessage()
            );
        }
    }
}