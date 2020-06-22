<?php
require_once(__DIR__ . "/session_lib.php");

// Prüfe, ob der POST-Parameter name existiert
if (isset($_POST['task'])) {

    // POST-Parameter abrufen
    $task = $_POST['task'];

    // Session starten
    startTodoSession();

    // Task entfernen
    removeTask($task);

}

// In jedem Fall erfolgt eine Weiterleitung auf die Startseite
header("Location: index.php");