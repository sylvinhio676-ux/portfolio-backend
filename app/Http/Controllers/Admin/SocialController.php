<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Social\StoreSocialRequest;
use App\Http\Requests\Social\UpdateSocialRequest;
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
     * Liste tous les réseaux sociaux
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $socials = $this->socialService->getAll();
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

    /**
     * Crée un nouveau réseau social
     *
     * @param StoreSocialRequest $request
     * @return JsonResponse
     */
    public function store(StoreSocialRequest $request): JsonResponse
    {
        try {
            $social = $this->socialService->create($request->validated());
            return ApiResponse::created(
                new SocialResource($social),
                'Réseau social créé avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la création du réseau social',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour un réseau social
     *
     * @param UpdateSocialRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateSocialRequest $request, int $id): JsonResponse
    {
        try {
            $social = $this->socialService->getAll()->find($id);
            
            if (!$social) {
                return ApiResponse::notFound('Réseau social non trouvé');
            }

            $updatedSocial = $this->socialService->update($social, $request->validated());
            
            return ApiResponse::success(
                new SocialResource($updatedSocial),
                'Réseau social mis à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour du réseau social',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime un réseau social
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $social = $this->socialService->getAll()->find($id);
            
            if (!$social) {
                return ApiResponse::notFound('Réseau social non trouvé');
            }

            $this->socialService->delete($social);
            
            return ApiResponse::message('Réseau social supprimé avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression du réseau social',
                $e->getMessage()
            );
        }
    }
}