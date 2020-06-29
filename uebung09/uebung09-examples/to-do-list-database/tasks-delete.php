<?php
require_once(__DIR__ . "/inc/Database.php");

$id = $_POST['id'];

$db = new Database();
$db->deleteTask($id);

header("Location: index.php");