<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\SeoResource;
use App\Services\SeoService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class SeoController extends Controller
{
    public function __construct(
        private readonly SeoService $seoService
    ) {}

    /**
     * Récupère les paramètres SEO d'une page spécifique
     *
     * @param string $page
     * @return JsonResponse
     */
    public function show(string $page): JsonResponse
    {
        try {
            $seo = $this->seoService->getByPage($page);
            return ApiResponse::success(new SeoResource($seo), 'Paramètres SEO récupérés avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des paramètres SEO',
                $e->getMessage()
            );
        }
    }
}