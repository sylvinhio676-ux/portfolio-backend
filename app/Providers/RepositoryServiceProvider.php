<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * 
 * Service Provider pour l'injection des dépendances des repositories
 * Lie chaque interface à son implémentation
 */
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Enregistrement des services.
     *
     * @return void
     */
    public function register(): void
    {
        // Contracts → Eloquent Repositories
        $this->app->bind(
            \App\Repositories\Contracts\AboutRepositoryInterface::class,
            \App\Repositories\Eloquent\AboutRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\SettingRepositoryInterface::class,
            \App\Repositories\Eloquent\SettingRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\SeoSettingRepositoryInterface::class,
            \App\Repositories\Eloquent\SeoSettingRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\SkillCategoryRepositoryInterface::class,
            \App\Repositories\Eloquent\SkillCategoryRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\SkillRepositoryInterface::class,
            \App\Repositories\Eloquent\SkillRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\ServiceRepositoryInterface::class,
            \App\Repositories\Eloquent\ServiceRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\SocialRepositoryInterface::class,
            \App\Repositories\Eloquent\SocialRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\TestimonialRepositoryInterface::class,
            \App\Repositories\Eloquent\TestimonialRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\ExperienceRepositoryInterface::class,
            \App\Repositories\Eloquent\ExperienceRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\ProjectRepositoryInterface::class,
            \App\Repositories\Eloquent\ProjectRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\ProjectImageRepositoryInterface::class,
            \App\Repositories\Eloquent\ProjectImageRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\ProjectTechnologyRepositoryInterface::class,
            \App\Repositories\Eloquent\ProjectTechnologyRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\WorkflowStepRepositoryInterface::class,
            \App\Repositories\Eloquent\WorkflowStepRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\CertificationRepositoryInterface::class,
            \App\Repositories\Eloquent\CertificationRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\CertificationDocumentRepositoryInterface::class,
            \App\Repositories\Eloquent\CertificationDocumentRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\EducationRepositoryInterface::class,
            \App\Repositories\Eloquent\EducationRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\EducationDocumentRepositoryInterface::class,
            \App\Repositories\Eloquent\EducationDocumentRepository::class
        );
    }

    /**
     * Services à démarrer après l'enregistrement.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}