<?php
require_once('hangman_lib.php');

// Init $_SESSION
session_name("zxmij86u08");
session_start();

initGame();
// Redirect to game
header("Location: hangman.php");
?>