#!/bin/sh
# Script de vérification pour Render
echo "--- Vérification des assets principaux ---"
if [ ! -f public/assets/css/main.css ]; then
  echo "ERREUR: public/assets/css/main.css manquant !"
  exit 1
fi
if [ ! -f public/assets/js/app.js ]; then
  echo "ERREUR: public/assets/js/app.js manquant !"
  exit 1
fi
echo "Assets principaux présents."

echo "--- Vérification du cache Laravel ---"
php artisan config:clear && php artisan view:clear && php artisan cache:clear || true
echo "Caches Laravel nettoyés."

echo "--- Vérification terminée ---"