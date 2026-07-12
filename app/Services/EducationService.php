<?php

namespace App\Services;

use App\Models\Education;
use App\Models\EducationDocument;
use App\Models\EducationImage;
use App\Repositories\Contracts\EducationRepositoryInterface;
use App\Repositories\Contracts\EducationDocumentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class EducationService
{
    public function __construct(
        private readonly EducationRepositoryInterface $educationRepository,
        private readonly EducationDocumentRepositoryInterface $educationDocumentRepository,
        private readonly CloudinaryService $cloudinary
    ) {}

    /**
     * Retourne les formations visibles avec leurs compétences (site public).
     *
     * @return Collection<int, Education>
     */
    public function getVisible(): Collection
    {
        return $this->educationRepository->getVisibleWith(['skills']);
    }

    /**
     * Retourne toutes les formations avec leurs relations (dashboard admin).
     *
     * @return Collection<int, Education>
     */
    public function getAll(): Collection
    {
        return $this->educationRepository->getAllWithRelations(['images', 'documents', 'skills']);
    }

    /**
     * Retourne une formation visible par son id avec toutes ses relations (page détail).
     */
    public function findVisibleById(int $id): ?Education
    {
        return $this->educationRepository->findVisibleById($id);
    }

    /**
     * Crée une formation et synchronise ses compétences dans une transaction.
     *
     * @param array<string, mixed>  $data
     * @param array<int, int>       $skills
     */
    public function create(array $data, array $skills = []): Education
    {
        return DB::transaction(function () use ($data, $skills): Education {
            // Créer la formation
            $education = $this->educationRepository->create($data);

            // Attacher les compétences si présentes
            if (!empty($skills)) {
                $education->skills()->sync($skills);
            }

            // Recharger avec les relations
            return $this->educationRepository->find($education->id, ['*'], ['images', 'documents', 'skills']);
        });
    }

    /**
     * Met à jour une formation et remplace ses compétences dans une transaction.
     *
     * @param array<string, mixed>  $data
     * @param array<int, int>|null  $skills
     */
    public function update(Education $education, array $data, ?array $skills = null): Education
    {
        return DB::transaction(function () use ($education, $data, $skills): Education {
            // Mettre à jour la formation
            $this->educationRepository->update($education, $data);

            // Remplacer les compétences seulement si envoyées dans la requête
            if ($skills !== null) {
                $education->skills()->sync($skills);
            }

            // Recharger avec les relations
            return $this->educationRepository->find($education->id, ['*'], ['images', 'documents', 'skills']);
        });
    }

    /**
     * Supprime une formation et ses médias Cloudinary dans une transaction.
     */
    public function delete(Education $education): void
    {
        DB::transaction(function () use ($education): void {
            // Suppression des images sur Cloudinary avant de supprimer en base
            foreach ($education->images as $image) {
                if ($image->public_id) {
                    $this->cloudinary->delete($image->public_id);
                }
            }

            // Suppression des documents (fichiers "raw") sur Cloudinary
            foreach ($education->documents as $document) {
                if ($document->public_id) {
                    $this->cloudinary->delete($document->public_id, 'raw');
                }
            }

            // Détacher les compétences liées (pivot)
            $education->skills()->detach();

            // Supprimer la formation (cascade sur images/documents en base)
            $this->educationRepository->delete($education);
        });
    }

    /**
     * Ajoute des images à une formation existante.
     *
     * @param  UploadedFile[]           $files
     * @param  array<int, string|null>  $alts
     * @return Collection<int, EducationImage>
     */
    public function addImages(Education $education, array $files, array $alts = []): Collection
    {
        return DB::transaction(function () use ($education, $files, $alts): Collection {
            // Upload vers Cloudinary
            $results = $this->cloudinary->uploadImages($files, 'education');

            $images = [];
            $currentCount = $education->images()->count();

            foreach ($results as $index => $result) {
                $image = EducationImage::create([
                    'education_id' => $education->id,
                    'url'          => $result['url'],
                    'public_id'    => $result['public_id'],
                    'alt'          => $alts[$index] ?? null,
                    'sort_order'   => $currentCount + $index,
                ]);

                $images[] = $image;
            }

            return new Collection($images);
        });
    }

    /**
     * Supprime une image d'une formation (base + Cloudinary).
     */
    public function deleteImage(EducationImage $image): void
    {
        DB::transaction(function () use ($image): void {
            // Supprimer sur Cloudinary
            if ($image->public_id) {
                $this->cloudinary->delete($image->public_id);
            }

            // Supprimer en base
            $image->delete();
        });
    }

    /**
     * Ajoute des documents (PDF) à une formation existante.
     *
     * @param  UploadedFile[]           $files
     * @param  array<int, string|null>  $types
     * @param  array<int, string|null>  $names
     * @return Collection<int, EducationDocument>
     */
    public function addDocuments(Education $education, array $files, array $types = [], array $names = []): Collection
    {
        return DB::transaction(function () use ($education, $files, $types, $names): Collection {
            $documents = [];
            $currentCount = $this->educationDocumentRepository->getByEducation($education->id)->count();

            foreach (array_values($files) as $index => $file) {
                // Upload du PDF vers Cloudinary (resource_type raw)
                $result = $this->cloudinary->uploadPdf($file);

                $document = $this->educationDocumentRepository->create([
                    'education_id' => $education->id,
                    'type'         => $types[$index] ?? 'autre',
                    'url'          => $result['url'],
                    'public_id'    => $result['public_id'],
                    'name'         => $names[$index] ?? null,
                    'sort_order'   => $currentCount + $index,
                ]);

                $documents[] = $document;
            }

            return new Collection($documents);
        });
    }

    /**
     * Supprime un document d'une formation (base + Cloudinary).
     */
    public function deleteDocument(EducationDocument $document): void
    {
        DB::transaction(function () use ($document): void {
            // Supprimer sur Cloudinary (fichier "raw")
            if ($document->public_id) {
                $this->cloudinary->delete($document->public_id, 'raw');
            }

            // Supprimer en base
            $this->educationDocumentRepository->delete($document);
        });
    }
}
