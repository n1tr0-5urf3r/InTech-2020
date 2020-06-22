<?php
require_once(__DIR__ . "/session_lib.php");

// Session starten
startTodoSession();

// Tasks zurücksetzen
resetTasks();

// Weiterleitung auf die Startseite
header("Location: index.php");
