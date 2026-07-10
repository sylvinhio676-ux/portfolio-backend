<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillCategory\StoreSkillCategoryRequest;
use App\Http\Requests\SkillCategory\UpdateSkillCategoryRequest;
use App\Http\Resources\SkillCategoryResource;
use App\Services\SkillCategoryService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class SkillCategoryController extends Controller
{
    public function __construct(
        private readonly SkillCategoryService $categoryService
    ) {}

    /**
     * Liste toutes les catégories
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $categories = $this->categoryService->getAll();
            return ApiResponse::success(
                SkillCategoryResource::collection($categories),
                'Catégories récupérées avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des catégories',
                $e->getMessage()
            );
        }
    }

    /**
     * Crée une nouvelle catégorie
     *
     * @param StoreSkillCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreSkillCategoryRequest $request): JsonResponse
    {
        try {
            $category = $this->categoryService->create($request->validated());
            return ApiResponse::created(
                new SkillCategoryResource($category),
                'Catégorie créée avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la création de la catégorie',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour une catégorie
     *
     * @param UpdateSkillCategoryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateSkillCategoryRequest $request, int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->getAll()->find($id);
            
            if (!$category) {
                return ApiResponse::notFound('Catégorie non trouvée');
            }

            $updatedCategory = $this->categoryService->update($category, $request->validated());
            
            return ApiResponse::success(
                new SkillCategoryResource($updatedCategory),
                'Catégorie mise à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour de la catégorie',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime une catégorie
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->getAll()->find($id);
            
            if (!$category) {
                return ApiResponse::notFound('Catégorie non trouvée');
            }

            $this->categoryService->delete($category);
            
            return ApiResponse::message('Catégorie supprimée avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression de la catégorie',
                $e->getMessage()
            );
        }
    }
}