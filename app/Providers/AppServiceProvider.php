<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;
use App\Services\CloudinaryService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Fix workaround: binding 'files' manquant dans cette release
        $this->app->singleton('files', function () {
            return new Filesystem();
        });

        $this->app->singleton(CloudinaryService::class, function () {
            return new CloudinaryService();
        });
    }

    public function boot(): void
    {
        // Configuration Cloudinary globale via variable d'environnement
        // Le SDK lit CLOUDINARY_URL automatiquement si définie dans .env
    }
}