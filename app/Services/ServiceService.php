<?php

namespace App\Services;

use App\Models\Service;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ServiceService
{
    public function __construct(
        private readonly ServiceRepositoryInterface $serviceRepository
    ) {}

    /**
     * Retourne les services visibles (site public).
     *
     * @return Collection<int, Service>
     */
    public function getVisible(): Collection
    {
        return $this->serviceRepository->getVisible();
    }

    /**
     * Retourne tous les services (dashboard admin).
     *
     * @return Collection<int, Service>
     */
    public function getAll(): Collection
    {
        return $this->serviceRepository->getOrdered();
    }

    /**
     * Crée un nouveau service.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Service
    {
        return $this->serviceRepository->create($data);
    }

    /**
     * Met à jour un service existant.
     *
     * @param array<string, mixed> $data
     */
    public function update(Service $service, array $data): Service
    {
        return $this->serviceRepository->update($service, $data);
    }

    /**
     * Supprime un service.
     */
    public function delete(Service $service): void
    {
        $this->serviceRepository->delete($service);
    }
}