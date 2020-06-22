<?php
require_once('hangman_lib.php');

session_name("zxmij86u08");
session_start();

if( isset($_POST["letter"]) ) {
    guessLetter($_POST["letter"]);
}
header("Location: hangman.php");

?>