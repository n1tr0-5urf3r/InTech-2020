<?php
require_once(__DIR__ . "/inc/Database.php");

$db = new Database();
$db->reset();

header("Location: index.php");
