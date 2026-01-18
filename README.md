# Notizen-App - Einstellungstest für Kosatec

Dies ist eine einfache Notizen-App, die im Rahmen eines Einstellungstests für Kosatec entwickelt wurde. Die Anwendung ermöglicht das Erstellen, Bearbeiten, Löschen und Priorisieren von Notizen.

## Features

- **Notizverwaltung**: Erstellen, Anzeigen, Bearbeiten und Löschen von Notizen.
- **Priorisierung**: Notizen können als "wichtig" markiert werden und erscheinen automatisch ganz oben in der Liste.
- **Echtzeit-Interaktion**: Dank Laravel Livewire werden Aktionen ohne vollständigen Seiten-Reload ausgeführt.
- **Lokalisierung**: Die Anwendung ist auf die Zeitzone `Europe/Berlin` konfiguriert, um korrekte Zeitstempel anzuzeigen.
- **Modernes Design**: Gestaltet mit Tailwind CSS für ein responsives und sauberes Interface.

## Tech Stack

- **Framework**: Laravel 11
- **Frontend**: Livewire 3 & Tailwind CSS
- **Datenbank**: SQLite (Standardmäßig konfiguriert)
- **Tests**: PHPUnit (Feature-Tests für die Kernfunktionalität)

## Installation

Folge diesen Schritten, um das Projekt lokal aufzusetzen:

1. **Repository klonen**
2. **Abhängigkeiten installieren**
   ```bash
   composer install
   npm install && npm run build
   ```
3. **Umgebungsdatei konfigurieren**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Datenbank vorbereiten**
   (Stelle sicher, dass eine leere `database/database.sqlite` Datei existiert, falls SQLite genutzt wird)
   ```bash
   php artisan migrate
   ```
5. **Server starten**
   ```bash
   php artisan serve
   ```

## Tests ausführen

Das Projekt enthält automatisierte Feature-Tests, um die Funktionalität sicherzustellen (Validierung, Sortierung, CRUD-Operationen).

```bash
php artisan test
```

## Besonderheiten im Projekt

- **Sortierlogik**: In `app/Livewire/Notes/Index.php` werden Notizen zuerst nach Wichtigkeit (`is_important`) und dann nach Aktualität sortiert.
- **Validierung**: Titel und Inhalt der Notizen werden serverseitig validiert, um Datenintegrität zu gewährleisten.


HINWEIS: Diese README wurde per KI erstellt. Der eigentliche Code allerdings nicht. Aus Gründen der Transparenz war es mir wichtig, dies noch einmal anzumerken.
Hintergrund des Ganzen ist meine Lese-Rechtschreibschwäche und die verbundene Herausforderung, meine eigenen Texte auf semantische Fehler zu prüfen.
Wenn ich mir die README generieren lasse, muss ich idr. nur mit Logikfehlern rechnen, was mir das Bearbeiten um einiges erleichtert.
