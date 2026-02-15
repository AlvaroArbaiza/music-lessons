# 🎵 Music Lessons - Sistema di Prenotazione Lezioni di Musica

Applicazione web sviluppata con Laravel 10 per la gestione e prenotazione di lezioni di musica. Gli utenti possono visualizzare le lezioni disponibili, prenotare slot orari e gestire le proprie prenotazioni.

## Funzionalità

- 🎵 **Catalogo Lezioni**: Visualizza tutte le lezioni di musica disponibili
- 📅 **Sistema di Prenotazione**: Prenota slot orari per le lezioni
- 👤 **Gestione Profilo**: Modifica il tuo profilo utente
- 🔐 **Autenticazione**: Sistema di login e registrazione (Laravel Breeze)
- 📊 **Dashboard Prenotazioni**: Visualizza e gestisci le tue prenotazioni

## Tecnologie Utilizzate

- **Backend**: Laravel 10, PHP 8.1+
- **Frontend**: Blade, Tailwind CSS, Alpine.js
- **Database**: MySQL
- **Build Tool**: Vite
- **Autenticazione**: Laravel Breeze

---

## 🖥️ Setup Locale

### Prerequisiti

- PHP 8.1+ e MySQL
- Composer
- Node.js & NPM

### Installazione

1. **Clona il repository e naviga nella cartella**
   ```bash
   cd music-lessons
   ```

2. **Installa le dipendenze PHP**
   ```bash
   composer install
   ```

3. **Installa le dipendenze Node**
   ```bash
   npm install
   ```

4. **Configura il database**
   - Avvia Apache e MySQL
   - Crea un nuovo database (es. `music_lessons`)

5. **Configura l'ambiente**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

6. **Modifica il file `.env`** con le tue credenziali:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=music_lessons
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. **Esegui le migrazioni**
   ```bash
   php artisan migrate
   ```

8. **Popola il database (opzionale)**
   ```bash
   php artisan db:seed
   ```

9. **Compila gli assets**
   ```bash
   npm run build
   npm run dev
   ```

10. **Avvia il server**
    ```bash
    php artisan serve
    ```

11. **Accedi all'applicazione**
    - URL es.: http://localhost:8000

---

## 🐳 Setup con Docker Desktop

### Prerequisiti

- Docker Desktop installato e avviato
- MySQL avviato (per il database)

### Installazione

1. **Crea il database**
   - Crea un nuovo database (es. `music_lessons`)

2. **Configura il file `.env`**

   Crea o modifica il file `.env` con queste impostazioni:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=host.docker.internal
   DB_PORT=3306
   DB_DATABASE=music_lessons
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   **Importante**: `host.docker.internal` permette al container Docker di connettersi al MySQL.

3. **Costruisci l'immagine Docker**
   ```bash
   docker build -t music-lessons .
   ```

4. **Avvia il container**
   ```bash
   docker run -d -p 8000:8000 --name music-lessons-app music-lessons
   ```

5. **Esegui le migrazioni** (prima volta)
   ```bash
   docker exec -it music-lessons-app php artisan migrate
   docker exec -it music-lessons-app php artisan db:seed
   ```

6. **Accedi all'applicazione**
   - URL: http://localhost:8000

### Comandi Docker Utili

```bash
# Visualizza i log
docker logs -f music-lessons-app

# Accedi al container
docker exec -it music-lessons-app bash

# Esegui comandi artisan
docker exec -it music-lessons-app php artisan [comando]

# Ferma il container
docker stop music-lessons-app

# Riavvia il container
docker start music-lessons-app

# Rimuovi il container
docker rm -f music-lessons-app

# Ricostruisci dopo modifiche al codice
docker build -t music-lessons . --no-cache
docker rm -f music-lessons-app
docker run -d -p 8000:8000 --name music-lessons-app music-lessons
```

---