<?php
require_once('hangman_lib.php');

// Init $_SESSION
session_start("zxmij86u8");
initGame();
// Redirect to game
header("Location: hangman.php");
?>