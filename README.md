XAMPP muss installiert werden und der entpackte Ordner in den htdocs Ordner in einen weiteren Ordner namens "hoteltropicana" entpackt werden.

XAMPP muss gestartet werden, "Apache" und "MySQL" müssen gestartet werden.

Bilderverkleinerung: Im XAMPP->Control Panel Bei Apache->Config->php.ini das ; vor extension=gd muss entfernt werden, damit das Thumbnail bei Newsupload erstellt werden kann.

Datenbank: Im XAMPP->Control Panel MySQL->Admin dort auf Neu und dann eine Datenbank namens "hotel" anlegen. Nun diese auf der linken Seite anklicken und dann auf importieren und die inkludierte "hotel.sql" importieren.

Oben auf Rechte und ein Benutzerkonto mit dem Namen "admin" erstellen mit "lokal" und keinem Passwort!
