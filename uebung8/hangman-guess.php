<?php
require_once('hangman_lib.php');

session_start();

if( isset($_POST['letter']) )
{
    guessLetter($letter);
}
header("Location: hangman.php");

?>