# Notizen-App - Einstellungstest für Kosatec

Dies ist eine einfache Notizen-App, die im Rahmen eines Einstellungstests für Kosatec entwickelt wurde. Die Anwendung ermöglicht das Erstellen, Bearbeiten, Löschen und Priorisieren von Notizen.

## Features

- **Notizverwaltung**: Erstellen, Anzeigen, Bearbeiten und Löschen von Notizen.
- **Priorisierung**: Notizen können als "wichtig" markiert werden und erscheinen automatisch ganz oben in der Liste.
- **Echtzeit-Interaktion**: Dank Laravel Livewire werden Aktionen ohne vollständigen Seiten-Reload ausgeführt.
- **Lokalisierung**: Die Anwendung ist auf die Zeitzone `Europe/Berlin` konfiguriert, um korrekte Zeitstempel anzuzeigen.
- **Modernes Design**: Gestaltet mit Tailwind CSS für ein responsives und sauberes Interface. (Ich bin kein Mediengestalter, da ich aber aktuell auch TailwindCSS verwende habe ich die Inhalte einiger custom Elementer unserer Mediangestaltung recycled. Ich habe mich für das Verwenden von Emojis entschieden, da ich explizit keine anderen Bibliotheken wie Flaticon dazu installieren sollte.)

## Tech Stack

- **Framework**: Laravel 11
- **Frontend**: Livewire 3 & Tailwind CSS
- **Datenbank**: SQLite (Standardmäßig konfiguriert)
- **Tests**: PHPUnit (Feature-Tests für die Kernfunktionalität)

## Voraussetzungen für WSL

Bevor du beginnst, stelle sicher, dass folgende Software in WSL installiert ist:

```bash
# System aktualisieren
sudo apt update && sudo apt upgrade -y

# PHP 8.2+ und benötigte Extensions installieren
sudo apt install -y php php-cli php-mbstring php-xml php-curl php-zip php-sqlite3 unzip

# Composer installieren
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Node.js und npm installieren (über NodeSource)
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

## Installation in WSL

Folge diesen Schritten, um das Projekt in WSL aufzusetzen:

### 1. Repository klonen

**Wichtig**: Klone das Projekt direkt in das WSL-Dateisystem (z.B. in `/home/deinbenutzername/`), **NICHT** in `/mnt/c/`. Das verhindert Berechtigungsprobleme und Performance-Einbußen.

```bash
cd ~
git clone <repository-url> notizen-app
cd notizen-app
```

### 2. Berechtigungen setzen

```bash
# Storage- und Cache-Ordner beschreibbar machen
chmod -R 775 storage bootstrap/cache
```

### 3. Umgebungsdatei konfigurieren

```bash
cp .env.example .env
```

### 4. Composer Abhängigkeiten installieren

```bash
composer install
php artisan key:generate
```

### 5. NPM Abhängigkeiten installieren

```bash
npm install
npm run build
```

### 6. SQLite-Datenbank erstellen

```bash
# Datenbank-Datei erstellen
touch database/database.sqlite

# Migrationen ausführen
php artisan migrate
```

### 7. Server starten

```bash
php artisan serve
```

Die Anwendung ist nun unter `http://localhost:8000` erreichbar.

## Tests ausführen

Das Projekt enthält automatisierte Feature-Tests, um die Funktionalität sicherzustellen (Validierung, Sortierung, CRUD-Operationen).

```bash
php artisan test
```

## Häufige WSL-Probleme und Lösungen

### Berechtigungsfehler bei storage/logs

```bash
chmod -R 775 storage bootstrap/cache
```

### "Permission denied" beim Schreiben von Logs

```bash
# Stelle sicher, dass du der Besitzer der Dateien bist
sudo chown -R $USER:$USER storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

### Langsame Performance

Stelle sicher, dass das Projekt im WSL-Dateisystem liegt (`/home/...`), nicht unter `/mnt/c/`. Dateizugriffe über das gemountete Windows-Dateisystem sind deutlich langsamer.

### Composer ist langsam

```bash
# Composer mit mehr Memory ausführen
COMPOSER_MEMORY_LIMIT=-1 composer install
```

## Entwicklung mit WSL-Tipps

- **VS Code**: Nutze die "Remote - WSL" Extension, um direkt in WSL zu entwickeln
- **Dateizugriff**: Greife auf deine WSL-Dateien in Windows über `\\wsl$\Ubuntu\home\deinbenutzername\` zu
- **Git**: Konfiguriere Git in WSL separat von deiner Windows-Installation

```bash
git config --global user.name "Dein Name"
git config --global user.email "deine@email.de"
```

## Nützliche Befehle

```bash
# Entwicklungsserver starten
php artisan serve

# Assets neu kompilieren (bei CSS/JS-Änderungen)
npm run dev

# Tests ausführen
php artisan test

# Cache leeren (bei Problemen)
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Datenbank zurücksetzen
php artisan migrate:fresh
```

## Besonderheiten im Projekt

- **Sortierlogik**: In `app/Livewire/Notes/Index.php` werden Notizen zuerst nach Wichtigkeit (`is_important`) und dann nach Aktualität sortiert.
- **Validierung**: Titel und Inhalt der Notizen werden serverseitig validiert, um Datenintegrität zu gewährleisten.

---

**HINWEIS**: Diese README wurde per KI erstellt. Der eigentliche Code allerdings nicht. Aus Gründen der Transparenz war es mir wichtig, dies noch einmal anzumerken.

Hintergrund des Ganzen ist meine Lese-Rechtschreibschwäche und die verbundene Herausforderung, meine eigenen Texte auf semantische Fehler zu prüfen.

Wenn ich mir die README generieren lasse, muss ich idr. nur mit Logikfehlern rechnen, was mir das Bearbeiten um einiges erleichtert.
