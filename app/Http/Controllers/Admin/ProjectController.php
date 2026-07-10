<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Requests\Project\StoreProjectImageRequest;
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

    /**
     * Liste tous les projets (admin)
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $projects = $this->projectService->getAll();
            return ApiResponse::success(
                ProjectResource::collection($projects),
                'Projets récupérés avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des projets',
                $e->getMessage()
            );
        }
    }

    /**
     * Crée un nouveau projet
     *
     * @param StoreProjectRequest $request
     * @return JsonResponse
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            $technologies = $request->input('technologies', []);
            
            $project = $this->projectService->create($validated, $technologies);
            
            return ApiResponse::created(
                new ProjectDetailResource($project),
                'Projet créé avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la création du projet',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour un projet
     *
     * @param UpdateProjectRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateProjectRequest $request, int $id): JsonResponse
    {
        try {
            $project = $this->projectService->getAll()->find($id);
            
            if (!$project) {
                return ApiResponse::notFound('Projet non trouvé');
            }

            $validated = $request->validated();
            $technologies = $request->input('technologies', null);
            
            $updatedProject = $this->projectService->update($project, $validated, $technologies);
            
            return ApiResponse::success(
                new ProjectDetailResource($updatedProject),
                'Projet mis à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour du projet',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime un projet
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $project = $this->projectService->getAll()->find($id);
            
            if (!$project) {
                return ApiResponse::notFound('Projet non trouvé');
            }

            $this->projectService->delete($project);
            
            return ApiResponse::message('Projet supprimé avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression du projet',
                $e->getMessage()
            );
        }
    }

    /**
     * Ajoute des images à un projet
     *
     * @param StoreProjectImageRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function addImages(StoreProjectImageRequest $request, int $id): JsonResponse
    {
        try {
            $project = $this->projectService->getAll()->find($id);
            
            if (!$project) {
                return ApiResponse::notFound('Projet non trouvé');
            }

            $files = $request->file('images');
            $alts = $request->input('alts', []);
            
            $this->projectService->addImages($project, $files, $alts);
            
            return ApiResponse::message('Images ajoutées avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de l\'ajout des images',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime une image d'un projet
     *
     * @param int $projectId
     * @param int $imageId
     * @return JsonResponse
     */
    public function deleteImage(int $projectId, int $imageId): JsonResponse
    {
        try {
            $image = \App\Models\ProjectImage::find($imageId);
            
            if (!$image) {
                return ApiResponse::notFound('Image non trouvée');
            }

            $this->projectService->deleteImage($image);
            
            return ApiResponse::message('Image supprimée avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression de l\'image',
                $e->getMessage()
            );
        }
    }
}