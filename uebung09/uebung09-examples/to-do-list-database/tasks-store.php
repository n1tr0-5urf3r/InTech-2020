<?php
require_once(__DIR__ . "/inc/Database.php");

$name = $_POST['name'];

// Nur nicht leere Tasks sollen gespeichert werden
if (!empty($name) && !empty(trim($name))) {

    $db = new Database();
    $db->addTask($name);
}


header("Location: index.php");