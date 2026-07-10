<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seo\UpdateSeoRequest;
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
     * Récupère les paramètres SEO d'une page
     *
     * @param string $page
     * @return JsonResponse
     */
    public function show(string $page): JsonResponse
    {
        try {
            $seo = $this->seoService->getByPage($page);
            return ApiResponse::success(
                new SeoResource($seo),
                'Paramètres SEO récupérés avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des paramètres SEO',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour les paramètres SEO d'une page
     *
     * @param UpdateSeoRequest $request
     * @param string $page
     * @return JsonResponse
     */
    public function update(UpdateSeoRequest $request, string $page): JsonResponse
    {
        try {
            $seo = $this->seoService->update($page, $request->validated());
            return ApiResponse::success(
                new SeoResource($seo),
                'Paramètres SEO mis à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour des paramètres SEO',
                $e->getMessage()
            );
        }
    }
}