SCSS-master eine Mastervorlage zum Erstellen von CSS mit SASS

1. Diese Vorlage kann in allen Projekten verwendet werden

2. Es können CSS-Dateien zu unterschiedlichen Layout-Varianten eines Projekts 
erstellt werden.
2.1 Front End (styles.scss daraus wird die styles.css kompilieren) wird fast 
immer im Projekt benötigt
2.2 Back End der Site (back-end-styles.scss)
2.3 bei Bedarf für bestimmte Werbekampagnen

3. Pflege und erweiterung dieser Mastervorlage

2. Verzeichnistruktur

scss-master
    | variables
        | global // z.B.: Farben nach ihren Namen (bei Änderungen in Proekten die Master-Vorlage erweitern)
        | base
            | after-usage // z.B.: Farben nach ihrer Verwendung
            | elements // Variablen für die einzelnen HTML-Elemente
            | fonts // Variablen für die Schriften z.B.: Konfiguration für das einbinden einer Schrift
            | layout
    | utilities
        | mixins
            | _global.scss
            | _grid.scss
        | functions
            | _global.scss
            | _grid.scss
    | abstacts // grundsätzliche Festlegungen
        | base // eigene Festlegungen (Reset, Normalize, Base)
            | elements  // eigene Festlegungen für alle HTML-Elemente
            | fonts // alle @font-face der vorhandenen Schriften
            | layout // Layout elemente (z.B.: das Grid)
        | extensions // fremde (wird von mir nicht verwendet)

        | variants // Hier die einzelnen Styles-Varianten des Projekts alegen
            | base-styles // Test für die Base
                | variables // hier nur Konfiguration
            | default-styles // Variante für die default Templates
                | variables // Überschreiben der Base-Variablen
                | queries
                    | layout
                        |segments // Bereiche des Grund-Layouts (kommen nur einmal auf einer Seite vor)
                            | _messages.scss // Flash messanger template
                            | _navigation.scss // Hauptnavigation Bereich
                            | _site-footer.scss
                            | _site-header.scss
                    | partials
                        | nav-bars
                            | _pagination_control_default.scss
                    | components
                        | content-header // Header im Hauptinhalt auf jeder Seite

*** Run SASS global from project root ***

** Create base-styles.css nur zum Testen der Base**
sass scss-master/base-styles.scss css/base-styles.css

** Create styles.css **
sass scss-master/default-styles.scss css/styles.css