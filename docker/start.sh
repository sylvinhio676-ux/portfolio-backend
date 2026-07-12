#!/usr/bin/env sh
# Script de démarrage du conteneur sur Render.
set -e

# Render impose le port d'écoute via $PORT (80 en local par défaut).
: "${PORT:=80}"
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Migrations à chaque déploiement (idempotent).
php artisan migrate --force

# Seed contrôlé : ne s'exécute QUE si RUN_SEED=true (à remettre à false ensuite
# pour éviter tout doublon aux redéploiements suivants).
if [ "${RUN_SEED}" = "true" ]; then
    echo ">>> RUN_SEED=true → seeding de la base…"
    php artisan db:seed --force
fi

# Seed CIBLÉ des modules Formations & Certifications (idempotent) : ne s'exécute
# QUE si RUN_MODULES_SEED=true. Ne duplique pas les autres données. À remettre à
# false après le premier déploiement réussi.
if [ "${RUN_MODULES_SEED}" = "true" ]; then
    echo ">>> RUN_MODULES_SEED=true → seeding des modules Formations & Certifications…"
    php artisan modules:seed
fi

# Lance Apache au premier plan.
exec apache2-foreground
