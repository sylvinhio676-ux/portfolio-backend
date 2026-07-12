<?php

namespace App\Services;

use App\Models\Certification;
use App\Models\CertificationDocument;
use App\Repositories\Contracts\CertificationRepositoryInterface;
use App\Repositories\Contracts\CertificationDocumentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class CertificationService
{
    public function __construct(
        private readonly CertificationRepositoryInterface $certificationRepository,
        private readonly CertificationDocumentRepositoryInterface $certificationDocumentRepository,
        private readonly CloudinaryService $cloudinary
    ) {}

    /**
     * Retourne les certifications visibles avec leurs compétences (site public).
     *
     * @return Collection<int, Certification>
     */
    public function getVisible(): Collection
    {
        return $this->certificationRepository->getVisibleWith(['skills']);
    }

    /**
     * Retourne toutes les certifications (dashboard admin).
     *
     * @return Collection<int, Certification>
     */
    public function getAll(): Collection
    {
        return $this->certificationRepository->getAllWithRelations(['images', 'documents', 'skills']);
    }

    /**
     * Retourne une certification visible par son id avec toutes ses relations (page détail).
     */
    public function getById(int $id): Certification
    {
        $certification = $this->certificationRepository->findVisibleById($id);

        if (!$certification) {
            abort(404, 'Certification not found');
        }

        return $certification;
    }

    /**
     * Crée une certification et synchronise ses compétences dans une transaction.
     *
     * @param array<string, mixed>  $data
     * @param array<int, int>|null  $skillIds
     */
    public function create(array $data, ?array $skillIds = null): Certification
    {
        return DB::transaction(function () use ($data, $skillIds): Certification {
            // Créer la certification
            $certification = $this->certificationRepository->create($data);

            // Associer les compétences si présentes
            if ($skillIds !== null) {
                $certification->skills()->sync($skillIds);
            }

            // Recharger avec les relations
            return $this->certificationRepository->find($certification->id, ['*'], ['images', 'documents', 'skills']);
        });
    }

    /**
     * Met à jour une certification et resynchronise ses compétences dans une transaction.
     *
     * @param array<string, mixed>  $data
     * @param array<int, int>|null  $skillIds
     */
    public function update(Certification $certification, array $data, ?array $skillIds = null): Certification
    {
        return DB::transaction(function () use ($certification, $data, $skillIds): Certification {
            // Mettre à jour la certification
            $this->certificationRepository->update($certification, $data);

            // Resynchroniser les compétences seulement si envoyées dans la requête
            if ($skillIds !== null) {
                $certification->skills()->sync($skillIds);
            }

            // Recharger avec les relations
            return $this->certificationRepository->find($certification->id, ['*'], ['images', 'documents', 'skills']);
        });
    }

    /**
     * Supprime une certification et ses médias Cloudinary dans une transaction.
     */
    public function delete(Certification $certification): void
    {
        DB::transaction(function () use ($certification): void {
            // Suppression des images sur Cloudinary avant de supprimer en base
            foreach ($certification->images as $image) {
                if ($image->public_id) {
                    $this->cloudinary->delete($image->public_id);
                }
            }

            // Suppression des documents sur Cloudinary
            foreach ($certification->documents as $document) {
                if ($document->public_id) {
                    $this->cloudinary->delete($document->public_id, $this->resourceTypeFromUrl($document->url));
                }
            }

            // Détacher les compétences liées (pivot)
            $certification->skills()->detach();

            // Supprimer la certification (cascade sur images/documents en base)
            $this->certificationRepository->delete($certification);
        });
    }

    /**
     * Téléverse (ou remplace) le badge d'une certification.
     */
    public function uploadBadge(Certification $certification, UploadedFile $file): Certification
    {
        return DB::transaction(function () use ($certification, $file): Certification {
            // Upload vers Cloudinary
            $result = $this->cloudinary->uploadImage($file, 'certifications');

            // Mettre à jour la colonne badge
            $this->certificationRepository->update($certification, [
                'badge' => $result['url'],
            ]);

            return $this->certificationRepository->find($certification->id, ['*'], ['images', 'documents', 'skills']);
        });
    }

    /**
     * Ajoute un document (certificat, QR code…) à une certification.
     */
    public function addDocument(Certification $certification, UploadedFile $file, string $type, ?string $name = null): CertificationDocument
    {
        return DB::transaction(function () use ($certification, $file, $type, $name): CertificationDocument {
            // Les PDF sont envoyés en 'raw', les images en 'image'
            $isPdf = strtolower($file->getClientOriginalExtension()) === 'pdf';
            $result = $isPdf
                ? $this->cloudinary->uploadPdf($file)
                : $this->cloudinary->uploadImage($file, 'certifications');

            $currentCount = $this->certificationDocumentRepository->getByCertification($certification->id)->count();

            return $this->certificationDocumentRepository->create([
                'certification_id' => $certification->id,
                'type'             => $type,
                'url'              => $result['url'],
                'public_id'        => $result['public_id'],
                'name'             => $name,
                'sort_order'       => $currentCount,
            ]);
        });
    }

    /**
     * Supprime un document d'une certification (base + Cloudinary).
     */
    public function deleteDocument(CertificationDocument $document): void
    {
        DB::transaction(function () use ($document): void {
            // Supprimer sur Cloudinary
            if ($document->public_id) {
                $this->cloudinary->delete($document->public_id, $this->resourceTypeFromUrl($document->url));
            }

            // Supprimer en base
            $this->certificationDocumentRepository->delete($document);
        });
    }

    /**
     * Déduit le type de ressource Cloudinary ('raw' pour les PDF, 'image' sinon)
     * à partir de l'URL stockée.
     */
    private function resourceTypeFromUrl(string $url): string
    {
        return str_contains($url, '/raw/') ? 'raw' : 'image';
    }
}
