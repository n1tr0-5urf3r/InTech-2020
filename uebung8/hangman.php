<?php
    session_start();
    if (!isset($_SESSION['toGuess'])) {
        header("Location: hangman-init.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hangman Wörter</title>
</head>
<body>
    <h1>Wörter raten</h1>

    <?php
        // Display mask
        print("<p>");
        foreach ($_SESSION["mask"] as $char){
            print("{$char} ");
        }
        print("</p>");
    ?>
    <form action="hangman-guess.php" method="POST">
        <?php
        $allLetters = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        $notUsed = array_diff($allLetters, $_SESSION["guessedLetters"]);
        foreach ($notUsed as $letter){
            print("<input type='submit' name='letter' value='{$letter}'>");
        }
        print("<p>Bisherige Fehlversuche {$_SESSION['errorCount']} / 8</p>");
        print("<p>DEBUG: Wort: {$_SESSION['toGuess']}</p>");

        ?>
    </form>


</body>
</html>