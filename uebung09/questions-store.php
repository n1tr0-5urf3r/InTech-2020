<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("db-lib.php");

    $question = $_POST['question'];
    $answer0 = $_POST['answer0'];
    $answer1 = $_POST['answer1'];
    $answer2 = $_POST['answer2'];
    $solution = $_POST['solution'];

    $db = new Database();
    $db->insertQuestion($question, $answer0, $answer1, $answer2, $solution);

    header("Location: questions-show.php");
}
