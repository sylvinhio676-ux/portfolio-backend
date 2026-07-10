<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Services\AboutService;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;

class AboutController extends Controller
{
    public function __construct(
        private readonly AboutService $aboutService
    ) {}

    public function show(): JsonResponse
    {
        try {
            $about = $this->aboutService->get();
            return ApiResponse::success(new AboutResource($about));
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des informations',
                $e->getMessage()
            );
        }
    }
}