<?php

namespace App\Services;

use App\Models\Testimonial;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TestimonialService
{
    public function __construct(
        private readonly TestimonialRepositoryInterface $testimonialRepository
    ) {}

    /**
     * Retourne les témoignages visibles (site public).
     *
     * @return Collection<int, Testimonial>
     */
    public function getVisible(): Collection
    {
        return $this->testimonialRepository->getVisible();
    }

    /**
     * Retourne tous les témoignages (dashboard admin).
     *
     * @return Collection<int, Testimonial>
     */
    public function getAll(): Collection
    {
        return $this->testimonialRepository->all();
    }

    /**
     * Crée un nouveau témoignage.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Testimonial
    {
        return $this->testimonialRepository->create($data);
    }

    /**
     * Met à jour un témoignage.
     *
     * @param array<string, mixed> $data
     */
    public function update(Testimonial $testimonial, array $data): Testimonial
    {
        return $this->testimonialRepository->update($testimonial, $data);
    }

    /**
     * Supprime un témoignage.
     */
    public function delete(Testimonial $testimonial): void
    {
        $this->testimonialRepository->delete($testimonial);
    }
}