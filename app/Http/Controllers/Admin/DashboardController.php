<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Experience;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    /**
     * Récupère les statistiques du tableau de bord
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $stats = [
                'projects' => Project::count(),
                'projects_published' => Project::where('status', 'published')->count(),
                'skills' => Skill::count(),
                'services' => Service::count(),
                'testimonials' => Testimonial::count(),
                'testimonials_visible' => Testimonial::where('is_visible', true)->count(),
                'experiences' => Experience::count(),
            ];

            return ApiResponse::success($stats, 'Statistiques récupérées avec succès');
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Erreur lors de la récupération des statistiques',
                $e->getMessage()
            );
        }
    }
}