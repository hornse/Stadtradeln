# 🚲 Stadtradeln Web-App (mit WebUntis-Login)

Diese Web-App ermöglicht es Schüler:innen einer Schule, ihre gefahrenen Kilometer während der Aktion **Stadtradeln** selbstständig online einzutragen. Die Daten werden klassenweise aggregiert und live als Balkendiagramm visualisiert.

## 🔐 Neu: WebUntis-Login

Nur angemeldete Schüler:innen mit gültigem WebUntis-Account erhalten Zugriff auf das Eingabeformular. Danke an Mike für das Bereitstellen.

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
