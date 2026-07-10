<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\SeoController;
use App\Http\Controllers\Public\SkillCategoryController;
use App\Http\Controllers\Public\SkillController;
use App\Http\Controllers\Public\ServiceController;
use App\Http\Controllers\Public\SocialController;
use App\Http\Controllers\Public\TestimonialController;
use App\Http\Controllers\Public\ExperienceController;
use App\Http\Controllers\Public\ProjectController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\WorkflowStepController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

// ============= Admin Controllers =============
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\SkillCategoryController as AdminSkillCategoryController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\SocialController as AdminSocialController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\SeoController as AdminSeoController;
use App\Http\Controllers\Admin\WorkflowStepController as AdminWorkflowStepController;
use App\Http\Controllers\Admin\MediaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Route de test
Route::get('/test', function () {
    return response()->json([
        'message' => 'API Portfolio OS is working!',
        'version' => 'v1',
        'status' => 'ready',
    ]);
});

// === ROUTES PUBLIQUES (sans authentification) ===
// À propos
Route::get('/about', [AboutController::class, 'show']);

// SEO
Route::get('/seo/{page}', [SeoController::class, 'show']);

// Catégories de compétences
Route::get('/skill-categories', [SkillCategoryController::class, 'index']);

// Compétences
Route::get('/skills', [SkillController::class, 'index']);

// Services
Route::get('/services', [ServiceController::class, 'index']);

// Réseaux sociaux
Route::get('/socials', [SocialController::class, 'index']);

// Témoignages
Route::get('/testimonials', [TestimonialController::class, 'index']);

// Expériences
Route::get('/experience', [ExperienceController::class, 'index']);

// Projets
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);

// Contact
Route::post('/contact', [ContactController::class, 'send']);

// Étapes de la méthode de travail (section About)
Route::get('/workflow-steps', [WorkflowStepController::class, 'index']);

/**
 * +--------------------------------------------------------------------------  
 *  Routes Admin (avec authentification)                                      |
 * +--------------------------------------------------------------------------
 */

Route::prefix('admin')->group(function () {
    // Authentification (publiques pour login)
    Route::post('/auth/login', [AuthController::class, 'login']);
    
    // Routes protégées par authentification
    Route::middleware(['api.auth'])->group(function () {
        // Authentification
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/user', [AuthController::class, 'user']);
        
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index']);
        
        // Projets
        Route::get('/projects', [AdminProjectController::class, 'index']);
        Route::post('/projects', [AdminProjectController::class, 'store']);
        Route::put('/projects/{id}', [AdminProjectController::class, 'update']);
        Route::delete('/projects/{id}', [AdminProjectController::class, 'destroy']);
        Route::post('/projects/{id}/images', [AdminProjectController::class, 'addImages']);
        Route::delete('/projects/{id}/images/{imageId}', [AdminProjectController::class, 'deleteImage']);
        
        // Compétences
        Route::get('/skills', [AdminSkillController::class, 'index']);
        Route::post('/skills', [AdminSkillController::class, 'store']);
        Route::put('/skills/{id}', [AdminSkillController::class, 'update']);
        Route::delete('/skills/{id}', [AdminSkillController::class, 'destroy']);
        
        // Catégories de compétences
        Route::get('/skill-categories', [AdminSkillCategoryController::class, 'index']);
        Route::post('/skill-categories', [AdminSkillCategoryController::class, 'store']);
        Route::put('/skill-categories/{id}', [AdminSkillCategoryController::class, 'update']);
        Route::delete('/skill-categories/{id}', [AdminSkillCategoryController::class, 'destroy']);
        
        // Services
        Route::get('/services', [AdminServiceController::class, 'index']);
        Route::post('/services', [AdminServiceController::class, 'store']);
        Route::put('/services/{id}', [AdminServiceController::class, 'update']);
        Route::delete('/services/{id}', [AdminServiceController::class, 'destroy']);
        
        // Expériences
        Route::get('/experience', [AdminExperienceController::class, 'index']);
        Route::post('/experience', [AdminExperienceController::class, 'store']);
        Route::put('/experience/{id}', [AdminExperienceController::class, 'update']);
        Route::delete('/experience/{id}', [AdminExperienceController::class, 'destroy']);
        
        // Témoignages
        Route::get('/testimonials', [AdminTestimonialController::class, 'index']);
        Route::post('/testimonials', [AdminTestimonialController::class, 'store']);
        Route::put('/testimonials/{id}', [AdminTestimonialController::class, 'update']);
        Route::delete('/testimonials/{id}', [AdminTestimonialController::class, 'destroy']);
        
        // Réseaux sociaux
        Route::get('/socials', [AdminSocialController::class, 'index']);
        Route::post('/socials', [AdminSocialController::class, 'store']);
        Route::put('/socials/{id}', [AdminSocialController::class, 'update']);
        Route::delete('/socials/{id}', [AdminSocialController::class, 'destroy']);
        
        // À propos
        Route::get('/about', [AdminAboutController::class, 'show']);
        Route::put('/about', [AdminAboutController::class, 'update']);

        // Étapes de la méthode de travail
        Route::get('/workflow-steps', [AdminWorkflowStepController::class, 'index']);
        Route::post('/workflow-steps', [AdminWorkflowStepController::class, 'store']);
        Route::put('/workflow-steps/{id}', [AdminWorkflowStepController::class, 'update']);
        Route::delete('/workflow-steps/{id}', [AdminWorkflowStepController::class, 'destroy']);
        
        
        // SEO
        Route::get('/seo/{page}', [AdminSeoController::class, 'show']);
        Route::put('/seo/{page}', [AdminSeoController::class, 'update']);
        
        // Médias
        Route::post('/media/upload', [MediaController::class, 'upload']);
        Route::delete('/media/delete', [MediaController::class, 'delete']);
    });
});
