#!/usr/bin/env sh
# Script de démarrage du conteneur sur Render.
set -e

# Render impose le port d'écoute via $PORT (80 en local par défaut).
: "${PORT:=80}"
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/:80>/:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# Migrations à chaque déploiement (idempotent).
php artisan migrate --force

# Lance Apache au premier plan.
exec apache2-foreground
