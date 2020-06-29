<?php

// ----------------------------------------------------
// ZUGANGSDATEN
// ----------------------------------------------------

// Hier: Automatisch auslesen aus .my.cnf. Sonst einfach von Hand eintragen
$user = get_current_user(); // Benutzer, dem diese Datei gehört!
$myCnf = parse_ini_file("/home/$user/.my.cnf");

$host = $myCnf['host'];
$user = $myCnf['user'];
$password = $myCnf['password'];
$database = $myCnf['database'];


// ----------------------------------------------------
// Prepared Statement für alles außer SELECT
// ----------------------------------------------------

// Variablen, die wir einfügen wollen
// Diese kommen normalerweise aus einem POST-Request
$string = "Ein String";
$integer = 12345;

// Verbindung aufbauen
$mysqli = new mysqli($host, $user, $password, $database);

// Prepare: Für jede Variable ein ?
$statement = $mysqli->prepare("INSERT INTO t VALUES(?, ?)");

// Parameter binden: Für jedes ? Typ (s=String, i=Integer) und Variable angeben
$statement->bind_param("si", $string, $integer);

// Query ausführen
$statement->execute();

// Statement schließen
$statement->close();

// Verbindung schließen
$mysqli->close();


// ----------------------------------------------------
// Prepared Statement bei SELECT-Queries
// ----------------------------------------------------

// Variablen, die wir in der Query verwenden wollen
// Diese kommt normalerweise aus einem GET- oder POST-Request
// Das %-Zeichen ist ein Platzhalter und bedeutet "hier darf irgendwas stehen"
$search_string = "%String%";


// Verbindung aufbauen
$mysqli = new mysqli($host, $user, $password, $database);

// Prepare: Für jede Variable ein ?
$statement = $mysqli->prepare("SELECT * FROM t WHERE string_column LIKE ?");

// Parameter binden: Für jedes ? Typ (s=String, i=Integer) und Variable angeben
$statement->bind_param("s", $search_string);

// Query ausführen
$statement->execute();

// Ergebnis an variablen binden: Für jede Spalte aus dem Result-Set eine Variable
// Hier zwei Spalten => zwei Variablen!
$statement->bind_result($string_column, $integer_column);

// Über das Result-Set iterieren (fetch_assoc() geht hier NICHT!)
while ($statement->fetch()) {
    // Die Variablen aus bind_result werden jetzt mit Werten aus dem Result-Set gefüllt!
    echo "string_column hat den Wert: $string_column. ";
    echo "integer_column hat den Wert: $integer_column. ";
    echo "\n";
}


// Speicher des Result-Sets freigeben
$statement->free_result();

// Statement schließen (Speicher des Statements freigeben)
$statement->close();

// Verbindung schließen
$mysqli->close();