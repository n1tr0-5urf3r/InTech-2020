<?php
require_once('hangman_lib.php');

session_start();

if( isset($_POST['letter']) )
{
    print($_POST['letter']);
    guessLetter($letter);
}else {
    print($_POST['letter']);
}
header("Location: hangman.php");

?>