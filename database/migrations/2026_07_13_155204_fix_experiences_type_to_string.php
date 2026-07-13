<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Corrige la colonne `type` des expériences : la contrainte enum d'origine
     * (['job','freelance','project','formation']) ne correspondait pas aux
     * valeurs réellement utilisées par l'application (job / freelance / personal
     * / academic), d'où une violation de contrainte CHECK en PostgreSQL.
     * On transforme la colonne en simple chaîne ; la validation des valeurs
     * reste assurée par les Form Requests (in:job,freelance,personal,academic).
     */
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            // Supprime la contrainte CHECK générée par enum(), puis passe en varchar.
            DB::statement('ALTER TABLE experiences DROP CONSTRAINT IF EXISTS experiences_type_check');
            DB::statement('ALTER TABLE experiences ALTER COLUMN type TYPE varchar(30)');
            DB::statement("ALTER TABLE experiences ALTER COLUMN type SET DEFAULT 'job'");
        } elseif ($driver === 'mysql') {
            // Convertit l'ENUM MySQL en VARCHAR (accepte alors toutes les valeurs).
            DB::statement("ALTER TABLE experiences MODIFY type VARCHAR(30) NOT NULL DEFAULT 'job'");
        }
        // sqlite : aucune contrainte CHECK n'est appliquée, rien à faire.
    }

    /**
     * Correctif non réversible : on ne restaure pas la contrainte enum incohérente.
     */
    public function down(): void
    {
        // Volontairement vide.
    }
};
