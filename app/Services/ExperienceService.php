<?php

namespace App\Services;

use App\Models\Experience;
use App\Repositories\Contracts\ExperienceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ExperienceService
{
    public function __construct(
        private readonly ExperienceRepositoryInterface $experienceRepository
    ) {}

    /**
     * Retourne toutes les expériences triées (site public).
     *
     * @return Collection<int, Experience>
     */
    public function getAll(): Collection
    {
        return $this->experienceRepository->getOrderedByDate();
    }

    /**
     * Crée une nouvelle expérience.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Experience
    {
        return $this->experienceRepository->create($this->mapRoleToPosition($data));
    }

    /**
     * Met à jour une expérience.
     *
     * @param array<string, mixed> $data
     */
    public function update(Experience $experience, array $data): Experience
    {
        return $this->experienceRepository->update($experience, $this->mapRoleToPosition($data));
    }

    /**
     * L'API expose le champ « role », mais la colonne en base est « position ».
     *
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    private function mapRoleToPosition(array $data): array
    {
        if (array_key_exists('role', $data)) {
            $data['position'] = $data['role'];
            unset($data['role']);
        }

        return $data;
    }

    /**
     * Supprime une expérience.
     */
    public function delete(Experience $experience): void
    {
        $this->experienceRepository->delete($experience);
    }
}