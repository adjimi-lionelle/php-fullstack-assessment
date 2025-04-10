#!/bin/bash
set -e  # Arrêter le script si une commande échoue

# Installer les dépendances Composer (avec celles de développement)
composer install

# Créer la base de données si elle n'existe pas encore
php bin/console doctrine:database:create --if-not-exists

# Générer un fichier de migration s'il n'y en a pas
if [ ! -d "migrations" ] || [ -z "$(ls -A migrations)" ]; then
    echo "Aucune migration trouvée, génération d'une nouvelle migration..."
    php bin/console make:migration
fi

# Appliquer les migrations de la base de données
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

# Charger les fixtures
php bin/console doctrine:fixture:load --no-interaction

# Démarrer PHP-FPM pour exécuter l'application Symfony
php-fpm