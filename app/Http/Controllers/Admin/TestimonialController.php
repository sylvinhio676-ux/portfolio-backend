<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Testimonial\StoreTestimonialRequest;
use App\Http\Requests\Testimonial\UpdateTestimonialRequest;
use App\Http\Resources\TestimonialResource;
use App\Services\TestimonialService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class TestimonialController extends Controller
{
    public function __construct(
        private readonly TestimonialService $testimonialService
    ) {}

    /**
     * Liste tous les témoignages
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $testimonials = $this->testimonialService->getAll();
            return ApiResponse::success(
                TestimonialResource::collection($testimonials),
                'Témoignages récupérés avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des témoignages',
                $e->getMessage()
            );
        }
    }

    /**
     * Crée un nouveau témoignage
     *
     * @param StoreTestimonialRequest $request
     * @return JsonResponse
     */
    public function store(StoreTestimonialRequest $request): JsonResponse
    {
        try {
            $testimonial = $this->testimonialService->create($request->validated());
            return ApiResponse::created(
                new TestimonialResource($testimonial),
                'Témoignage créé avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la création du témoignage',
                $e->getMessage()
            );
        }
    }

    /**
     * Met à jour un témoignage
     *
     * @param UpdateTestimonialRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateTestimonialRequest $request, int $id): JsonResponse
    {
        try {
            $testimonial = $this->testimonialService->getAll()->find($id);
            
            if (!$testimonial) {
                return ApiResponse::notFound('Témoignage non trouvé');
            }

            $updatedTestimonial = $this->testimonialService->update($testimonial, $request->validated());
            
            return ApiResponse::success(
                new TestimonialResource($updatedTestimonial),
                'Témoignage mis à jour avec succès'
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la mise à jour du témoignage',
                $e->getMessage()
            );
        }
    }

    /**
     * Supprime un témoignage
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $testimonial = $this->testimonialService->getAll()->find($id);
            
            if (!$testimonial) {
                return ApiResponse::notFound('Témoignage non trouvé');
            }

            $this->testimonialService->delete($testimonial);
            
            return ApiResponse::message('Témoignage supprimé avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la suppression du témoignage',
                $e->getMessage()
            );
        }
    }
}