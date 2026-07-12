<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Seed ciblé des modules Formations & Certifications.
 *
 * Idempotent (les seeders sautent si des données existent déjà), donc sûr à
 * lancer en production : il ne touche QUE ces deux modules et ne duplique pas
 * les autres données (à l'inverse de `db:seed` complet).
 */
class SeedModules extends Command
{
    protected $signature = 'modules:seed';

    protected $description = 'Seed uniquement les modules Formations & Certifications (idempotent).';

    public function handle(): int
    {
        $this->info('Seeding des modules Formations & Certifications…');
        $this->call('db:seed', ['--class' => 'EducationSeeder', '--force' => true]);
        $this->call('db:seed', ['--class' => 'CertificationSeeder', '--force' => true]);
        $this->info('Modules seedés.');

        return self::SUCCESS;
    }
}
