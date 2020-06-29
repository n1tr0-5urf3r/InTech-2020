<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("db-lib.php");

    $id = $_POST['id'];

    $db = new Database();
    $db->deleteQuestion($id);

    header("Location: questions-show.php");
}
