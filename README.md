# 🚲 Stadtradeln Web-App (mit WebUntis-Login)

Diese Web-App ermöglicht es Schüler:innen einer Schule, ihre gefahrenen Kilometer während der Aktion **Stadtradeln** selbstständig online einzutragen. Die Daten werden klassenweise aggregiert und live als Balkendiagramm visualisiert.

## 🔐 Neu: WebUntis-Login

Nur angemeldete Schüler:innen mit gültigem WebUntis-Account erhalten Zugriff auf das Eingabeformular.

---

## 🌍 Live-Demo

**Landing Page:**  
➡️ [https://hornse.de/stadtradeln/landing.html](https://hornse.de/stadtradeln/landing.html)

---

## 📂 Projektstruktur

```plaintext
stadtradeln/
├── auth/                      # WebUntis-Login-Integration
│   ├── webuntis_config.php    # Konfiguration (ausfüllen!)
│   ├── login.php              # OAuth-Redirect zu WebUntis
│   └── callback.php           # Rückgabe-Verarbeitung
├── index.php                  # Authentifiziertes Eingabeformular + Diagramm
├── landing.html               # Öffentliche Einstiegsseite
├── submit.php                 # Speichert Einträge (geschützt)
├── data.php                   # Gibt JSON-Daten für das Diagramm zurück
├── style.css                  # Gemeinsames Styling
└── db.sqlite                  # SQLite-Datenbank (nach Init)
```

---

## 🚀 Installation auf Uberspace

1. Repository klonen oder entpacken nach `~/html/stadtradeln/`

```bash
git clone https://github.com/hornse/stadt-radeln-webapp.git ~/html/stadtradeln
```

2. Datenbank initialisieren (einmalig):

```bash
php ~/html/stadtradeln/init_db.php
```

> Danach `init_db.php` **löschen oder umbenennen**, um Missbrauch zu verhindern.

3. `webuntis_config.php` anpassen:

```php
return [
  'school' => 'DEINE_SCHULE',
  'url' => 'https://webuntis.com/WebUntis/',
  'client_id' => 'stadtradeln-app',
  'client_secret' => '...',
  'redirect_uri' => 'https://<deineDomain>/stadtradeln/auth/callback.php'
];
```

---

## 🖥️ Lokal testen

```bash
php -S localhost:8000 -t stadtradeln
```

Dann im Browser:
- `http://localhost:8000/landing.html`
- `http://localhost:8000/index.php` (nur mit Login)

> Achtung: WebUntis-Login funktioniert nur mit öffentlicher Domain.

---

## ✅ Features

- WebUntis-Login über OAuth 2.0
- Nur authentifizierte Nutzer:innen können Kilometer eintragen
- Live-Balkendiagramm mit Chart.js
- Schön gestaltete Landing Page
- Leichtgewichtig (kein Framework, nur PHP + JS)

---

## 🔒 Sicherheitshinweise

- Schütze `webuntis_config.php` vor Zugriff
- Lösche `init_db.php` nach Verwendung
- Session-Check schützt `submit.php` und `index.php` vor unbefugtem Zugriff

---

## 📜 Lizenz

MIT License – siehe [LICENSE](LICENSE)

