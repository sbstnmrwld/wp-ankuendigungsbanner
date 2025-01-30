# Ankündigungsbanner

## Beschreibung

Das **Ankündigungsbanner**-Plugin fügt eine einzeilige Meldung im Header der Website hinzu. Diese kann entweder als einfacher Text oder als Link angezeigt werden. Die Meldung kann im Admin-Bereich konfiguriert werden.

## Funktionen

- Aktivieren oder Deaktivieren der Ankündigungsleiste
- Textbasierte Meldung oder verlinkte Meldung anzeigen
- Link aus den vorhandenen WordPress-Seiten auswählen
- Anpassbare Schriftgröße
- Einfache Bedienung über das Admin-Panel

## Installation

1. Lade den Plugin-Ordner `ankuendigungsbanner` in das Verzeichnis `/wp-content/plugins/` deiner WordPress-Installation hoch.
2. Aktiviere das Plugin über die **Plugins**-Seite im WordPress-Adminbereich.
3. Konfiguriere das Plugin über das Menü **Ankündigungsbanner** in der WordPress-Administration.

## Verwendung

1. Navigiere zu **Einstellungen → Ankündigungsbanner**.
2. Trage die gewünschte Meldung in das Textfeld ein.
3. Wähle den Meldungstyp:
   - **Text**: Zeigt nur eine Textnachricht an.
   - **Link**: Erstellt einen klickbaren Link aus der Nachricht.
4. Falls **Link** ausgewählt wurde, wähle eine Zielseite aus.
5. Passe die Schriftgröße nach Bedarf an.
6. Speichere die Änderungen.

## Entwicklung

### Hooks & Actions

- **`wp_body_open`**: Fügt das Banner beim Öffnen des `<body>`-Tags hinzu.
- **`wp_head`**: Fügt CSS-Stile für das Banner in den `<head>`-Bereich ein.
- **`admin_menu`**: Erstellt den Menüpunkt im Admin-Panel.
- **`register_activation_hook(__FILE__, 'ab_activate')`**: Setzt Standardoptionen bei Plugin-Aktivierung.
- **`register_deactivation_hook(__FILE__, 'ab_deactivate')`**: Entfernt Optionen bei Deaktivierung.

### Sicherheit

- **`sanitize_text_field()`**: Entfernt unsichere HTML-Elemente aus den Eingaben.
- **`esc_url()`**: Sichert URL-Eingaben.
- **`wp_kses_post()`**: Sichert die Ausgabe von HTML-Inhalten.

<!-- ## Screenshots

### Admin-Einstellungen:
![Einstellungsseite des Plugins](screenshot-1.png)

### Beispiel-Banner:
![Ankündigungsbanner auf einer Website](screenshot-2.png) -->

## Lizenz

Dieses Plugin ist unter der **GPL-2.0** oder höher lizenziert.
