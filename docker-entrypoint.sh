#!/bin/bash

echo "Starting Music Lessons Application..."

# Crea il file .env se non esiste
if [ ! -f ".env" ]; then
  echo "Creating .env file from .env.example..."
  cp .env.example .env
  php artisan key:generate
  echo "IMPORTANTE: Configura il DB_HOST=host.docker.internal nel file .env per connetterti a XAMPP"
fi

# Crea link per lo storage se non esiste
if [ ! -L "public/storage" ]; then
  echo "Creating storage link..."
  php artisan storage:link
fi

# Pulisci cache
echo "Clearing cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

echo ""
echo "========================================="
echo "  Music Lessons Application is ready!"
echo "========================================="
echo "  URL: http://localhost:8000"
echo ""
echo "  Database: Assicurati che nel .env:"
echo "  DB_HOST=host.docker.internal"
echo "  DB_PORT=3306"
echo "  DB_DATABASE=[il tuo database XAMPP]"
echo "========================================="
echo ""

# Avvia il server Laravel
php artisan serve --host=0.0.0.0 --port=8000
