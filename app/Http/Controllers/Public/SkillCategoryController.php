<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
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
     * Récupère toutes les catégories avec leurs compétences visibles
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $categories = $this->categoryService->getAllWithSkills();
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
}