<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ProjectDetailResource;
use App\Services\ProjectService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectService $projectService
    ) {}

    public function index(): JsonResponse
    {
        try {
            $projects = $this->projectService->getPublished();
            return ApiResponse::success(ProjectResource::collection($projects));
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des projets',
                $e->getMessage()
            );
        }
    }

    public function show(string $slug): JsonResponse
    {
        try {
            $project = $this->projectService->getBySlug($slug);
            return ApiResponse::success(new ProjectDetailResource($project));
        } catch (ModelNotFoundException $e) {
            return ApiResponse::notFound('Projet non trouvé');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération du projet',
                $e->getMessage()
            );
        }
    }
}