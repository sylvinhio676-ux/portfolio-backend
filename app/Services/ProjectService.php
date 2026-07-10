<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectImage;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\Contracts\ProjectImageRepositoryInterface;
use App\Repositories\Contracts\ProjectTechnologyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projectRepository,
        private readonly ProjectImageRepositoryInterface $projectImageRepository,
        private readonly ProjectTechnologyRepositoryInterface $projectTechnologyRepository,
        private readonly CloudinaryService $cloudinary
    ) {}

    /**
     * Retourne les projets publiés avec leurs technologies (site public).
     *
     * @return Collection<int, Project>
     */
    public function getPublished(): Collection
    {
        return $this->projectRepository->getPublishedWith(['technologies']);
    }

    /**
     * Retourne tous les projets (dashboard admin).
     *
     * @return Collection<int, Project>
     */
    public function getAll(): Collection
    {
        return $this->projectRepository->getAllWithRelations(['technologies', 'images']);
    }

    /**
     * Retourne un projet publié par son slug avec toutes ses relations (page détail).
     */
    public function getBySlug(string $slug): Project
    {
        $project = $this->projectRepository->findPublishedBySlug($slug);

        if (!$project) {
            abort(404, 'Project not found');
        }

        return $project;
    }

    /**
     * Crée un projet avec ses technologies dans une transaction.
     *
     * @param array<string, mixed>  $data
     * @param array<int, array{name: string, color: string|null, icon: string|null}> $technologies
     */
    public function create(array $data, array $technologies = []): Project
    {
        return DB::transaction(function () use ($data, $technologies): Project {
            // Créer le projet
            $project = $this->projectRepository->create($data);

            // Ajouter les technologies si présentes
            if (!empty($technologies)) {
                $this->projectTechnologyRepository->createMany($project->id, $technologies);
            }

            // Recharger avec les relations
            return $this->projectRepository->find($project->id, ['*'], ['technologies', 'images']);
        });
    }

    /**
     * Met à jour un projet et remplace ses technologies dans une transaction.
     *
     * @param array<string, mixed>  $data
     * @param array<int, array{name: string, color: string|null, icon: string|null}>|null $technologies
     */
    public function update(Project $project, array $data, ?array $technologies = null): Project
    {
        return DB::transaction(function () use ($project, $data, $technologies): Project {
            // Mettre à jour le projet
            $this->projectRepository->update($project, $data);

            // Remplacer les technologies seulement si envoyées dans la requête
            if ($technologies !== null) {
                // Supprimer les anciennes technologies
                $this->projectTechnologyRepository->deleteByProjectId($project->id);

                // Ajouter les nouvelles
                if (!empty($technologies)) {
                    $this->projectTechnologyRepository->createMany($project->id, $technologies);
                }
            }

            // Recharger avec les relations
            return $this->projectRepository->find($project->id, ['*'], ['technologies', 'images']);
        });
    }

    /**
     * Supprime un projet et ses images Cloudinary dans une transaction.
     */
    public function delete(Project $project): void
    {
        DB::transaction(function () use ($project): void {
            // Suppression des images sur Cloudinary avant de supprimer en base
            foreach ($project->images as $image) {
                if ($image->public_id) {
                    $this->cloudinary->delete($image->public_id);
                }
            }

            // Supprimer les technologies liées
            $this->projectTechnologyRepository->deleteByProjectId($project->id);

            // Supprimer le projet
            $this->projectRepository->delete($project);
        });
    }

    /**
     * Ajoute des images à un projet existant.
     *
     * @param  UploadedFile[]  $files
     * @param  array<int, string|null>  $alts
     * @return Collection<int, ProjectImage>
     */
    public function addImages(Project $project, array $files, array $alts = []): Collection
    {
        return DB::transaction(function () use ($project, $files, $alts): Collection {
            // Upload vers Cloudinary
            $results = $this->cloudinary->uploadImages($files, 'projects');

            $images = [];
            $currentCount = $this->projectImageRepository->getByProject($project->id)->count();

            foreach ($results as $index => $result) {
                $image = $this->projectImageRepository->create([
                    'project_id' => $project->id,
                    'url'        => $result['url'],
                    'public_id'  => $result['public_id'],
                    'alt'        => $alts[$index] ?? null,
                    'sort_order' => $currentCount + $index,
                ]);

                $images[] = $image;
            }

            return new Collection($images);
        });
    }

    /**
     * Supprime une image d'un projet (base + Cloudinary).
     */
    public function deleteImage(ProjectImage $image): void
    {
        DB::transaction(function () use ($image): void {
            // Supprimer sur Cloudinary
            if ($image->public_id) {
                $this->cloudinary->delete($image->public_id);
            }

            // Supprimer en base
            $this->projectImageRepository->delete($image);
        });
    }
}