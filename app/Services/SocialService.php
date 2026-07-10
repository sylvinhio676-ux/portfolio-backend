<?php

namespace App\Services;

use App\Models\Social;
use App\Repositories\Contracts\SocialRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SocialService
{
    public function __construct(
        private readonly SocialRepositoryInterface $socialRepository
    ) {}

    /**
     * Retourne les réseaux visibles (site public).
     *
     * @return Collection<int, Social>
     */
    public function getVisible(): Collection
    {
        return $this->socialRepository->getVisible();
    }

    /**
     * Retourne tous les réseaux (dashboard admin).
     *
     * @return Collection<int, Social>
     */
    public function getAll(): Collection
    {
        return $this->socialRepository->getOrdered();
    }

    /**
     * Crée un nouveau réseau social.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Social
    {
        return $this->socialRepository->create($data);
    }

    /**
     * Met à jour un réseau social.
     *
     * @param array<string, mixed> $data
     */
    public function update(Social $social, array $data): Social
    {
        return $this->socialRepository->update($social, $data);
    }

    /**
     * Supprime un réseau social.
     */
    public function delete(Social $social): void
    {
        $this->socialRepository->delete($social);
    }
}