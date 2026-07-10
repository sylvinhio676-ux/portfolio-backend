<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
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
     * Récupère tous les témoignages visibles
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $testimonials = $this->testimonialService->getVisible();
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
}