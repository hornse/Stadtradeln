# Stadtradeln Web-App

Einfache Web-App zur Erfassung und Visualisierung von gefahrenen Kilometern pro Klasse.

## 📂 Struktur

- `index.html` – Eingabeformular + Chart.js-Diagramm
- `submit.php` – speichert Einträge in SQLite
- `data.php` – liefert JSON-Daten für das Diagramm
- `init_db.php` – erzeugt einmalig die Datenbank
- `db.sqlite` – entsteht automatisch nach dem ersten Eintrag

## 🚀 Installation auf Uberspace

1. Dateien nach `~/html/stadtradeln/` hochladen
2. `init_db.php` im Browser aufrufen:  
   `https://<username>.uber.space/stadtradeln/init_db.php`  
   → danach die Datei zur Sicherheit löschen.
3. Web-App nutzen unter:  
   `https://<username>.uber.space/stadtradeln/index.html`
